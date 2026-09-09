<?php

session_start();

/*
    AZURA REEF DIVE
    Premium Gear / Pricing Page
*/

$gear = [

    [
        'name' => 'Complete Scuba Set',
        'description' => 'A complete rental package for divers who need all essential scuba equipment.',
        'includes' => 'BCD, regulator, wetsuit, mask, fins, weights, tank',
        'price' => 1200,
        'image' => 'images/complete.jpg'
    ],

    [
        'name' => 'BCD Rental',
        'description' => 'Comfortable and well-maintained buoyancy control device for your dive.',
        'includes' => 'BCD only',
        'price' => 350,
        'image' => 'images/bcd.jpg'
    ],

    [
        'name' => 'Regulator Rental',
        'description' => 'Reliable regulator set checked and maintained for safe diving.',
        'includes' => 'Primary regulator, alternate air source, pressure gauge',
        'price' => 300,
        'image' => 'images/regulator.jpg'
    ],

    [
        'name' => 'Wetsuit Rental',
        'description' => 'Comfortable wetsuit suitable for warm tropical waters around Siquijor.',
        'includes' => 'Wetsuit only',
        'price' => 250,
        'image' => 'images/wetsuit.jpg'
    ],

    [
        'name' => 'Mask & Fins Set',
        'description' => 'Perfect for divers or snorkelers who only need basic water gear.',
        'includes' => 'Mask and fins',
        'price' => 200,
        'image' => 'images/maskfins.jpg'
    ],

    [
        'name' => 'Tank Rental',
        'description' => 'Standard scuba tank prepared and inspected by our dive team.',
        'includes' => 'One scuba tank',
        'price' => 400,
        'image' => 'images/tank.jpg'
    ]

];

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
Premium Gear | Azura Reef Dive
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
    href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="style.css"
>


<style>

/* =========================
   PAGE
========================= */

body {
    background: var(--mint-50);
}


/* =========================
   HERO
========================= */

.gear-hero {

    min-height: 530px;

    display: flex;

    align-items: center;

    position: relative;

    background:

        linear-gradient(
            90deg,
            rgba(7,46,43,.94),
            rgba(13,58,55,.72),
            rgba(13,58,55,.30)
        ),

        url("images/waterdive.jpg")
        center / cover
        no-repeat;

    overflow: hidden;

}


.gear-hero::after {

    content: "";

    position: absolute;

    left: 0;
    right: 0;
    bottom: 0;

    height: 110px;

    background:
        linear-gradient(
            to bottom,
            transparent,
            var(--mint-50)
        );

}


.gear-hero-content {

    width: 100%;

    max-width: 1140px;

    margin: auto;

    padding:
        85px 24px
        125px;

    position: relative;

    z-index: 2;

}


.hero-eyebrow {

    display: flex;

    align-items: center;

    gap: 10px;

    color: #d4eee7;

    font-size: .76rem;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .16em;

    margin-bottom: 18px;

}


.hero-eyebrow::before {

    content: "";

    width: 32px;

    height: 1px;

    background: #d4eee7;

}


.gear-hero h1 {

    color: white;

    font-family:
        "Fraunces",
        serif;

    font-size:
        clamp(
            3rem,
            7vw,
            5rem
        );

    line-height: 1;

    max-width: 720px;

    margin-bottom: 22px;

}


.gear-hero p {

    max-width: 610px;

    color:
        rgba(
            255,
            255,
            255,
            .88
        );

    font-size: 1.05rem;

    line-height: 1.8;

}


.hero-buttons {

    display: flex;

    gap: 12px;

    flex-wrap: wrap;

    margin-top: 28px;

}


.hero-primary {

    background: white;

    color: var(--teal-900);

    padding: 12px 20px;

    border-radius: 10px;

    text-decoration: none;

    font-weight: 700;

}


.hero-secondary {

    color: white;

    border:
        1px solid
        rgba(
            255,
            255,
            255,
            .55
        );

    padding: 12px 20px;

    border-radius: 10px;

    text-decoration: none;

    font-weight: 600;

}


/* =========================
   GEAR SECTION
========================= */

.gear-section {

    padding:
        55px 24px
        90px;

}


.gear-heading {

    max-width: 720px;

    margin:
        0 auto
        48px;

    text-align: center;

}


.section-eyebrow {

    display: inline-block;

    color: var(--teal-500);

    font-size: .75rem;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .14em;

    margin-bottom: 12px;

}


.gear-heading h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size:
        clamp(
            2rem,
            4vw,
            2.8rem
        );

    margin-bottom: 12px;

}


