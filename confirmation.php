<?php

session_start();

require_once "db.php";


/* =========================
   LOGIN CHECK
========================= */

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}


/* =========================
   BOOKING ID
========================= */

$booking_id =
    (int) ($_GET["id"] ?? 0);

if ($booking_id <= 0) {
    header("Location: index.php");
    exit;
}


/* =========================
   GET BOOKING SECURELY
========================= */

$user_id =
    (int) $_SESSION["user_id"];

$role =
    $_SESSION["role"] ?? "customer";


if ($role === "admin") {

    /*
       Admin may view any booking receipt.
    */

    $stmt = $conn->prepare(
        "SELECT *
         FROM bookings
         WHERE id = ?"
    );

    $stmt->bind_param(
        "i",
        $booking_id
    );

} else {

    /*
       Customer may only view
       their own booking receipt.
    */

    $stmt = $conn->prepare(
        "SELECT *
         FROM bookings
         WHERE id = ?
         AND user_id = ?"
    );

    $stmt->bind_param(
        "ii",
        $booking_id,
        $user_id
    );

}


$stmt->execute();

$result =
    $stmt->get_result();

$booking =
    $result->fetch_assoc();


/* =========================
   BOOKING NOT FOUND / NO ACCESS
========================= */

if (!$booking) {

    if ($role === "admin") {
        header(
            "Location: admin_dashboard.php"
        );
    } else {
        header(
            "Location: my_bookings.php"
        );
    }

    exit;
}


/* =========================
   BOOKING STATUS
========================= */

$booking_status =
    strtolower(
        $booking["booking_status"]
        ?? "pending"
    );


/* =========================
   PAYMENT STATUS
========================= */

$payment_status =
    strtolower(
        $booking["payment_status"]
        ?? "unpaid"
    );


/* =========================
   PAYMENT METHOD
========================= */

$payment_method =
    strtolower(
        $booking["payment_method"]
        ?? "cash"
    );


if ($payment_method === "gcash") {

    $payment_method_label =
        "GCash";

} elseif ($payment_method === "card") {

    $payment_method_label =
        "Credit / Debit Card";

} else {

    $payment_method_label =
        "Cash";

}


/* =========================
   RECEIPT NUMBER
========================= */

$receipt_number =
    "AZR-" .
    str_pad(
        $booking["id"],
        4,
        "0",
        STR_PAD_LEFT
    );

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
Booking Receipt | Azura Reef
</title>

<link
    rel="preconnect"
    href="https://fonts.googleapis.com"
>

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="style.css"
>

<style>

body {
    background: var(--mint-50);
}

.receipt-page {
    min-height: 100vh;
    padding: 25px 15px;
}

.receipt-container {
    max-width: 600px;
    margin: auto;
}

.receipt-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
}

.receipt-header {
    text-align: center;
    padding-bottom: 18px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 18px;
}

.receipt-header h1 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 1.7rem;
    margin-bottom: 4px;
}

.receipt-header p {
    color: var(--muted);
    font-size: .85rem;
}

.receipt-number {
    margin-top: 8px;
    font-size: .85rem;
    font-weight: 700;
    color: var(--teal-900);
}

.receipt-section {
    margin-bottom: 18px;
}

.receipt-section h2 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 1.05rem;
    margin-bottom: 10px;
}

.receipt-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.receipt-item {
    background: var(--mint-50);
    border-radius: 9px;
    padding: 10px 12px;
}

.receipt-label {
    font-size: .7rem;
    color: var(--muted);
    margin-bottom: 3px;
}

.receipt-value {
    font-size: .85rem;
    font-weight: 600;
    color: var(--ink);
}

.status-badge {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 999px;
    font-size: .65rem;
    font-weight: 700;
    text-transform: uppercase;
}

.message-box {
    background: var(--mint-50);
    padding: 10px 12px;
    border-radius: 9px;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.4;
    margin-top: 10px;
}

.receipt-actions {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
}

.receipt-actions .btn {
    padding: 9px 14px;
    font-size: .8rem;
}

.print-btn {
    border: none;
    cursor: pointer;
}

