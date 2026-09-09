<?php

session_start();

/*
    AZURA REEF DIVE
    Snorkeling Tours
*/

$tours = [

    [
        'name' => 'Coral Garden Snorkeling',
        'description' => 'Swim above colorful coral gardens and discover tropical fish in the clear waters of Siquijor.',
        'duration' => '2 Hours',
        'location' => 'Tubod Marine Sanctuary',
        'level' => 'Beginner Friendly',
        'price' => 1200,
        'image' => 'images/coralgardenjpg.jpg'
    ],

    [
        'name' => 'Turtle & Reef Adventure',
        'description' => 'Explore beautiful reef areas with a local guide and enjoy the chance to spot turtles and other marine life.',
        'duration' => '3 Hours',
        'location' => 'Siquijor Coastal Reefs',
        'level' => 'Beginner Friendly',
        'price' => 1500,
        'image' => 'images/turtle.jpg'
    ],

    [
        'name' => 'Island Snorkeling Experience',
        'description' => 'Spend a relaxing half-day visiting snorkeling spots around Siquijor and experiencing the island from the water.',
        'duration' => '4 Hours',
        'location' => 'Selected Siquijor Reefs',
        'level' => 'All Experience Levels',
        'price' => 2000,
        'image' => 'images/islandsnorkeling.jpg'
    ]

];


$inclusions = [

    'Snorkeling mask and snorkel',
    'Fins',
    'Life vest',
    'Local snorkeling guide',
    'Safety briefing',
    'Drinking water'

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
Snorkeling Tours | Azura Reef Dive
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

.tour-hero {

    min-height: 530px;

    position: relative;

    display: flex;

    align-items: center;

    background:

        linear-gradient(
            90deg,
            rgba(7, 46, 43, .94),
            rgba(13, 58, 55, .72),
            rgba(13, 58, 55, .28)
        ),

        url("images/watercorals.jpg")
        center / cover
        no-repeat;

    overflow: hidden;

}


.tour-hero::after {

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


.tour-hero-content {

    width: 100%;

    max-width: 1140px;

    margin: auto;

    padding:
        85px 24px
        125px;

    position: relative;

    z-index: 2;

}


.tour-eyebrow {

    display: flex;

    align-items: center;

    gap: 10px;

    color: #d4eee7;

    font-size: .76rem;

    font-weight: 700;

    letter-spacing: .16em;

    text-transform: uppercase;

    margin-bottom: 18px;

}


.tour-eyebrow::before {

    content: "";

    width: 32px;

    height: 1px;

    background: #d4eee7;

}


.tour-hero h1 {

    max-width: 730px;

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

    margin-bottom: 22px;

}


.tour-hero p {

    max-width: 610px;

    color:
        rgba(
            255,
            255,
            255,
            .88
        );

    line-height: 1.8;

    font-size: 1.05rem;

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
   TOURS
========================= */

.tours-section {

    padding:
        55px 24px
        90px;

}


.tours-heading {

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

    letter-spacing: .14em;

    text-transform: uppercase;

    margin-bottom: 12px;

}


.tours-heading h2 {

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


.tours-heading p {

    color: var(--muted);

    line-height: 1.7;

}


/* =========================
   TOUR CARDS
========================= */

.tour-grid {

    max-width: 1140px;

    margin: auto;

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 24px;

}


.tour-card {

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
        rgba(13, 58, 55, .5);

    transition:
        transform .25s ease,
        box-shadow .25s ease;

}


.tour-card:hover {

    transform:
        translateY(-6px);

    box-shadow:
        0 27px 55px -30px
        rgba(13, 58, 55, .55);

}


/* IMAGE */

.tour-image {

    height: 250px;

    position: relative;

    overflow: hidden;

}


.tour-image::after {

    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            to top,
            rgba(7,46,43,.32),
            transparent 55%
        );

}


.tour-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition:
        transform .5s ease;

}


.tour-card:hover
.tour-image img {

    transform:
        scale(1.05);

}


.tour-badge {

    position: absolute;

    top: 16px;

    left: 16px;

    z-index: 2;

    background:
        rgba(
            255,
            255,
            255,
            .94
        );

    color: var(--teal-900);

    padding: 7px 12px;

    border-radius: 999px;

    font-size: .7rem;

    font-weight: 700;

    box-shadow:
        0 5px 18px
        rgba(0,0,0,.1);

}


/* CONTENT */

.tour-content {

    padding: 25px;

    flex: 1;

    display: flex;

    flex-direction: column;

}


.tour-type {

    color: var(--teal-500);

    text-transform: uppercase;

    letter-spacing: .1em;

    font-size: .68rem;

    font-weight: 700;

    margin-bottom: 7px;

}


.tour-content h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.45rem;

    line-height: 1.2;

    margin-bottom: 10px;

}


.tour-description {

    color: var(--muted);

    line-height: 1.65;

    font-size: .9rem;

    margin-bottom: 20px;

}


/* INFORMATION */

.tour-info {

    display: flex;

    flex-direction: column;

    gap: 8px;

    margin-bottom: 22px;

}


.tour-info-row {

    display: flex;

    justify-content:
        space-between;

    gap: 14px;

    background:
        var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 9px;

    padding: 10px 12px;

    font-size: .79rem;

}


.tour-info-label {

    color: var(--muted);

}


.tour-info-value {

    color: var(--teal-900);

    font-weight: 700;

    text-align: right;

}


/* PRICE */

.tour-bottom {

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

    letter-spacing: .08em;

    text-transform: uppercase;

    margin-bottom: 3px;

}


.tour-price {

    margin-bottom: 15px;

}


.tour-price strong {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.75rem;

}


.tour-price span {

    color: var(--muted);

    font-size: .8rem;

}


.tour-bottom .btn {

    width: 100%;

    justify-content: center;

}


/* =========================
   WHY SNORKEL
========================= */

.why-snorkel {

    background: white;

    padding:
        85px 24px;

    border-top:
        1px solid
        var(--border);

}


.why-container {

    max-width: 1080px;

    margin: auto;

}


.why-heading {

    max-width: 650px;

    margin-bottom: 38px;

}


.why-heading h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 2.4rem;

    margin:
        8px 0 10px;

}