.gear-heading p {

    color: var(--muted);

    line-height: 1.7;

}


/* =========================
   GEAR GRID
========================= */

.gear-grid {

    max-width: 1140px;

    margin: auto;

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 24px;

}


.gear-card {

    background: white;

    border:
        1px solid
        var(--border);

    border-radius: 20px;

    overflow: hidden;

    display: flex;

    flex-direction: column;

    box-shadow:
        0 18px 45px -30px
        rgba(13,58,55,.5);

    transition:
        transform .25s ease,
        box-shadow .25s ease;

}


.gear-card:hover {

    transform:
        translateY(-6px);

    box-shadow:
        0 27px 55px -30px
        rgba(13,58,55,.55);

}


/* =========================
   GEAR IMAGE
========================= */

.gear-image {

    height: 235px;

    position: relative;

    overflow: hidden;

}


.gear-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition:
        transform .5s ease;

}


.gear-card:hover
.gear-image img {

    transform:
        scale(1.05);

}


.gear-image::after {

    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            to top,
            rgba(7,46,43,.34),
            transparent 55%
        );

}


.gear-badge {

    position: absolute;

    top: 16px;

    left: 16px;

    z-index: 3;

    background:
        rgba(
            255,
            255,
            255,
            .95
        );

    color: var(--teal-900);

    border-radius: 999px;

    padding: 7px 12px;

    font-size: .7rem;

    font-weight: 700;

    box-shadow:
        0 5px 18px
        rgba(0,0,0,.1);

}


/* =========================
   CONTENT
========================= */

.gear-content {

    padding: 25px;

    display: flex;

    flex-direction: column;

    flex: 1;

}


.gear-type {

    color: var(--teal-500);

    text-transform: uppercase;

    letter-spacing: .1em;

    font-size: .68rem;

    font-weight: 700;

    margin-bottom: 7px;

}


.gear-content h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.45rem;

    line-height: 1.2;

    margin-bottom: 10px;

}


.gear-description {

    color: var(--muted);

    font-size: .9rem;

    line-height: 1.65;

    margin-bottom: 19px;

}


/* =========================
   INCLUDES BOX
========================= */

.gear-includes {

    background:
        var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 10px;

    padding: 13px;

    margin-bottom: 21px;

}


.gear-includes span {

    display: block;

    color: var(--muted);

    font-size: .66rem;

    font-weight: 700;

    letter-spacing: .08em;

    text-transform: uppercase;

    margin-bottom: 5px;

}


.gear-includes strong {

    color: var(--teal-900);

    font-size: .83rem;

    line-height: 1.5;

}


/* =========================
   PRICE + BUTTON
========================= */

.gear-bottom {

    margin-top: auto;

    padding-top: 18px;

    border-top:
        1px solid
        var(--border);

}


.price-label {

    display: block;

    color: var(--muted);

    font-size: .67rem;

    text-transform: uppercase;

    letter-spacing: .08em;

    margin-bottom: 3px;

}


.gear-price {

    margin-bottom: 15px;

}


.gear-price strong {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.75rem;

}


.gear-price span {

    color: var(--muted);

    font-size: .8rem;

}


.gear-bottom .btn {

    width: 100%;

    justify-content: center;

}


/* =========================
   RENTAL BENEFITS
========================= */

.rental-benefits {

    background: white;

    padding:
        85px 24px;

    border-top:
        1px solid
        var(--border);

}


.benefits-container {

    max-width: 1080px;

    margin: auto;

}


.benefits-heading {

    max-width: 650px;

    margin-bottom: 38px;

}


.benefits-heading h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 2.4rem;

    margin:
        8px 0 10px;

}


.benefits-heading p {

    color: var(--muted);

    line-height: 1.7;

}


.benefits-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 18px;

}


.benefit-card {

    background:
        var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 16px;

    padding: 25px;

}


.benefit-number {

    width: 42px;

    height: 42px;

    border-radius: 50%;

    background: var(--teal-900);

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    font-family:
        "Fraunces",
        serif;

    margin-bottom: 17px;

}


.benefit-card h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.2rem;

    margin-bottom: 8px;

}


.benefit-card p {

    color: var(--muted);

    font-size: .9rem;

    line-height: 1.65;

}


/* =========================
   RENTAL NOTE
========================= */

.rental-note {

    background:
        var(--mint-50);

    padding:
        90px 24px;

}


.rental-note-container {

    max-width: 1080px;

    margin: auto;

    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 50px;

    align-items: center;

}


