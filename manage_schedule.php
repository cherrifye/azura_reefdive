<?php

session_start();

require_once "db.php";


if (
    !isset($_SESSION["user_id"]) ||
    ($_SESSION["role"] ?? "") !== "admin"
) {
    header("Location: login.php");
    exit;
}


/* =========================
   SCHEDULE ACTIONS
========================= */

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $action =
        $_POST["action"] ?? "add_schedule";


    /* =========================
       ADD NEW SCHEDULE
    ========================= */

    if ($action === "add_schedule") {

        $service_name =
            trim(
                $_POST["service_name"]
                ?? ""
            );

        $schedule_date =
            $_POST["schedule_date"]
            ?? "";

        $schedule_time =
            $_POST["schedule_time"]
            ?? "";

        $available_slots =
            (int) (
                $_POST["available_slots"]
                ?? 0
            );

        $is_available =
            isset($_POST["is_available"])
                ? 1
                : 0;


        if (
            $service_name === "" ||
            $schedule_date === "" ||
            $schedule_time === "" ||
            $available_slots < 0
        ) {

            $message =
                "Please complete all fields correctly.";

        } elseif (
            $schedule_date <
            date("Y-m-d")
        ) {

            $message =
                "You cannot add a schedule in the past.";

        } else {

            $stmt =
                $conn->prepare(
                    "
                    INSERT INTO dive_schedules
                    (
                        service_name,
                        schedule_date,
                        schedule_time,
                        available_slots,
                        is_available
                    )
                    VALUES (?, ?, ?, ?, ?)
                    "
                );

            if ($stmt) {

                $stmt->bind_param(
                    "sssii",
                    $service_name,
                    $schedule_date,
                    $schedule_time,
                    $available_slots,
                    $is_available
                );


                if ($stmt->execute()) {

                    $message =
                        "Schedule added successfully.";

                } else {

                    if (
                        $conn->errno === 1062
                    ) {

                        $message =
                            "That service, date, and time already exists.";

                    } else {

                        $message =
                            "Unable to add schedule.";

                    }

                }

                $stmt->close();

            } else {

                $message =
                    "Unable to add schedule.";

            }

        }

    }


    /* =========================
       UPDATE REMAINING SLOTS
    ========================= */

    elseif (
        $action === "update_slots"
    ) {

        $schedule_id =
            (int) (
                $_POST["schedule_id"]
                ?? 0
            );

        $available_slots =
            (int) (
                $_POST["available_slots"]
                ?? -1
            );


        if (
            $schedule_id <= 0 ||
            $available_slots < 0
        ) {

            $message =
                "Invalid schedule or slot amount.";

        } else {

            $stmt =
                $conn->prepare(
                    "
                    UPDATE dive_schedules
                    SET available_slots = ?
                    WHERE id = ?
                    "
                );

            if ($stmt) {

                $stmt->bind_param(
                    "ii",
                    $available_slots,
                    $schedule_id
                );

                if ($stmt->execute()) {

                    $message =
                        "Available slots updated.";

                } else {

                    $message =
                        "Unable to update slots.";

                }

                $stmt->close();

            }

        }

    }


    /* =========================
       AVAILABLE / UNAVAILABLE
    ========================= */

    elseif (
        $action === "toggle_status"
    ) {

        $schedule_id =
            (int) (
                $_POST["schedule_id"]
                ?? 0
            );

        $new_status =
            (int) (
                $_POST["new_status"]
                ?? 0
            );

        $new_status =
            $new_status === 1
                ? 1
                : 0;


        if ($schedule_id <= 0) {

            $message =
                "Invalid schedule.";

        } else {

            $stmt =
                $conn->prepare(
                    "
                    UPDATE dive_schedules
                    SET is_available = ?
                    WHERE id = ?
                    "
                );

            if ($stmt) {

                $stmt->bind_param(
                    "ii",
                    $new_status,
                    $schedule_id
                );

                if ($stmt->execute()) {

                    $message =
                        $new_status === 1
                            ? "Schedule is now available."
                            : "Schedule is now unavailable.";

                } else {

                    $message =
                        "Unable to update schedule status.";

                }

                $stmt->close();

            }

        }

    }

}


