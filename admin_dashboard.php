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
   DASHBOARD COUNTS
========================= */

$totalBookingsResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM bookings"
    );

$totalBookings =
    $totalBookingsResult
        ->fetch_assoc()["total"];


$pendingBookingsResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM bookings
         WHERE booking_status = 'pending'"
    );

$pendingBookings =
    $pendingBookingsResult
        ->fetch_assoc()["total"];


$confirmedBookingsResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM bookings
         WHERE booking_status = 'confirmed'"
    );

$confirmedBookings =
    $confirmedBookingsResult
        ->fetch_assoc()["total"];


$totalCustomersResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM users
         WHERE role = 'customer'"
    );

$totalCustomers =
    $totalCustomersResult
        ->fetch_assoc()["total"];


/* =========================
   GET BOOKINGS
========================= */

$bookings =
    $conn->query(
        "SELECT *
         FROM bookings
         ORDER BY created_at DESC"
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

<title>Admin Dashboard | Azura Reef</title>


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

/* =========================
   GENERAL
========================= */

body {
    background: var(--mint-50);
}

.admin-page {
    min-height: 100vh;
}


/* =========================
   HEADER
========================= */

.admin-header {
    background: white;

    border-bottom:
        1px solid var(--border);

    position: relative;
    z-index: 20;
}

.admin-nav {
    max-width: 1300px;
    min-height: 76px;

    margin: auto;
    padding: 0 20px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    gap: 30px;
}

.admin-brand {
    display: flex;
    align-items: center;

    text-decoration: none;
}

.admin-brand img {
    width: 125px;
    height: 52px;

    object-fit: contain;
}

.admin-center {
    display: flex;
    align-items: center;

    gap: 8px;

    color: var(--teal-900);

    font-size: .76rem;
    font-weight: 700;

    letter-spacing: .08em;
    text-transform: uppercase;
}

.admin-dot {
    width: 7px;
    height: 7px;

    background: var(--teal-500);

    border-radius: 50%;
}

.admin-links {
    display: flex;
    align-items: center;

    gap: 15px;
}

.admin-welcome {
    color: var(--muted);

    font-size: .78rem;

    white-space: nowrap;
}

.admin-welcome strong {
    color: var(--teal-900);
}

.admin-links a {
    color: var(--teal-900);

    text-decoration: none;

    font-size: .78rem;
    font-weight: 700;

    transition: color .2s;
}

.admin-links a:hover {
    color: var(--teal-500);
}


/* =========================
   DASHBOARD HERO
========================= */

.admin-hero {
    position: relative;

    min-height: 285px;

    display: flex;
    align-items: center;

    background:
        url("images/watercorals.jpg")
        center 48% / cover no-repeat;

    overflow: hidden;
}

.admin-hero::before {
    content: "";

    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(8, 48, 45, .96) 0%,
            rgba(8, 48, 45, .86) 48%,
            rgba(8, 48, 45, .48) 100%
        );
}

.admin-hero-content {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 1300px;

    margin: auto;
    padding: 50px 20px;

    color: white;
}

.hero-eyebrow {
    display: block;

    margin-bottom: 12px;

    color: #c7e4dc;

    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .17em;
}

.admin-hero h1 {
    margin: 0 0 12px;

    color: white;

    font-family: "Fraunces", serif;

    font-size:
        clamp(2.5rem, 5vw, 4rem);

    font-weight: 600;

    line-height: 1;

    letter-spacing: -.03em;
}

.admin-hero h1 em {
    color: #c9e4dc;

    font-weight: 500;
}

.admin-hero p {
    max-width: 520px;

    margin: 0;

    color:
        rgba(255,255,255,.8);

    font-size: .88rem;
    line-height: 1.7;
}


/* =========================
   DASHBOARD
========================= */

.dashboard {
    max-width: 1300px;

    margin: auto;

    padding:
        55px 20px 85px;
}


/* =========================
   DASHBOARD TITLE
========================= */

.dashboard-title {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 25px;

    margin-bottom: 27px;
}