.rental-note-image {

    height: 420px;

    border-radius: 22px;

    overflow: hidden;

    box-shadow:
        0 22px 45px -30px
        rgba(13,58,55,.55);

}


.rental-note-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

}


.rental-note-text h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size:
        2.5rem;

    margin:
        8px 0 14px;

}


.rental-note-text p {

    color: var(--muted);

    line-height: 1.75;

    margin-bottom: 24px;

}


/* =========================
   CTA
========================= */

.gear-cta-section {

    background: white;

    padding:
        80px 24px;

}


.gear-cta {

    max-width: 1080px;

    margin: auto;

    background:
        var(--teal-900);

    border-radius: 24px;

    padding:
        55px 30px;

    text-align: center;

    position: relative;

    overflow: hidden;

}


.gear-cta::before {

    content: "";

    position: absolute;

    width: 330px;

    height: 330px;

    border-radius: 50%;

    background:
        rgba(
            255,
            255,
            255,
            .04
        );

    top: -190px;

    right: -100px;

}


.gear-cta h2 {

    position: relative;

    color: white;

    font-family:
        "Fraunces",
        serif;

    font-size:
        clamp(
            2rem,
            4vw,
            2.7rem
        );

    margin-bottom: 10px;

}


.gear-cta p {

    position: relative;

    color:
        rgba(
            255,
            255,
            255,
            .8
        );

    max-width: 590px;

    line-height: 1.7;

    margin:
        0 auto
        24px;

}


.cta-buttons {

    position: relative;

    display: flex;

    justify-content: center;

    gap: 12px;

    flex-wrap: wrap;

}


.cta-primary {

    background: white;

    color: var(--teal-900);

    text-decoration: none;

    padding: 12px 20px;

    border-radius: 10px;

    font-weight: 700;

}


.cta-secondary {

    color: white;

    border:
        1px solid
        rgba(
            255,
            255,
            255,
            .5
        );

    text-decoration: none;

    padding: 12px 20px;

    border-radius: 10px;

    font-weight: 600;

}


/* =========================
   FOOTER
========================= */

.gear-footer {

    background: white;

    border-top:
        1px solid
        var(--border);

    padding: 25px 20px;

}


.gear-footer-inner {

    max-width: 1080px;

    margin: auto;

    display: flex;

    align-items: center;

    justify-content:
        space-between;

    gap: 20px;

}


.gear-footer p {

    color: var(--muted);

    font-size: .83rem;

}


.gear-footer a {

    color: var(--teal-900);

    text-decoration: none;

    font-size: .85rem;

    font-weight: 600;

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 900px) {

    .gear-grid {

        grid-template-columns:
            repeat(2, 1fr);

    }


    .benefits-grid {

        grid-template-columns: 1fr;

    }


    .rental-note-container {

        grid-template-columns: 1fr;

    }

}


@media(max-width: 650px) {

    .gear-hero {

        min-height: 480px;

    }


    .gear-hero-content {

        padding:
            70px 20px
            105px;

    }


    .gear-grid {

        grid-template-columns: 1fr;

    }


    .rental-note-image {

        height: 300px;

    }


    .gear-footer-inner {

        flex-direction: column;

        text-align: center;

    }

}

</style>

</head>


<body>


<!-- =========================
     HEADER
========================= -->

<header>

<div class="nav-wrap">


<a
    href="index.php"
    class="brand"
>

<span class="brand-icon">

<img
    src="images/daybbb .png"
    alt="Azura Reef logo"
>

</span>

<span class="brand-name">
Azura Reef
</span>

</a>



<nav class="nav-links">

<a href="index.php#services">
Services
</a>

<a href="index.php#lessons">
Lessons
</a>

<a href="index.php#why-us">
Why Us
</a>

<a href="index.php#about">
About
</a>

</nav>



<div class="nav-cta">

<a
    href="index.php"
    class="nav-logout"
>
Home
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



<!-- =========================
     HERO
========================= -->

<section class="gear-hero">


<div class="gear-hero-content">


<div class="hero-eyebrow">
Dive Prepared
</div>


<h1>
Reliable Gear for Every Adventure.
</h1>


<p>
Choose from individual equipment rentals or a
complete scuba set for your trip. Find the gear
you need and reserve it before your underwater
experience.
</p>


<div class="hero-buttons">


<a
    href="#gear"
    class="hero-primary"
>
Browse Equipment
</a>


<a
    href="booking.php?type=gear"
    class="hero-secondary"
>
Reserve Gear
</a>