/* =========================
   GET ALL SCHEDULES
========================= */

$schedules =
    $conn->query(
        "SELECT *
         FROM dive_schedules
         ORDER BY schedule_date ASC,
                  schedule_time ASC"
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
Manage Schedule | Azura Reef
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
    background:
        var(--mint-50);
}

.schedule-admin {
    max-width: 1100px;

    margin: auto;

    padding:
        45px 20px 80px;
}

.schedule-heading {
    margin-bottom: 25px;
}

.schedule-heading h1 {
    margin-bottom: 8px;

    color:
        var(--teal-900);

    font-family:
        "Fraunces", serif;

    font-size: 2.4rem;
}

.schedule-heading p {
    color:
        var(--muted);
}

.admin-topbar {
    background:
        white;

    border-bottom:
        1px solid var(--border);
}

.admin-topbar-inner {
    max-width: 1100px;

    min-height: 70px;

    margin: auto;
    padding: 0 20px;

    display: flex;

    align-items: center;
    justify-content: space-between;
}

.admin-topbar a {
    color:
        var(--teal-900);

    text-decoration: none;

    font-weight: 700;

    font-size: .8rem;
}

.form-card,
.table-card {
    background:
        white;

    border:
        1px solid var(--border);

    border-radius: 16px;

    padding: 24px;

    margin-bottom: 30px;

    box-shadow:
        0 18px 40px -32px
        rgba(13,58,55,.45);
}

.form-card h2,
.table-card h2 {
    margin-bottom: 18px;

    color:
        var(--teal-900);

    font-family:
        "Fraunces", serif;
}

.form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 15px;
}

.form-group {
    display: flex;

    flex-direction: column;

    gap: 6px;
}

.form-group label {
    color:
        var(--teal-900);

    font-size: .78rem;

    font-weight: 700;
}

.form-group input,
.form-group select {
    width: 100%;

    padding: 11px 12px;

    border:
        1px solid var(--border);

    border-radius: 8px;

    font-family:
        "Inter", sans-serif;
}

.checkbox-row {
    display: flex;

    align-items: center;

    gap: 8px;

    margin-top: 15px;

    color:
        var(--muted);

    font-size: .8rem;
}

.form-actions {
    margin-top: 20px;
}

.message {
    margin-bottom: 20px;

    padding: 12px 14px;

    background:
        var(--mint-100);

    color:
        var(--teal-900);

    border-radius: 8px;

    font-size: .82rem;
}

.table-wrap {
    overflow-x: auto;
}

table {
    width: 100%;

    border-collapse: collapse;

    min-width: 800px;
}

th {
    background:
        var(--teal-900);

    color: white;

    padding: 12px;

    text-align: left;

    font-size: .72rem;
}

td {
    padding: 13px 12px;

    border-bottom:
        1px solid var(--border);

    font-size: .8rem;
}

.status-active {
    color:
        #1f684c;

    font-weight: 700;
}

.status-inactive {
    color:
        #983939;

    font-weight: 700;
}

@media(max-width: 700px) {

    .form-grid {
        grid-template-columns: 1fr;
    }

}

</style>

</head>


<body>


<header class="admin-topbar">

<div class="admin-topbar-inner">

<a href="admin_dashboard.php">
← Back to Dashboard
</a>

<a href="logout.php">
Log Out
</a>

</div>

</header>


<main class="schedule-admin">


<div class="schedule-heading">

<h1>
Manage Schedule
</h1>

<p>
Add available dates, times,
and booking slots for each service.
</p>

</div>


<?php if ($message !== ""): ?>

<div class="message">

<?= htmlspecialchars($message) ?>

</div>

<?php endif; ?>


