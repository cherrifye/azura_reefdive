<?php
session_start();

/*
    AZURA REEF DIVE
    Snorkeling Tours Page

    These tours are temporary PHP data.
    Later, we can connect them to the MySQL database.
*/

$tours = [
    [
        'name' => 'Coral Garden Snorkeling',
        'description' => 'Swim above colorful coral gardens and discover tropical fish in the clear waters of Siquijor.',
        'duration' => '2 Hours',
        'location' => 'Tubod Marine Sanctuary',
        'level' => 'Beginner Friendly',
        'price' => 1200,
        'image' => 'images/watercorals.jpg'
    ],
    [
        'name' => 'Turtle & Reef Adventure',
        'description' => 'Explore beautiful reef areas with a local guide and enjoy the chance to spot turtles and other marine life.',
        'duration' => '3 Hours',
        'location' => 'Siquijor Coastal Reefs',
        'level' => 'Beginner Friendly',
        'price' => 1500,
        'image' => 'images/waterdive.jpg'
    ],
    [
        'name' => 'Island Snorkeling Experience',
        'description' => 'Spend a relaxing half-day visiting snorkeling spots around Siquijor and experiencing the island from the water.',
        'duration' => '4 Hours',
        'location' => 'Selected Siquijor Reefs',
        'level' => 'All Experience Levels',
        'price' => 2000,
        'image' => 'images/diverfish.jpg'
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Snorkeling Tours | Azura Reef Dive</title>

    <!-- Same fonts as homepage -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Your existing CSS -->
    <link rel="stylesheet" href="style.css">

    <style>

        /* =========================
           SNORKELING TOURS PAGE
        ========================= */

        .page-hero {
            background: var(--teal-900);
            color: white;
            text-align: center;
            padding: 85px 24px;
        }

        .page-hero h1 {
            font-size: clamp(2.2rem, 5vw, 3.4rem);
            margin-bottom: 16px;
        }

        .page-hero p {
            max-width: 650px;
            margin: auto;
            color: var(--muted-light);
            font-size: 1.05rem;
        }

        .tours-section {
            background: var(--mint-50);
            padding: 85px 24px;
        }

        .tours-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 50px;
        }

        .tours-heading h2 {
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .tours-heading p {
            color: var(--muted);
        }

        .tour-grid {
            max-width: 1140px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .tour-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            transition: transform .2s ease;
        }

        .tour-card:hover {
            transform: translateY(-6px);
        }

        .tour-image {
            height: 220px;
            overflow: hidden;
        }

        .tour-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .tour-card:hover .tour-image img {
            transform: scale(1.05);
        }

        .tour-content {
            padding: 26px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .tour-content h3 {
            color: var(--teal-900);
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .tour-description {
            color: var(--muted);
            font-size: .94rem;
            margin-bottom: 22px;
        }

        .tour-info {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 16px 0;
            margin-bottom: 22px;
        }

        .tour-info-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 9px;
            font-size: .88rem;
        }

        .tour-info-row:last-child {
            margin-bottom: 0;
        }

        .tour-info-label {
            color: var(--muted);
        }

        .tour-info-value {
            color: var(--teal-900);
            font-weight: 600;
            text-align: right;
        }

        .tour-bottom {
            margin-top: auto;
        }

        .tour-price {
            margin-bottom: 18px;
            color: var(--teal-900);
        }

        .tour-price strong {
            font-family: 'Fraunces', serif;
            font-size: 1.7rem;
        }

        .tour-price span {
            color: var(--muted);
            font-size: .85rem;
        }

        .tour-bottom .btn {
            width: 100%;
            justify-content: center;
        }


        /* =========================
           TOUR INCLUSIONS
        ========================= */

        .inclusions-section {
            background: white;
            padding: 85px 24px;
        }

        .inclusions-box {
            max-width: 900px;
            margin: auto;
            background: var(--mint-50);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 45px;
        }

        .inclusions-box h2 {
            color: var(--teal-900);
            text-align: center;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .inclusions-intro {
            color: var(--muted);
            text-align: center;
            margin-bottom: 32px;
        }

        .inclusion-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .inclusion-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border-radius: var(--radius-sm);
            padding: 15px 18px;
            color: var(--teal-900);
            font-size: .92rem;
            font-weight: 500;
        }

        .check {
            width: 25px;
            height: 25px;
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
           CALL TO ACTION
        ========================= */

        .tour-cta {
            background: var(--teal-900);
            color: white;
            text-align: center;
            padding: 75px 24px;
        }

        .tour-cta h2 {
            color: white;
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .tour-cta p {
            max-width: 570px;
            margin: 0 auto 25px;
            color: var(--muted-light);
        }

        .back-home {
            margin-top: 25px;
        }

        .back-home a {
            color: var(--muted-light);
            font-size: .9rem;
        }

        .back-home a:hover {
            color: white;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .tour-grid {
                grid-template-columns: 1fr;
                max-width: 600px;
            }

            .inclusion-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .page-hero {
                padding: 65px 20px;
            }

            .tours-section,
            .inclusions-section {
                padding: 60px 20px;
            }

            .inclusions-box {
                padding: 30px 20px;
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

        <a href="index.php" class="brand">

            <span class="brand-icon">
                <img src="images/daybbb .png" alt="Azura Reef logo">
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

            <a href="index.php" class="nav-logout">
                Home
            </a>

            <a href="booking.php" class="btn btn-dark">
                Book a Dive
            </a>

        </div>

    </div>

</header>


<!-- =========================
     PAGE HERO
========================= -->

<section class="page-hero">

    <h1>Snorkeling Tours</h1>

    <p>
        Discover Siquijor's beautiful marine life from the surface.
        Our guided snorkeling tours are perfect for families,
        beginners, and anyone who wants to experience the island's
        underwater beauty without scuba diving.
    </p>

</section>


<!-- =========================
     TOUR OPTIONS
========================= -->

<section class="tours-section">

    <div class="tours-heading">

        <span class="eyebrow-line">
            Explore Siquijor
        </span>

        <h2>Choose Your Snorkeling Adventure</h2>

        <p>
            Find the experience that fits your trip and enjoy
            Siquijor's clear waters with one of our local guides.
        </p>

    </div>


    <div class="tour-grid">

        <?php foreach ($tours as $tour): ?>

            <div class="tour-card">


                <!-- IMAGE -->

                <div class="tour-image">

                    <img
                        src="<?= htmlspecialchars($tour['image']) ?>"
                        alt="<?= htmlspecialchars($tour['name']) ?>"
                    >

                </div>


                <!-- TOUR CONTENT -->

                <div class="tour-content">

                    <h3>
                        <?= htmlspecialchars($tour['name']) ?>
                    </h3>

                    <p class="tour-description">
                        <?= htmlspecialchars($tour['description']) ?>
                    </p>


                    <!-- TOUR INFORMATION -->

                    <div class="tour-info">

                        <div class="tour-info-row">

                            <span class="tour-info-label">
                                Location
                            </span>

                            <span class="tour-info-value">
                                <?= htmlspecialchars($tour['location']) ?>
                            </span>

                        </div>


                        <div class="tour-info-row">

                            <span class="tour-info-label">
                                Duration
                            </span>

                            <span class="tour-info-value">
                                <?= htmlspecialchars($tour['duration']) ?>
                            </span>

                        </div>


                        <div class="tour-info-row">

                            <span class="tour-info-label">
                                Experience
                            </span>

                            <span class="tour-info-value">
                                <?= htmlspecialchars($tour['level']) ?>
                            </span>

                        </div>

                    </div>


                    <!-- PRICE AND BUTTON -->

                    <div class="tour-bottom">

                        <div class="tour-price">

                            <strong>
                                ₱<?= number_format($tour['price']) ?>
                            </strong>

                            <span>
                                / person
                            </span>

                        </div>


                        <a
                            href="booking.php?type=snorkeling&tour=<?= urlencode($tour['name']) ?>"
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
     WHAT'S INCLUDED
========================= -->

<section class="inclusions-section">

    <div class="inclusions-box">

        <span class="eyebrow-line" style="text-align:center;">
            We've Got You Covered
        </span>

        <h2>What's Included?</h2>

        <p class="inclusions-intro">
            Everything you need for a safe and enjoyable
            snorkeling experience is included in your tour.
        </p>


        <div class="inclusion-grid">

            <?php foreach ($inclusions as $item): ?>

                <div class="inclusion-item">

                    <span class="check">
                        ✓
                    </span>

                    <?= htmlspecialchars($item) ?>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- =========================
     BOTTOM CTA
========================= -->

<section class="tour-cta">

    <h2>Ready to Explore the Reef?</h2>

    <p>
        Choose your snorkeling adventure and experience
        Siquijor's beautiful waters with Azura Reef Dive.
    </p>

    <a
        href="booking.php?type=snorkeling"
        class="btn btn-primary"
    >
        Book a Snorkeling Tour
    </a>


    <div class="back-home">

        <a href="index.php">
            ← Back to Home
        </a>

    </div>

</section>


</body>
</html>