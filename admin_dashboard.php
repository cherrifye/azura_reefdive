<?php
session_start();
require_once "db.php";

/* Admin only */
if (
    !isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin"
) {
    header("Location: login.php");
    exit;
}

/* Dashboard totals */

$totalBookings = 0;
$pendingBookings = 0;
$confirmedBookings = 0;
$totalCustomers = 0;

/* Total bookings */
$result = $conn->query("SELECT COUNT(*) AS total FROM bookings");

if ($result) {
    $row = $result->fetch_assoc();
    $totalBookings = $row["total"];
}

/* Pending bookings */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM bookings
     WHERE booking_status = 'pending'"
);

if ($result) {
    $row = $result->fetch_assoc();
    $pendingBookings = $row["total"];
}

/* Confirmed bookings */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM bookings
     WHERE booking_status = 'confirmed'"
);

if ($result) {
    $row = $result->fetch_assoc();
    $confirmedBookings = $row["total"];
}

/* Total customers */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM users
     WHERE role = 'customer'"
);

if ($result) {
    $row = $result->fetch_assoc();
    $totalCustomers = $row["total"];
}

/* Get bookings */
$bookings = $conn->query(
    "SELECT *
     FROM bookings
     ORDER BY created_at DESC"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Azura Reef Dive</title>

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

        .admin-header {
            background: var(--teal-900);
            color: white;
            padding: 20px 24px;
        }

        .admin-nav {
            max-width: 1250px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .admin-brand h2 {
            color: white;
            margin: 0;
            font-size: 1.4rem;
        }

        .admin-brand span {
            display: block;
            color: var(--muted-light);
            font-size: .8rem;
            margin-top: 3px;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .admin-user span {
            color: var(--muted-light);
            font-size: .9rem;
        }

        .admin-user a {
            color: white;
            font-weight: 600;
        }

        .admin-main {
            max-width: 1250px;
            margin: auto;
            padding: 55px 24px;
        }

        .dashboard-heading {
            margin-bottom: 32px;
        }

        .dashboard-heading h1 {
            color: var(--teal-900);
            font-size: 2.2rem;
            margin-bottom: 7px;
        }

        .dashboard-heading p {
            color: var(--muted);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 45px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 25px;
            box-shadow: 0 10px 30px -22px rgba(13,58,55,.5);
        }

        .stat-card span {
            color: var(--muted);
            font-size: .82rem;
        }

        .stat-card strong {
            display: block;
            font-family: 'Fraunces', serif;
            color: var(--teal-900);
            font-size: 2.1rem;
            margin-top: 8px;
        }

        .bookings-section {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .section-top {
            padding: 25px 28px;
            border-bottom: 1px solid var(--border);
        }

        .section-top h2 {
            color: var(--teal-900);
            margin-bottom: 4px;
        }

        .section-top p {
            color: var(--muted);
            font-size: .9rem;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th {
            background: var(--mint-50);
            color: var(--teal-900);
            text-align: left;
            padding: 14px 15px;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        td {
            padding: 15px;
            border-top: 1px solid var(--border);
            color: var(--ink);
            font-size: .87rem;
            vertical-align: middle;
        }

        .booking-code {
            color: var(--teal-700);
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff6dc;
            color: #8a6511;
        }

        .status-confirmed {
            background: #e8f5ef;
            color: #21694f;
        }

        .status-completed {
            background: #e8effa;
            color: #315b91;
        }

        .status-cancelled {
            background: #fff0f0;
            color: #9a3434;
        }

        .booking-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .action-button {
            border: none;
            cursor: pointer;
            padding: 7px 10px;
            border-radius: 7px;
            font-family: Inter, sans-serif;
            font-size: .75rem;
            font-weight: 600;
        }

        .confirm-button {
            background: var(--teal-900);
            color: white;
        }

        .complete-button {
            background: var(--teal-500);
            color: white;
        }

        .cancel-button {
            background: #f5eded;
            color: #8c3030;
        }

        .empty-message {
            padding: 50px 25px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 950px) {

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .admin-nav {
                align-items: flex-start;
            }

            .admin-user {
                flex-direction: column;
                align-items: flex-end;
                gap: 4px;
            }
        }

    </style>

</head>

<body>

<header class="admin-header">

    <div class="admin-nav">

        <div class="admin-brand">

            <h2>
                Azura Reef Admin
            </h2>

            <span>
                Management Dashboard
            </span>

        </div>

        <div class="admin-user">

            <span>
                Hi, <?= htmlspecialchars($_SESSION["first_name"] ?? "Admin") ?>
            </span>

            <a href="logout.php">
                Log Out
            </a>

        </div>

    </div>

</header>


<main class="admin-main">

    <div class="dashboard-heading">

        <h1>Dashboard</h1>

        <p>
            View and manage customer bookings.
        </p>

    </div>


    <div class="stats-grid">

        <div class="stat-card">

            <span>
                Total Bookings
            </span>

            <strong>
                <?= $totalBookings ?>
            </strong>

        </div>


        <div class="stat-card">

            <span>
                Pending
            </span>

            <strong>
                <?= $pendingBookings ?>
            </strong>

        </div>


        <div class="stat-card">

            <span>
                Confirmed
            </span>

            <strong>
                <?= $confirmedBookings ?>
            </strong>

        </div>


        <div class="stat-card">

            <span>
                Customers
            </span>

            <strong>
                <?= $totalCustomers ?>
            </strong>

        </div>

    </div>


    <section class="bookings-section">

        <div class="section-top">

            <h2>
                Customer Bookings
            </h2>

            <p>
                Review submitted bookings and update their status.
            </p>

        </div>


        <?php if ($bookings && $bookings->num_rows > 0): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>Booking</th>

                            <th>Customer</th>

                            <th>Service</th>

                            <th>Date</th>

                            <th>Guests</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php while ($booking = $bookings->fetch_assoc()): ?>

                        <tr>

                            <td>

                                <span class="booking-code">

                                    AZR-<?= str_pad(
                                        $booking["id"],
                                        4,
                                        "0",
                                        STR_PAD_LEFT
                                    ) ?>

                                </span>

                            </td>


                            <td>

                                <strong>
                                    <?= htmlspecialchars($booking["full_name"]) ?>
                                </strong>

                                <br>

                                <small>
                                    <?= htmlspecialchars($booking["email"]) ?>
                                </small>

                            </td>


                            <td>

                                <?= htmlspecialchars($booking["service_name"]) ?>

                                <br>

                                <small>
                                    <?= htmlspecialchars(
                                        ucfirst($booking["service_type"])
                                    ) ?>
                                </small>

                            </td>


                            <td>

                                <?= htmlspecialchars($booking["booking_date"]) ?>

                                <br>

                                <small>
                                    <?= htmlspecialchars($booking["booking_time"]) ?>
                                </small>

                            </td>


                            <td>
                                <?= (int) $booking["guests"] ?>
                            </td>


                            <td>

                                <span
                                    class="status status-<?= htmlspecialchars(
                                        $booking["booking_status"]
                                    ) ?>"
                                >

                                    <?= htmlspecialchars(
                                        ucfirst($booking["booking_status"])
                                    ) ?>

                                </span>

                            </td>


                            <td>

                                <div class="booking-actions">


                                    <?php if (
                                        $booking["booking_status"] === "pending"
                                    ): ?>

                                        <form
                                            method="POST"
                                            action="update_booking.php"
                                        >

                                            <input
                                                type="hidden"
                                                name="booking_id"
                                                value="<?= $booking["id"] ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="confirmed"
                                            >

                                            <button
                                                type="submit"
                                                class="action-button confirm-button"
                                            >
                                                Confirm
                                            </button>

                                        </form>

                                    <?php endif; ?>


                                    <?php if (
                                        $booking["booking_status"] === "confirmed"
                                    ): ?>

                                        <form
                                            method="POST"
                                            action="update_booking.php"
                                        >

                                            <input
                                                type="hidden"
                                                name="booking_id"
                                                value="<?= $booking["id"] ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="completed"
                                            >

                                            <button
                                                type="submit"
                                                class="action-button complete-button"
                                            >
                                                Complete
                                            </button>

                                        </form>

                                    <?php endif; ?>


                                    <?php if (
                                        $booking["booking_status"] !== "cancelled"
                                        &&
                                        $booking["booking_status"] !== "completed"
                                    ): ?>

                                        <form
                                            method="POST"
                                            action="update_booking.php"
                                        >

                                            <input
                                                type="hidden"
                                                name="booking_id"
                                                value="<?= $booking["id"] ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="cancelled"
                                            >

                                            <button
                                                type="submit"
                                                class="action-button cancel-button"
                                            >
                                                Cancel
                                            </button>

                                        </form>

                                    <?php endif; ?>


                                </div>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-message">
                No customer bookings yet.
            </div>

        <?php endif; ?>

    </section>

</main>

</body>
</html>/t