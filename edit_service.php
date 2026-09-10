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
   GET SERVICE ID
========================= */

$service_id =
    isset($_GET["id"])
        ? (int) $_GET["id"]
        : 0;

if ($service_id <= 0) {
    header("Location: manage_services.php");
    exit;
}


/* =========================
   GET SERVICE
========================= */

$stmt = $conn->prepare(
    "SELECT *
     FROM services
     WHERE id = ?"
);

$stmt->bind_param(
    "i",
    $service_id
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {

    $stmt->close();

    header("Location: manage_services.php");
    exit;
}

$service =
    $result->fetch_assoc();

$stmt->close();


/* =========================
   UPDATE SERVICE
========================= */

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $service_name =
        trim($_POST["service_name"] ?? "");

    $service_type =
        trim($_POST["service_type"] ?? "");

    $description =
        trim($_POST["description"] ?? "");

    $price =
        trim($_POST["price"] ?? "");

    $image_path =
       $service["image"] ?? null;

    $is_active =
        isset($_POST["is_active"])
            ? (int) $_POST["is_active"]
            : 1;


    /* =========================
       VALIDATION
    ========================= */

    if (
        $service_name === "" ||
        $service_type === "" ||
        $price === ""
    ) {

        $error =
            "Please complete all required fields.";

    } elseif (
        !in_array(
            $service_type,
            [
                "dive",
                "snorkeling",
                "course",
                "gear"
            ],
            true
        )
    ) {

        $error =
            "Invalid service type.";

    } elseif (
        !is_numeric($price) ||
        (float) $price < 0
    ) {

        $error =
            "Please enter a valid price.";

    } elseif (
        !in_array(
            $is_active,
            [0, 1],
            true
        )
    ) {

        $error =
            "Invalid service status.";

}

/* =========================
   UPDATE IMAGE
========================= */

if (
    $error === "" &&
    isset($_FILES["service_image"]) &&
    $_FILES["service_image"]["error"] !== UPLOAD_ERR_NO_FILE
) {

    if (
        $_FILES["service_image"]["error"] !== UPLOAD_ERR_OK
    ) {

        $error =
            "There was a problem uploading the image.";

    } else {

        $allowed_types = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];

        $file_type =
            mime_content_type(
                $_FILES["service_image"]["tmp_name"]
            );

        if (
            !in_array(
                $file_type,
                $allowed_types,
                true
            )
        ) {

            $error =
                "Only JPG, PNG, and WEBP images are allowed.";

        } elseif (
            $_FILES["service_image"]["size"]
            > 5 * 1024 * 1024
        ) {

            $error =
                "Image must be 5MB or smaller.";

        } else {

            if ($file_type === "image/jpeg") {
                $extension = "jpg";
            } elseif ($file_type === "image/png") {
                $extension = "png";
            } else {
                $extension = "webp";
            }

            $upload_folder =
    __DIR__ . "/uploads/service_images/";
            if (!is_dir($upload_folder)) {
                mkdir(
                    $upload_folder,
                    0777,
                    true
                );
            }

            $filename =
                "service_" .
                time() .
                "_" .
                bin2hex(random_bytes(4)) .
                "." .
                $extension;

            $destination =
                $upload_folder .
                $filename;

            if (
                move_uploaded_file(
                    $_FILES["service_image"]["tmp_name"],
                    $destination
                )
            ) {

                $image_path =
                  "uploads/service_images/" .
                   $filename;

            } else {

                $error =
                    "Unable to save the uploaded image.";
            }
        }
    }
}


/* =========================
   UPDATE SERVICE
========================= */

