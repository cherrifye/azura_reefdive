<?php

session_start();

require_once "db.php";

/* ADMIN ONLY */
if (
    !isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin"
) {
    header("Location: login.php");
    exit;
}

/* POST ONLY */
if (
    $_SERVER["REQUEST_METHOD"] !== "POST"
) {
    header("Location: admin_dashboard.php");
    exit;
}

$booking_id =
    (int) ($_POST["booking_id"] ?? 0);

$status =
    $_POST["status"] ?? "";

$allowedStatuses = [
    "pending",
    "confirmed",
    "completed",
    "cancelled"
];

if (
    $booking_id <= 0 ||
    !in_array(
        $status,
        $allowedStatuses,
        true
    )
) {
    header("Location: admin_dashboard.php");
    exit;
}

$conn->begin_transaction();

try {

    $booking_stmt =
        $conn->prepare(
            "
            SELECT
                booking_status,
                schedule_id,
                guests
            FROM bookings
            WHERE id = ?
            FOR UPDATE
            "
        );

    if (!$booking_stmt) {
        throw new Exception(
            "Unable to prepare booking check."
        );
    }

    $booking_stmt->bind_param(
        "i",
        $booking_id
    );

    $booking_stmt->execute();

    $booking_result =
        $booking_stmt->get_result();

    $booking =
        $booking_result->fetch_assoc();

    $booking_stmt->close();


    if (!$booking) {
        throw new Exception(
            "Booking not found."
        );
    }


    $current_status =
        $booking["booking_status"];

    $schedule_id =
        $booking["schedule_id"] !== null
            ? (int) $booking["schedule_id"]
            : null;

    $guests =
        (int) $booking["guests"];


    /* DO NOT REOPEN CANCELLED BOOKINGS */
    if (
        $current_status === "cancelled" &&
        $status !== "cancelled"
    ) {
        throw new Exception(
            "Cancelled bookings cannot be reopened."
        );
    }


    /* RETURN SLOTS WHEN CANCELLED */
    if (
        $status === "cancelled" &&
        $current_status !== "cancelled" &&
        $schedule_id !== null
    ) {

        $slot_stmt =
            $conn->prepare(
                "
                UPDATE dive_schedules
                SET available_slots =
                    available_slots + ?
                WHERE id = ?
                "
            );

        if (!$slot_stmt) {
            throw new Exception(
                "Unable to prepare slot return."
            );
        }

        $slot_stmt->bind_param(
            "ii",
            $guests,
            $schedule_id
        );

        $slot_stmt->execute();

        $slot_stmt->close();
    }


    /* UPDATE BOOKING STATUS */
    $update_stmt =
        $conn->prepare(
            "
            UPDATE bookings
            SET booking_status = ?
            WHERE id = ?
            "
        );

    if (!$update_stmt) {
        throw new Exception(
            "Unable to prepare booking update."
        );
    }

    $update_stmt->bind_param(
        "si",
        $status,
        $booking_id
    );

    $update_stmt->execute();

    $update_stmt->close();


    $conn->commit();

    $conn->close();

    header(
        "Location: admin_dashboard.php"
    );

    exit;

} catch (Throwable $e) {

    $conn->rollback();

    error_log(
        "Booking status update error: "
        . $e->getMessage()
    );

    $conn->close();

    die(
        htmlspecialchars(
            $e->getMessage()
        )
    );
}

?>