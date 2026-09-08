<?php
session_start();

$type   = $_GET['type'] ?? '';
$dive   = $_GET['dive'] ?? '';
$tour   = $_GET['tour'] ?? '';
$gear   = $_GET['gear'] ?? '';
$course = $_GET['course'] ?? '';

$service_name = '';

if (!empty($dive)) {
    $service_name = $dive;
} elseif (!empty($tour)) {
    $service_name = $tour;
} elseif (!empty($gear)) {
    $service_name = $gear;
} elseif (!empty($course)) {
    $service_name = $course;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Book a Dive | Azura Reef</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<style>

/* =========================
   BOOKING PAGE
========================= */

body {
    background: var(--mint-50);
}

.booking-page {
    min-height: 100vh;
    padding: 55px 20px 90px;
    position: relative;
}

/* soft background decoration */
.booking-page::before {
    content: "";
    position: absolute;
    top: 80px;
    right: -150px;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: rgba(47, 138, 125, .06);
    pointer-events: none;
}

.booking-container {
    max-width: 980px;
    margin: auto;
    position: relative;
    z-index: 1;
}


/* =========================
   BACK HOME
========================= */

.back-home {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 28px;
    color: var(--teal-900);
    text-decoration: none;
    font-size: .88rem;
    font-weight: 700;
    transition: .2s;
}

.back-home:hover {
    color: var(--teal-500);
    transform: translateX(-3px);
}


/* =========================
   BOOKING HEADER
========================= */

.booking-header {
    text-align: center;
    max-width: 680px;
    margin: 0 auto 38px;
}

.booking-header::before {
    content: "PLAN YOUR EXPERIENCE";
    display: block;
    color: var(--teal-500);
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .16em;
    margin-bottom: 12px;
}

.booking-header h1 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: clamp(2.5rem, 6vw, 3.6rem);
    line-height: 1.05;
    margin-bottom: 14px;
}

.booking-header p {
    color: var(--muted);
    font-size: .98rem;
    line-height: 1.7;
}


/* =========================
   MAIN FORM
========================= */

.booking-form {
    background: white;
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 42px;
    box-shadow:
        0 25px 60px -35px
        rgba(13, 58, 55, .45);
}


/* =========================
   FORM SECTIONS
========================= */

.form-section {
    margin-bottom: 42px;
    padding-bottom: 42px;
    border-bottom: 1px solid var(--border);
}

.form-section:last-of-type {
    margin-bottom: 0;
    padding-bottom: 15px;
    border-bottom: none;
}

/* automatically number the sections */
.booking-form {
    counter-reset: booking-section;
}

.form-section h2 {
    counter-increment: booking-section;

    display: flex;
    align-items: center;
    gap: 12px;

    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 1.45rem;
    margin-bottom: 24px;
}

.form-section h2::before {
    content: "0" counter(booking-section);

    width: 39px;
    height: 39px;

    flex: none;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: var(--teal-900);
    color: white;

    font-family: "Inter", sans-serif;
    font-size: .7rem;
    font-weight: 700;
}


/* =========================
   FORM GRID
========================= */

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 19px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group.full {
    grid-column: 1 / -1;
}


/* =========================
   LABELS
========================= */

label {
    color: var(--ink);
    font-size: .82rem;
    font-weight: 700;
}


/* =========================
   INPUTS
========================= */

input,
select,
textarea {
    width: 100%;

    background: #fff;

    border: 1px solid var(--border);
    border-radius: 11px;

    padding: 13px 14px;

    color: var(--ink);

    font-family: "Inter", sans-serif;
    font-size: .9rem;

    outline: none;

    transition:
        border-color .2s,
        box-shadow .2s,
        background .2s;
}

input:hover,
select:hover,
textarea:hover {
    border-color: #c7dcd6;
}

input:focus,
select:focus,
textarea:focus {
    border-color: var(--teal-500);
    box-shadow:
        0 0 0 3px
        rgba(47, 138, 125, .09);
}

textarea {
    min-height: 110px;
    resize: vertical;
}

input::placeholder,
textarea::placeholder {
    color: #9aaca8;
}


/* =========================
   RENTAL EQUIPMENT
========================= */

