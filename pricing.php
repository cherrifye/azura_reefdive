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
        'image' => 'images/scubawoman.jpg'
    ],
    [
        'name' => 'BCD Rental',
        'description' => 'Comfortable and well-maintained buoyancy control device for your dive.',
        'includes' => 'BCD only',
        'price' => 350,
        'image' => 'images/diverfish.jpg'
    ],
    [
        'name' => 'Regulator Rental',
        'description' => 'Reliable regulator set checked and maintained for safe diving.',
        'includes' => 'Primary regulator, alternate air source, pressure gauge',
        'price' => 300,
        'image' => 'images/waterdive.jpg'
    ],
    [
        'name' => 'Wetsuit Rental',
        'description' => 'Comfortable wetsuit suitable for warm tropical waters around Siquijor.',
        'includes' => 'Wetsuit only',
        'price' => 250,
        'image' => 'images/corals.jpg'
    ],
    [
        'name' => 'Mask & Fins Set',
        'description' => 'Perfect for divers or snorkelers who only need basic water gear.',
        'includes' => 'Mask and fins',
        'price' => 200,
        'image' => 'images/watercorals.jpg'
    ],
    [
        'name' => 'Tank Rental',
        'description' => 'Standard scuba tank prepared and inspected by our dive team.',
        'includes' => 'One scuba tank',
        'price' => 400,
        'image' => 'images/daybbb .jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Premium Gear | Azura Reef Dive</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">

    <style>

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

        .gear-section {
            background: var(--mint-50);
            padding: 85px 24px;
        }

        .gear-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 50px;
        }

        .gear-heading h2 {
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .gear-heading p {
            color: var(--muted);
        }

        .gear-grid {
            max-width: 1140px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .gear-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            transition: transform .2s ease;
        }

        .gear-card:hover {
            transform: translateY(-6px);
        }

        .gear-image {
            height: 210px;
            overflow: hidden;
        }

        .gear-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .gear-card:hover .gear-image img {
            transform: scale(1.05);
        }

        .gear-content {
            padding: 26px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .gear-content h3 {
            color: var(--teal-900);
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .gear-description {
            color: var(--muted);
            font-size: .93rem;
            margin-bottom: 18px;
        }

        .gear-includes {
            background: var(--mint-50);
            border-radius: var(--radius-sm);
            padding: 14px;
            margin-bottom: 22px;
        }

        .gear-includes span {
            display: block;
            font-size: .75rem;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
            letter-spacing: .05em;
        }

        .gear-includes strong {
            color: var(--teal-900);
            font-size: .9rem;
        }

        .gear-bottom {
            margin-top: auto;
        }

        .gear-price {
            margin-bottom: 18px;
        }

        .gear-price strong {
            font-family: 'Fraunces', serif;
            color: var(--teal-900);
            font-size: 1.7rem;
        }

        .gear-price span {
            color: var(--muted);
            font-size: .85rem;
        }

        .gear-bottom .btn {
            width: 100%;
            justify-content: center;
        }

        .rental-note {
            background: white;
            padding: 80px 24px;
        }

        .note-box {
            max-width: 850px;
            margin: auto;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 42px;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .note-box h2 {
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .note-box p {
            color: var(--muted);
            max-width: 650px;
            margin: 0 auto 24px;
        }

        .back-home {
            margin-top: 20px;
        }

        .back-home a {
            color: var(--muted);
            font-size: .9rem;
        }

        .back-home a:hover {
            color: var(--teal-500);
        }

        @media (max-width: 900px) {
            .gear-grid {
                grid-template-columns: 1fr;
                max-width: 600px;
            }
        }

        @media (max-width: 600px) {
            .page-hero {
                padding: 65px 20px;
            }

            .gear-section,
            .rental-note {
                padding: 60px 20px;
            }

            .note-box {
                padding: 30px 20px;
            }
        }

    </style>

</head>

<body>

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


<section class="page-hero">

    <h1>Premium Gear</h1>

    <p>
        Dive with confidence using clean, reliable, and well-maintained
        equipment from Azura Reef Dive.
    </p>

</section>


<section class="gear-section">

    <div class="gear-heading">

        <span class="eyebrow-line">
            Gear Rental
        </span>

        <h2>Choose Your Equipment</h2>

        <p>
            Rent individual equipment or choose a complete scuba set
            for your underwater adventure.
        </p>

    </div>


    <div class="gear-grid">

        <?php foreach ($gear as $item): ?>

            <div class="gear-card">

                <div class="gear-image">

                    <img
                        src="<?= htmlspecialchars($item['image']) ?>"
                        alt="<?= htmlspecialchars($item['name']) ?>"
                    >

                </div>


                <div class="gear-content">

                    <h3>
                        <?= htmlspecialchars($item['name']) ?>
                    </h3>

                    <p class="gear-description">
                        <?= htmlspecialchars($item['description']) ?>
                    </p>


                    <div class="gear-includes">

                        <span>
                            Includes
                        </span>

                        <strong>
                            <?= htmlspecialchars($item['includes']) ?>
                        </strong>

                    </div>


                    <div class="gear-bottom">

                        <div class="gear-price">

                            <strong>
                                ₱<?= number_format($item['price']) ?>
                            </strong>

                            <span>
                                / day
                            </span>

                        </div>


                        <a
                            href="booking.php?type=gear&gear=<?= urlencode($item['name']) ?>"
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


<section class="rental-note">

    <div class="note-box">

        <span class="eyebrow-line">
            Safe & Reliable
        </span>

        <h2>Equipment You Can Trust</h2>

        <p>
            Our rental equipment is inspected and maintained regularly.
            If you are unsure which gear you need, our dive team can
            help you choose the right equipment for your experience.
        </p>

        <a href="booking.php?type=gear" class="btn btn-dark">
            Reserve Equipment
        </a>

        <div class="back-home">

            <a href="index.php">
                ← Back to Home
            </a>

        </div>

    </div>

</section>

</body>
</html>