.why-heading p {

    color: var(--muted);

    line-height: 1.7;

}


.why-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 18px;

}


.why-card {

    background: var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 16px;

    padding: 25px;

}


.why-number {

    width: 42px;

    height: 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: var(--teal-900);

    color: white;

    font-family:
        "Fraunces",
        serif;

    margin-bottom: 17px;

}


.why-card h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.2rem;

    margin-bottom: 8px;

}


.why-card p {

    color: var(--muted);

    line-height: 1.65;

    font-size: .9rem;

}


/* =========================
   INCLUSIONS
========================= */

.inclusions-section {

    padding:
        90px 24px;

    background: var(--mint-50);

}


.inclusions-container {

    max-width: 1080px;

    margin: auto;

    display: grid;

    grid-template-columns:
        .85fr 1.15fr;

    gap: 55px;

    align-items: center;

}


.inclusions-text h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 2.5rem;

    margin:
        8px 0 13px;

}


.inclusions-text p {

    color: var(--muted);

    line-height: 1.75;

}


.inclusion-grid {

    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 12px;

}


.inclusion-item {

    background: white;

    border:
        1px solid
        var(--border);

    border-radius: 12px;

    padding: 15px;

    display: flex;

    align-items: center;

    gap: 11px;

    color: var(--teal-900);

    font-size: .86rem;

    font-weight: 600;

}


.check {

    width: 27px;

    height: 27px;

    flex: none;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: var(--mint-100);

    color: var(--teal-500);

    font-weight: 700;

}


/* =========================
   CTA
========================= */

.tour-cta-section {

    background: white;

    padding:
        80px 24px;

}


.tour-cta {

    max-width: 1080px;

    margin: auto;

    background:
        var(--teal-900);

    border-radius: 24px;

    text-align: center;

    padding:
        55px 30px;

    position: relative;

    overflow: hidden;

}


.tour-cta::before {

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

    right: -120px;

    top: -200px;

}


