<?php

session_start();

require_once "db.php";

/* =========================
   BOOKING ERROR PAGE
========================= */

function showBookingError($message)
{
    $safe_message =
        htmlspecialchars(
            $message,
            ENT_QUOTES,
            "UTF-8"
        );

    echo '
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >

        <title>Booking Notice | Azura Reef</title>

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
                margin: 0;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 25px;

                background:
                    linear-gradient(
                        rgba(8, 48, 45, .82),
                        rgba(8, 48, 45, .82)
                    ),
                    url("images/waterdive.jpg")
                    center / cover no-repeat;

                font-family:
                    "Inter",
                    sans-serif;
            }

            .error-card {
                width: 100%;
                max-width: 540px;

                background: white;

                border-radius: 24px;

                padding: 45px 38px;

                text-align: center;

                box-shadow:
                    0 25px 70px
                    rgba(0, 0, 0, .25);
            }

            .error-icon {
                width: 62px;
                height: 62px;

                margin:
                    0 auto 20px;

                border-radius: 50%;

                display: flex;
                align-items: center;
                justify-content: center;

                background: #eef7f4;

                color: #0d3a37;

                font-size: 28px;
                font-weight: 700;
            }

            .eyebrow {
                display: block;

                margin-bottom: 10px;

                color: #2f8a7d;

                font-size: .72rem;
                font-weight: 700;

                letter-spacing: .14em;
            }

            h1 {
                margin:
                    0 0 14px;

                color: #0d3a37;

                font-family:
                    "Fraunces",
                    serif;

                font-size: 2rem;
            }

            .message {
                margin:
                    0 auto 28px;

                max-width: 420px;

                color: #617a75;

                font-size: .95rem;
                line-height: 1.7;
            }

            .back-btn {
                display: inline-block;

                border: none;
                border-radius: 10px;

                padding: 14px 24px;

                background: #0d3a37;
                color: white;

                font-family:
                    "Inter",
                    sans-serif;

                font-size: .88rem;
                font-weight: 700;

                cursor: pointer;

                transition:
                    transform .2s,
                    background .2s;
            }

            .back-btn:hover {
                background: #2f8a7d;

                transform:
                    translateY(-2px);
            }

            @media(max-width: 600px) {

                .error-card {
                    padding:
                        35px 24px;
                }

                h1 {
                    font-size:
                        1.7rem;
                }

            }

        </style>

    </head>

    <body>

        <div class="error-card">

            <div class="error-icon">
                !
            </div>

            <span class="eyebrow">
                BOOKING NOTICE
            </span>

            <h1>
                Booking Could Not Be Completed
            </h1>

            <p class="message">
                ' . $safe_message . '
                Please adjust your booking
                and try again.
            </p>

            <button
                type="button"
                class="back-btn"
                onclick="history.back()"
            >
                ← Back to Booking
            </button>

        </div>

    </body>

    </html>
    ';

    exit;
}


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
   SAVE BOOKING + RESERVE SLOT
========================= */

$schedule_id =
    (int) ($_POST["schedule_id"] ?? 0);

$scheduled_types = [
    "dive",
    "snorkeling",
    "course"
];

$is_scheduled_service =
    in_array(
        $service_type,
        $scheduled_types,
        true
    );


/*
    Dive, snorkeling, and course
    bookings MUST use a schedule
    created by the admin.
*/

if (
    $is_scheduled_service &&
    $schedule_id <= 0
) {

    if (
        !empty($payment_proof) &&
        isset($destination) &&
        file_exists($destination)
    ) {
        unlink($destination);
    }

    die(
        "Please choose an available schedule."
    );
}


/* =========================
   START TRANSACTION
========================= */

$conn->begin_transaction();

