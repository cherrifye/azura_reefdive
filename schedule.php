<?php

session_start();

require_once "db.php";


/*
    INFORMATION THAT DOES NOT CHANGE
    FOR EACH DIVE SITE
*/

$dive_details = [

    "Tubod Marine Sanctuary" => [
        "description" =>
            "Explore colorful coral gardens and marine life with one of our experienced local guides.",

        "duration" => "2–3 Hours",
        "level" => "Open Water Diver",
        "price" => 2500,
        "image" => "images/tubod.jpg"
    ],

    "Paliton Reef Dive" => [
        "description" =>
            "Enjoy clear waters, beautiful reef formations, and a relaxing guided dive along the coast of Siquijor.",

        "duration" => "2–3 Hours",
        "level" => "Open Water Diver",
        "price" => 2800,
        "image" => "images/paliton.jpg"
    ],

    "Maite Reef Adventure" => [
        "description" =>
            "Discover Siquijor’s underwater scenery while exploring a lively reef with our professional dive team.",

        "duration" => "3 Hours",
        "level" => "Open Water Diver",
        "price" => 3000,
        "image" => "images/maite.jpg"
    ]

];

/*
    GET DIVE SERVICES CREATED BY ADMIN
*/

$service_result = $conn->query(
    "
    SELECT
        service_name,
        description,
        image,
        price,
        is_active
    FROM services
    WHERE service_type = 'dive'
    ORDER BY created_at ASC
    "
);

if ($service_result) {

    while ($service = $service_result->fetch_assoc()) {

        $name = $service["service_name"];

        if ((int) $service["is_active"] !== 1) {

            if (isset($dive_details[$name])) {
                unset($dive_details[$name]);
            }

            continue;
        }

        if (isset($dive_details[$name])) {

            $dive_details[$name]["description"] =
                $service["description"] ?? "";

            $dive_details[$name]["price"] =
                (float) $service["price"];

            if (!empty($service["image"])) {
                $dive_details[$name]["image"] =
                    $service["image"];
            }

        } else {

            $dive_details[$name] = [

                "description" =>
                    $service["description"] ?? "",

                "duration" =>
                    "2–3 Hours",

                "level" =>
                    "Open Water Diver",

                "price" =>
                    (float) $service["price"],

                "image" =>
                    !empty($service["image"])
                        ? $service["image"]
                        : "images/corals.jpg"

            ];
        }
    }
}
/*
    GET THE SCHEDULES CREATED BY ADMIN
*/

$sql = "
    SELECT
        service_name,
        schedule_date,
        schedule_time,
        available_slots
    FROM dive_schedules
    WHERE
        is_available = 1
        AND available_slots > 0
        AND schedule_date >= CURDATE()
    ORDER BY
        schedule_date ASC,
        schedule_time ASC
";


$result = $conn->query($sql);

$dives = [];


if ($result) {

    while ($schedule = $result->fetch_assoc()) {

        $name = $schedule["service_name"];

        if (!isset($dive_details[$name])) {
            continue;
        }


        $details =
            $dive_details[$name];


        $dives[] = [

            "name" =>
                $name,

            "description" =>
                $details["description"],

            "date" =>
                date(
                    "F j, Y",
                    strtotime(
                        $schedule["schedule_date"]
                    )
                ),

            "time" =>
                date(
                    "g:i A",
                    strtotime(
                        $schedule["schedule_time"]
                    )
                ),

            "duration" =>
                $details["duration"],

            "level" =>
                $details["level"],

            "price" =>
                $details["price"],

            "slots" =>
                (int)
                $schedule["available_slots"],

            "image" =>
                $details["image"]

        ];
    }
}

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
Guided Fun Dives | Azura Reef Dive
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

.schedule-hero {

    min-height: 520px;

    display: flex;
    align-items: center;
    justify-content: center;

    position: relative;

    background:
        linear-gradient(
            90deg,
            rgba(7, 46, 43, .92),
            rgba(13, 58, 55, .72),
            rgba(13, 58, 55, .35)
        ),
        url("images/corals.jpg")
        center / cover
        no-repeat;

    overflow: hidden;
}