.tour-cta h2 {

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


.tour-cta p {

    position: relative;

    max-width: 570px;

    margin:
        0 auto
        24px;

    color:
        rgba(
            255,
            255,
            255,
            .8
        );

    line-height: 1.7;

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

    padding: 12px 20px;

    border-radius: 10px;

    text-decoration: none;

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

    padding: 12px 20px;

    border-radius: 10px;

    text-decoration: none;

    font-weight: 600;

}


/* =========================
   FOOTER
========================= */

.tours-footer {

    background: white;

    border-top:
        1px solid
        var(--border);

    padding: 25px 20px;

}


.tours-footer-inner {

    max-width: 1080px;

    margin: auto;

    display: flex;

    align-items: center;

    justify-content:
        space-between;

    gap: 20px;

}


.tours-footer p {

    color: var(--muted);

    font-size: .83rem;

}


.tours-footer a {

    color: var(--teal-900);

    text-decoration: none;

    font-weight: 600;

    font-size: .85rem;

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 900px) {

    .tour-grid {

        grid-template-columns: 1fr;

        max-width: 620px;

    }


    .tour-image {

        height: 320px;

    }


    .why-grid {

        grid-template-columns: 1fr;

    }


    .inclusions-container {

        grid-template-columns: 1fr;

        gap: 35px;

    }

}


@media(max-width: 650px) {

    .tour-hero {

        min-height: 480px;

    }


    .tour-hero-content {

        padding:
            70px 20px
            105px;

    }


    .inclusion-grid {

        grid-template-columns: 1fr;

    }


    .tours-footer-inner {

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

<section class="tour-hero">


<div class="tour-hero-content">


<div class="tour-eyebrow">
Explore From the Surface
</div>


<h1>
See Siquijor Beneath the Blue.
</h1>


<p>
Discover colorful reefs and marine life without
going deep underwater. Our guided snorkeling
experiences are a relaxing way to explore the
beauty surrounding Siquijor Island.
</p>


<div class="hero-buttons">


<a
    href="#snorkeling-tours"
    class="hero-primary"
>
Explore Tours
</a>


<a
    href="booking.php?type=snorkeling"
    class="hero-secondary"
>
Book a Tour
</a>


</div>


</div>


</section>



<!-- =========================
     TOUR OPTIONS
========================= -->

<section
    class="tours-section"
    id="snorkeling-tours"
>


<div class="tours-heading">


<span class="section-eyebrow">
Choose Your Adventure
</span>


<h2>
Snorkeling Experiences
</h2>


<p>
From colorful coral gardens to longer island
experiences, find the tour that fits the way
you want to explore Siquijor.
</p>


</div>



<div class="tour-grid">


<?php foreach (
    $tours as $tour
): ?>


<div class="tour-card">


<div class="tour-image">


<img
    src="<?= htmlspecialchars(
        $tour['image']
    ) ?>"
    alt="<?= htmlspecialchars(
        $tour['name']
    ) ?>"
>


<div class="tour-badge">

<?= htmlspecialchars(
    $tour['level']
) ?>

</div>


</div>



<div class="tour-content">


<div class="tour-type">
Guided Snorkeling
</div>


<h3>

<?= htmlspecialchars(
    $tour['name']
) ?>

</h3>


<p class="tour-description">

<?= htmlspecialchars(
    $tour['description']
) ?>

</p>



<div class="tour-info">


<div class="tour-info-row">

<span class="tour-info-label">
Location
</span>

<span class="tour-info-value">

<?= htmlspecialchars(
    $tour['location']
) ?>

</span>

</div>



<div class="tour-info-row">

<span class="tour-info-label">
Duration
</span>

<span class="tour-info-value">

<?= htmlspecialchars(
    $tour['duration']
) ?>

</span>

</div>



<div class="tour-info-row">

<span class="tour-info-label">
Experience
</span>

<span class="tour-info-value">

<?= htmlspecialchars(
    $tour['level']
) ?>

</span>

</div>


</div>



<div class="tour-bottom">


<span class="price-label">
Starting at
</span>


<div class="tour-price">

<strong>

₱<?= number_format(
    $tour['price']
) ?>

</strong>

<span>
/ person
</span>

</div>


<a
    href="booking.php?type=snorkeling&tour=<?= urlencode(
        $tour['name']
    ) ?>"
    class="btn btn-primary"
>
Book This Tour
</a>


</div>


</div>


</div>


<?php endforeach; ?>


</div>


</section>



<!-- =========================
     WHY SNORKEL
========================= -->

<section class="why-snorkel">


<div class="why-container">


<div class="why-heading">


<span class="section-eyebrow">
Easy Island Adventure
</span>


<h2>
A Different Way to Explore
</h2>


<p>
Enjoy the water, discover the reefs, and experience
another side of Siquijor with a guided snorkeling
tour.
</p>


</div>



<div class="why-grid">


<div class="why-card">

<div class="why-number">
01
</div>

<h3>
Beginner Friendly
</h3>

<p>
Our snorkeling options include experiences suitable
for beginners and guests who simply want to enjoy
the water.
</p>

</div>



<div class="why-card">

<div class="why-number">
02
</div>

<h3>
Local Guidance
</h3>

<p>
Explore with a local snorkeling guide who accompanies
the group throughout the scheduled experience.
</p>

</div>



<div class="why-card">

<div class="why-number">
03
</div>

<h3>
Beautiful Locations
</h3>

<p>
Visit selected snorkeling areas and enjoy views of
Siquijor's reefs and marine scenery from the surface.
</p>

</div>


</div>


</div>


</section>



<!-- =========================
     INCLUSIONS
========================= -->

<section class="inclusions-section">


<div class="inclusions-container">


<div class="inclusions-text">


<span class="section-eyebrow">
We've Got You Covered
</span>


<h2>
What's Included?
</h2>


<p>
Your snorkeling tour includes the basic equipment
and support listed here, so you can focus on enjoying
your experience around Siquijor.
</p>


</div>



<div class="inclusion-grid">


<?php foreach (
    $inclusions as $item
): ?>


<div class="inclusion-item">


<span class="check">
✓
</span>


<?= htmlspecialchars(
    $item
) ?>


</div>


<?php endforeach; ?>


</div>


</div>


</section>



<!-- =========================
     CTA
========================= -->

<section class="tour-cta-section">


<div class="tour-cta">


<h2>
Ready to Explore the Reef?
</h2>


<p>
Choose your snorkeling adventure and experience
Siquijor's beautiful waters with Azura Reef Dive.
</p>


<div class="cta-buttons">


<a
    href="booking.php?type=snorkeling"
    class="cta-primary"
>
Book a Snorkeling Tour
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

<footer class="tours-footer">


<div class="tours-footer-inner">


<p>
© <?= date("Y") ?> Azura Reef Dive.
Siquijor Island, Philippines.
</p>


<div>


<a href="schedule.php">
Dive Sites
</a>

&nbsp;&nbsp;&nbsp;

<a href="pricing.php">
Pricing
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