.dashboard-title-left {
    max-width: 600px;
}

.section-eyebrow {
    display: block;

    margin-bottom: 8px;

    color: var(--teal-500);

    font-size: .67rem;
    font-weight: 700;

    letter-spacing: .15em;
}

.dashboard-title h2 {
    margin: 0 0 7px;

    color: var(--teal-900);

    font-family: "Fraunces", serif;

    font-size: 2.2rem;
    font-weight: 600;
}

.dashboard-title p {
    margin: 0;

    color: var(--muted);

    font-size: .86rem;
    line-height: 1.6;
}

.view-site-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    padding: 11px 17px;

    background: white;

    color: var(--teal-900);

    border:
        1px solid var(--teal-900);

    border-radius: 9px;

    text-decoration: none;

    font-size: .76rem;
    font-weight: 700;

    transition: .2s;
}

.view-site-btn:hover {
    background: var(--teal-900);
    color: white;
}


/* =========================
   STATS
========================= */

.stats {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 15px;

    margin-bottom: 42px;
}

.stat-card {
    position: relative;

    min-height: 135px;

    background: white;

    border:
        1px solid var(--border);

    border-radius: 16px;

    padding: 21px;

    overflow: hidden;

    box-shadow:
        0 18px 40px -32px
        rgba(13, 58, 55, .5);

    transition:
        transform .2s,
        box-shadow .2s;
}

.stat-card:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 24px 45px -32px
        rgba(13, 58, 55, .55);
}

.stat-card::after {
    content: "";

    position: absolute;

    width: 65px;
    height: 65px;

    right: -20px;
    top: -20px;

    background:
        var(--mint-100);

    border-radius: 50%;
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 17px;
}

.stat-label {
    color: var(--muted);

    font-size: .72rem;
    font-weight: 600;
}

.stat-number {
    position: relative;
    z-index: 2;

    color: var(--teal-900);

    font-family: "Fraunces", serif;

    font-size: 2.35rem;
    font-weight: 700;

    line-height: 1;
}

.stat-note {
    margin-top: 8px;

    color: #8aa09a;

    font-size: .66rem;
}


/* =========================
   MANAGEMENT HEADING
========================= */

.management-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 20px;

    margin-bottom: 17px;
}

.management-heading h2 {
    margin: 0 0 5px;

    color: var(--teal-900);

    font-family: "Fraunces", serif;

    font-size: 1.75rem;
}

.management-heading p {
    margin: 0;

    color: var(--muted);

    font-size: .8rem;
}


/* =========================
   TABLE CARD
========================= */

.table-card {
    background: white;

    border:
        1px solid var(--border);

    border-radius: 18px;

    box-shadow:
        0 20px 45px -34px
        rgba(13, 58, 55, .5);

    overflow: hidden;
}

.table-scroll {
    overflow-x: auto;
}

table {
    width: 100%;

    min-width: 1180px;

    border-collapse: collapse;
}

thead {
    background:
        var(--teal-900);
}

th {
    padding: 15px 13px;

    color:
        rgba(255,255,255,.8);

    text-align: left;

    font-size: .66rem;
    font-weight: 700;

    letter-spacing: .06em;
    text-transform: uppercase;
}

td {
    padding: 17px 13px;

    border-bottom:
        1px solid var(--border);

    vertical-align: top;

    color: var(--ink);

    font-size: .79rem;

    line-height: 1.5;
}

tbody tr {
    transition:
        background .2s;
}

tbody tr:hover {
    background:
        var(--mint-50);
}

tbody tr:last-child td {
    border-bottom: none;
}


/* =========================
   TABLE DETAILS
========================= */

.booking-code {
    color: var(--teal-900);

    font-weight: 700;

    white-space: nowrap;
}

.customer-name {
    color: var(--teal-900);

    font-weight: 700;
}

.customer-email {
    display: inline-block;

    margin-top: 3px;

    color: var(--muted);

    font-size: .69rem;
}

.service-title {
    color: var(--teal-900);

    font-weight: 700;
}