.schedule-hero::after {

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


.hero-content {

    width: 100%;
    max-width: 1140px;

    margin: auto;

    padding: 80px 24px 120px;

    position: relative;

    z-index: 2;

}


.hero-eyebrow {

    display: inline-flex;

    align-items: center;

    gap: 10px;

    color: #d4eee7;

    font-size: .78rem;

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


.schedule-hero h1 {

    color: white;

    font-family: "Fraunces", serif;

    font-size: clamp(
        3rem,
        7vw,
        5rem
    );

    line-height: 1;

    max-width: 720px;

    margin-bottom: 22px;

}


.schedule-hero p {

    max-width: 600px;

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


.hero-light-btn {

    background: white;

    color: var(--teal-900);

    padding: 12px 20px;

    border-radius: 10px;

    text-decoration: none;

    font-weight: 700;

}


.hero-outline-btn {

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
   INTRO
========================= */

.schedule-section {

    padding:
        55px 24px
        90px;

}


.schedule-title {

    max-width: 720px;

    margin:
        0 auto
        48px;

    text-align: center;

}


.schedule-title .eyebrow {

    display: inline-block;

    color: var(--teal-500);

    text-transform: uppercase;

    letter-spacing: .14em;

    font-weight: 700;

    font-size: .75rem;

    margin-bottom: 12px;

}


.schedule-title h2 {

    color: var(--teal-900);

    font-family: "Fraunces", serif;

    font-size:
        clamp(
            2rem,
            4vw,
            2.8rem
        );

    margin-bottom: 12px;

}


.schedule-title p {

    color: var(--muted);

    line-height: 1.7;

}


/* =========================
   DIVE CARDS
========================= */

.dive-list {

    max-width: 1080px;

    margin: auto;

    display: flex;

    flex-direction: column;

    gap: 30px;

}


.dive-card {

    background: white;

    border:
        1px solid
        var(--border);

    border-radius: 22px;

    overflow: hidden;

    box-shadow:
        0 18px 45px -30px
        rgba(13, 58, 55, .5);

    display: grid;

    grid-template-columns:
        390px 1fr;

    transition:
        transform .25s ease,
        box-shadow .25s ease;

}


.dive-card:hover {

    transform:
        translateY(-4px);

    box-shadow:
        0 26px 55px -30px
        rgba(13, 58, 55, .55);

}


/* IMAGE */

.dive-card-image {

    position: relative;

    min-height: 390px;

    overflow: hidden;

}


.dive-card-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition:
        transform .5s ease;

}


.dive-card:hover
.dive-card-image img {

    transform:
        scale(1.04);

}


.availability {

    position: absolute;

    top: 18px;

    left: 18px;

    background:
        rgba(
            255,
            255,
            255,
            .94
        );

    color: var(--teal-900);

    border-radius: 999px;

    padding: 8px 13px;

    font-size: .74rem;

    font-weight: 700;

    box-shadow:
        0 5px 20px
        rgba(0,0,0,.12);

}


.availability-dot {

    display: inline-block;

    width: 7px;

    height: 7px;

    border-radius: 50%;

    background:
        var(--teal-500);

    margin-right: 5px;

}


/* CARD CONTENT */

.dive-card-content {

    padding: 34px;

    display: flex;

    flex-direction: column;

    justify-content: center;

}


.dive-tag {

    color: var(--teal-500);

    font-size: .73rem;

    font-weight: 700;

    letter-spacing: .1em;

    text-transform: uppercase;

    margin-bottom: 8px;

}


.dive-card-content h3 {

    font-family:
        "Fraunces",
        serif;

    color:
        var(--teal-900);

    font-size: 1.75rem;

    margin-bottom: 10px;

}


.dive-description {

    color: var(--muted);

    line-height: 1.7;

    margin-bottom: 23px;

}


/* INFO */

.dive-info {

    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 10px;

    margin-bottom: 25px;

}


.info-item {

    background:
        var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 10px;

    padding: 11px 13px;

}


.info-label {

    display: block;

    font-size: .67rem;

    text-transform: uppercase;

    letter-spacing: .07em;

    color: var(--muted);

    margin-bottom: 4px;

}


.info-value {

    color: var(--teal-900);

    font-size: .87rem;

    font-weight: 700;

}


/* PRICE */

.dive-bottom {

    display: flex;

    justify-content:
        space-between;

    align-items:
        center;

    gap: 20px;

    padding-top: 20px;

    border-top:
        1px solid
        var(--border);

}


.price small {

    display: block;

    color: var(--muted);

    font-size: .7rem;

    text-transform: uppercase;

    letter-spacing: .08em;

    margin-bottom: 2px;

}


.price strong {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.7rem;

}


.price span {

    color: var(--muted);

    font-size: .8rem;

}


/* =========================
   EXPECT SECTION
========================= */

.expect-section {

    background: white;

    padding:
        85px 24px;

    border-top:
        1px solid
        var(--border);

    border-bottom:
        1px solid
        var(--border);

}


.expect-container {

    max-width: 1080px;

    margin: auto;

}


.expect-heading {

    max-width: 650px;

    margin-bottom: 38px;

}


.expect-heading span {

    color: var(--teal-500);

    font-size: .75rem;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .14em;

}


.expect-heading h2 {

    font-family:
        "Fraunces",
        serif;

    color: var(--teal-900);

    font-size: 2.4rem;

    margin:
        8px 0 10px;

}


.expect-heading p {

    color: var(--muted);

    line-height: 1.7;

}


.expect-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 18px;

}


.expect-card {

    background:
        var(--mint-50);

    border:
        1px solid
        var(--border);

    border-radius: 16px;

    padding: 25px;

}


.expect-number {

    width: 40px;

    height: 40px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    background:
        var(--teal-900);

    color: white;

    font-family:
        "Fraunces",
        serif;

    margin-bottom: 17px;

}


.expect-card h3 {

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.2rem;

    margin-bottom: 8px;

}


.expect-card p {

    color: var(--muted);

    line-height: 1.65;

    font-size: .9rem;

}


/* =========================
   CTA
========================= */

.schedule-cta-section {

    padding:
        80px 24px;

    background:
        var(--mint-50);

}


.schedule-cta {

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


.schedule-cta::before {

    content: "";

    position: absolute;

    width: 300px;

    height: 300px;

    border-radius: 50%;

    background:
        rgba(
            255,
            255,
            255,
            .04
        );

    top: -180px;

    right: -80px;

}


.schedule-cta h2 {

    position: relative;

    font-family:
        "Fraunces",
        serif;

    color: white;

    font-size:
        clamp(
            2rem,
            4vw,
            2.7rem
        );

    margin-bottom: 10px;

}


.schedule-cta p {

    position: relative;

    color:
        rgba(
            255,
            255,
            255,
            .78
        );

    max-width: 580px;

    margin:
        0 auto 24px;

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

.schedule-footer {

    background: white;

    border-top:
        1px solid
        var(--border);

    padding: 25px 20px;

}


.schedule-footer-inner {

    max-width: 1080px;

    margin: auto;

    display: flex;

    justify-content:
        space-between;

    align-items: center;

    gap: 20px;

}


.schedule-footer p {

    color: var(--muted);

    font-size: .83rem;

}


.schedule-footer a {

    color: var(--teal-900);

    text-decoration: none;

    font-size: .85rem;

    font-weight: 600;

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 850px) {

    .dive-card {

        grid-template-columns:
            1fr;

    }


    .dive-card-image {

        min-height: 300px;

        height: 300px;

    }


    .expect-grid {

        grid-template-columns:
            1fr;

    }

}


@media(max-width: 650px) {

    .schedule-hero {

        min-height: 470px;

    }


    .hero-content {

        padding:
            70px 20px
            100px;

    }


    .dive-info {

        grid-template-columns:
            1fr;

    }


    .dive-bottom {

        flex-direction:
            column;

        align-items:
            flex-start;

    }


    .schedule-footer-inner {

        flex-direction:
            column;

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

<section class="schedule-hero">


<div class="hero-content">


<div class="hero-eyebrow">
Explore Siquijor
</div>


<h1>
Dive Into Something Extraordinary.
</h1>


<p>
Discover Siquijor's vibrant reefs with experienced
local guides. Choose an upcoming guided dive and
experience the island from an entirely different
point of view.
</p>


<div class="hero-buttons">

<a
    href="#upcoming-dives"
    class="hero-light-btn"
>
View Upcoming Dives
</a>

<a
    href="booking.php"
    class="hero-outline-btn"
>
Book an Experience
</a>

</div>


</div>


</section>



<!-- =========================
     UPCOMING DIVES
========================= -->

<section
    class="schedule-section"
    id="upcoming-dives"
>


<div class="schedule-title">


<span class="eyebrow">
Dive With Us
</span>


<h2>
Upcoming Dive Schedule
</h2>


<p>
Choose the dive that fits your schedule and
discover some of Siquijor's beautiful underwater
destinations.
</p>


</div>



<div class="dive-list">


<?php if (empty($dives)): ?>

<div
    style="
        background:white;
        border:1px solid var(--border);
        border-radius:18px;
        padding:40px;
        text-align:center;
        color:var(--muted);
    "
>

    <h3
        style="
            color:var(--teal-900);
            font-family:'Fraunces',serif;
            margin-bottom:8px;
        "
    >
        No Upcoming Dives Yet
    </h3>

    <p>
        New dive schedules will appear here
        once they are added by our team.
    </p>

</div>

<?php else: ?>


<?php foreach (
    $dives as $dive
): ?>


<div class="dive-card">


<!-- IMAGE -->

<div class="dive-card-image">


<img
    src="<?= htmlspecialchars(
        $dive['image']
    ) ?>"
    alt="<?= htmlspecialchars(
        $dive['name']
    ) ?>"
>


<div class="availability">

<span class="availability-dot">
</span>

<?= (int) $dive['slots'] ?>
slots available

</div>


</div>



<!-- CONTENT -->

<div class="dive-card-content">


<div class="dive-tag">
Guided Fun Dive
</div>


<h3>

<?= htmlspecialchars(
    $dive['name']
) ?>

</h3>


<p class="dive-description">

<?= htmlspecialchars(
    $dive['description']
) ?>

</p>



<div class="dive-info">


<div class="info-item">

<span class="info-label">
Date
</span>

<span class="info-value">

<?= htmlspecialchars(
    $dive['date']
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Time
</span>

<span class="info-value">

<?= htmlspecialchars(
    $dive['time']
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Duration
</span>

<span class="info-value">

<?= htmlspecialchars(
    $dive['duration']
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Required Level
</span>

<span class="info-value">

<?= htmlspecialchars(
    $dive['level']
) ?>

</span>

</div>


</div>



<div class="dive-bottom">


<div class="price">

<small>
Starting at
</small>

<strong>

₱<?= number_format(
    $dive['price']
) ?>

</strong>

<span>
/ person
</span>

</div>



<a
    href="booking.php?type=dive&dive=<?= urlencode(
        $dive['name']
    ) ?>"
    class="btn btn-primary"
>
Book This Dive
</a>


</div>


</div>


</div>


<?php endforeach; ?>

<?php endif; ?>


</div>


</section>



<!-- =========================
     WHAT TO EXPECT
========================= -->

<section class="expect-section">


<div class="expect-container">


<div class="expect-heading">

<span>
Your Dive Experience
</span>

<h2>
What to Expect
</h2>

<p>
A simple, guided experience designed to help you
enjoy Siquijor's underwater scenery with confidence.
</p>

</div>



<div class="expect-grid">


<div class="expect-card">

<div class="expect-number">
01
</div>

<h3>
Meet Your Guide
</h3>

<p>
Meet the dive team and review the important details
of your scheduled dive before heading out.
</p>

</div>



<div class="expect-card">

<div class="expect-number">
02
</div>

<h3>
Get Ready
</h3>

<p>
Prepare for the activity and make sure your selected
equipment and booking information are ready.
</p>

</div>



<div class="expect-card">

<div class="expect-number">
03
</div>

<h3>
Explore Siquijor
</h3>

<p>
Enjoy your guided experience and discover the reefs
and marine scenery that make Siquijor special.
</p>

</div>


</div>


</div>


</section>



<!-- =========================
     CTA
========================= -->

<section class="schedule-cta-section">


<div class="schedule-cta">


<h2>
Ready for Your Next Dive?
</h2>


<p>
Choose your preferred experience and reserve your
spot with Azura Reef Dive.
</p>


<div class="cta-buttons">


<a
    href="booking.php"
    class="cta-primary"
>
Book an Experience
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

<footer class="schedule-footer">


<div class="schedule-footer-inner">


<p>
© <?= date("Y") ?> Azura Reef Dive.
Siquijor Island, Philippines.
</p>


<div>

<a href="courses.php">
Courses
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