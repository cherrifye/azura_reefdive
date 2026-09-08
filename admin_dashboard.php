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


/* Dashboard counts */

$totalBookingsResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM bookings"
    );

$totalBookings =
    $totalBookingsResult
        ->fetch_assoc()["total"];


$pendingBookingsResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM bookings
         WHERE booking_status = 'pending'"
    );

$pendingBookings =
    $pendingBookingsResult
        ->fetch_assoc()["total"];


$confirmedBookingsResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM bookings
         WHERE booking_status = 'confirmed'"
    );

$confirmedBookings =
    $confirmedBookingsResult
        ->fetch_assoc()["total"];


$totalCustomersResult =
    $conn->query(
        "SELECT COUNT(*) AS total
         FROM users
         WHERE role = 'customer'"
    );

$totalCustomers =
    $totalCustomersResult
        ->fetch_assoc()["total"];


/* Get bookings */

$bookings =
    $conn->query(
        "SELECT *
         FROM bookings
         ORDER BY created_at DESC"
    );
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
Admin Dashboard | Azura Reef
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
    href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="style.css"
>

<style>

body {
    background: var(--mint-50);
}

.admin-header {
    background: white;
    border-bottom: 1px solid var(--border);
}

.admin-nav {
    max-width: 1300px;
    margin: auto;
    padding: 18px 20px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.admin-brand {
    font-family: "Fraunces", serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--teal-900);
    text-decoration: none;
}

.admin-links {
    display: flex;
    align-items: center;
    gap: 18px;
}

.admin-links span {
    color: var(--muted);
    font-size: .9rem;
}

.admin-links a {
    color: var(--teal-900);
    text-decoration: none;
    font-weight: 600;
    font-size: .9rem;
}

.dashboard {
    max-width: 1300px;
    margin: auto;
    padding: 45px 20px 80px;
}

.dashboard-title {
    margin-bottom: 28px;
}

.dashboard-title h1 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 2.5rem;
    margin-bottom: 8px;
}

.dashboard-title p {
    color: var(--muted);
}

.stats {
    display: grid;
    grid-template-columns:
        repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 35px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 22px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
}

.stat-label {
    color: var(--muted);
    font-size: .85rem;
    margin-bottom: 8px;
}

.stat-number {
    font-family: "Fraunces", serif;
    font-size: 2rem;
    font-weight: 700;
    color: var(--teal-900);
}

.table-card {
    background: white;
    border-radius: 18px;
    padding: 22px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    overflow-x: auto;
}

.table-card h2 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1150px;
}

th {
    text-align: left;
    padding: 13px;
    font-size: .78rem;
    color: var(--muted);
    background: var(--mint-50);
}

td {
    padding: 14px 13px;
    border-bottom:
        1px solid var(--border);
    vertical-align: top;
    font-size: .88rem;
}

.booking-code {
    font-weight: 700;
    color: var(--teal-900);
}