if ($error === "") {

    $price_value =
        (float) $price;

        

        $update = $conn->prepare(
            "
            UPDATE services

            SET
                service_name = ?,
                service_type = ?,
                description = ?,
                image = ?,
                price = ?,
                is_active = ?

            WHERE id = ?
            "
        );

        $update->bind_param(
            "ssssdii",
            $service_name,
            $service_type,
            $description,
            $image_path,
            $price_value,
            $is_active,
            $service_id
        );

        if ($update->execute()) {

            $update->close();

            header(
                "Location: manage_services.php"
            );

            exit;

        } else {

            $error =
                "Unable to update the service.";
        }

        $update->close();
    }


    $service["service_name"] =
        $service_name;

    $service["service_type"] =
        $service_type;

    $service["description"] =
        $description;

    $service["price"] =
        $price;

    $service["is_active"] =
        $is_active;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Edit Service | Azura Reef</title>

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

.edit-service-page {
    min-height: 100vh;
}

.edit-service-header {
    background: white;

    border-bottom:
        1px solid var(--border);
}

.edit-service-nav {
    width: 100%;
    min-height: 82px;

    padding: 0 55px;

    box-sizing: border-box;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.edit-service-brand {
    display: flex;
    align-items: center;

    gap: 10px;

    text-decoration: none;
}

.edit-service-brand img {
    width: 46px;
    height: 46px;

    object-fit: contain;
}

.edit-service-brand span {
    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 1.45rem;
    font-weight: 700;
}

.back-link {
    color: var(--teal-900);

    text-decoration: none;

    font-size: 16px;
    font-weight: 700;
}

.back-link:hover {
    color: var(--teal-500);
}

.edit-service-container {
    max-width: 760px;

    margin: auto;

    padding:
        55px 20px
        80px;
}

.page-eyebrow {
    display: block;

    margin-bottom: 8px;

    color: var(--teal-500);

    font-size: .68rem;
    font-weight: 700;

    letter-spacing: .15em;
}

.edit-service-container h1 {
    margin: 0 0 8px;

    color: var(--teal-900);

    font-family:
        "Fraunces",
        serif;

    font-size: 2.4rem;
}

.edit-service-container > p {
    margin: 0 0 28px;

    color: var(--muted);

    font-size: .9rem;
}

.service-form {
    background: white;

    border:
        1px solid
        var(--border);

    border-radius: 18px;

    padding: 30px;

    box-shadow:
        0 20px 45px -34px
        rgba(13,58,55,.5);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;

    margin-bottom: 7px;

    color: var(--teal-900);

    font-size: .8rem;
    font-weight: 700;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;

    padding: 12px 13px;

    box-sizing: border-box;

    border:
        1px solid
        var(--border);

    border-radius: 9px;

    background: white;

    color: var(--ink);

    font-family:
        "Inter",
        sans-serif;

    font-size: .85rem;
}

.form-group textarea {
    min-height: 120px;

    resize: vertical;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;

    border-color:
        var(--teal-500);
}

.status-note {
    margin-top: 7px;

    color: var(--muted);

    font-size: .72rem;
    line-height: 1.5;
}

.form-actions {
    display: flex;

    gap: 10px;

    margin-top: 25px;
}

.save-btn,
.cancel-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 12px 18px;

    border-radius: 9px;

    font-family:
        "Inter",
        sans-serif;

    font-size: .8rem;
    font-weight: 700;

    text-decoration: none;
}

.save-btn {
    border: none;

    background:
        var(--teal-900);

    color: white;

    cursor: pointer;
}

.save-btn:hover {
    background:
        var(--teal-700);
}

.cancel-btn {
    background: white;

    color:
        var(--teal-900);

    border:
        1px solid
        var(--teal-900);
}

.cancel-btn:hover {
    background:
        var(--mint-50);
}

.error-message {
    margin-bottom: 20px;

    padding: 12px 14px;

    background: #fde9e9;

    border:
        1px solid
        #f3caca;

    border-radius: 9px;

    color: #983939;

    font-size: .8rem;
}

@media(max-width: 650px) {

    .edit-service-nav {
        padding: 0 20px;
    }

    .edit-service-brand span {
        display: none;
    }

    .service-form {
        padding: 22px;
    }

    .form-actions {
        flex-direction: column;
    }

    .save-btn,
    .cancel-btn {
        width: 100%;
    }
}

