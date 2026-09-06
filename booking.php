<?php
require 'db.php';

$success = false;
$errors  = [];

// If someone arrives via a link like booking.php?service=Snorkeling+Tours,
// pre-select that service in the dropdown. A resubmitted form (POST) wins over the URL.
$preselected_service = $_POST['service'] ?? ($_GET['service'] ?? '');

$services_list = [
    'Guided Fun Dives',
    'Snorkeling Tours',
    'Premium Gear',
    'Discover Scuba Diving',
    'Open Water Certification',
    'Advanced Courses',
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name      = trim($_POST['full_name'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $phone          = trim($_POST['phone'] ?? '');
    $service        = trim($_POST['service'] ?? '');
    $booking_date   = trim($_POST['booking_date'] ?? '');
    $payment_method = trim($_POST['payment_method'] ?? '');

    // Basic validation
    if ($full_name === '') $errors[] = 'Full name is required.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
    if (!in_array($service, $services_list, true)) $errors[] = 'Please choose a valid service.';
    if ($booking_date === '') $errors[] = 'Please choose a date.';
    if (!in_array($payment_method, ['cash', 'online'], true)) $errors[] = 'Please choose a payment method.';

    if (empty($errors)) {
        $stmt = $conn->prepare(
            'INSERT INTO bookings (full_name, email, phone, service, booking_date, payment_method, payment_status)
             VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        $payment_status = 'pending'; // both cash and online start as pending until confirmed

        $stmt->bind_param(
            'sssssss',
            $full_name,
            $email,
            $phone,
            $service,
            $booking_date,
            $payment_method,
            $payment_status
        );

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = 'Something went wrong saving your booking. Please try again.';
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book a Dive — Azura Reef Dive</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
  .booking-wrap{max-width:560px;margin:0 auto;padding:96px 24px;}
  .booking-wrap h1{font-size:2rem;color:var(--teal-900);margin-bottom:12px;}
  .booking-wrap > p{color:var(--muted);margin-bottom:36px;}
  .form-group{margin-bottom:20px;}
  .form-group label{display:block;font-weight:600;font-size:0.9rem;color:var(--teal-900);margin-bottom:6px;}
  .form-group input[type="text"],
  .form-group input[type="email"],
  .form-group input[type="tel"],
  .form-group input[type="date"],
  .form-group select{
    width:100%;
    padding:12px 14px;
    border:1px solid var(--border);
    border-radius:var(--radius-sm);
    font-family:'Inter',sans-serif;
    font-size:0.95rem;
    color:var(--ink);
  }
  .form-group input:focus,
  .form-group select:focus{
    outline:none;
    border-color:var(--teal-500);
  }
  .radio-row{display:flex;gap:20px;}
  .radio-option{
    display:flex;align-items:center;gap:8px;
    padding:12px 16px;
    border:1px solid var(--border);
    border-radius:var(--radius-sm);
    cursor:pointer;
    flex:1;
    font-size:0.92rem;
  }
  .radio-option:has(input:checked){
    border-color:var(--teal-500);
    background:var(--mint-50);
  }
  .alert{
    padding:14px 18px;
    border-radius:var(--radius-sm);
    margin-bottom:24px;
    font-size:0.92rem;
  }
  .alert-success{background:#e6f4ef;color:var(--teal-800);border:1px solid #b9e2d3;}
  .alert-error{background:#fdecea;color:#9c2b25;border:1px solid #f5c2bd;}
  .alert-error ul{margin:6px 0 0 18px;list-style:disc;}
  .back-link{display:inline-block;margin-bottom:24px;font-size:0.9rem;color:var(--teal-500);font-weight:600;}
</style>
</head>
<body>

<div class="booking-wrap">
  <a href="index.php" class="back-link">&larr; Back to home</a>
  <h1>Book a Dive</h1>
  <p>Fill in your details and we'll confirm your spot. You can pay online now or in cash when you arrive.</p>

  <?php if ($success): ?>
    <div class="alert alert-success">
      Thanks! Your booking has been received. We'll reach out to confirm the details soon.
    </div>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-error">
      Please fix the following:
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="POST" action="booking.php">
    <div class="form-group">
      <label for="full_name">Full Name</label>
      <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
    </div>

    <div class="form-group">
      <label for="phone">Phone Number (optional)</label>
      <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label for="service">Service</label>
      <select id="service" name="service" required>
        <option value="">-- Choose a service --</option>
        <?php foreach ($services_list as $s): ?>
          <option value="<?= htmlspecialchars($s) ?>" <?= ($preselected_service === $s) ? 'selected' : '' ?>>
            <?= htmlspecialchars($s) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="booking_date">Preferred Date</label>
      <input type="date" id="booking_date" name="booking_date" value="<?= htmlspecialchars($_POST['booking_date'] ?? '') ?>" required>
    </div>

    <div class="form-group">
      <label>Payment Method</label>
      <div class="radio-row">
        <label class="radio-option">
          <input type="radio" name="payment_method" value="cash" <?= (($_POST['payment_method'] ?? '') === 'cash') ? 'checked' : '' ?> required>
          Pay in cash at the dive center
        </label>
        <label class="radio-option">
          <input type="radio" name="payment_method" value="online" <?= (($_POST['payment_method'] ?? '') === 'online') ? 'checked' : '' ?>>
          Pay online now
        </label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit Booking</button>
  </form>
</div>

</body>
</html>