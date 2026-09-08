<?php
session_start();
require_once "db.php";

/* Customer must be logged in */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

/* Admin should use the admin dashboard */
if (($_SESSION["role"] ?? "") === "admin") {
    header("Location: admin_dashboard.php");
    exit;
}

$user_id = $_SESSION["user_id"];

/* Get bookings belonging to logged-in customer */
$stmt = $conn->prepare(
    "SELECT *
     FROM bookings
     WHERE user_id = ?
     ORDER BY created_at DESC"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$bookings = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Bookings | Azura Reef Dive</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">


    <style>

        body {
            background: var(--mint-50);
        }


        /* HEADER */

        .customer-header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 18px 24px;
        }

        .customer-nav {
            max-width: 1100px;
            margin: auto;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .brand {
            font-family: "Fraunces", serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--teal-900);
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .nav-right span {
            color: var(--muted);
            font-size: .9rem;
        }

        .nav-right a {
            color: var(--teal-900);
            font-weight: 600;
            text-decoration: none;
        }


        /* MAIN */

        .bookings-main {
            max-width: 1000px;
            margin: auto;
            padding: 55px 24px 80px;
        }

        .page-heading {
            margin-bottom: 35px;
        }

        .page-heading h1 {
            font-family: "Fraunces", serif;
            color: var(--teal-900);
            font-size: 2.4rem;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--muted);
        }


        /* BOOKING CARD */

        .booking-card {
            background: white;

            border: 1px solid var(--border);
            border-radius: var(--radius-lg);

            padding: 28px;

            margin-bottom: 22px;

            box-shadow:
                0 15px 35px -25px rgba(13, 58, 55, .4);
        }


        /* TOP */

        .booking-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 20px;

            margin-bottom: 25px;
        }

        .booking-number {
            color: var(--teal-500);
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .04em;

            margin-bottom: 6px;
        }

        .booking-title {
            font-family: "Fraunces", serif;
            color: var(--teal-900);
            font-size: 1.4rem;
            margin: 0;
        }


        /* STATUS */

        .booking-status {
            display: inline-block;

            padding: 8px 14px;

            border-radius: 999px;

            font-size: .75rem;
            font-weight: 700;

            letter-spacing: .03em;
        }

        .pending {
            background: #fff4cf;
            color: #8a6511;
        }

        .confirmed {
            background: #e4f5ed;
            color: #1f684c;
        }

        .completed {
            background: #e5eef9;
            color: #315c8e;
        }

        .cancelled {
            background: #fde9e9;
            color: #983939;
        }


        /* DETAILS */

        .booking-details {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 24px;

            border-top: 1px solid var(--border);

            padding-top: 23px;
        }

        .detail-label {
            display: block;

            color: var(--muted);

            font-size: .75rem;

            margin-bottom: 5px;
        }

        .detail-value {
            color: var(--ink);

            font-size: .9rem;

            font-weight: 600;
        }


        /* STATUS MESSAGE */

        .status-message {
            margin-top: 24px;

            padding: 15px 17px;

            border-radius: var(--radius-sm);

            font-size: .87rem;
        }

        .message-pending {
            background: #fffaf0;
            color: #725817;
        }

        .message-confirmed {
            background: #edf8f3;
            color: #205f49;
        }

        .message-completed {
            background: #eef4fa;
            color: #315b84;
        }

        .message-cancelled {
            background: #fdf0f0;
            color: #8c3838;
        }


        /* BOTTOM */

        .booking-bottom {
            margin-top: 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 15px;
        }

        .payment {
            color: var(--muted);
            font-size: .83rem;
        }

        .payment strong {
            color: var(--teal-900);
            text-transform: capitalize;
        }

        .book-another {
            background: var(--teal-900);

            color: white;

            padding: 10px 17px;

            border-radius: 8px;

            text-decoration: none;

            font-size: .82rem;
            font-weight: 600;
        }


        /* NO BOOKINGS */

        .empty-state {
            background: white;

            border: 1px solid var(--border);

            border-radius: var(--radius-lg);

            padding: 60px 30px;

            text-align: center;

            box-shadow: var(--shadow);
        }

        .empty-state h2 {
            font-family: "Fraunces", serif;
            color: var(--teal-900);

            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--muted);
            margin-bottom: 25px;
        }


        /* MOBILE */

        @media (max-width: 700px) {

            .booking-details {
                grid-template-columns: 1fr 1fr;
            }

        }


        @media (max-width: 500px) {

            .booking-top {
                flex-direction: column;
            }

            .booking-details {
                grid-template-columns: 1fr;
            }

            .booking-bottom {
                flex-direction: column;
                align-items: flex-start;
            }

            .customer-nav {
                align-items: flex-start;
            }

            .nav-right {
                flex-direction: column;
                align-items: flex-end;
                gap: 4px;
            }

        }

    </style>