<div class="form-card">

<h2>
Add Schedule
</h2>


<form
    method="POST"
    action="manage_schedule.php"
>


<div class="form-grid">


<div class="form-group">

<label>
Service
</label>

<select
    name="service_name"
    required
>

<option value="">
Select Service
</option>

<option>
Tubod Marine Sanctuary
</option>

<option>
Paliton Reef Dive
</option>

<option>
Maite Reef Adventure
</option>

<option>
Coral Garden Snorkeling
</option>

<option>
Turtle & Reef Adventure
</option>

<option>
Island Snorkeling Experience
</option>

<option>
Discover Scuba Diving
</option>

<option>
Open Water Certification
</option>

<option>
Advanced Open Water
</option>

</select>

</div>


<div class="form-group">

<label>
Date
</label>

<input
    type="date"
    name="schedule_date"
    required
>

</div>


<div class="form-group">

<label>
Time
</label>

<input
    type="time"
    name="schedule_time"
    required
>

</div>


<div class="form-group">

<label>
Available Slots
</label>

<input
    type="number"
    name="available_slots"
    min="0"
    value="6"
    required
>

</div>


</div>


<label class="checkbox-row">

<input
    type="checkbox"
    name="is_available"
    checked
>

Available for booking

</label>


<div class="form-actions">

<button
    type="submit"
    class="btn btn-dark"
>
Add Schedule
</button>

</div>


</form>

</div>


<div class="table-card">

<h2>
Current Schedules
</h2>


<?php if (
    $schedules &&
    $schedules->num_rows > 0
): ?>


<div class="table-wrap">

<table>

<thead>

<tr>

<th>
Service
</th>

<th>
Date
</th>

<th>
Time
</th>

<th>
Slots
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
    $schedule =
    $schedules->fetch_assoc()
): ?>


<tr>

<td>

<?= htmlspecialchars(
    $schedule["service_name"]
) ?>

</td>


<td>

<?= htmlspecialchars(
    $schedule["schedule_date"]
) ?>

</td>


<td>

<?= date(
    "g:i A",
    strtotime(
        $schedule["schedule_time"]
    )
) ?>

</td>


<td>

<?= (int)
    $schedule["available_slots"]
?>

</td>


<td>

<?php if (
    (int)
    $schedule["is_available"] === 1
): ?>

<span class="status-active">
Available
</span>

<?php else: ?>

<span class="status-inactive">
Unavailable
</span>

<?php endif; ?>

</td>

<td>

<form
    method="POST"
    action="manage_schedule.php"
    style="margin-bottom:8px;"
>

<input
    type="hidden"
    name="action"
    value="update_slots"
>

<input
    type="hidden"
    name="schedule_id"
    value="<?= (int) $schedule["id"] ?>"
>

<input
    type="number"
    name="available_slots"
    min="0"
    value="<?= (int) $schedule["available_slots"] ?>"
    style="
        width:70px;
        padding:6px;
        margin-right:5px;
    "
>

<button
    type="submit"
    class="btn btn-dark"
>
Update Slots
</button>

</form>


<form
    method="POST"
    action="manage_schedule.php"
>

<input
    type="hidden"
    name="action"
    value="toggle_status"
>

<input
    type="hidden"
    name="schedule_id"
    value="<?= (int) $schedule["id"] ?>"
>

<input
    type="hidden"
    name="new_status"
    value="<?=
        (int) $schedule["is_available"] === 1
            ? 0
            : 1
    ?>"
>

<button
    type="submit"
    class="btn"
>
<?=
    (int) $schedule["is_available"] === 1
        ? "Make Unavailable"
        : "Make Available"
?>
</button>

</form>

</td>

</tr>


<?php endwhile; ?>


</tbody>

</table>

</div>


<?php else: ?>

<p>
No schedules added yet.
</p>

<?php endif; ?>


</div>


</main>


</body>

</html>


<?php

$conn->close();

?>