#rental-gear-group {
    background: var(--mint-50);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 20px;
}

#rental-gear-group > label {
    color: var(--teal-900);
    margin-bottom: 3px;
}

.rental-gear-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.rental-gear-options label {
    display: flex;
    align-items: center;
    gap: 10px;

    background: white;

    border: 1px solid var(--border);
    border-radius: 10px;

    padding: 13px;

    color: var(--teal-900);
    font-size: .8rem;
    font-weight: 600;

    cursor: pointer;

    transition:
        border-color .2s,
        transform .2s,
        box-shadow .2s;
}

.rental-gear-options label:hover {
    border-color: var(--teal-500);
    transform: translateY(-1px);
    box-shadow:
        0 6px 15px
        rgba(13, 58, 55, .05);
}

.rental-gear-options input {
    width: 16px;
    height: 16px;
    margin: 0;
    accent-color: var(--teal-700);
}


/* =========================
   PAYMENT OPTIONS
========================= */

.payment-options {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 13px;
}

.payment-option {
    min-height: 125px;

    position: relative;

    display: block;

    background: var(--mint-50);

    border: 1px solid var(--border);
    border-radius: 14px;

    padding: 18px;

    cursor: pointer;

    transition:
        transform .2s,
        border-color .2s,
        box-shadow .2s,
        background .2s;
}

.payment-option:hover {
    transform: translateY(-3px);
    border-color: var(--teal-500);
    background: white;
    box-shadow:
        0 12px 25px -18px
        rgba(13, 58, 55, .5);
}

.payment-option input {
    width: 16px;
    height: 16px;
    margin: 0 0 15px;
    display: block;
    accent-color: var(--teal-700);
}

.payment-option strong {
    display: block;
    color: var(--teal-900);
    font-family: "Fraunces", serif;
    font-size: 1.08rem;
    margin-bottom: 5px;
}

.payment-note {
    color: var(--muted);
    font-size: .76rem;
    line-height: 1.5;
    margin-top: 5px;
}


/* =========================
   PAYMENT DETAILS
========================= */

.payment-section {
    display: none;

    margin-top: 20px;

    background: var(--mint-50);

    border: 1px solid var(--border);
    border-radius: 16px;

    padding: 24px;
}

.payment-section.active {
    display: block;
}


/* =========================
   GCASH
========================= */

.gcash-box {
    text-align: center;
    margin-bottom: 22px;
}

.gcash-box h3 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 1.35rem;
    margin-bottom: 7px;
}

.gcash-box p {
    color: var(--muted);
    font-size: .86rem;
}

.gcash-box img {
    width: 215px;
    max-width: 100%;

    display: block;

    margin: 18px auto;

    background: white;

    border: 1px solid var(--border);
    border-radius: 15px;

    padding: 10px;

    box-shadow:
        0 12px 30px -20px
        rgba(13, 58, 55, .4);
}


/* =========================
   DEMO CARD
========================= */

.demo-card-warning {
    background: #fff8dd;
    border: 1px solid #f1dfa2;

    color: #765b13;

    border-radius: 10px;

    padding: 13px 15px;

    margin-bottom: 20px;

    font-size: .8rem;
    line-height: 1.5;
}


/* =========================
   SUBMIT
========================= */

.submit-area {
    text-align: center;
    padding-top: 30px;
}

.submit-btn {
    min-width: 220px;

    border: none;

    padding: 15px 30px;

    font-size: .9rem;
    font-weight: 700;

    cursor: pointer;

    box-shadow:
        0 12px 24px -15px
        rgba(13, 58, 55, .7);

    transition:
        transform .2s,
        box-shadow .2s;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow:
        0 17px 30px -17px
        rgba(13, 58, 55, .75);
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width: 700px) {

    .booking-page {
        padding: 35px 16px 65px;
    }

    .booking-header {
        margin-bottom: 28px;
    }

    .booking-form {
        padding: 26px 20px;
        border-radius: 18px;
    }

    .form-section {
        margin-bottom: 32px;
        padding-bottom: 32px;
    }

    .form-grid,
    .payment-options,
    .rental-gear-options {
        grid-template-columns: 1fr;
    }

    .payment-option {
        min-height: auto;
    }

    .form-section h2 {
        font-size: 1.3rem;
    }

    .submit-btn {
        width: 100%;
    }

}

