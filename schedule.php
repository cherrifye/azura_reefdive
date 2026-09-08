<?php
session_start();

/*
    AZURA REEF DIVE
    Guided Fun Dive Schedule

    For now, the schedules are stored here.
    Later, we will get these from the MySQL database.
*/

$dives = [
    [
        'name' => 'Tubod Marine Sanctuary',
        'description' => 'Explore colorful coral gardens and marine life with one of our experienced local guides.',
        'date' => 'September 12, 2026',
        'time' => '8:00 AM',
        'duration' => '2–3 Hours',
        'level' => 'Open Water Diver',
        'price' => 2500,
        'slots' => 6,
        'image' => 'images/corals.jpg'
    ],
    [
        'name' => 'Paliton Reef Dive',
        'description' => 'Enjoy clear waters, beautiful reef formations, and a relaxing guided dive along the coast of Siquijor.',
        'date' => 'September 14, 2026',
        'time' => '9:00 AM',
        'duration' => '2–3 Hours',
        'level' => 'Open Water Diver',
        'price' => 2800,
        'slots' => 4,
        'image' => 'images/diverfish.jpg'
    ],
    [
        'name' => 'Maite Reef Adventure',
        'description' => 'Discover Siquijor’s underwater scenery while exploring a lively reef with our professional dive team.',
        'date' => 'September 17, 2026',
        'time' => '7:30 AM',
        'duration' => '3 Hours',
        'level' => 'Open Water Diver',
        'price' => 3000,
        'slots' => 5,
        'image' => 'images/watercorals.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Guided Fun Dives | Azura Reef Dive</title>

    <!-- Same fonts used by the homepage -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Your existing homepage CSS -->
    <link rel="stylesheet" href="style.css">

    <style>

        /* SCHEDULE PAGE */

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

        .schedule-section {
            background: var(--mint-50);
            padding: 80px 24px;
        }

        .schedule-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .schedule-title h2 {
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .schedule-title p {
            color: var(--muted);
        }

        .dive-list {
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .dive-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);

            display: grid;
            grid-template-columns: 330px 1fr;
        }

        .dive-card-image {
            height: 100%;
            min-height: 300px;
        }

        .dive-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dive-card-content {
            padding: 32px;
        }

        .dive-card-content h3 {
            color: var(--teal-900);
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .dive-description {
            color: var(--muted);
            margin-bottom: 24px;
        }

        .dive-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 26px;
        }

        .info-item {
            background: var(--mint-50);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
        }

        .info-label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .info-value {
            font-weight: 600;
            color: var(--teal-900);
            font-size: 0.92rem;
        }

        .dive-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .price {
            color: var(--teal-900);
        }

        .price strong {
            font-family: 'Fraunces', serif;
            font-size: 1.6rem;
        }

        .price span {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .back-home {
            text-align: center;
            margin-top: 45px;
        }

        @media (max-width: 750px) {

            .dive-card {
                grid-template-columns: 1fr;
            }

            .dive-card-image {
                height: 230px;
                min-height: auto;
            }

            .dive-info {
                grid-template-columns: 1fr;
            }

            .dive-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }

    </style>
</head>

<body>

<!-- HEADER -->
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

            <a href="index.php"
               class="nav-logout">
                Home
            </a>

            <a href="booking.php"
               class="btn btn-dark">
                Book a Dive
            </a>

        </div>

    </div>

</header>


<!-- PAGE INTRODUCTION -->

<section class="page-hero">

    <h1>Guided Fun Dives</h1>

    <p>
        Discover some of Siquijor's beautiful underwater sites
        with experienced local guides. Choose an upcoming dive
        and start your next underwater adventure.
    </p>

</section>


<!-- AVAILABLE DIVES -->

<section class="schedule-section">

    <div class="schedule-title">

        <span class="eyebrow-line">
            Dive With Us
        </span>

        <h2>Upcoming Dive Schedule</h2>

        <p>
            Choose a dive that fits your schedule.
        </p>

    </div>


    <div class="dive-list">

        <?php foreach ($dives as $dive): ?>

            <div class="dive-card">


                <!-- DIVE IMAGE -->

                <div class="dive-card-image">

                    <img
                        src="<?= htmlspecialchars($dive['image']) ?>"
                        alt="<?= htmlspecialchars($dive['name']) ?>"
                    >

                </div>


                <!-- DIVE INFORMATION -->

                <div class="dive-card-content">

                    <h3>
                        <?= htmlspecialchars($dive['name']) ?>
                    </h3>

                    <p class="dive-description">
                        <?= htmlspecialchars($dive['description']) ?>
                    </p>


                    <div class="dive-info">

                        <div class="info-item">

                            <span class="info-label">
                                Date
                            </span>

                            <span class="info-value">
                                <?= htmlspecialchars($dive['date']) ?>
                            </span>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Time
                            </span>

                            <span class="info-value">
                                <?= htmlspecialchars($dive['time']) ?>
                            </span>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Duration
                            </span>

                            <span class="info-value">
                                <?= htmlspecialchars($dive['duration']) ?>
                            </span>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Required Level
                            </span>

                            <span class="info-value">
                                <?= htmlspecialchars($dive['level']) ?>
                            </span>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Available Slots
                            </span>

                            <span class="info-value">
                                <?= (int)$dive['slots'] ?> slots
                            </span>

                        </div>

                    </div>


                    <!-- PRICE + BOOK BUTTON -->

                    <div class="dive-bottom">

                        <div class="price">

                            <strong>
                                ₱<?= number_format($dive['price']) ?>
                            </strong>

                            <span>
                                / person
                            </span>

                        </div>


                        <a
                            href="booking.php?dive=<?= urlencode($dive['name']) ?>"
                            class="btn btn-primary"
                        >
                            Book This Dive
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>


    <div class="back-home">

        <a href="index.php"
           class="link-arrow">

            ← Back to Home

        </a>

    </div>

</section>


</body>
</html>