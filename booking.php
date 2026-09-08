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

.booking-page {
    background: var(--mint-50);
    min-height: 100vh;
    padding: 60px 20px;
}

.booking-container {
    max-width: 900px;
    margin: auto;
}

.booking-header {
    text-align: center;
    margin-bottom: 35px;
}

.booking-header h1 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    font-size: 2.7rem;
    margin-bottom: 10px;
}

.booking-header p {
    color: var(--muted);
}

.booking-form {
    background: white;
    border-radius: 20px;
    padding: 35px;
    box-shadow: var(--shadow);
}

.form-section {
    margin-bottom: 32px;
}

.form-section h2 {
    font-family: "Fraunces", serif;
    color: var(--teal-900);
    margin-bottom: 18px;
    font-size: 1.5rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.form-group.full {
    grid-column: 1 / -1;
}

label {
    font-weight: 600;
    color: var(--ink);
    font-size: .9rem;
}

input,
select,
textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-family: "Inter", sans-serif;
    font-size: .95rem;
    outline: none;
}

input:focus,
select:focus,
textarea:focus {
    border-color: var(--teal-500);
}

textarea {
    min-height: 100px;
    resize: vertical;
}


/* RENTAL EQUIPMENT */

.rental-gear-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.rental-gear-options label {
    display: flex;
    align-items: center;
    gap: 9px;

    background: var(--mint-50);
    border: 1px solid var(--border);
    border-radius: 10px;

    padding: 12px 14px;
    cursor: pointer;
}

.rental-gear-options input {
    width: auto;
    margin: 0;
}


/* PAYMENT */

.payment-options {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
}

.payment-option {
    border: 2px solid var(--border);
    border-radius: 14px;
    padding: 18px;
    cursor: pointer;
    transition: .2s;
    background: white;
}

.payment-option:hover {
    border-color: var(--teal-500);
}

.payment-option input {
    width: auto;
    margin-right: 7px;
}

.payment-option strong {
    color: var(--teal-900);
}

.payment-section {
    display: none;
    margin-top: 20px;
    padding: 20px;
    border-radius: 14px;
    background: var(--mint-50);
    border: 1px solid var(--border);
}

.payment-section.active {
    display: block;
}

.gcash-box {
    text-align: center;
}

.gcash-box img {
    width: 230px;
    max-width: 100%;
    border-radius: 14px;
    margin: 15px auto;
    display: block;
    background: white;
    padding: 10px;
    border: 1px solid var(--border);
}

.payment-note {
    font-size: .85rem;
    color: var(--muted);
    margin-top: 8px;
}

.demo-card-warning {
    background: #fff8dd;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 16px;
    font-size: .85rem;
    color: #765b13;
}

.submit-area {
    text-align: center;
    margin-top: 30px;
}

.submit-btn {
    border: none;
    cursor: pointer;
    font-size: 1rem;
    padding: 14px 28px;
}

.back-home {
    display: inline-block;
    margin-bottom: 20px;
    color: var(--teal-900);
    text-decoration: none;
    font-weight: 600;
}


@media(max-width: 700px) {

    .form-grid,
    .payment-options,
    .rental-gear-options {
        grid-template-columns: 1fr;
    }

    .booking-form {
        padding: 24px;
    }

}

</style>

</head>

<body>

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