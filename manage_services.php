<?php

session_start();

require_once "db.php";

/* =========================
   ADMIN ONLY
========================= */

if (
    !isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin"
) {
    header("Location: login.php");
    exit;
}


/* =========================
   GET SERVICES
========================= */

$services = $conn->query(
    "SELECT *
     FROM services
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

<title>Manage Services | Azura Reef</title>

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

.services-page {
    min-height: 100vh;
}

.services-header {
    background: white;
    border-bottom: 1px solid var(--border);
}

.services-nav {
    width: 100%;
    min-height: 82px;

    padding: 0 55px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    box-sizing: border-box;
}

.services-brand {
    display: flex;
    align-items: center;
    gap: 10px;

    text-decoration: none;
}

.services-brand img {
    width: 46px;
    height: 46px;
    object-fit: contain;
}

.services-brand span {
    font-family: "Fraunces", serif;
    font-size: 1.45rem;
    font-weight: 700;
    color: var(--teal-900);
}

.services-nav-links {
    display: flex;
    align-items: center;
    gap: 18px;
}

.services-nav-links a {
    color: var(--teal-900);
    text-decoration: none;

    font-size: 16px;
    font-weight: 700;
}

.services-container {
    max-width: 1200px;

    margin: auto;
    padding: 55px 20px 80px;
}

.services-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 25px;

    margin-bottom: 28px;
}

.services-heading h1 {
    margin: 0 0 7px;

    font-family: "Fraunces", serif;

    color: var(--teal-900);

    font-size: 2.4rem;
}

.services-heading p {
    margin: 0;

    color: var(--muted);

    font-size: .9rem;
}

.add-service-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 12px 19px;

    background: var(--teal-900);
    color: white;

    border-radius: 9px;

    text-decoration: none;

    font-size: .8rem;
    font-weight: 700;
}

.services-card {
    background: white;

    border: 1px solid var(--border);
    border-radius: 18px;

    overflow: hidden;

    box-shadow:
        0 20px 45px -34px
        rgba(13, 58, 55, .5);
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: var(--teal-900);
}

th {
    padding: 15px 14px;

    color: rgba(255,255,255,.85);

    text-align: left;

    font-size: .7rem;
    letter-spacing: .05em;

    text-transform: uppercase;
}

td {
    padding: 17px 14px;

    border-bottom: 1px solid var(--border);

    color: var(--ink);

    font-size: .82rem;
}

tbody tr:last-child td {
    border-bottom: none;
}

.service-name {
    color: var(--teal-900);
    font-weight: 700;
}

.service-type {
    text-transform: capitalize;
}

.service-status {
    display: inline-flex;

    padding: 6px 10px;

    border-radius: 999px;

    font-size: .67rem;
    font-weight: 700;
}

.status-active {
    background: #e4f5ed;
    color: #1f684c;
}

.status-inactive {
    background: #fde9e9;
    color: #983939;
}

.service-actions {
    display: flex;
    gap: 7px;
}

.action-link {
    padding: 7px 10px;

    border-radius: 7px;

    text-decoration: none;

    font-size: .68rem;
    font-weight: 700;
}

.edit-link {
    background: var(--mint-100);
    color: var(--teal-900);
}

.delete-link {
    background: #fde9e9;
    color: #983939;
}

.no-services {
    padding: 55px 20px;

    text-align: center;

    color: var(--muted);
}

</style>

</head>

<body>

<div class="services-page">

<header class="services-header">

<div class="services-nav">

<a
    href="admin_dashboard.php"
    class="services-brand"
>

    <img
        src="images/daybbb .png"
        alt="Azura Reef"
    >

    <span>
        Azura Reef
    </span>

</a>

<div class="services-nav-links">

    <a href="admin_dashboard.php">
        Dashboard
    </a>

    <a href="manage_schedule.php">
        Manage Schedule
    </a>

    <a href="logout.php">
        Log Out
    </a>

</div>

</div>

</header>


<main class="services-container">

<div class="services-heading">

<div>

<h1>
    Manage Services
</h1>

<p>
    Create and manage dives, snorkeling tours, courses, and gears.
</p>

</div>

<a
    href="add_service.php"
    class="add-service-btn"
>
    + Add Service
</a>

</div>


<div class="services-card">

<?php if (
    $services &&
    $services->num_rows > 0
): ?>

<table>

<thead>

<tr>

<th>
    Image
</th>

<th>
    Service
</th>

<th>
    Type
</th>

<th>
    Description
</th>

<th>
    Price
</th>

<th>
    Status
</th>

<th>
    Actions
</th>

</tr>

</thead>

<tbody>

<?php while (
    $service = $services->fetch_assoc()
): ?>

<tr>

<td>

<?php if (!empty($service["image"])): ?>

<img
    src="<?= htmlspecialchars($service["image"]) ?>"
    alt="<?= htmlspecialchars($service["service_name"]) ?>"
    style="
        width:90px;
        height:65px;
        object-fit:cover;
        border-radius:9px;
        display:block;
    "
>

<?php else: ?>

<span style="color:var(--muted);">
    No image
</span>

<?php endif; ?>

</td>

<td>

<div class="service-name">

<?= htmlspecialchars(
    $service["service_name"]
) ?>

</div>

</td>

<td class="service-type">

<?= htmlspecialchars(
    $service["service_type"]
) ?>

</td>

<td>

<?= htmlspecialchars(
    $service["description"] ?? ""
) ?>

</td>

<td>

₱<?= number_format(
    (float) $service["price"],
    2
) ?>

</td>

<td>

<?php if (
    (int) $service["is_active"] === 1
): ?>

<span class="service-status status-active">
    Active
</span>

<?php else: ?>

<span class="service-status status-inactive">
    Inactive
</span>

<?php endif; ?>

</td>

<td>

<div class="service-actions">

<a
    href="edit_service.php?id=<?= (int) $service["id"] ?>"
    class="action-link edit-link"
>
    Edit
</a>

<form
    method="POST"
    action="delete_service.php"
    onsubmit="return confirm('Are you sure you want to delete this service?');"
    style="margin:0;"
>

<input
    type="hidden"
    name="service_id"
    value="<?= (int) $service["id"] ?>"
>

<button
    type="submit"
    class="action-link delete-link"
    style="border:none; cursor:pointer;"
>
    Delete
</button>

</form>

</div>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

<?php else: ?>

<div class="no-services">

No services yet.

</div>

<?php endif; ?>

</div>

</main>

</div>

</body>

</html>

<?php

$conn->close();

?>