<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Terms of Service | Azura Reef Dive</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<link rel="stylesheet" href="style.css">

<style>

body {
    background: var(--mint-50);
}

.policy-header {
    background: white;
    border-bottom: 1px solid var(--border);
}

.policy-nav {
    max-width: 1140px;
    min-height: 76px;
    margin: auto;
    padding: 0 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.policy-logo img {
    width: 125px;
    height: 52px;
    object-fit: contain;
}

.policy-nav-links {
    display: flex;
    align-items: center;
    gap: 22px;
}

.policy-nav-links a {
    color: var(--teal-900);
    text-decoration: none;
    font-size: .8rem;
    font-weight: 600;
}

.policy-nav-links a:hover {
    color: var(--teal-500);
}

.policy-hero {
    position: relative;

    min-height: 310px;

    display: flex;
    align-items: center;

    background:
        url("images/corals.jpg")
        center / cover no-repeat;
}

.policy-hero::before {
    content: "";
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(8,48,45,.94),
            rgba(8,48,45,.65)
        );
}

.policy-hero-content {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 1140px;

    margin: auto;
    padding: 50px 20px;

    color: white;
}

.eyebrow {
    display: block;

    margin-bottom: 10px;

    color: #c7e4dc;

    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .16em;
}

.policy-hero h1 {
    margin: 0 0 12px;

    color: white;

    font-family: "Fraunces", serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 600;
}

.policy-hero p {
    max-width: 550px;

    margin: 0;

    color: rgba(255,255,255,.8);

    font-size: .88rem;
    line-height: 1.7;
}

.policy-content {
    max-width: 850px;

    margin: auto;

    padding: 60px 20px 80px;
}

.policy-intro {
    margin-bottom: 30px;

    color: var(--muted);

    font-size: .9rem;
    line-height: 1.8;
}

.policy-card {
    margin-bottom: 15px;

    padding: 24px;

    background: white;

    border: 1px solid var(--border);
    border-radius: 14px;

    box-shadow:
        0 18px 40px -35px
        rgba(13,58,55,.45);
}

.policy-card h2 {
    margin: 0 0 10px;

    color: var(--teal-900);

    font-family: "Fraunces", serif;
    font-size: 1.25rem;
}

.policy-card p {
    margin: 0;

    color: var(--muted);

    font-size: .84rem;
    line-height: 1.75;
}

.policy-actions {
    margin-top: 30px;

    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.policy-footer {
    padding: 28px 20px;

    background: var(--teal-900);

    text-align: center;
}

.policy-footer p {
    margin: 0;

    color: rgba(255,255,255,.6);

    font-size: .72rem;
}

@media(max-width: 700px) {

    .policy-nav-links a:not(.book-link) {
        display: none;
    }

    .policy-logo img {
        width: 105px;
    }

}

</style>

</head>

<body>


<header class="policy-header">

<div class="policy-nav">

<a href="index.php" class="policy-logo">

<img
    src="images/daybbb .png"
    alt="Azura Reef Dive"
>

</a>


<div class="policy-nav-links">

<a href="index.php">
Home
</a>

<a href="schedule.php">
Dive Sites
</a>

<a href="courses.php">
Courses
</a>

<a href="pricing.php">
Pricing
</a>

<a
    href="booking.php"
    class="book-link"
>
Book a Dive
</a>

</div>

</div>

</header>


<section class="policy-hero">

<div class="policy-hero-content">

<span class="eyebrow">
AZURA REEF DIVE
</span>

<h1>
Terms of Service
</h1>

<p>
Please review the terms that apply when
creating an account, making a reservation,
or using the Azura Reef Dive website.
</p>

</div>

</section>


<main class="policy-content">

<p class="policy-intro">
By using the Azura Reef Dive website and
submitting a booking, users agree to provide
accurate information and follow the booking
and payment procedures described on the site.
</p>


<div class="policy-card">

<h2>1. Customer Accounts</h2>

<p>
Customers are responsible for providing
accurate information when creating an account.
Account credentials should be kept private.
Customers are responsible for activity
performed through their account.
</p>

</div>


<div class="policy-card">

<h2>2. Booking Information</h2>

<p>
Customers must provide accurate booking
information, including the selected service,
date, time, number of guests, certification
information when applicable, and equipment
requirements.
</p>

</div>


<div class="policy-card">

<h2>3. Booking Confirmation</h2>

<p>
Submitting a booking does not automatically
mean that the reservation has been confirmed.
A booking may initially have a pending status
and may be reviewed and confirmed by an
authorized administrator.
</p>

</div>


<div class="policy-card">

<h2>4. Payments</h2>

<p>
Available payment methods may include cash,
GCash, and the demonstration card payment
option provided by this school project.
GCash payments may require payment proof
before they are marked as paid.
</p>

</div>


<div class="policy-card">

<h2>5. Equipment Rental</h2>

<p>
Customers who require rental equipment should
select the appropriate equipment during the
booking process. Equipment availability may
depend on the selected service and scheduled
booking.
</p>

</div>


<div class="policy-card">

<h2>6. Diving and Snorkeling Requirements</h2>

<p>
Some diving activities may have certification
or experience requirements. Customers should
provide accurate certification information
and follow the safety instructions provided
for their selected activity.
</p>

</div>


<div class="policy-card">

<h2>7. Booking Changes and Status</h2>

<p>
Bookings may have a pending, confirmed,
completed, or cancelled status. Customers
can review their current booking and payment
status through the My Bookings page after
logging in.
</p>

</div>


<div class="policy-card">

<h2>8. Website Use</h2>

<p>
Users should use the website only for its
intended purpose, including viewing services,
creating legitimate reservations, and
managing their own booking information.
Users should not attempt to access another
customer's account or private booking data.
</p>

</div>


<div class="policy-card">

<h2>9. Changes to These Terms</h2>

<p>
These Terms of Service may be updated when
the website's services, booking procedures,
or features change. Continued use of the
website is subject to the current version
displayed on this page.
</p>

</div>


<div class="policy-actions">

<a
    href="index.php"
    class="btn btn-outline"
>
Back to Home
</a>

<a
    href="privacy.php"
    class="btn btn-dark"
>
Privacy Policy
</a>

</div>

</main>


<footer class="policy-footer">

<p>
© <?= date("Y") ?> Azura Reef Dive.
All rights reserved.
</p>

</footer>


</body>
</html>