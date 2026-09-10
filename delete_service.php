<?php

session_start();

require_once "db.php";

/* =========================
   ADMIN ONLY
========================= */

if (
    !isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin"
) {
    header("Location: login.php");
    exit;
}


/* =========================
   POST ONLY
========================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: manage_services.php");
    exit;
}


/* =========================
   GET SERVICE ID
========================= */

$service_id =
    isset($_POST["service_id"])
        ? (int) $_POST["service_id"]
        : 0;

if ($service_id <= 0) {
    header("Location: manage_services.php");
    exit;
}


/* =========================
   DELETE SERVICE
========================= */

$stmt = $conn->prepare(
    "DELETE FROM services
     WHERE id = ?"
);

$stmt->bind_param(
    "i",
    $service_id
);

$stmt->execute();

$stmt->close();

$conn->close();


/* =========================
   BACK TO SERVICES
========================= */

header("Location: manage_services.php");
exit;

?>