/* =========================
   HEADER
========================= */

.site-header {
    background: #fff;
    border-bottom: 1px solid var(--border);
    position: relative;
    z-index: 20;
}

.header-inner {
    min-height: 76px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
}

.brand {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.brand img {
    width: 125px;
    height: 52px;
    object-fit: contain;
}

.main-nav {
    display: flex;
    align-items: center;
    gap: 28px;
}

.main-nav a {
    color: var(--ink);
    text-decoration: none;
    font-size: .82rem;
    font-weight: 600;
    transition: color .2s;
}

.main-nav a:hover {
    color: var(--teal-500);
}


/* =========================
   BOOKING HERO
========================= */

.booking-hero {
    min-height: 430px;
    position: relative;

    display: flex;
    align-items: center;

    background:
        url("images/waterdive.jpg")
        center 45% / cover no-repeat;

    overflow: hidden;
}

.booking-hero-overlay {
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(8, 48, 45, .92) 0%,
            rgba(8, 48, 45, .76) 48%,
            rgba(8, 48, 45, .25) 100%
        );
}

.booking-hero-content {
    position: relative;
    z-index: 2;

    width: 100%;
    color: white;
}

.booking-hero .eyebrow {
    display: block;

    margin-bottom: 17px;

    color: #c7e4dc;

    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .17em;
}

.booking-hero h1 {
    max-width: 680px;

    margin: 0 0 18px;

    color: white;

    font-family: "Fraunces", serif;
    font-size: clamp(2.7rem, 6vw, 4.6rem);
    font-weight: 600;
    line-height: .98;
    letter-spacing: -.03em;
}

.booking-hero h1 em {
    color: #c9e4dc;
    font-weight: 500;
}

.booking-hero p {
    max-width: 500px;

    color: rgba(255,255,255,.82);

    font-size: .92rem;
    line-height: 1.7;
}


/* booking form sits nicely below hero */

.booking-page {
    padding-top: 55px;
}


/* =========================
   HEADER RESPONSIVE
========================= */

@media(max-width: 800px) {

    .main-nav {
        display: none;
    }

    .header-inner {
        min-height: 68px;
    }

    .brand img {
        width: 105px;
    }

    .booking-hero {
        min-height: 380px;
    }

    .booking-hero-overlay {
        background:
            rgba(8, 48, 45, .75);
    }

}

</style>

</head>

<body>

<header class="site-header">
    <div class="container header-inner">

        <a href="index.php" class="brand">
            <img src="images/daybbb .png" alt="Azura Reef Dive">
        </a>

        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="schedule.php">Dive Sites</a>
            <a href="tours.php">Snorkeling</a>
            <a href="courses.php">Courses</a>
            <a href="pricing.php">Pricing</a>
        </nav>

        <a href="booking.php" class="btn btn-dark">
            Book a Dive
        </a>

    </div>
</header>

<section class="booking-hero">
    <div class="booking-hero-overlay"></div>

    <div class="container booking-hero-content">
        <span class="eyebrow">YOUR SIQUIJOR ADVENTURE</span>

        <h1>
            Ready to Dive<br>
            Into Something <em>Extraordinary?</em>
        </h1>

        <p>
            Choose your experience, select your schedule,
            and we'll take care of the rest.
        </p>
    </div>
</section>

<div class="booking-page">

<div class="booking-container">

<a href="index.php" class="back-home">
    ← Back to Home
</a>

<div class="booking-header">

<h1>Book Your Experience</h1>

<p>
Complete the form below to reserve your Azura Reef experience.
</p>

</div>


<form
    action="process_booking.php"
    method="POST"
    enctype="multipart/form-data"
    class="booking-form"
>


<!-- BOOKING DETAILS -->

<div class="form-section">

<h2>Booking Details</h2>

<div class="form-grid">


<!-- SERVICE TYPE -->

<div class="form-group">

<label>Service Type</label>

<select
    name="service_type"
    id="service_type"
    required
>

<option value="">
Select service type
</option>

<option
    value="dive"
    <?= $type === 'dive' ? 'selected' : '' ?>