.service-type {
    display: inline-block;

    margin-top: 3px;

    color: var(--muted);

    font-size: .69rem;

    text-transform: capitalize;
}

.rental-gear {
    margin-top: 8px;

    padding: 7px 8px;

    background: var(--mint-50);

    border-radius: 7px;

    color: var(--muted);

    font-size: .68rem;

    line-height: 1.45;
}

.rental-gear strong {
    color: var(--teal-900);
}

.schedule-date {
    color: var(--teal-900);

    font-weight: 600;

    white-space: nowrap;
}

.schedule-time {
    display: inline-block;

    margin-top: 3px;

    color: var(--muted);

    font-size: .7rem;
}


/* =========================
   STATUS BADGES
========================= */

.status-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 6px 10px;

    border-radius: 999px;

    font-size: .62rem;
    font-weight: 700;

    letter-spacing: .04em;

    text-transform: uppercase;

    white-space: nowrap;
}

.pending {
    background: #fff4cf;
    color: #8a6511;
}

.confirmed {
    background: #e4f5ed;
    color: #1f684c;
}

.completed {
    background: #e5eef9;
    color: #315c8e;
}

.cancelled {
    background: #fde9e9;
    color: #983939;
}

.unpaid {
    background: #fde9e9;
    color: #983939;
}

.paid {
    background: #e4f5ed;
    color: #1f684c;
}


/* =========================
   PAYMENT
========================= */

.payment-stack {
    display: flex;

    flex-direction: column;

    align-items: flex-start;

    gap: 7px;
}

.payment-method {
    color: var(--teal-900);

    font-size: .74rem;
    font-weight: 700;
}


/* =========================
   ACTION BUTTONS
========================= */

.action-group {
    display: flex;

    flex-wrap: wrap;

    gap: 6px;
}

.action-group form,
.payment-stack form {
    margin: 0;
}

.small-btn,
.proof-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 31px;

    padding: 7px 9px;

    border: none;
    border-radius: 7px;

    cursor: pointer;

    text-decoration: none;

    font-family:
        "Inter", sans-serif;

    font-size: .66rem;
    font-weight: 700;

    line-height: 1;

    transition:
        opacity .2s,
        transform .2s;
}

.small-btn:hover,
.proof-btn:hover {
    opacity: .88;

    transform:
        translateY(-1px);
}

.confirm-btn {
    background:
        var(--teal-900);

    color: white;
}

.complete-btn {
    background: #315c8e;

    color: white;
}

.cancel-btn {
    background: #983939;

    color: white;
}

.paid-btn {
    background: #1f684c;

    color: white;
}

.proof-btn {
    background:
        var(--teal-500);

    color: white;

    white-space: nowrap;
}


/* =========================
   NO BOOKINGS
========================= */

.no-bookings {
    padding: 60px 25px;

    text-align: center;

    color: var(--muted);

    font-size: .85rem;
}


/* =========================
   FOOTER
========================= */

.admin-footer {
    padding: 28px 20px;

    background:
        var(--teal-900);

    text-align: center;
}

.admin-footer p {
    margin: 0;

    color:
        rgba(255,255,255,.6);

    font-size: .72rem;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 950px) {

    .admin-center {
        display: none;
    }

    .stats {
        grid-template-columns:
            repeat(2, 1fr);
    }

}


@media(max-width: 650px) {

    .admin-nav {
        min-height: 68px;
    }

    .admin-brand img {
        width: 105px;
    }

    .admin-welcome {
        display: none;
    }

    .admin-hero {
        min-height: 270px;
    }

    .admin-hero::before {
        background:
            rgba(8, 48, 45, .8);
    }

    .admin-hero-content {
        padding:
            42px 20px;
    }

    .dashboard {
        padding:
            42px 16px 65px;
    }

    .dashboard-title {
        flex-direction: column;

        align-items: flex-start;
    }

    .stats {
        grid-template-columns: 1fr;
    }

    .management-heading {
        align-items: flex-start;

        flex-direction: column;
    }

}

