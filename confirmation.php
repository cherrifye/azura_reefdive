<?php
session_start();

require_once "db.php";

$booking_id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($booking_id <= 0) {
    header("Location: index.php");
    exit;
}

$sql = "
    SELECT *
    FROM bookings
    WHERE id = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $booking_id);

$stmt->execute();

$result = $stmt->get_result();

$booking = $result->fetch_assoc();

if (!$booking) {
    die("Booking not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Booking Confirmation | Azura Reef Dive</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">

    <style>

        .confirmation-section {
            min-height: 80vh;
            background: var(--mint-50);
            padding: 90px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .confirmation-card {
            width: 100%;
            max-width: 720px;
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 45px;
        }

        .success-icon {
            width: 65px;
            height: 65px;
            background: var(--mint-100);
            color: var(--teal-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        .confirmation-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .confirmation-heading h1 {
            color: var(--teal-900);
            font-size: 2.3rem;
            margin-bottom: 10px;
        }

        .confirmation-heading p {
            color: var(--muted);
        }

        .booking-number {
            background: var(--teal-900);
            color: white;
            border-radius: var(--radius-md);
            text-align: center;
            padding: 18px;
            margin-bottom: 30px;
        }

        .booking-number span {
            display: block;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--muted-light);
            margin-bottom: 4px;
        }

        .booking-number strong {
            font-family: 'Fraunces', serif;
            font-size: 1.6rem;
        }

        .details {
            border-top: 1px solid var(--border);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-label {
            color: var(--muted);
        }

        .detail-value {
            color: var(--teal-900);
            font-weight: 600;
            text-align: right;
        }

        .confirmation-actions {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        @media (max-width: 600px) {

            .confirmation-card {
                padding: 30px 20px;
            }

            .detail-row {
                flex-direction: column;
                gap: 5px;
            }

            .detail-value {
                text-align: left;
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

        <div class="nav-cta">

            <a href="index.php" class="btn btn-dark">
                Home
            </a>

        </div>

    </div>

</header>


<section class="confirmation-section">

    <div class="confirmation-card">

        <div class="success-icon">
            ✓
        </div>

        <div class="confirmation-heading">

            <h1>Booking Received!</h1>

            <p>
                Thank you, <?= htmlspecialchars($booking["full_name"]) ?>.
                Your booking has been submitted successfully.
            </p>

        </div>


        <div class="booking-number">

            <span>
                Booking Number
            </span>

            <strong>
                AZR-<?= str_pad($booking["id"], 4, "0", STR_PAD_LEFT) ?>
            </strong>

        </div>


        <div class="details">

            <div class="detail-row">

                <span class="detail-label">
                    Experience
                </span>

                <span class="detail-value">
                    <?= htmlspecialchars($booking["service_name"]) ?>
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Service Type
                </span>

                <span class="detail-value">
                    <?= htmlspecialchars(ucwords(str_replace("_", " ", $booking["service_type"]))) ?>
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Date
                </span>

                <span class="detail-value">
                    <?= htmlspecialchars($booking["booking_date"]) ?>
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Time
                </span>

                <span class="detail-value">
                    <?= htmlspecialchars($booking["booking_time"]) ?>
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Guests
                </span>

                <span class="detail-value">
                    <?= (int) $booking["guests"] ?>
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Equipment
                </span>

                <span class="detail-value">
                    <?= htmlspecialchars($booking["equipment"]) ?>
                </span>

            </div>


            <div class="detail-row">

                <span class="detail-label">
                    Booking Status
                </span>

                <span class="detail-value">
                    <?= ucfirst(htmlspecialchars($booking["booking_status"])) ?>
                </span>

            </div>

        </div>


        <div class="confirmation-actions">

            <a href="index.php" class="btn btn-dark">
                Back to Home
            </a>

            <a href="booking.php" class="btn btn-outline">
                Make Another Booking
            </a>

        </div>

    </div>

</section>


</body>
</html>