</head>


<body>


<!-- HEADER -->

<header class="customer-header">

    <div class="customer-nav">


        <a
            href="index.php"
            class="brand"
        >
            Azura Reef
        </a>


        <div class="nav-right">

            <span>

                Hi,
                <?= htmlspecialchars(
                    $_SESSION["first_name"] ?? "Customer"
                ) ?>

            </span>


            <a href="index.php">
                Home
            </a>


            <a href="logout.php">
                Log Out
            </a>

        </div>


    </div>

</header>



<!-- MAIN -->

<main class="bookings-main">


    <div class="page-heading">

        <h1>
            My Bookings
        </h1>

        <p>
            Track your reservations and booking status.
        </p>

    </div>



    <?php if ($bookings->num_rows > 0): ?>


        <?php while ($booking = $bookings->fetch_assoc()): ?>


            <?php

            $status = strtolower(
                $booking["booking_status"]
            );

            ?>


            <article class="booking-card">


                <!-- TOP -->

                <div class="booking-top">


                    <div>


                        <div class="booking-number">

                            BOOKING
                            AZR-<?= str_pad(
                                $booking["id"],
                                4,
                                "0",
                                STR_PAD_LEFT
                            ) ?>

                        </div>


                        <h2 class="booking-title">

                            <?= htmlspecialchars(
                                $booking["service_name"]
                            ) ?>

                        </h2>


                    </div>



                    <!-- BOOKING STATUS -->

                    <span
                        class="booking-status <?= htmlspecialchars($status) ?>"
                    >

                        <?= strtoupper(
                            htmlspecialchars($status)
                        ) ?>

                    </span>


                </div>



                <!-- DETAILS -->

                <div class="booking-details">


                    <div>

                        <span class="detail-label">
                            Service Type
                        </span>

                        <span class="detail-value">

                            <?= htmlspecialchars(
                                ucfirst(
                                    $booking["service_type"]
                                )
                            ) ?>

                        </span>

                    </div>



                    <div>

                        <span class="detail-label">
                            Date
                        </span>

                        <span class="detail-value">

                            <?= htmlspecialchars(
                                $booking["booking_date"]
                            ) ?>

                        </span>

                    </div>



                    <div>

                        <span class="detail-label">
                            Time
                        </span>

                        <span class="detail-value">

                            <?= htmlspecialchars(
                                $booking["booking_time"]
                            ) ?>

                        </span>

                    </div>



                    <div>

                        <span class="detail-label">
                            Guests
                        </span>

                        <span class="detail-value">

                            <?= (int) $booking["guests"] ?>

                        </span>

                    </div>



                    <div>

                        <span class="detail-label">
                            Equipment
                        </span>

                        <span class="detail-value">

                            <?= htmlspecialchars(
                                ucfirst(
                                    $booking["equipment"]
                                )
                            ) ?>

                        </span>

                    </div>



                    <div>

                        <span class="detail-label">
                            Certification
                        </span>

                        <span class="detail-value">

                            <?= htmlspecialchars(
                                $booking["certification"]
                            ) ?>

                        </span>

                    </div>


                </div>



                <!-- STATUS EXPLANATION -->

                <?php if ($status === "pending"): ?>

                    <div
                        class="
                            status-message
                            message-pending
                        "
                    >

                        Your booking has been received and is
                        waiting for confirmation from Azura Reef.

                    </div>


                <?php elseif ($status === "confirmed"): ?>

                    <div
                        class="
                            status-message
                            message-confirmed
                        "
                    >

                        ✓ Your booking has been confirmed by
                        Azura Reef.

                    </div>


                <?php elseif ($status === "completed"): ?>

                    <div
                        class="
                            status-message
                            message-completed
                        "
                    >

                        ✓ This booking has been completed.

                    </div>


                <?php elseif ($status === "cancelled"): ?>

                    <div
                        class="
                            status-message
                            message-cancelled
                        "
                    >

                        This booking has been cancelled.

                    </div>


                <?php endif; ?>



                <!-- BOTTOM -->

                <div class="booking-bottom">


                    <div class="payment">

                        Payment Status:

                        <strong>

                            <?= htmlspecialchars(
                                $booking["payment_status"]
                            ) ?>

                        </strong>

                    </div>


                    <a
                        href="booking.php"
                        class="book-another"
                    >
                        Book Another
                    </a>


                </div>


            </article>


        <?php endwhile; ?>


    <?php else: ?>


        <div class="empty-state">


            <h2>
                No bookings yet
            </h2>


            <p>
                You haven't made a reservation yet.
            </p>


            <a
                href="booking.php"
                class="btn btn-primary"
            >
                Book a Dive
            </a>


        </div>


    <?php endif; ?>


</main>


</body>

</html>

<?php
$stmt->close();
?>