</style>

</head>

<body>

<div class="edit-service-page">

<header class="edit-service-header">

<div class="edit-service-nav">

<a
    href="admin_dashboard.php"
    class="edit-service-brand"
>

<img
    src="images/daybbb .png"
    alt="Azura Reef"
>

<span>
    Azura Reef
</span>

</a>

<a
    href="manage_services.php"
    class="back-link"
>
    ← Back to Services
</a>

</div>

</header>


<main class="edit-service-container">

<span class="page-eyebrow">
    SERVICE MANAGEMENT
</span>

<h1>
    Edit Service
</h1>

<p>
    Update the service information,
    price, type, or availability.
</p>


<?php if ($error !== ""): ?>

<div class="error-message">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>


<form
    method="POST"
    enctype="multipart/form-data"
    class="service-form"
>

<div class="form-group">

<label for="service_name">
    Service Name
</label>

<input
    type="text"
    id="service_name"
    name="service_name"
    required
    value="<?= htmlspecialchars(
        $service["service_name"]
    ) ?>"
>

</div>


<div class="form-group">

<label for="service_type">
    Service Type
</label>

<select
    id="service_type"
    name="service_type"
    required
>

<option
    value="dive"
    <?= (
        $service["service_type"]
        === "dive"
    ) ? "selected" : "" ?>
>
    Dive
</option>

<option
    value="snorkeling"
    <?= (
        $service["service_type"]
        === "snorkeling"
    ) ? "selected" : "" ?>
>
    Snorkeling
</option>

<option
    value="course"
    <?= (
        $service["service_type"]
        === "course"
    ) ? "selected" : "" ?>
>
    Course
</option>

<option
    value="gear"
    <?= (
        $service["service_type"]
        === "gear"
    ) ? "selected" : "" ?>
>
    Gear Rental
</option>

</select>

</div>


<div class="form-group">

<label for="description">
    Description
</label>

<textarea
    id="description"
    name="description"
><?= htmlspecialchars(
    $service["description"]
    ?? ""
) ?></textarea>

</div>

<div class="form-group">

<label for="service_image">
    Service Image
</label>

<?php if (!empty($service["image"])): ?>

<img
    src="<?= htmlspecialchars($service["image"]) ?>"
    alt="<?= htmlspecialchars($service["service_name"]) ?>"
    style="
        width:100%;
        max-width:350px;
        height:200px;
        object-fit:cover;
        border-radius:12px;
        margin-bottom:12px;
    "
>

<?php endif; ?>

<input
    type="file"
    id="service_image"
    name="service_image"
    accept=".jpg,.jpeg,.png,.webp"
>

<div class="status-note">
    Leave this empty if you want to keep the current image.
</div>

</div>

<div class="form-group">

<label for="price">
    Price
</label>

<input
    type="number"
    id="price"
    name="price"
    min="0"
    step="0.01"
    required
    value="<?= htmlspecialchars(
        $service["price"]
    ) ?>"
>

</div>


<div class="form-group">

<label for="is_active">
    Service Status
</label>

<select
    id="is_active"
    name="is_active"
>

<option
    value="1"
    <?= (
        (int) $service["is_active"] === 1
    ) ? "selected" : "" ?>
>
    Active
</option>

<option
    value="0"
    <?= (
        (int) $service["is_active"] === 0
    ) ? "selected" : "" ?>
>
    Inactive
</option>

</select>

<div class="status-note">
    Inactive services stay in your records
    but can later be hidden from customers.
</div>

</div>


<div class="form-actions">

<button
    type="submit"
    class="save-btn"
>
    Save Changes
</button>

<a
    href="manage_services.php"
    class="cancel-btn"
>
    Cancel
</a>

</div>

</form>

</main>

</div>

</body>

</html>

<?php

$conn->close();

?>