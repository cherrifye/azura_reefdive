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

if (($_SESSION["role"] ?? "") === "admin") {
    header("Location: admin_dashboard.php");
    exit;
}


/* =========================
   GET CUSTOMER BOOKINGS
========================= */

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare(
    "
        SELECT *
        FROM bookings
        WHERE user_id = ?
        ORDER BY created_at DESC
    "
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$bookings = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>My Bookings | Azura Reef</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<link rel="stylesheet" href="style.css">


<style>

/* =========================
   PAGE
========================= */

body {
    background: var(--mint-50);
}

.my-bookings-page {
    min-height: 100vh;
}


/* =========================
   HEADER
========================= */

.site-header {
    background: #fff;
    border-bottom: 1px solid var(--border);
    position: relative;
    z-index: 20;
}

.header-inner {
    max-width: 1140px;
    min-height: 76px;

    margin: auto;
    padding: 0 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 28px;
}

.brand {
    display: flex;
    align-items: center;
    text-decoration: none;
    flex-shrink: 0;
}

.brand img {
    width: 125px;
    height: 52px;
    object-fit: contain;
}

.main-nav {
    display: flex;
    align-items: center;
    gap: 25px;
}

.main-nav a {
    color: var(--ink);
    text-decoration: none;

    font-size: .81rem;
    font-weight: 600;

    transition: color .2s;
}

.main-nav a:hover {
    color: var(--teal-500);
}

.account-actions {
    display: flex;
    align-items: center;
    gap: 13px;
}

.welcome-user {
    color: var(--muted);
    font-size: .78rem;
    white-space: nowrap;
}

.welcome-user strong {
    color: var(--teal-900);
}

.logout-link {
    color: var(--teal-900);
    text-decoration: none;

    font-size: .78rem;
    font-weight: 700;

    white-space: nowrap;
}

.logout-link:hover {
    color: var(--teal-500);
}


/* =========================
   HERO
========================= */

.bookings-hero {
    min-height: 355px;

    position: relative;

    display: flex;
    align-items: center;

    background:
        url("images/corals.jpg")
        center 48% / cover no-repeat;

    overflow: hidden;
}

.bookings-hero::before {
    content: "";

    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(8, 48, 45, .94) 0%,
            rgba(8, 48, 45, .78) 48%,
            rgba(8, 48, 45, .30) 100%
        );
}

.hero-content {
    width: 100%;
    max-width: 1140px;

    position: relative;
    z-index: 2;

    margin: auto;
    padding: 60px 20px;

    color: white;
}

.hero-eyebrow {
    display: block;

    color: #c7e4dc;

    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .17em;

    margin-bottom: 14px;
}

.hero-content h1 {
    max-width: 650px;

    margin: 0 0 15px;

    color: white;

    font-family: "Fraunces", serif;
    font-size: clamp(2.7rem, 6vw, 4.4rem);
    font-weight: 600;
    line-height: 1;

    letter-spacing: -.03em;
}

.hero-content h1 em {
    color: #c9e4dc;
    font-weight: 500;
}

.hero-content p {
    max-width: 520px;

    color: rgba(255, 255, 255, .82);

    font-size: .92rem;
    line-height: 1.7;
}


/* =========================
   MAIN CONTENT
========================= */

.bookings-container {
    max-width: 1000px;

    margin: auto;
    padding: 65px 20px 90px;
}


/* =========================
   PAGE HEADING
========================= */

.page-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 25px;

    margin-bottom: 30px;
}

.page-heading-text {
    max-width: 600px;
}

.section-eyebrow {
    display: block;

    color: var(--teal-500);

    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .15em;

    margin-bottom: 9px;
}

.page-heading h2 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);

    font-size: 2.3rem;
    line-height: 1.1;

    margin: 0 0 9px;
}

.page-heading p {
    color: var(--muted);

    font-size: .9rem;
    line-height: 1.6;

    margin: 0;
}

.new-booking-btn {
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: var(--teal-900);
    color: white;

    padding: 12px 19px;

    border-radius: 10px;

    text-decoration: none;

    font-size: .8rem;
    font-weight: 700;

    transition: .2s;
}

.new-booking-btn:hover {
    transform: translateY(-2px);
    background: var(--teal-700);
}


/* =========================
   BOOKING CARD
========================= */