>
Guided Fun Dive
</option>

<option
    value="snorkeling"
    <?= $type === 'snorkeling' ? 'selected' : '' ?>
>
Snorkeling Tour
</option>

<option
    value="course"
    <?= $type === 'course' ? 'selected' : '' ?>
>
Diving Course
</option>

<option
    value="gear"
    <?= $type === 'gear' ? 'selected' : '' ?>
>
Premium Gear
</option>

</select>

</div>


<!-- EXPERIENCE / SERVICE -->

<div class="form-group">

<label>Experience / Service</label>

<select
    name="service_name"
    id="service_name"
    required
>

<option value="">
Select a service first
</option>

</select>

</div>


<!-- DATE -->

<div class="form-group">

<label>Booking Date</label>

<input
    type="date"
    name="booking_date"
    id="booking_date"
    required
>

</div>


<!-- TIME -->

<div class="form-group">

<label>Booking Time</label>

<select
    name="booking_time"
    required
>

<option value="">
Choose time
</option>

<option value="7:30 AM">
7:30 AM
</option>

<option value="8:00 AM">
8:00 AM
</option>

<option value="9:00 AM">
9:00 AM
</option>

<option value="1:00 PM">
1:00 PM
</option>

</select>

</div>


<!-- GUESTS -->

<div class="form-group">

<label>Number of Guests</label>

<input
    type="number"
    name="guests"
    min="1"
    value="1"
    required
>

</div>


<!-- EQUIPMENT -->

<div
    class="form-group"
    id="equipment-group"
>

<label>Equipment</label>

<select
    name="equipment"
    id="equipment"
    required
>

<option value="">
Select equipment option
</option>

<option value="Yes">
I need rental equipment
</option>

<option value="No">
I have my own equipment
</option>

</select>

</div>


<!-- RENTAL GEAR -->

<div
    class="form-group full"
    id="rental-gear-group"
    style="display: none;"
>

<label>Choose Rental Equipment</label>

<div class="rental-gear-options">

<label>
<input
    type="checkbox"
    name="rental_gear[]"
    value="Complete Scuba Set"
>
Complete Scuba Set
</label>


<label>
<input
    type="checkbox"
    name="rental_gear[]"
    value="BCD Rental"
>
BCD Rental
</label>


<label>
<input
    type="checkbox"
    name="rental_gear[]"
    value="Regulator Rental"
>
Regulator Rental
</label>


<label>
<input
    type="checkbox"
    name="rental_gear[]"
    value="Wetsuit Rental"
>
Wetsuit Rental
</label>


<label>
<input
    type="checkbox"
    name="rental_gear[]"
    value="Mask & Fins Set"
>
Mask & Fins Set
</label>


<label>
<input
    type="checkbox"
    name="rental_gear[]"
    value="Tank Rental"
>
Tank Rental
</label>

</div>

</div>


<!-- CERTIFICATION -->

<div class="form-group full">

<label>Certification</label>

<select name="certification">

<option value="None">
None / Not Certified
</option>

<option value="Open Water">
Open Water
</option>

<option value="Advanced Open Water">
Advanced Open Water
</option>

<option value="Other">
Other
</option>

</select>

</div>


</div>

</div>



<!-- CUSTOMER INFORMATION -->

<div class="form-section">

<h2>Customer Information</h2>

<div class="form-grid">


<div class="form-group">

<label>Full Name</label>

<input
    type="text"
    name="full_name"
    value="<?= htmlspecialchars(
        trim(
            ($_SESSION['first_name'] ?? '') . ' ' .
            ($_SESSION['last_name'] ?? '')
        )
    ) ?>"
    required
>

</div>


<div class="form-group">

<label>Email Address</label>

<input
    type="email"
    name="email"
    value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>"
    required
>

</div>


<div class="form-group full">

<label>Phone Number</label>

<input
    type="text"
    name="phone"
    placeholder="09XXXXXXXXX"
    required
>

</div>


<div class="form-group full">

<label>Additional Notes</label>

<textarea
    name="notes"
    placeholder="Optional requests or notes..."
></textarea>

</div>


</div>

</div>



<!-- PAYMENT -->

<div class="form-section">