</div>


</div>


</section>



<!-- =========================
     GEAR OPTIONS
========================= -->

<section
    class="gear-section"
    id="gear"
>


<div class="gear-heading">


<span class="section-eyebrow">
Gear Rental
</span>


<h2>
Choose Your Equipment
</h2>


<p>
Rent only what you need or choose a complete scuba
set for your next underwater experience.
</p>


</div>



<div class="gear-grid">


<?php foreach (
    $gear as $item
): ?>


<div class="gear-card">


<div class="gear-image">


<img
    src="<?= htmlspecialchars(
        $item['image']
    ) ?>"
    alt="<?= htmlspecialchars(
        $item['name']
    ) ?>"
>


<span class="gear-badge">
Rental Equipment
</span>


</div>



<div class="gear-content">


<div class="gear-type">
Azura Gear
</div>


<h3>

<?= htmlspecialchars(
    $item['name']
) ?>

</h3>


<p class="gear-description">

<?= htmlspecialchars(
    $item['description']
) ?>

</p>



<div class="gear-includes">


<span>
Includes
</span>


<strong>

<?= htmlspecialchars(
    $item['includes']
) ?>

</strong>


</div>



<div class="gear-bottom">


<span class="price-label">
Rental price
</span>


<div class="gear-price">


<strong>

₱<?= number_format(
    $item['price']
) ?>

</strong>


<span>
/ day
</span>


</div>



<a
    href="booking.php?type=gear&gear=<?= urlencode(
        $item['name']
    ) ?>"
    class="btn btn-primary"
>
Rent This Gear
</a>


</div>


</div>


</div>


<?php endforeach; ?>


</div>


</section>



<!-- =========================
     BENEFITS
========================= -->

<section class="rental-benefits">


<div class="benefits-container">


<div class="benefits-heading">


<span class="section-eyebrow">
Simple & Convenient
</span>


<h2>
Why Rent With Azura?
</h2>


<p>
Reserve the equipment you need before your
experience and have your rental selection
recorded together with your booking.
</p>


</div>



<div class="benefits-grid">


<div class="benefit-card">


<div class="benefit-number">
01
</div>


<h3>
Choose What You Need
</h3>


<p>
Select individual items or reserve a complete
scuba set depending on the equipment you need.
</p>


</div>



<div class="benefit-card">


<div class="benefit-number">
02
</div>


<h3>
Clear Rental Prices
</h3>


<p>
Each available item displays its rental rate so
you can easily compare your equipment options.
</p>


</div>



<div class="benefit-card">


<div class="benefit-number">
03
</div>


<h3>
Easy Reservation
</h3>


<p>
Reserve your selected equipment through the same
Azura Reef booking system used for our experiences.
</p>


</div>


</div>


</div>


</section>



<!-- =========================
     EQUIPMENT NOTE
========================= -->

<section class="rental-note">


<div class="rental-note-container">


<div class="rental-note-image">


<img
    src="images/corals.jpg"
    alt="Azura Reef diving experience"
>


</div>



<div class="rental-note-text">


<span class="section-eyebrow">
Safe & Reliable
</span>


<h2>
Equipment You Can Trust
</h2>


<p>
Our rental equipment is inspected and maintained
regularly. If you are unsure which gear you need,
our dive team can help you choose the equipment
that fits your experience.
</p>


<a
    href="booking.php?type=gear"
    class="btn btn-dark"
>
Reserve Equipment
</a>


</div>


</div>


</section>



<!-- =========================
     CTA
========================= -->

<section class="gear-cta-section">


<div class="gear-cta">


<h2>
Need Gear for Your Next Dive?
</h2>


<p>
Choose your equipment and reserve it through
Azura Reef Dive before your underwater adventure.
</p>


<div class="cta-buttons">


<a
    href="booking.php?type=gear"
    class="cta-primary"
>
Reserve Equipment
</a>


<a
    href="index.php"
    class="cta-secondary"
>
Back to Home
</a>


</div>


</div>


</section>



<!-- =========================
     FOOTER
========================= -->

<footer class="gear-footer">


<div class="gear-footer-inner">


<p>
© <?= date("Y") ?> Azura Reef Dive.
Siquijor Island, Philippines.
</p>


<div>


<a href="schedule.php">
Dive Sites
</a>

&nbsp;&nbsp;&nbsp;

<a href="courses.php">
Courses
</a>

&nbsp;&nbsp;&nbsp;

<a href="faq.php">
FAQ
</a>


</div>


</div>


</footer>


</body>

</html>