.booking-card {
    position: relative;

    background: white;

    border: 1px solid var(--border);
    border-radius: 20px;

    padding: 30px;

    margin-bottom: 22px;

    box-shadow:
        0 18px 40px -30px
        rgba(13, 58, 55, .5);

    overflow: hidden;

    transition:
        transform .2s,
        box-shadow .2s;
}

.booking-card::before {
    content: "";

    position: absolute;

    left: 0;
    top: 0;
    bottom: 0;

    width: 4px;

    background: var(--teal-500);
}

.booking-card:hover {
    transform: translateY(-2px);

    box-shadow:
        0 24px 50px -32px
        rgba(13, 58, 55, .55);
}


/* =========================
   CARD TOP
========================= */

.booking-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;

    gap: 20px;

    margin-bottom: 25px;
}

.booking-number {
    color: var(--teal-500);

    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .11em;
    text-transform: uppercase;

    margin-bottom: 7px;
}

.service-name {
    font-family: "Fraunces", serif;

    color: var(--teal-900);

    font-size: 1.65rem;
    font-weight: 600;
    line-height: 1.15;
}


/* =========================
   STATUS PILLS
========================= */

.booking-status,
.payment-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 7px 12px;

    border-radius: 999px;

    font-size: .66rem;
    font-weight: 700;
    letter-spacing: .05em;

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
   BOOKING DETAILS
========================= */

.booking-details {
    display: grid;
    grid-template-columns: repeat(4, 1fr);

    gap: 10px;

    margin-bottom: 25px;
}

.detail-box {
    min-height: 90px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    background: var(--mint-50);

    border: 1px solid #e9f1ed;
    border-radius: 11px;

    padding: 14px;
}

.detail-label {
    color: var(--muted);

    font-size: .68rem;
    font-weight: 600;

    margin-bottom: 6px;
}

.detail-value {
    color: var(--ink);

    font-size: .82rem;
    font-weight: 700;

    line-height: 1.45;

    word-break: break-word;
}


/* =========================
   PAYMENT
========================= */

.payment-box {
    border-top: 1px solid var(--border);

    padding-top: 23px;
    margin-top: 5px;
}

.payment-box h3 {
    font-family: "Fraunces", serif;

    color: var(--teal-900);

    margin: 0 0 16px;

    font-size: 1.15rem;
}

.payment-row {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    margin-bottom: 11px;
}

.payment-label {
    color: var(--muted);
    font-size: .8rem;
}

.payment-method {
    color: var(--teal-900);

    font-size: .82rem;
    font-weight: 700;
}


/* =========================
   STATUS MESSAGE
========================= */

.status-message {
    margin-top: 16px;

    padding: 13px 15px;

    background: var(--mint-50);

    border: 1px solid #e8f0ec;
    border-radius: 10px;

    color: var(--muted);

    font-size: .8rem;
    line-height: 1.55;
}

.status-message strong {
    color: var(--teal-900);
}


/* =========================
   ACTIONS
========================= */

.booking-actions {
    display: flex;
    align-items: center;

    gap: 10px;

    flex-wrap: wrap;

    margin-top: 20px;
}

.booking-actions .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 42px;

    padding: 10px 17px;

    border-radius: 9px;

    text-decoration: none;

    font-size: .77rem;
    font-weight: 700;

    transition: .2s;
}

.booking-actions .btn-outline {
    background: white;
    color: var(--teal-900);

    border: 1px solid var(--teal-900);
}

.booking-actions .btn-outline:hover {
    background: var(--teal-900);
    color: white;
}

.booking-actions .btn-dark {
    background: var(--teal-900);
    color: white;

    border: 1px solid var(--teal-900);
}

.booking-actions .btn-dark:hover {
    background: var(--teal-700);
    border-color: var(--teal-700);
}


/* =========================
   EMPTY STATE
========================= */

.empty-state {
    position: relative;

    text-align: center;

    background: white;

    border: 1px solid var(--border);
    border-radius: 20px;

    padding: 70px 25px;

    box-shadow:
        0 18px 40px -30px
        rgba(13, 58, 55, .5);
}

.empty-icon {
    width: 65px;
    height: 65px;

    margin: 0 auto 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: var(--mint-100);

    border-radius: 50%;

    color: var(--teal-900);

    font-family: "Fraunces", serif;
    font-size: 1.6rem;
}