<h2>Mode of Payment</h2>

<div class="payment-options">


<!-- CASH -->

<label class="payment-option">

<input
    type="radio"
    name="payment_method"
    value="cash"
    required
>

<strong>Cash</strong>

<div class="payment-note">
Pay directly at the dive center.
</div>

</label>



<!-- GCASH -->

<label class="payment-option">

<input
    type="radio"
    name="payment_method"
    value="gcash"
    required
>

<strong>GCash</strong>

<div class="payment-note">
Scan the QR code and upload payment proof.
</div>

</label>



<!-- CARD -->

<label class="payment-option">

<input
    type="radio"
    name="payment_method"
    value="card"
    required
>

<strong>Credit / Debit Card</strong>

<div class="payment-note">
Demo payment form for the project.
</div>

</label>


</div>



<!-- GCASH SECTION -->

<div
    id="gcash-section"
    class="payment-section"
>

<div class="gcash-box">

<h3>Pay through GCash</h3>

<p>
Scan the QR code below using your GCash app.
</p>

<img
    src="images/gcash-qr.jpg"
    alt="GCash QR Code"
>

</div>


<div class="form-group">

<label>
Upload Screenshot / Payment Receipt
</label>

<input
    type="file"
    name="payment_proof"
    id="payment_proof"
    accept=".jpg,.jpeg,.png"
>

<div class="payment-note">
Accepted files: JPG, JPEG, PNG.
</div>

</div>

</div>



<!-- CARD SECTION -->

<div
    id="card-section"
    class="payment-section"
>

<div class="demo-card-warning">

For school demonstration only.
Do not enter real card information.

</div>


<div class="form-grid">


<div class="form-group">

<label>Cardholder Name</label>

<input
    type="text"
    name="cardholder_name"
    id="cardholder_name"
    placeholder="Name on card"
>

</div>


<div class="form-group">

<label>Card Number</label>

<input
    type="text"
    name="card_number"
    id="card_number"
    placeholder="1111 2222 3333 4444"
    maxlength="19"
>

</div>


<div class="form-group">

<label>Expiration Date</label>

<input
    type="text"
    name="expiration_date"
    id="expiration_date"
    placeholder="MM/YY"
    maxlength="5"
>

</div>


<div class="form-group">

<label>Security Code</label>

<input
    type="password"
    name="security_code"
    id="security_code"
    placeholder="CVV"
    maxlength="4"
>

</div>


</div>

</div>


</div>



<!-- SUBMIT -->

<div class="submit-area">

<button
    type="submit"
    class="btn btn-dark submit-btn"
>
Confirm Booking
</button>

</div>


</form>

</div>

</div>



<script>

/* =========================
   SERVICE DROPDOWN
========================= */

const serviceType =
document.getElementById('service_type');

const serviceName =
document.getElementById('service_name');

const equipmentGroup =
document.getElementById('equipment-group');

const equipment =
document.getElementById('equipment');

const rentalGearGroup =
document.getElementById('rental-gear-group');

const rentalGearCheckboxes =
document.querySelectorAll(
    'input[name="rental_gear[]"]'
);


const serviceOptions = {

    dive: [
        'Tubod Marine Sanctuary',
        'Paliton Reef Dive',
        'Maite Reef Adventure'
    ],

    snorkeling: [
        'Coral Garden Snorkeling',
        'Turtle & Reef Adventure',
        'Island Snorkeling Experience'
    ],

    course: [
        'Discover Scuba Diving',
        'Open Water Certification',
        'Advanced Open Water'
    ],

    gear: [
        'Complete Scuba Set',
        'BCD Rental',
        'Regulator Rental',
        'Wetsuit Rental',
        'Mask & Fins Set',
        'Tank Rental'
    ]

};


const preselectedService =
<?= json_encode($service_name) ?>;


function updateServiceOptions(
    selectedService = ''
) {

    serviceName.innerHTML =
        '<option value="">Select experience / service</option>';

    const selectedType =
        serviceType.value;

    if (
        !selectedType ||
        !serviceOptions[selectedType]
    ) {
        return;
    }


    serviceOptions[selectedType].forEach(
        function (service) {

            const option =
                document.createElement('option');

            option.value = service;

            option.textContent = service;

            if (
                service === selectedService
            ) {
                option.selected = true;
            }

            serviceName.appendChild(
                option
            );

        }
    );

}



