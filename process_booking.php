<?php

session_start();

require_once "db.php";


/* =========================
   ONLY ACCEPT POST REQUEST
========================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: booking.php");
    exit;

}


/* =========================
   GET FORM DATA
========================= */

$user_id =
    $_SESSION["user_id"] ?? null;

$full_name =
    trim($_POST["full_name"] ?? "");

$email =
    trim($_POST["email"] ?? "");

$phone =
    trim($_POST["phone"] ?? "");

$service_type =
    trim($_POST["service_type"] ?? "");

$service_name =
    trim($_POST["service_name"] ?? "");

$booking_date =
    trim($_POST["booking_date"] ?? "");

$booking_time =
    trim($_POST["booking_time"] ?? "");

$guests =
    (int) ($_POST["guests"] ?? 1);

$equipment =
    trim($_POST["equipment"] ?? "");

$certification =
    trim($_POST["certification"] ?? "None");

$notes =
    trim($_POST["notes"] ?? "");

$payment_method =
    trim($_POST["payment_method"] ?? "");


/* =========================
   REQUIRED FIELDS
========================= */

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


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die("Please enter a valid email address.");

}


if ($guests < 1) {

    $guests = 1;

}


/* =========================
   PREVENT PAST DATES
========================= */

$today =
    date("Y-m-d");


if ($booking_date < $today) {

    die("Booking date cannot be in the past.");

}


/* =========================
   VALID SERVICES
========================= */

$allowed_services = [

    "dive" => [
        "Tubod Marine Sanctuary",
        "Paliton Reef Dive",
        "Maite Reef Adventure"
    ],

    "snorkeling" => [
        "Coral Garden Snorkeling",
        "Turtle & Reef Adventure",
        "Island Snorkeling Experience"
    ],

    "course" => [
        "Discover Scuba Diving",
        "Open Water Certification",
        "Advanced Open Water"
    ],

    "gear" => [
        "Complete Scuba Set",
        "BCD Rental",
        "Regulator Rental",
        "Wetsuit Rental",
        "Mask & Fins Set",
        "Tank Rental"
    ]

];


if (
    !isset($allowed_services[$service_type]) ||
    !in_array(
        $service_name,
        $allowed_services[$service_type],
        true
    )
) {

    die("Invalid service selected.");

}


/* =========================
   RENTAL EQUIPMENT
========================= */

$rental_gear_items =
    $_POST["rental_gear"] ?? [];


if (!is_array($rental_gear_items)) {

    $rental_gear_items = [];

}


$allowed_rental_gear = [

    "Complete Scuba Set",
    "BCD Rental",
    "Regulator Rental",
    "Wetsuit Rental",
    "Mask & Fins Set",
    "Tank Rental"

];


$valid_rental_gear = [];


foreach (
    $rental_gear_items as $item
) {

    if (
        in_array(
            $item,
            $allowed_rental_gear,
            true
        )
    ) {

        $valid_rental_gear[] = $item;

    }

}


/*
If they chose rental equipment
for a dive or snorkeling booking,
they must select at least one item.
*/

if (
    (
        $service_type === "dive" ||
        $service_type === "snorkeling"
    ) &&
    $equipment === "Yes" &&
    empty($valid_rental_gear)
) {

    die(
        "Please choose at least one rental equipment item."
    );

}


/*
Save selected gear as:

BCD Rental, Wetsuit Rental, Tank Rental
*/

$rental_gear =
    !empty($valid_rental_gear)
        ? implode(", ", $valid_rental_gear)
        : null;



/* =========================
   PAYMENT METHOD
========================= */

$allowed_payment_methods = [
    "cash",
    "gcash",
    "card"
];


if (
    !in_array(
        $payment_method,
        $allowed_payment_methods,
        true
    )
) {

    die("Invalid payment method.");

}


$payment_status = "unpaid";

$payment_proof = null;



/* =========================
   GCASH
========================= */