.empty-state h2 {
    font-family: "Fraunces", serif;

    color: var(--teal-900);

    font-size: 1.7rem;

    margin: 0 0 8px;
}

.empty-state p {
    color: var(--muted);

    font-size: .88rem;

    margin: 0 0 24px;
}


/* =========================
   FOOTER
========================= */

.account-footer {
    background: var(--teal-900);

    padding: 30px 20px;

    text-align: center;
}

.account-footer p {
    margin: 0;

    color: rgba(255, 255, 255, .65);

    font-size: .75rem;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 900px) {

    .main-nav {
        display: none;
    }

    .booking-details {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media(max-width: 650px) {

    .header-inner {
        min-height: 68px;
    }

    .brand img {
        width: 105px;
    }

    .welcome-user {
        display: none;
    }

    .bookings-hero {
        min-height: 320px;
    }

    .bookings-hero::before {
        background: rgba(8, 48, 45, .78);
    }

    .hero-content {
        padding-top: 45px;
        padding-bottom: 45px;
    }

    .bookings-container {
        padding: 45px 16px 65px;
    }

    .page-heading {
        align-items: flex-start;
        flex-direction: column;
    }

    .booking-card {
        padding: 23px 20px 23px 24px;
    }

    .booking-card-top {
        flex-direction: column;
    }

    .booking-details {
        grid-template-columns: 1fr;
    }

    .detail-box {
        min-height: auto;
    }

    .payment-row {
        align-items: flex-start;
        flex-direction: column;
        gap: 6px;
    }

    .booking-actions {
        flex-direction: column;
    }

    .booking-actions .btn {
        width: 100%;
    }

}

/* =========================
   BACK TO HOME
========================= */

.bookings-back-bar {
    max-width: 1000px;
    margin: 0 auto;
    padding: 32px 20px 0;
}

.back-home-link {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    color: var(--teal-900);
    text-decoration: none;

    font-size: .82rem;
    font-weight: 700;

    transition: .2s;
}

.back-home-link span {
    font-size: 1.1rem;
    transition: transform .2s;
}

.back-home-link:hover {
    color: var(--teal-500);
}

.back-home-link:hover span {
    transform: translateX(-3px);
}

</style>

</head>


<body>

<div class="my-bookings-page">

<div class="bookings-back-bar">

    <a
        href="index.php"
        class="back-home-link"
    >
        <span>←</span>
        Back to Home
    </a>

</div>


<!-- =========================
     MAIN
========================= -->

<main class="bookings-container">


<div class="page-heading">

    <div class="page-heading-text">

        <span class="section-eyebrow">
            BOOKING HISTORY
        </span>

        <h2>
            My Bookings
        </h2>

        <p>
            View the latest status of your
            reservations and payments.
        </p>

    </div>


    <a
        href="booking.php"
        class="new-booking-btn"
    >
        + New Booking
    </a>

</div>


<?php if ($bookings->num_rows > 0): ?>


<?php while ($booking = $bookings->fetch_assoc()): ?>


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


if ($payment_method === "gcash") {

    $payment_method_label = "GCash";

} elseif ($payment_method === "card") {

    $payment_method_label =
        "Credit / Debit Card";

} else {

    $payment_method_label = "Cash";

}


/* =========================
   BOOKING MESSAGE
========================= */

if ($booking_status === "confirmed") {

    $status_message =
        "✓ Your booking has been confirmed by Azura Reef.";

} elseif ($booking_status === "completed") {

    $status_message =
        "✓ This booking has been completed.";

} elseif ($booking_status === "cancelled") {

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

} elseif ($payment_method === "cash") {

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
     DETAILS
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
            !empty($booking["rental_gear"])
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
     EMPTY STATE
========================= -->

<div class="empty-state">

    <div class="empty-icon">
        ~
    </div>

    <h2>
        No Bookings Yet
    </h2>

    <p>
        Your Siquijor underwater adventure
        can start whenever you're ready.
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


<!-- =========================
     FOOTER
========================= -->

<footer class="account-footer">

    <p>
        © <?= date("Y") ?> Azura Reef Dive.
        Discover Siquijor beneath the surface.
    </p>

</footer>


</div>


</body>
</html>


<?php

$stmt->close();
$conn->close();

?>