@media(max-width: 650px) {

    .receipt-grid {
        grid-template-columns: 1fr;
    }

    .receipt-card {
        padding: 24px;
    }

}

@media print {

    body {
        background: white;
    }

    .receipt-page {
        padding: 0;
    }

    .receipt-card {
        box-shadow: none;
        border: none;
    }

    .receipt-actions {
        display: none;
    }

}

</style>

</head>

<body>

<div class="receipt-page">

<div class="receipt-container">

<div class="receipt-card">


<div class="receipt-header">

<h1>
Azura Reef Dive
</h1>

<p>
Booking & Payment Receipt
</p>

<div class="receipt-number">

Receipt No:
<?= htmlspecialchars($receipt_number) ?>

</div>

</div>



<div class="receipt-section">

<h2>
Customer Information
</h2>

<div class="receipt-grid">


<div class="receipt-item">

<div class="receipt-label">
Customer Name
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["full_name"]
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Email
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["email"]
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Phone
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["phone"]
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Guests
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["guests"]
) ?>

</div>

</div>


</div>

</div>



<div class="receipt-section">

<h2>
Booking Details
</h2>

<div class="receipt-grid">


<div class="receipt-item">

<div class="receipt-label">
Service
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["service_name"]
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Service Type
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    ucfirst(
        $booking["service_type"]
    )
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Booking Date
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["booking_date"]
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Booking Time
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["booking_time"]
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Equipment
</div>

<div class="receipt-value">

<?php if (
    !empty($booking["rental_gear"])
): ?>

    <?= htmlspecialchars(
        $booking["rental_gear"]
    ) ?>

<?php elseif (
    ($booking["equipment"] ?? "") === "Yes"
): ?>

    Rental equipment requested

<?php else: ?>

    I have my own equipment

<?php endif; ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Certification
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $booking["certification"]
) ?>

</div>

</div>


</div>

</div>



<div class="receipt-section">

<h2>
Payment Information
</h2>

<div class="receipt-grid">


<div class="receipt-item">

<div class="receipt-label">
Payment Method
</div>

<div class="receipt-value">

<?= htmlspecialchars(
    $payment_method_label
) ?>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Payment Status
</div>

<div class="receipt-value">

<span
class="status-badge <?= htmlspecialchars(
    $payment_status
) ?>"
>

<?= strtoupper(
    htmlspecialchars(
        $payment_status
    )
) ?>

</span>

</div>

</div>


<div class="receipt-item">

<div class="receipt-label">
Booking Status
</div>

<div class="receipt-value">

<span
class="status-badge <?= htmlspecialchars(
    $booking_status
) ?>"
>

<?= strtoupper(
    htmlspecialchars(
        $booking_status
    )
) ?>

</span>

</div>

</div>


</div>


<div class="message-box">

<?php if (
    $payment_method === "gcash" &&
    $payment_status === "pending"
): ?>

Your GCash payment proof has been submitted and is waiting for admin verification.

<?php elseif (
    $payment_method === "gcash" &&
    $payment_status === "paid"
): ?>

Your GCash payment has been verified.

<?php elseif (
    $payment_method === "cash" &&
    $payment_status === "unpaid"
): ?>

Payment will be made in cash.

<?php elseif (
    $payment_method === "cash" &&
    $payment_status === "paid"
): ?>

Cash payment has been recorded as paid.

<?php elseif (
    $payment_method === "card"
): ?>

Demo card payment recorded successfully.

<?php endif; ?>

</div>

</div>



<div class="receipt-actions">

<a
    href="index.php"
    class="btn btn-dark"
>
Back to Home
</a>


<?php if (
    isset($_SESSION["user_id"]) &&
    ($_SESSION["role"] ?? "") === "customer"
): ?>

<a
    href="my_bookings.php"
    class="btn btn-outline"
>
My Bookings
</a>

<?php endif; ?>


<a
    href="booking.php"
    class="btn btn-dark"
>
Book Another
</a>


<button
    type="button"
    onclick="window.print()"
    class="btn btn-dark print-btn"
>
Print Receipt
</button>

</div>


</div>

</div>

</div>


</body>

</html>

<?php

$stmt->close();
$conn->close();

?>