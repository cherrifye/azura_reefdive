<?php
session_start();

require_once "db.php";

/* Admin only */

if (
    !isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin"
) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: admin_dashboard.php");
    exit;
}

$booking_id =
    (int) ($_POST["booking_id"] ?? 0);

$payment_status =
    $_POST["payment_status"] ?? "";

$allowedStatuses = [
    "unpaid",
    "pending",
    "paid"
];

if (
    $booking_id <= 0 ||
    !in_array(
        $payment_status,
        $allowedStatuses,
        true
    )
) {
    header("Location: admin_dashboard.php");
    exit;
}

$stmt = $conn->prepare(
    "UPDATE bookings
     SET payment_status = ?
     WHERE id = ?"
);

$stmt->bind_param(
    "si",
    $payment_status,
    $booking_id
);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: admin_dashboard.php");
exit;
?>