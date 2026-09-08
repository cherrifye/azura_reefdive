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
   ADMIN REDIRECT
========================= */

if (
    ($_SESSION["role"] ?? "") === "admin"
) {

    header("Location: admin_dashboard.php");
    exit;

}


/* =========================
   GET CUSTOMER BOOKINGS
========================= */

$user_id =
    $_SESSION["user_id"];


$stmt =
    $conn->prepare(
        "
        SELECT *
        FROM bookings
        WHERE user_id = ?
        ORDER BY created_at DESC
        "
    );


$stmt->bind_param(
    "i",
    $user_id
);


$stmt->execute();


$bookings =
    $stmt->get_result();

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
My Bookings | Azura Reef
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

    background:
        var(--mint-50);

}


.my-bookings-page {

    min-height:
        100vh;

}


/* =========================
   HEADER
========================= */

.account-header {

    background:
        white;

    border-bottom:
        1px solid var(--border);

}


.account-nav {

    max-width:
        1140px;

    margin:
        auto;

    padding:
        18px 20px;

    display:
        flex;

    justify-content:
        space-between;

    align-items:
        center;

    gap:
        20px;

}


.account-brand {

    font-family:
        "Fraunces",
        serif;

    font-size:
        1.5rem;

    font-weight:
        700;

    color:
        var(--teal-900);

    text-decoration:
        none;

}


.account-actions {

    display:
        flex;

    align-items:
        center;

    gap:
        16px;

}


.account-actions span {

    color:
        var(--muted);

    font-size:
        .9rem;

}


.account-actions a {

    color:
        var(--teal-900);

    text-decoration:
        none;

    font-weight:
        600;

    font-size:
        .9rem;

}


/* =========================
   PAGE
========================= */

.bookings-container {

    max-width:
        1000px;

    margin:
        auto;

    padding:
        55px 20px 80px;

}


.page-heading {

    margin-bottom:
        30px;

}


.page-heading h1 {

    font-family:
        "Fraunces",
        serif;

    color:
        var(--teal-900);

    font-size:
        2.5rem;

    margin-bottom:
        8px;

}


.page-heading p {

    color:
        var(--muted);

}


/* =========================
   BOOKING CARD
========================= */

.booking-card {

    background:
        white;

    border-radius:
        18px;

    padding:
        28px;

    margin-bottom:
        22px;

    box-shadow:
        var(--shadow);

    border:
        1px solid var(--border);

}


.booking-card-top {

    display:
        flex;

    justify-content:
        space-between;

    align-items:
        flex-start;

    gap:
        20px;

    margin-bottom:
        25px;

}


.booking-number {

    color:
        var(--muted);

    font-size:
        .82rem;

    margin-bottom:
        5px;

}


.service-name {

    font-family:
        "Fraunces",
        serif;

    color:
        var(--teal-900);

    font-size:
        1.55rem;

}


/* =========================
   STATUS
========================= */

.booking-status,
.payment-status {

    display:
        inline-block;

    padding:
        8px 14px;

    border-radius:
        999px;

    font-size:
        .75rem;

    font-weight:
        700;

    letter-spacing:
        .03em;

}


.pending {

    background:
        #fff4cf;

    color:
        #8a6511;

}


.confirmed {

    background:
        #e4f5ed;

    color:
        #1f684c;

}


.completed {

    background:
        #e5eef9;

    color:
        #315c8e;

}


.cancelled {

    background:
        #fde9e9;

    color:
        #983939;

}


.unpaid {

    background:
        #fde9e9;

    color:
        #983939;

}


.paid {

    background:
        #e4f5ed;

    color:
        #1f684c;

}


/* =========================
   BOOKING DETAILS
========================= */

.booking-details {

    display:
        grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap:
        18px 25px;

    margin-bottom:
        24px;

}


.detail-box {

    background:
        var(--mint-50);

    border-radius:
        12px;

    padding:
        15px;

}


.detail-label {

    color:
        var(--muted);

    font-size:
        .78rem;

    margin-bottom:
        5px;

}


.detail-value {

    color:
        var(--ink);

    font-weight:
        600;

    line-height:
        1.5;

}


/* =========================
   PAYMENT
========================= */

