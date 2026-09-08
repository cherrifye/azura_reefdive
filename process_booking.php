<?php
session_start();

require_once "db.php";

/* Only accept POST requests */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: booking.php");
    exit;
}


/* Get booking information */

$user_id = $_SESSION["user_id"] ?? null;

$full_name = trim($_POST["full_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");

$service_type = trim($_POST["service_type"] ?? "");
$service_name = trim($_POST["service_name"] ?? "");

$booking_date = trim($_POST["booking_date"] ?? "");
$booking_time = trim($_POST["booking_time"] ?? "");

$guests = (int) ($_POST["guests"] ?? 1);

$equipment = trim($_POST["equipment"] ?? "");
$certification = trim($_POST["certification"] ?? "None");

$notes = trim($_POST["notes"] ?? "");

$payment_method = trim($_POST["payment_method"] ?? "");


/* Basic validation */

if (
    empty($full_name) ||
    empty($email) ||
    empty($phone) ||
    empty($service_type) ||
    empty($service_name) ||
    empty($booking_date) ||
    empty($booking_time) ||
    empty($equipment) ||
    empty($payment_method)
) {
    die("Please complete all required fields.");
}


if ($guests < 1) {
    $guests = 1;
}


/* Check allowed payment methods */

$allowed_payment_methods = [
    "cash",
    "gcash",
    "card"
];

if (!in_array($payment_method, $allowed_payment_methods, true)) {
    die("Invalid payment method.");
}


/*
|--------------------------------------------------------------------------
| Payment Status
|--------------------------------------------------------------------------
|
| Cash:
| Customer has not paid yet.
|
| GCash:
| Customer uploads proof.
| Admin still needs to verify it.
|
| Card:
| This is only a DEMO payment for the school project.
| We DO NOT save card number or security code.
|
*/

$payment_status = "unpaid";
$payment_proof = null;


if ($payment_method === "gcash") {

    $payment_status = "pending";


    /*
    |--------------------------------------------------------------------------
    | Check uploaded GCash proof
    |--------------------------------------------------------------------------
    */

    if (
        !isset($_FILES["payment_proof"]) ||
        $_FILES["payment_proof"]["error"] !== UPLOAD_ERR_OK
    ) {
        die("Please upload your GCash payment proof.");
    }


    $file = $_FILES["payment_proof"];


    /* Maximum file size: 5 MB */

    $max_file_size = 5 * 1024 * 1024;

    if ($file["size"] > $max_file_size) {
        die("Payment proof must be 5 MB or smaller.");
    }


    /*
    |--------------------------------------------------------------------------
    | Validate image type
    |--------------------------------------------------------------------------
    */

    $finfo = new finfo(FILEINFO_MIME_TYPE);

    $mime_type = $finfo->file($file["tmp_name"]);


    $allowed_types = [
        "image/jpeg" => "jpg",
        "image/png"  => "png"
    ];


    if (!isset($allowed_types[$mime_type])) {
        die("Payment proof must be a JPG, JPEG, or PNG image.");
    }


    $extension = $allowed_types[$mime_type];


    /*
    |--------------------------------------------------------------------------
    | Create upload folder if it does not exist
    |--------------------------------------------------------------------------
    */

    $upload_folder = __DIR__ . "/uploads/payment_proofs/";

    if (!is_dir($upload_folder)) {

        if (!mkdir($upload_folder, 0755, true)) {
            die("Unable to create payment proof folder.");
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Generate a unique filename
    |--------------------------------------------------------------------------
    */

    $new_filename =
        "gcash_" .
        time() .
        "_" .
        bin2hex(random_bytes(4)) .
        "." .
        $extension;


    $destination =
        $upload_folder .
        $new_filename;


    /*
    |--------------------------------------------------------------------------
    | Move uploaded image
    |--------------------------------------------------------------------------
    */

    if (
        !move_uploaded_file(
            $file["tmp_name"],
            $destination
        )
    ) {

        die("Unable to save payment proof.");

    }


    /*
    |--------------------------------------------------------------------------
    | Path saved in database
    |--------------------------------------------------------------------------
    */

    $payment_proof =
        "uploads/payment_proofs/" .
        $new_filename;

}


/*
|--------------------------------------------------------------------------
| Demo Card Payment
|--------------------------------------------------------------------------
|
| IMPORTANT:
| Do not save the full card number or CVV.
|
*/

if ($payment_method === "card") {

    $cardholder_name =
        trim($_POST["cardholder_name"] ?? "");

    $card_number =
        preg_replace(
            "/\D/",
            "",
            $_POST["card_number"] ?? ""
        );

    $expiration_date =
        trim($_POST["expiration_date"] ?? "");

    $security_code =
        preg_replace(
            "/\D/",
            "",
            $_POST["security_code"] ?? ""
        );


    if (
        empty($cardholder_name) ||
        empty($card_number) ||
        empty($expiration_date) ||
        empty($security_code)
    ) {

        die("Please complete the demo card information.");

    }


    /*
    |--------------------------------------------------------------------------
    | Simple demo validation
    |--------------------------------------------------------------------------
    */

    if (strlen($card_number) !== 16) {
        die("For the demo, enter a 16-digit test card number.");
    }


    if (
        strlen($security_code) < 3 ||
        strlen($security_code) > 4
    ) {

        die("Enter a valid demo security code.");

    }


    /*
    |--------------------------------------------------------------------------
    | Simulate successful card payment
    |--------------------------------------------------------------------------
    |
    | Since this school project is NOT connected to a real payment gateway,
    | the card payment is only simulated.
    |
    */

    $payment_status = "paid";


    /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    |--------------------------------------------------------------------------
    |
    | We intentionally do NOT insert:
    |
    | $card_number
    | $security_code
    |
    | into the database.
    |
    */

}


/*
|--------------------------------------------------------------------------
| Insert booking into database
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare(
    "INSERT INTO bookings (
        user_id,
        full_name,
        email,
        phone,
        service_type,
        service_name,
        booking_date,
        booking_time,
        guests,
        equipment,
        certification,
        notes,
        payment_method,
        payment_status,
        payment_proof
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);


if (!$stmt) {
    die(
        "Database error: " .
        $conn->error
    );
}


$stmt->bind_param(
    "isssssssissssss",
    $user_id,
    $full_name,
    $email,
    $phone,
    $service_type,
    $service_name,
    $booking_date,
    $booking_time,
    $guests,
    $equipment,
    $certification,
    $notes,
    $payment_method,
    $payment_status,
    $payment_proof
);


if ($stmt->execute()) {

    $booking_id =
        $stmt->insert_id;


    header(
        "Location: confirmation.php?id=" .
        $booking_id
    );

    exit;

} else {

    die(
        "Unable to save booking: " .
        $stmt->error
    );

}


$stmt->close();

$conn->close();
?>