if (
    $payment_method === "gcash"
) {

    $payment_status = "pending";


    if (
        !isset($_FILES["payment_proof"]) ||
        $_FILES["payment_proof"]["error"]
            !== UPLOAD_ERR_OK
    ) {

        die(
            "Please upload your GCash payment proof."
        );

    }


    $file =
        $_FILES["payment_proof"];


    $max_file_size =
        5 * 1024 * 1024;


    if (
        $file["size"] > $max_file_size
    ) {

        die(
            "Payment proof must be 5 MB or smaller."
        );

    }


    $finfo =
        new finfo(
            FILEINFO_MIME_TYPE
        );


    $mime_type =
        $finfo->file(
            $file["tmp_name"]
        );


    $allowed_types = [

        "image/jpeg" => "jpg",

        "image/png" => "png"

    ];


    if (
        !isset(
            $allowed_types[$mime_type]
        )
    ) {

        die(
            "Payment proof must be a JPG, JPEG, or PNG image."
        );

    }


    $extension =
        $allowed_types[$mime_type];


    $upload_folder =
        __DIR__
        . "/uploads/payment_proofs/";


    if (
        !is_dir($upload_folder)
    ) {

        if (
            !mkdir(
                $upload_folder,
                0755,
                true
            )
        ) {

            die(
                "Unable to create payment proof folder."
            );

        }

    }


    $new_filename =
        "gcash_"
        . time()
        . "_"
        . bin2hex(
            random_bytes(4)
        )
        . "."
        . $extension;


    $destination =
        $upload_folder
        . $new_filename;


    if (
        !move_uploaded_file(
            $file["tmp_name"],
            $destination
        )
    ) {

        die(
            "Unable to save payment proof."
        );

    }


    $payment_proof =
        "uploads/payment_proofs/"
        . $new_filename;

}



/* =========================
   DEMO CARD
========================= */

if (
    $payment_method === "card"
) {

    $cardholder_name =
        trim(
            $_POST["cardholder_name"]
            ?? ""
        );


    $card_number =
        preg_replace(
            "/\D/",
            "",
            $_POST["card_number"]
            ?? ""
        );


    $expiration_date =
        trim(
            $_POST["expiration_date"]
            ?? ""
        );


    $security_code =
        preg_replace(
            "/\D/",
            "",
            $_POST["security_code"]
            ?? ""
        );


    if (
        empty($cardholder_name) ||
        empty($card_number) ||
        empty($expiration_date) ||
        empty($security_code)
    ) {

        die(
            "Please complete the demo card information."
        );

    }


    if (
        strlen($card_number) !== 16
    ) {

        die(
            "For the demo, enter a 16-digit test card number."
        );

    }


    if (
        strlen($security_code) < 3 ||
        strlen($security_code) > 4
    ) {

        die(
            "Enter a valid demo security code."
        );

    }


    /*
    SCHOOL DEMO ONLY.

    Card number and security code
    are NOT stored in the database.
    */

    $payment_status = "paid";

}



/* =========================
   SAVE BOOKING
========================= */

$stmt =
    $conn->prepare(
        "
        INSERT INTO bookings
        (
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
            rental_gear,
            certification,
            notes,
            payment_method,
            payment_status,
            payment_proof
        )

        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?
        )
        "
    );


if (!$stmt) {

    error_log(
        "Booking prepare error: "
        . $conn->error
    );

    die(
        "Something went wrong while preparing your booking."
    );

}


$stmt->bind_param(

    "isssssssisssssss",

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

    $rental_gear,

    $certification,

    $notes,

    $payment_method,

    $payment_status,

    $payment_proof

);



/* =========================
   FINISH
========================= */

if (
    $stmt->execute()
) {

    $booking_id =
        $stmt->insert_id;


    $stmt->close();

    $conn->close();


    header(
        "Location: confirmation.php?id="
        . $booking_id
    );

    exit;

}


/*
Don't expose raw database errors
to the customer.
*/

error_log(
    "Booking insert error: "
    . $stmt->error
);


$stmt->close();

$conn->close();


die(
    "Something went wrong while saving your booking. Please try again."
);

?>