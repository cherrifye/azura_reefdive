<?php

session_start();

/*
    AZURA REEF DIVE
    Learn to Dive / Courses
*/

$courses = [

    [
        'name' => 'Discover Scuba Diving',
        'description' => 'A beginner-friendly introduction to scuba diving for those who want to experience the underwater world without committing to a full certification course.',
        'duration' => '1 Day',
        'level' => 'Beginner',
        'requirement' => 'No prior diving experience',
        'price' => 2500,
        'image' => 'images/scubawoman.jpg'
    ],

    [
        'name' => 'Open Water Certification',
        'description' => 'Learn the essential skills needed to become a certified scuba diver through theory lessons, confined water practice, and open water dives.',
        'duration' => '3–4 Days',
        'level' => 'Beginner Certification',
        'requirement' => 'Basic swimming ability',
        'price' => 12500,
        'image' => 'images/diverfish.jpg'
    ],

    [
        'name' => 'Advanced Open Water',
        'description' => 'Improve your diving skills through advanced training such as navigation, deeper dives, and other underwater activities.',
        'duration' => '2–3 Days',
        'level' => 'Advanced',
        'requirement' => 'Open Water Certification',
        'price' => 10500,
        'image' => 'images/waterdive.jpg'
    ]

];


$included = [

    'Professional dive instructor',
    'Scuba equipment during training',
    'Learning materials',
    'Safety briefing',
    'Confined water training',
    'Open water dives'

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
Learn to Dive | Azura Reef Dive
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

.course-hero {

    min-height: 530px;

    position: relative;

    display: flex;

    align-items: center;

    background:

        linear-gradient(
            90deg,
            rgba(7, 46, 43, .94),
            rgba(13, 58, 55, .73),
            rgba(13, 58, 55, .30)
        ),

        url("images/scubawoman.jpg")
        center / cover
        no-repeat;

    overflow: hidden;

}


.course-hero::after {

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


.course-hero-content {

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


.course-hero h1 {

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


.course-hero p {

    color:
        rgba(
            255,
            255,
            255,
            .88
        );

    max-width: 610px;

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
   COURSES SECTION
========================= */

.courses-section {

    padding:
        55px 24px
        90px;

}


.courses-heading {

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


.courses-heading h2 {

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


.courses-heading p {

    color: var(--muted);

    line-height: 1.7;

}


/* =========================
   COURSE CARDS
========================= */

.course-grid {

    max-width: 1140px;

    margin: auto;

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 24px;

}


.course-card {

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


.course-card:hover {

    transform:
        translateY(-6px);

    box-shadow:
        0 27px 55px -30px
        rgba(13, 58, 55, .55);

}


/* IMAGE */

.course-image {

    height: 250px;

    position: relative;

    overflow: hidden;

}


.course-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition:
        transform .5s ease;

}


.course-card:hover
.course-image img {

    transform:
        scale(1.05);

}


.course-image::after {

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


.course-level {

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


/* CONTENT */

.course-content {

    padding: 25px;

    display: flex;

    flex-direction: column;

    flex: 1;

}


.course-type {

    color: var(--teal-500);

    text-transform: uppercase;

    letter-spacing: .1em;

    font-size: .68rem;

    font-weight: 700;

    margin-bottom: 7px;

}


.course-content h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.45rem;

    line-height: 1.2;

    margin-bottom: 10px;

}


.course-description {

    color: var(--muted);

    font-size: .9rem;

    line-height: 1.65;

    margin-bottom: 20px;

}


/* DETAILS */

.course-details {

    display: flex;

    flex-direction: column;

    gap: 8px;

    margin-bottom: 22px;

}


.detail-row {

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


.detail-label {

    color: var(--muted);

}


.detail-value {

    color: var(--teal-900);

    font-weight: 700;

    text-align: right;

}


/* PRICE */

.course-bottom {

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


.course-price {

    margin-bottom: 15px;

}


.course-price strong {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.75rem;

}


.course-price span {

    color: var(--muted);

    font-size: .8rem;

}


.course-bottom .btn {

    width: 100%;

    justify-content: center;

}


/* =========================
   JOURNEY SECTION
========================= */

.journey-section {

    background: white;

    padding:
        85px 24px;

    border-top:
        1px solid
        var(--border);

}


.journey-container {

    max-width: 1080px;

    margin: auto;

}


.journey-heading {

    max-width: 660px;

    margin-bottom: 40px;

}


.journey-heading h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 2.4rem;

    margin:
        8px 0 10px;

}


.journey-heading p {

    color: var(--muted);

    line-height: 1.7;

}


.journey-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 18px;

}


.journey-card {

    background: var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 16px;

    padding: 25px;

}


.journey-number {

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


.journey-card h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.2rem;

    margin-bottom: 8px;

}


.journey-card p {

    color: var(--muted);

    font-size: .9rem;

    line-height: 1.65;

}


/* =========================
   INCLUDED
========================= */

.included-section {

    background: var(--mint-50);

    padding:
        90px 24px;

}


.included-container {

    max-width: 1080px;

    margin: auto;

    display: grid;

    grid-template-columns:
        .85fr 1.15fr;

    gap: 55px;

    align-items: center;

}


.included-text h2 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 2.5rem;

    margin:
        8px 0 13px;

}


.included-text p {

    color: var(--muted);

    line-height: 1.75;

}


.included-grid {

    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 12px;

}


.included-item {

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

    border-radius: 50%;

    background: var(--mint-100);

    color: var(--teal-500);

    display: flex;

    align-items: center;

    justify-content: center;

    font-weight: 700;

}


/* =========================
   CTA
========================= */

.course-cta-section {

    background: white;

    padding:
        80px 24px;

}


.course-cta {

    max-width: 1080px;

    margin: auto;

    background: var(--teal-900);

    border-radius: 24px;

    padding:
        55px 30px;

    text-align: center;

    position: relative;

    overflow: hidden;

}


.course-cta::before {

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


.course-cta h2 {

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


.course-cta p {

    position: relative;

    max-width: 590px;

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

.courses-footer {

    background: white;

    border-top:
        1px solid
        var(--border);

    padding: 25px 20px;

}


.courses-footer-inner {

    max-width: 1080px;

    margin: auto;

    display: flex;

    justify-content:
        space-between;

    align-items: center;

    gap: 20px;

}


.courses-footer p {

    color: var(--muted);

    font-size: .83rem;

}


.courses-footer a {

    color: var(--teal-900);

    text-decoration: none;

    font-weight: 600;

    font-size: .85rem;

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 900px) {

    .course-grid {

        grid-template-columns: 1fr;

        max-width: 620px;

    }


    .course-image {

        height: 320px;

    }


    .journey-grid {

        grid-template-columns: 1fr;

    }


    .included-container {

        grid-template-columns: 1fr;

        gap: 35px;

    }

}


@media(max-width: 650px) {

    .course-hero {

        min-height: 480px;

    }


    .course-hero-content {

        padding:
            70px 20px
            105px;

    }


    .included-grid {

        grid-template-columns: 1fr;

    }


    .courses-footer-inner {

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

<section class="course-hero">


<div class="course-hero-content">


<div class="hero-eyebrow">
Learn With Azura
</div>


<h1>
Your Underwater Journey Starts Here.
</h1>


<p>
Learn the skills and confidence to explore beneath
the surface. From your first scuba experience to
advanced training, find the course that matches
your diving journey.
</p>


<div class="hero-buttons">


<a
    href="#courses"
    class="hero-primary"
>
Explore Courses
</a>


<a
    href="booking.php?type=course"
    class="hero-secondary"
>
Book a Course
</a>


</div>


</div>


</section>



<!-- =========================
     COURSES
========================= -->

<section
    class="courses-section"
    id="courses"
>


<div class="courses-heading">


<span class="section-eyebrow">
Start Your Journey
</span>


<h2>
Choose Your Diving Course
</h2>


<p>
Whether you're experiencing scuba for the first
time or building on your existing skills, choose
the training level that fits you.
</p>


</div>



<div class="course-grid">


<?php foreach (
    $courses as $course
): ?>


<div class="course-card">


<div class="course-image">


<img
    src="<?= htmlspecialchars(
        $course['image']
    ) ?>"
    alt="<?= htmlspecialchars(
        $course['name']
    ) ?>"
>


<span class="course-level">

<?= htmlspecialchars(
    $course['level']
) ?>

</span>


</div>



<div class="course-content">


<div class="course-type">
Dive Training
</div>


<h3>

<?= htmlspecialchars(
    $course['name']
) ?>

</h3>


<p class="course-description">

<?= htmlspecialchars(
    $course['description']
) ?>

</p>



<div class="course-details">


<div class="detail-row">

<span class="detail-label">
Duration
</span>

<span class="detail-value">

<?= htmlspecialchars(
    $course['duration']
) ?>

</span>

</div>



<div class="detail-row">

<span class="detail-label">
Requirement
</span>

<span class="detail-value">

<?= htmlspecialchars(
    $course['requirement']
) ?>

</span>

</div>


</div>



<div class="course-bottom">


<span class="price-label">
Course price
</span>


<div class="course-price">

<strong>

₱<?= number_format(
    $course['price']
) ?>

</strong>

<span>
/ course
</span>

</div>



<a
    href="booking.php?type=course&course=<?= urlencode(
        $course['name']
    ) ?>"
    class="btn btn-primary"
>
Enroll in Course
</a>


</div>


</div>


</div>


<?php endforeach; ?>


</div>


</section>



<!-- =========================
     LEARNING JOURNEY
========================= -->

<section class="journey-section">


<div class="journey-container">


<div class="journey-heading">


<span class="section-eyebrow">
Learn. Practice. Explore.
</span>


<h2>
Your Learning Journey
</h2>


<p>
Our courses combine instruction and practical
training to help you progress through your
chosen diving program.
</p>


</div>



<div class="journey-grid">


<div class="journey-card">

<div class="journey-number">
01
</div>

<h3>
Learn the Basics
</h3>

<p>
Begin with the important concepts and information
needed for your selected diving course.
</p>

</div>



<div class="journey-card">

<div class="journey-number">
02
</div>

<h3>
Practice Your Skills
</h3>

<p>
Develop your skills through guided training and
practice with your dive instructor.
</p>

</div>



<div class="journey-card">

<div class="journey-number">
03
</div>

<h3>
Experience the Water
</h3>

<p>
Apply what you have learned during the practical
parts included in your selected course.
</p>

</div>


</div>


</div>


</section>



<!-- =========================
     WHAT'S INCLUDED
========================= -->

<section class="included-section">


<div class="included-container">


<div class="included-text">


<span class="section-eyebrow">
Training Essentials
</span>


<h2>
What's Included?
</h2>


<p>
Your course includes the essential training,
equipment, and learning support listed here as
part of your Azura Reef diving experience.
</p>


</div>



<div class="included-grid">


<?php foreach (
    $included as $item
): ?>


<div class="included-item">


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

<section class="course-cta-section">


<div class="course-cta">


<h2>
Ready to Start Diving?
</h2>


<p>
Choose your course and take the next step in your
underwater journey with Azura Reef Dive.
</p>


<div class="cta-buttons">


<a
    href="booking.php?type=course"
    class="cta-primary"
>
Book a Course
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

<footer class="courses-footer">


<div class="courses-footer-inner">


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