try {


    /* =========================
       RESERVE SLOTS
    ========================= */

    if ($is_scheduled_service) {

        /*
            Lock and verify the exact
            admin-created schedule.
        */

        $schedule_stmt =
            $conn->prepare(
                "
                SELECT
                    id,
                    service_name,
                    schedule_date,
                    schedule_time,
                    available_slots,
                    is_available
                FROM dive_schedules
                WHERE id = ?
                FOR UPDATE
                "
            );

        if (!$schedule_stmt) {

            throw new Exception(
                "Unable to prepare schedule check."
            );

        }


        $schedule_stmt->bind_param(
            "i",
            $schedule_id
        );

        $schedule_stmt->execute();

        $schedule_result =
            $schedule_stmt->get_result();

        $schedule =
            $schedule_result->fetch_assoc();

        $schedule_stmt->close();


        /*
            Make sure the customer
            did not alter the form.
        */

        if (!$schedule) {

            throw new Exception(
                "The selected schedule no longer exists."
            );

        }


        if (
            (int) $schedule["is_available"]
                !== 1
        ) {

            throw new Exception(
                "This schedule is no longer available."
            );

        }


        if (
            $schedule["service_name"]
                !== $service_name ||
            $schedule["schedule_date"]
                !== $booking_date
        ) {

            throw new Exception(
                "The selected schedule does not match your booking."
            );

        }


        /*
            Compare time using HH:MM:SS.
        */

        $submitted_time =
            date(
                "H:i:s",
                strtotime($booking_time)
            );

        if (
            $schedule["schedule_time"]
                !== $submitted_time
        ) {

            throw new Exception(
                "The selected booking time is invalid."
            );

        }


        $remaining_slots =
            (int)
            $schedule["available_slots"];


        /*
            Prevent overbooking.
        */

        if (
            $remaining_slots < $guests
        ) {

            throw new Exception(
                "Only " .
                $remaining_slots .
                (
                    $remaining_slots === 1
                        ? " slot is"
                        : " slots are"
                ) .
                " available for this schedule."
            );

        }


        /*
            Deduct the customer's guests
            immediately.

            Example:
            8 slots - 2 guests = 6 slots
        */

        $slot_stmt =
            $conn->prepare(
                "
                UPDATE dive_schedules
                SET available_slots =
                    available_slots - ?
                WHERE
                    id = ?
                    AND is_available = 1
                    AND available_slots >= ?
                "
            );

        if (!$slot_stmt) {

            throw new Exception(
                "Unable to prepare slot reservation."
            );

        }


        $slot_stmt->bind_param(
            "iii",
            $guests,
            $schedule_id,
            $guests
        );

        $slot_stmt->execute();


        if (
            $slot_stmt->affected_rows !== 1
        ) {

            $slot_stmt->close();

            throw new Exception(
                "There are not enough slots available for this schedule."
            );

        }

        $slot_stmt->close();

    } else {

        /*
            Gear rental does not belong
            to a dive schedule.
        */

        $schedule_id = null;

    }


    /* =========================
       INSERT BOOKING
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
                schedule_id,
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
                ?, ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?, ?
            )
            "
        );


    if (!$stmt) {

        throw new Exception(
            "Unable to prepare booking."
        );

    }


    $stmt->bind_param(
        "isssssississsssss",

        $user_id,
        $full_name,
        $email,
        $phone,
        $service_type,
        $service_name,
        $schedule_id,
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


    if (!$stmt->execute()) {

        throw new Exception(
            "Unable to save booking."
        );

    }


    $booking_id =
        $stmt->insert_id;

    $stmt->close();


    /* =========================
       SAVE EVERYTHING
    ========================= */

    $conn->commit();

    $conn->close();


    header(
        "Location: confirmation.php?id="
        . $booking_id
    );

    exit;


} catch (Throwable $e) {


    /* =========================
       UNDO SLOT DEDUCTION
    ========================= */

    $conn->rollback();


    /*
        If a GCash image was uploaded
        but the booking failed,
        remove the unused image.
    */

    if (
        !empty($payment_proof) &&
        isset($destination) &&
        file_exists($destination)
    ) {

        unlink($destination);

    }


    error_log(
        "Booking error: "
        . $e->getMessage()
    );


    /*
        Safe messages that are useful
        to the customer.
    */

    $safe_messages = [

        "The selected schedule no longer exists.",

        "This schedule is no longer available.",

        "The selected schedule does not match your booking.",

        "The selected booking time is invalid.",

        "There are not enough slots available for this schedule."

    ];


    if (
    in_array(
        $e->getMessage(),
        $safe_messages,
        true
    ) ||
    str_starts_with(
        $e->getMessage(),
        "Only "
    )
) {

    showBookingError(
        $e->getMessage()
    );

}


showBookingError(
    "Something went wrong while saving your booking. Please try again."
);

}
?>

if (
    in_array(
        $e->getMessage(),
        $safe_messages,
        true
    ) ||
    str_starts_with(
        $e->getMessage(),
        "Only "
    )
) {

    showBookingError(
        $e->getMessage()
    );

}


showBookingError(
    "Something went wrong while saving your booking. Please try again."
);