</style>

</head>


<body>

<div class="admin-page">


<!-- =========================
     HEADER
========================= -->

<header class="admin-header">

<div class="admin-nav">


<a
    href="admin_dashboard.php"
    class="admin-brand"
>

<img
    src="images/daybbb .png"
    alt="Azura Reef Dive"
>

</a>


<div class="admin-center">

<span class="admin-dot"></span>

Administration Portal

</div>


<div class="admin-links">

<span class="admin-welcome">

Hi,
<strong>
<?= htmlspecialchars(
    $_SESSION["first_name"]
    ?? "Admin"
) ?>
</strong>

</span>


<a href="index.php">
Website
</a>


<a href="logout.php">
Log Out
</a>

</div>


</div>

</header>


<!-- =========================
     HERO
========================= -->

<section class="admin-hero">

<div class="admin-hero-content">

<span class="hero-eyebrow">
AZURA REEF MANAGEMENT
</span>

<h1>
Manage Every<br>
<em>Adventure.</em>
</h1>

<p>
Review customer reservations,
verify payments, and manage
upcoming Azura Reef experiences
from one place.
</p>

</div>

</section>


<!-- =========================
     DASHBOARD
========================= -->

<main class="dashboard">


<!-- =========================
     OVERVIEW
========================= -->

<div class="dashboard-title">

<div class="dashboard-title-left">

<span class="section-eyebrow">
DASHBOARD OVERVIEW
</span>

<h2>
Welcome Back,
<?= htmlspecialchars(
    $_SESSION["first_name"]
    ?? "Admin"
) ?>
</h2>

<p>
Here's an overview of current
bookings and registered customers.
</p>

</div>


<a
    href="index.php"
    class="view-site-btn"
>
View Website
</a>

</div>


<!-- =========================
     STATS
========================= -->

<div class="stats">


<div class="stat-card">

<div class="stat-top">

<div class="stat-label">
Total Bookings
</div>

</div>

<div class="stat-number">
<?= (int) $totalBookings ?>
</div>

<div class="stat-note">
All customer reservations
</div>

</div>


<div class="stat-card">

<div class="stat-top">

<div class="stat-label">
Pending Bookings
</div>

</div>

<div class="stat-number">
<?= (int) $pendingBookings ?>
</div>

<div class="stat-note">
Waiting for confirmation
</div>

</div>


<div class="stat-card">

<div class="stat-top">

<div class="stat-label">
Confirmed Bookings
</div>

</div>

<div class="stat-number">
<?= (int) $confirmedBookings ?>
</div>

<div class="stat-note">
Approved reservations
</div>

</div>


<div class="stat-card">

<div class="stat-top">

<div class="stat-label">
Registered Customers
</div>

</div>

<div class="stat-number">
<?= (int) $totalCustomers ?>
</div>

<div class="stat-note">
Customer accounts
</div>

</div>


</div>


<!-- =========================
     BOOKING MANAGEMENT
========================= -->

<div class="management-heading">

<div>

<span class="section-eyebrow">
BOOKING MANAGEMENT
</span>

<h2>
All Bookings
</h2>

<p>
Review reservations, payments,
equipment rentals, and booking status.
</p>

</div>

</div>


<div class="table-card">

<?php if (
    $bookings &&
    $bookings->num_rows > 0
): ?>


<div class="table-scroll">

<table>


<thead>

<tr>

<th>
Booking
</th>

<th>
Customer
</th>

<th>
Service
</th>

<th>
Schedule
</th>

<th>
Guests
</th>

<th>
Payment
</th>

<th>
Booking Status
</th>

<th>
Actions
</th>

</tr>

</thead>


<tbody>


<?php while (
    $booking =
    $bookings->fetch_assoc()
): ?>


<?php

$booking_status =
    strtolower(
        $booking["booking_status"]
        ?? "pending"
    );


$payment_status =
    strtolower(
        $booking["payment_status"]
        ?? "unpaid"
    );


