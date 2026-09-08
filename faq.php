<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>FAQ | Azura Reef</title>

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

.faq-page {
    min-height: 100vh;
}

.faq-header {
    background: white;
    border-bottom: 1px solid var(--border);
}

.faq-nav {
    max-width: 1140px;
    margin: auto;
    padding: 18px 20px;

    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.faq-brand {
    font-family: "Fraunces", serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--teal-900);
    text-decoration: none;
}

.faq-nav-links {
    display: flex;
    align-items: center;
    gap: 16px;
}

.faq-nav-links a {
    color: var(--teal-900);
    text-decoration: none;
    font-weight: 600;
    font-size: .9rem;
}

.faq-container {
    max-width: 900px;
    margin: auto;
    padding: 60px 20px 80px;
}

.faq-heading {
    text-align: center;
    margin-bottom: 35px;
}

.faq-heading h1 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 2.6rem;
    margin-bottom: 10px;
}

.faq-heading p {
    color: var(--muted);
    max-width: 650px;
    margin: auto;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.faq-item {
    background: white;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 22px;
    box-shadow: var(--shadow);
}

.faq-item h2 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 1.15rem;
    margin-bottom: 8px;
}

.faq-item p {
    color: var(--muted);
    line-height: 1.6;
}

.faq-bottom {
    text-align: center;
    margin-top: 35px;
}

@media(max-width: 700px) {

    .faq-nav {
        flex-direction: column;
        align-items: flex-start;
    }

    .faq-nav-links {
        flex-wrap: wrap;
    }

    .faq-heading h1 {
        font-size: 2rem;
    }

}

</style>

</head>


<body>

<div class="faq-page">


<header class="faq-header">

<div class="faq-nav">

<a
    href="index.php"
    class="faq-brand"
>
Azura Reef
</a>


<div class="faq-nav-links">

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
    class="btn btn-dark"
>
Book a Dive
</a>

</div>

</div>

</header>



<main class="faq-container">


<div class="faq-heading">

<h1>
Frequently Asked Questions
</h1>

<p>
Find answers to common questions about booking,
diving courses, equipment, payments, and our
Azura Reef experiences.
</p>

</div>



<div class="faq-list">


<div class="faq-item">

<h2>
How do I book a dive or activity?
</h2>

<p>
Go to the Booking page, choose your service,
preferred date and time, complete your information,
select a payment method, and submit your booking.
</p>

</div>



<div class="faq-item">

<h2>
Do I need a diving certification?
</h2>

<p>
Some guided dives require diving certification,
while beginner courses such as Discover Scuba Diving
are designed for guests with no previous diving experience.
</p>

</div>



<div class="faq-item">

<h2>
Can I rent diving equipment?
</h2>

<p>
Yes. Rental equipment is available for selected activities.
Customers can choose available equipment during the booking process.
</p>

</div>



<div class="faq-item">

<h2>
What payment methods are accepted?
</h2>

<p>
Azura Reef accepts cash, GCash, and a demo credit or debit
card option for this school project.
</p>

</div>



<div class="faq-item">

<h2>
How does GCash payment work?
</h2>

<p>
Select GCash during booking, scan the displayed QR code,
and upload your payment proof. The payment will remain
pending until it is verified by the admin.
</p>

</div>



<div class="faq-item">

<h2>
How can I check my booking status?
</h2>

<p>
Log in to your account and open My Bookings.
You can view whether your booking is pending,
confirmed, completed, or cancelled.
</p>

</div>



<div class="faq-item">

<h2>
Can I view my booking receipt?
</h2>

<p>
Yes. Open My Bookings and click View Receipt
for the booking you want to review or print.
</p>

</div>



<div class="faq-item">

<h2>
Where is Azura Reef located?
</h2>

<p>
Azura Reef Dive is based in San Juan,
Siquijor Island, Philippines.
</p>

</div>


</div>



<div class="faq-bottom">

<a
    href="index.php"
    class="btn btn-outline"
>
Back to Home
</a>

</div>


</main>


</div>


</body>

</html>