.payment-box {

    border-top:
        1px solid var(--border);

    padding-top:
        22px;

    margin-top:
        5px;

}


.payment-box h3 {

    color:
        var(--teal-900);

    margin-bottom:
        15px;

    font-size:
        1.05rem;

}


.payment-row {

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        15px;

    margin-bottom:
        12px;

}


.payment-label {

    color:
        var(--muted);

}


.payment-method {

    font-weight:
        700;

    color:
        var(--teal-900);

}


/* =========================
   MESSAGES
========================= */

.status-message {

    margin-top:
        18px;

    padding:
        14px 16px;

    border-radius:
        10px;

    background:
        var(--mint-50);

    color:
        var(--muted);

    font-size:
        .9rem;

    line-height:
        1.5;

}


/* =========================
   BUTTONS
========================= */

.booking-actions {

    margin-top:
        22px;

    display:
        flex;

    gap:
        12px;

    flex-wrap:
        wrap;

}


.booking-actions .btn {

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    text-decoration:
        none;

}


.booking-actions .btn-outline {

    background:
        white;

    color:
        var(--teal-900);

    border:
        2px solid var(--teal-900);

    padding:
        11px 18px;

    border-radius:
        10px;

    font-weight:
        600;

}


.booking-actions
.btn-outline:hover {

    background:
        var(--teal-900);

    color:
        white;

}


/* =========================
   EMPTY STATE
========================= */

.empty-state {

    text-align:
        center;

    background:
        white;

    border-radius:
        18px;

    padding:
        60px 25px;

    box-shadow:
        var(--shadow);

}


.empty-state h2 {

    font-family:
        "Fraunces",
        serif;

    color:
        var(--teal-900);

    margin-bottom:
        10px;

}


.empty-state p {

    color:
        var(--muted);

    margin-bottom:
        25px;

}


/* =========================
   MOBILE
========================= */

@media(max-width: 700px) {

    .account-nav,
    .booking-card-top,
    .payment-row {

        flex-direction:
            column;

        align-items:
            flex-start;

    }


    .booking-details {

        grid-template-columns:
            1fr;

    }

}


</style>


</head>



<body>


<div class="my-bookings-page">


<!-- =========================
     HEADER
========================= -->

<header class="account-header">


<div class="account-nav">


<a
    href="index.php"
    class="account-brand"
>
Azura Reef
</a>


<div class="account-actions">


<span>

Hi,

<?= htmlspecialchars(
    $_SESSION["first_name"]
    ?? "Customer"
) ?>

</span>


<a href="index.php">
Home
</a>


<a href="logout.php">
Log Out
</a>


</div>


</div>


</header>



<!-- =========================
     MAIN
========================= -->

<main class="bookings-container">


<div class="page-heading">


<h1>
My Bookings
</h1>


<p>
View your booking and payment status.
</p>


</div>



<?php if (
    $bookings->num_rows > 0
): ?>



<?php while (
    $booking =
        $bookings->fetch_assoc()
): ?>



<?php


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


if (
    $payment_method === "gcash"
) {

    $payment_method_label =
        "GCash";

} elseif (
    $payment_method === "card"
) {

    $payment_method_label =
        "Credit / Debit Card";

} else {

    $payment_method_label =
        "Cash";

}


/* =========================
   BOOKING MESSAGE
========================= */

if (
    $booking_status ===
    "confirmed"
) {

    $status_message =
        "✓ Your booking has been confirmed by Azura Reef.";

} elseif (
    $booking_status ===
    "completed"
) {

    $status_message =
        "✓ This booking has been completed.";

} elseif (
    $booking_status ===
    "cancelled"
) {

    $status_message =
        "This booking has been cancelled.";

} else {

    $status_message =
        "Your booking has been received and is waiting for confirmation from Azura Reef.";

}


/* =========================
   PAYMENT MESSAGE
========================= */