$payment_method =
    strtolower(
        $booking["payment_method"]
        ?? "cash"
    );


if ($payment_method === "gcash") {

    $payment_label =
        "GCash";

} elseif ($payment_method === "card") {

    $payment_label =
        "Credit / Debit Card";

} else {

    $payment_label =
        "Cash";

}

?>


<tr>


<!-- BOOKING -->

<td>

<div class="booking-code">

AZR-<?= str_pad(
    $booking["id"],
    4,
    "0",
    STR_PAD_LEFT
) ?>

</div>

</td>


<!-- CUSTOMER -->

<td>

<div class="customer-name">

<?= htmlspecialchars(
    $booking["full_name"]
) ?>

</div>


<span class="customer-email">

<?= htmlspecialchars(
    $booking["email"]
) ?>

</span>

</td>


<!-- SERVICE -->

<td>

<div class="service-title">

<?= htmlspecialchars(
    $booking["service_name"]
) ?>

</div>


<span class="service-type">

<?= htmlspecialchars(
    $booking["service_type"]
) ?>

</span>


<?php if (
    !empty(
        $booking["rental_gear"]
    )
): ?>

<div class="rental-gear">

<strong>
Rental Gear:
</strong>

<br>

<?= htmlspecialchars(
    $booking["rental_gear"]
) ?>

</div>

<?php endif; ?>


</td>


<!-- SCHEDULE -->

<td>

<div class="schedule-date">

<?= htmlspecialchars(
    $booking["booking_date"]
) ?>

</div>


<span class="schedule-time">

<?= htmlspecialchars(
    $booking["booking_time"]
) ?>

</span>

</td>


<!-- GUESTS -->

<td>

<?= htmlspecialchars(
    $booking["guests"]
) ?>

</td>


<!-- PAYMENT -->

<td>

<div class="payment-stack">


<div class="payment-method">

<?= htmlspecialchars(
    $payment_label
) ?>

</div>


<span
    class="
        status-badge
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


<?php if (
    $payment_method === "gcash" &&
    !empty(
        $booking["payment_proof"]
    )
): ?>


<a
    href="<?= htmlspecialchars(
        $booking["payment_proof"]
    ) ?>"
    target="_blank"
    class="proof-btn"
>
View Payment Proof
</a>


<?php endif; ?>


<?php if (
    (
        $payment_method === "gcash" ||
        $payment_method === "cash"
    ) &&
    $payment_status !== "paid"
): ?>


<form
    method="POST"
    action="update_payment.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="payment_status"
    value="paid"
>

<button
    type="submit"
    class="small-btn paid-btn"
>
Mark as Paid
</button>

</form>


<?php endif; ?>


</div>

</td>


<!-- BOOKING STATUS -->

<td>

<span
    class="
        status-badge
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

</td>


<!-- ACTIONS -->

<td>

<div class="action-group">


<?php if (
    $booking_status === "pending"
): ?>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="confirmed"
>

<button
    type="submit"
    class="small-btn confirm-btn"
>
Confirm
</button>

</form>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="cancelled"
>

<button
    type="submit"
    class="small-btn cancel-btn"
>
Cancel
</button>

</form>


<?php elseif (
    $booking_status === "confirmed"
): ?>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="completed"
>

<button
    type="submit"
    class="small-btn complete-btn"
>
Complete
</button>

</form>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="cancelled"
>

<button
    type="submit"
    class="small-btn cancel-btn"
>
Cancel
</button>

</form>


<?php else: ?>

<span style="color:var(--muted);">
—
</span>

<?php endif; ?>


</div>

</td>


</tr>


<?php endwhile; ?>


</tbody>


</table>

</div>


<?php else: ?>


<div class="no-bookings">

No bookings found.

</div>


<?php endif; ?>


</div>


</main>


<!-- =========================
     FOOTER
========================= -->

<footer class="admin-footer">

<p>
© <?= date("Y") ?> Azura Reef Dive.
Administration Portal.
</p>

</footer>


</div>


</body>

</html>


<?php

$conn->close();

?>