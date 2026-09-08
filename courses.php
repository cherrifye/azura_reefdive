<?php
session_start();

/*
    AZURA REEF DIVE
    Learn to Dive / Courses Page
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Learn to Dive | Azura Reef Dive</title>

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
            max-width: 670px;
            margin: auto;
            color: var(--muted-light);
            font-size: 1.05rem;
        }

        .courses-section {
            background: var(--mint-50);
            padding: 85px 24px;
        }

        .courses-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 50px;
        }

        .courses-heading h2 {
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .courses-heading p {
            color: var(--muted);
        }

        .course-grid {
            max-width: 1140px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .course-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            transition: transform .2s ease;
        }

        .course-card:hover {
            transform: translateY(-6px);
        }

        .course-image {
            height: 220px;
            overflow: hidden;
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .course-card:hover .course-image img {
            transform: scale(1.05);
        }

        .course-content {
            padding: 27px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .course-level {
            display: inline-block;
            width: fit-content;
            background: var(--mint-100);
            color: var(--teal-700);
            border-radius: 999px;
            padding: 6px 12px;
            font-size: .75rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .course-content h3 {
            color: var(--teal-900);
            font-size: 1.35rem;
            margin-bottom: 10px;
        }

        .course-description {
            color: var(--muted);
            font-size: .93rem;
            margin-bottom: 20px;
        }

        .course-details {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 16px 0;
            margin-bottom: 22px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            font-size: .88rem;
            margin-bottom: 9px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            color: var(--muted);
        }

        .detail-value {
            color: var(--teal-900);
            font-weight: 600;
            text-align: right;
        }

        .course-bottom {
            margin-top: auto;
        }

        .course-price {
            margin-bottom: 18px;
        }

        .course-price strong {
            font-family: 'Fraunces', serif;
            color: var(--teal-900);
            font-size: 1.7rem;
        }

        .course-price span {
            color: var(--muted);
            font-size: .85rem;
        }

        .course-bottom .btn {
            width: 100%;
            justify-content: center;
        }

        .included-section {
            background: white;
            padding: 85px 24px;
        }

        .included-box {
            max-width: 900px;
            margin: auto;
            background: var(--mint-50);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 45px;
        }

        .included-box h2 {
            text-align: center;
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .included-box > p {
            color: var(--muted);
            text-align: center;
            margin-bottom: 32px;
        }

        .included-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .included-item {
            background: white;
            border-radius: var(--radius-sm);
            padding: 15px 18px;
            display: flex;
            gap: 12px;
            align-items: center;
            font-size: .92rem;
            color: var(--teal-900);
            font-weight: 500;
        }

        .check {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: var(--mint-100);
            color: var(--teal-500);
            display: flex;
            align-items: center;
            justify-content: center;
            flex: none;
            font-weight: 700;
        }

        .course-cta {
            background: var(--teal-900);
            color: white;
            text-align: center;
            padding: 75px 24px;
        }

        .course-cta h2 {
            color: white;
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .course-cta p {
            color: var(--muted-light);
            max-width: 580px;
            margin: 0 auto 25px;
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

        @media (max-width: 900px) {

            .course-grid {
                grid-template-columns: 1fr;
                max-width: 600px;
            }

            .included-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .page-hero {
                padding: 65px 20px;
            }

            .courses-section,
            .included-section {
                padding: 60px 20px;
            }

            .included-box {
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

    <h1>Learn to Dive</h1>

    <p>
        Start your underwater journey with professional instruction
        from Azura Reef Dive. Choose the course that matches your
        current experience and diving goals.
    </p>

</section>


<section class="courses-section">

    <div class="courses-heading">

        <span class="eyebrow-line">
            Start Your Journey
        </span>

        <h2>Our Diving Courses</h2>

        <p>
            From your very first dive to advanced underwater training,
            we have a course for every stage of your diving journey.
        </p>

    </div>


    <div class="course-grid">

        <?php foreach ($courses as $course): ?>

            <div class="course-card">

                <div class="course-image">

                    <img
                        src="<?= htmlspecialchars($course['image']) ?>"
                        alt="<?= htmlspecialchars($course['name']) ?>"
                    >

                </div>


                <div class="course-content">

                    <span class="course-level">
                        <?= htmlspecialchars($course['level']) ?>
                    </span>

                    <h3>
                        <?= htmlspecialchars($course['name']) ?>
                    </h3>

                    <p class="course-description">
                        <?= htmlspecialchars($course['description']) ?>
                    </p>


                    <div class="course-details">

                        <div class="detail-row">

                            <span class="detail-label">
                                Duration
                            </span>

                            <span class="detail-value">
                                <?= htmlspecialchars($course['duration']) ?>
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Requirement
                            </span>

                            <span class="detail-value">
                                <?= htmlspecialchars($course['requirement']) ?>
                            </span>

                        </div>

                    </div>


                    <div class="course-bottom">

                        <div class="course-price">

                            <strong>
                                ₱<?= number_format($course['price']) ?>
                            </strong>

                            <span>
                                / course
                            </span>

                        </div>


                        <a
                            href="booking.php?type=course&course=<?= urlencode($course['name']) ?>"
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


<section class="included-section">

    <div class="included-box">

        <span class="eyebrow-line" style="text-align:center;">
            Training Essentials
        </span>

        <h2>What's Included?</h2>

        <p>
            Your course includes the essential training and equipment
            needed for a safe and comfortable learning experience.
        </p>


        <div class="included-grid">

            <?php foreach ($included as $item): ?>

                <div class="included-item">

                    <span class="check">
                        ✓
                    </span>

                    <?= htmlspecialchars($item) ?>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<section class="course-cta">

    <h2>Ready to Start Diving?</h2>

    <p>
        Choose your course and take your first step toward exploring
        Siquijor beneath the surface.
    </p>

    <a href="booking.php?type=course" class="btn btn-primary">
        Book a Course
    </a>

    <div class="back-home">

        <a href="index.php">
            ← Back to Home
        </a>

    </div>

</section>

</body>
</html>