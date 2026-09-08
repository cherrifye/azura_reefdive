<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Privacy Policy | Azura Reef Dive</title>

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
        url("images/watercorals.jpg")
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
Privacy Policy
</h1>

<p>
Learn how Azura Reef Dive collects,
uses, and protects the information
provided when using our booking website.
</p>

</div>

</section>


<main class="policy-content">

<p class="policy-intro">
At Azura Reef Dive, we respect the privacy
of our customers. This Privacy Policy explains
the information collected through our website
and how that information is used when customers
create an account or make a booking.
</p>


<div class="policy-card">

<h2>1. Information We Collect</h2>

<p>
When you register or make a booking, we may
collect information such as your name, email
address, phone number, booking details,
selected services, equipment requirements,
and payment method.
</p>

</div>


<div class="policy-card">

<h2>2. How We Use Your Information</h2>

<p>
The information provided is used to manage
customer accounts, process reservations,
organize diving or snorkeling activities,
manage rental equipment, verify payments,
and communicate information related to
a customer's booking.
</p>

</div>


<div class="policy-card">

<h2>3. Payment Information</h2>

<p>
Cash payments are recorded through the system.
For GCash payments, customers may upload a
payment proof for verification by the
administrator. Card payment in this school
project is a demonstration feature only.
The website does not store full card numbers
or security codes.
</p>

</div>


<div class="policy-card">

<h2>4. Uploaded Payment Proof</h2>

<p>
GCash payment proof submitted through the
booking system is used only for payment
verification. Authorized administrators
may review the uploaded proof when checking
the payment status of a booking.
</p>

</div>


<div class="policy-card">

<h2>5. Account and Booking Information</h2>

<p>
Customers must log in to access their account
and booking information. Customers are only
allowed to view booking receipts associated
with their own account, while authorized
administrators may manage customer bookings.
</p>

</div>


<div class="policy-card">

<h2>6. Information Security</h2>

<p>
Azura Reef Dive uses account authentication
and access restrictions to help protect
customer information. Users should also keep
their account password private and log out
when using a shared computer.
</p>

</div>


<div class="policy-card">

<h2>7. Changes to This Policy</h2>

<p>
This Privacy Policy may be updated when the
website's services or features change.
Customers are encouraged to review this page
for the latest information about how their
data is handled.
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
    href="terms.php"
    class="btn btn-dark"
>
Terms of Service
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