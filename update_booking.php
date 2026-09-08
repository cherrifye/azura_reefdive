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

$booking_id = (int) ($_POST["booking_id"] ?? 0);

$status = $_POST["status"] ?? "";

$allowedStatuses = [
    "pending",
    "confirmed",
    "completed",
    "cancelled"
];

if (
    $booking_id <= 0 ||
    !in_array($status, $allowedStatuses, true)
) {
    header("Location: admin_dashboard.php");
    exit;
}

$stmt = $conn->prepare(
    "UPDATE bookings
     SET booking_status = ?
     WHERE id = ?"
);

$stmt->bind_param(
    "si",
    $status,
    $booking_id
);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: admin_dashboard.php");
exit;
?>