/* =========================
   RENTAL GEAR
========================= */

function updateRentalGear() {

    if (
        equipment.value === 'Yes' &&
        (
            serviceType.value === 'dive' ||
            serviceType.value === 'snorkeling'
        )
    ) {

        rentalGearGroup.style.display =
            'flex';

    } else {

        rentalGearGroup.style.display =
            'none';

        rentalGearCheckboxes.forEach(
            function (checkbox) {

                checkbox.checked = false;

            }
        );

    }

}


equipment.addEventListener(
    'change',
    updateRentalGear
);



/* =========================
   EQUIPMENT FIELD
========================= */

function updateEquipmentField() {

    const selectedType =
        serviceType.value;


    if (
        selectedType === 'course' ||
        selectedType === 'gear'
    ) {

        equipmentGroup.style.display =
            'none';

        equipment.required = false;

        /*
        Courses already include equipment.
        Premium Gear is itself an equipment rental.
        */

        equipment.value = 'No';

    } else {

        equipmentGroup.style.display =
            'flex';

        equipment.required = true;

        equipment.value = '';

    }


    updateRentalGear();

}



serviceType.addEventListener(
    'change',
    function () {

        updateServiceOptions();

        updateEquipmentField();

    }
);


updateEquipmentField();

updateServiceOptions(
    preselectedService
);



/* =========================
   PAYMENT
========================= */

const paymentRadios =
document.querySelectorAll(
    'input[name="payment_method"]'
);

const gcashSection =
document.getElementById(
    'gcash-section'
);

const cardSection =
document.getElementById(
    'card-section'
);

const paymentProof =
document.getElementById(
    'payment_proof'
);

const cardholderName =
document.getElementById(
    'cardholder_name'
);

const cardNumber =
document.getElementById(
    'card_number'
);

const expirationDate =
document.getElementById(
    'expiration_date'
);

const securityCode =
document.getElementById(
    'security_code'
);


paymentRadios.forEach(
    radio => {

        radio.addEventListener(
            'change',
            function () {

                gcashSection
                    .classList
                    .remove('active');

                cardSection
                    .classList
                    .remove('active');


                paymentProof.required =
                    false;

                cardholderName.required =
                    false;

                cardNumber.required =
                    false;

                expirationDate.required =
                    false;

                securityCode.required =
                    false;


                if (
                    this.value === 'gcash'
                ) {

                    gcashSection
                        .classList
                        .add('active');

                    paymentProof.required =
                        true;

                }


                if (
                    this.value === 'card'
                ) {

                    cardSection
                        .classList
                        .add('active');

                    cardholderName.required =
                        true;

                    cardNumber.required =
                        true;

                    expirationDate.required =
                        true;

                    securityCode.required =
                        true;

                }

            }
        );

    }
);



/* =========================
   CARD FORMATTING
========================= */

cardNumber.addEventListener(
    'input',
    function () {

        let value =
            this.value.replace(
                /\D/g,
                ''
            );

        value =
            value.substring(
                0,
                16
            );

        this.value =
            value.replace(
                /(.{4})/g,
                '$1 '
            ).trim();

    }
);


expirationDate.addEventListener(
    'input',
    function () {

        let value =
            this.value.replace(
                /\D/g,
                ''
            );

        value =
            value.substring(
                0,
                4
            );


        if (
            value.length >= 3
        ) {

            value =
                value.substring(
                    0,
                    2
                )
                + '/'
                + value.substring(2);

        }


        this.value = value;

    }
);



/* =========================
   PREVENT PAST DATES
========================= */

const bookingDate =
document.getElementById(
    'booking_date'
);

if (bookingDate) {

    const today =
        new Date();

    const year =
        today.getFullYear();

    const month =
        String(
            today.getMonth() + 1
        ).padStart(
            2,
            '0'
        );

    const day =
        String(
            today.getDate()
        ).padStart(
            2,
            '0'
        );

    bookingDate.min =
        `${year}-${month}-${day}`;

}

</script>


</body>

</html>