if (
    $payment_method === "gcash" &&
    $payment_status === "pending"
) {

    $payment_message =
        "Your GCash payment proof has been submitted and is waiting for admin verification.";

} elseif (
    $payment_method === "gcash" &&
    $payment_status === "paid"
) {

    $payment_message =
        "✓ Your GCash payment has been verified.";

} elseif (
    $payment_method === "cash" &&
    $payment_status === "paid"
) {

    $payment_message =
        "✓ Your cash payment has been marked as paid.";

} elseif (
    $payment_method === "cash"
) {

    $payment_message =
        "Payment will be made in cash.";

} elseif (
    $payment_method === "card" &&
    $payment_status === "paid"
) {

    $payment_message =
        "✓ Demo card payment completed.";

} else {

    $payment_message =
        "Payment status is currently "
        . $payment_status
        . ".";

}


?>



<!-- =========================
     ONE BOOKING CARD
========================= -->

<div class="booking-card">


<!-- TOP -->

<div class="booking-card-top">


<div>


<div class="booking-number">

Booking No.

AZR-<?= str_pad(
    $booking["id"],
    4,
    "0",
    STR_PAD_LEFT
) ?>

</div>


<div class="service-name">

<?= htmlspecialchars(
    $booking["service_name"]
) ?>

</div>


</div>



<span
    class="
        booking-status
        <?= htmlspecialchars(
            $booking_status
        ) ?>
    "
>

<?= strtoupper(
    htmlspecialchars(
        $booking_status
    )
) ?>

</span>


</div>



<!-- =========================
     BOOKING DETAILS
========================= -->

<div class="booking-details">


<!-- DATE -->

<div class="detail-box">


<div class="detail-label">
Booking Date
</div>


<div class="detail-value">

<?= htmlspecialchars(
    $booking["booking_date"]
) ?>

</div>


</div>



<!-- TIME -->

<div class="detail-box">


<div class="detail-label">
Booking Time
</div>


<div class="detail-value">

<?= htmlspecialchars(
    $booking["booking_time"]
) ?>

</div>


</div>



<!-- GUESTS -->

<div class="detail-box">


<div class="detail-label">
Guests
</div>


<div class="detail-value">

<?= htmlspecialchars(
    $booking["guests"]
) ?>

</div>


</div>



<!-- EQUIPMENT -->

<div class="detail-box">


<div class="detail-label">
Equipment
</div>


<div class="detail-value">


<?php if (
    !empty(
        $booking["rental_gear"]
    )
): ?>


<?= htmlspecialchars(
    $booking["rental_gear"]
) ?>


<?php elseif (
    ($booking["equipment"] ?? "")
    === "Yes"
): ?>


Rental equipment requested


<?php else: ?>


I have my own equipment


<?php endif; ?>


</div>


</div>


</div>



<!-- =========================
     PAYMENT
========================= -->

<div class="payment-box">


<h3>
Payment Information
</h3>



<div class="payment-row">


<span class="payment-label">
Payment Method
</span>


<span class="payment-method">

<?= htmlspecialchars(
    $payment_method_label
) ?>

</span>


</div>



<div class="payment-row">


<span class="payment-label">
Payment Status
</span>


<span
    class="
        payment-status
        <?= htmlspecialchars(
            $payment_status
        ) ?>
    "
>

<?= strtoupper(
    htmlspecialchars(
        $payment_status
    )
) ?>

</span>


</div>



<div class="status-message">

<?= htmlspecialchars(
    $payment_message
) ?>

</div>


</div>



<!-- =========================
     BOOKING STATUS MESSAGE
========================= -->

<div class="status-message">


<strong>
Booking Status:
</strong>

<br>


<?= htmlspecialchars(
    $status_message
) ?>


</div>



<!-- =========================
     ACTIONS
========================= -->

<div class="booking-actions">


<a
    href="confirmation.php?id=<?= (int) $booking["id"] ?>"
    class="btn btn-outline"
>
View Receipt
</a>


<a
    href="booking.php"
    class="btn btn-dark"
>
Book Another
</a>


</div>


</div>

<!-- END ONE BOOKING CARD -->



<?php endwhile; ?>



<?php else: ?>



<!-- =========================
     NO BOOKINGS
========================= -->

<div class="empty-state">


<h2>
No Bookings Yet
</h2>


<p>
You haven't made any bookings yet.
</p>


<a
    href="booking.php"
    class="btn btn-dark"
>
Book Your First Dive
</a>


</div>



<?php endif; ?>


</main>


</div>


</body>


</html>


<?php


$stmt->close();

$conn->close();


?>