.status-badge {
    display: inline-block;
    padding: 7px 11px;
    border-radius: 999px;
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
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

.unpaid {
    background: #fde9e9;
    color: #983939;
}

.paid {
    background: #e4f5ed;
    color: #1f684c;
}

.action-group {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
}

.action-group form {
    margin: 0;
}

.small-btn {
    border: none;
    border-radius: 8px;
    padding: 8px 10px;
    cursor: pointer;
    font-family: "Inter", sans-serif;
    font-size: .76rem;
    font-weight: 600;
}

.confirm-btn {
    background: var(--teal-900);
    color: white;
}

.complete-btn {
    background: #315c8e;
    color: white;
}

.cancel-btn {
    background: #983939;
    color: white;
}

.paid-btn {
    background: #1f684c;
    color: white;
}

.proof-btn {
    display: inline-block;
    text-decoration: none;
    background: var(--teal-500);
    color: white;
    padding: 8px 10px;
    border-radius: 8px;
    font-size: .76rem;
    font-weight: 600;
}

.payment-method {
    font-weight: 600;
    color: var(--teal-900);
    margin-bottom: 6px;
}

.payment-stack {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 7px;
}

.no-bookings {
    padding: 35px;
    text-align: center;
    color: var(--muted);
}

@media(max-width: 900px) {

    .stats {
        grid-template-columns:
            repeat(2, 1fr);
    }

}

@media(max-width: 600px) {

    .stats {
        grid-template-columns: 1fr;
    }

    .admin-nav {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

}

</style>

</head>

<body>


<header class="admin-header">

<div class="admin-nav">

<a
    href="admin_dashboard.php"
    class="admin-brand"
>
Azura Reef Admin
</a>

<div class="admin-links">

<span>
Hi,
<?= htmlspecialchars(
    $_SESSION["first_name"]
    ?? "Admin"
) ?>
</span>

<a href="index.php">
Website
</a>

<a href="logout.php">
Log Out
</a>

</div>

</div>

</header>


<main class="dashboard">


<div class="dashboard-title">

<h1>
Admin Dashboard
</h1>

<p>
Manage bookings and customer payments.
</p>

</div>



<div class="stats">


<div class="stat-card">

<div class="stat-label">
Total Bookings
</div>

<div class="stat-number">
<?= $totalBookings ?>
</div>

</div>


<div class="stat-card">

<div class="stat-label">
Pending Bookings
</div>

<div class="stat-number">
<?= $pendingBookings ?>
</div>

</div>


<div class="stat-card">

<div class="stat-label">
Confirmed Bookings
</div>

<div class="stat-number">
<?= $confirmedBookings ?>
</div>

</div>


<div class="stat-card">

<div class="stat-label">
Customers
</div>

<div class="stat-number">
<?= $totalCustomers ?>
</div>

</div>


</div>



<div class="table-card">

<h2>
All Bookings
</h2>


<?php if (
    $bookings &&
    $bookings->num_rows > 0
): ?>


<table>

<thead>

<tr>

<th>
Booking
</th>

<th>
Customer
</th>

<th>
Service
</th>

<th>
Schedule
</th>

<th>
Guests
</th>

<th>
Payment
</th>

<th>
Booking Status
</th>

<th>
Actions
</th>

</tr>

</thead>


<tbody>


<?php while (
    $booking =
    $bookings->fetch_assoc()
): ?>


<?php

$booking_status =
    strtolower(
        $booking["booking_status"]
        ?? "pending"
    );

$payment_status =
    strtolower(
        $booking["payment_status"]
        ?? "unpaid"
    );

$payment_method =
    strtolower(
        $booking["payment_method"]
        ?? "cash"
    );


if ($payment_method === "gcash") {

    $payment_label = "GCash";

} elseif ($payment_method === "card") {

    $payment_label =
        "Credit / Debit Card";

} else {

    $payment_label = "Cash";

}

?>


<tr>


<td>

<div class="booking-code">

AZR-<?= str_pad(
    $booking["id"],
    4,
    "0",
    STR_PAD_LEFT
) ?>

</div>

</td>


<td>

<strong>
<?= htmlspecialchars(
    $booking["full_name"]
) ?>
</strong>

<br>

<small>
<?= htmlspecialchars(
    $booking["email"]
) ?>
</small>

</td>

<td>

    <strong>
        <?= htmlspecialchars(
            $booking["service_name"]
        ) ?>
    </strong>

    <br>

    <small>
        <?= htmlspecialchars(
            $booking["service_type"]
        ) ?>
    </small>


    <?php if (!empty($booking["rental_gear"])): ?>

        <div style="margin-top:8px;">

            <strong>Rental Gear:</strong>

            <br>

            <?= htmlspecialchars(
                $booking["rental_gear"]
            ) ?>

        </div>

    <?php endif; ?>

</td>

<td>

<?= htmlspecialchars(
    $booking["booking_date"]
) ?>

<br>

<?= htmlspecialchars(
    $booking["booking_time"]
) ?>

</td>


<td>

<?= htmlspecialchars(
    $booking["guests"]
) ?>

</td>



<td>

<div class="payment-stack">

<div class="payment-method">

<?= htmlspecialchars(
    $payment_label
) ?>

</div>


<span
class="status-badge <?= htmlspecialchars(
    $payment_status
) ?>"
>

<?= strtoupper(
    htmlspecialchars(
        $payment_status
    )
) ?>

</span>


<?php if (
    $payment_method === "gcash" &&
    !empty(
        $booking["payment_proof"]
    )
): ?>

<a
    href="<?= htmlspecialchars(
        $booking["payment_proof"]
    ) ?>"
    target="_blank"
    class="proof-btn"
>
View Payment Proof
</a>

<?php endif; ?>


<?php if (
    (
        $payment_method === "gcash" ||
        $payment_method === "cash"
    ) &&
    $payment_status !== "paid"
): ?>

<form
    method="POST"
    action="update_payment.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="payment_status"
    value="paid"
>

<button
    type="submit"
    class="small-btn paid-btn"
>
Mark as Paid
</button>

</form>

<?php endif; ?>


</div>

</td>



<td>

<span
class="status-badge <?= htmlspecialchars(
    $booking_status
) ?>"
>

<?= strtoupper(
    htmlspecialchars(
        $booking_status
    )
) ?>

</span>

</td>



<td>

<div class="action-group">


<?php if (
    $booking_status === "pending"
): ?>

<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="confirmed"
>

<button
    type="submit"
    class="small-btn confirm-btn"
>
Confirm
</button>

</form>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="cancelled"
>

<button
    type="submit"
    class="small-btn cancel-btn"
>
Cancel
</button>

</form>


<?php elseif (
    $booking_status === "confirmed"
): ?>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="completed"
>

<button
    type="submit"
    class="small-btn complete-btn"
>
Complete
</button>

</form>


<form
    method="POST"
    action="update_booking.php"
>

<input
    type="hidden"
    name="booking_id"
    value="<?= (int)
        $booking["id"]
    ?>"
>

<input
    type="hidden"
    name="status"
    value="cancelled"
>

<button
    type="submit"
    class="small-btn cancel-btn"
>
Cancel
</button>

</form>


<?php else: ?>

—

<?php endif; ?>


</div>

</td>


</tr>


<?php endwhile; ?>


</tbody>

</table>


<?php else: ?>


<div class="no-bookings">

No bookings found.

</div>


<?php endif; ?>


</div>


</main>


</body>

</html>

<?php
$conn->close();
?>