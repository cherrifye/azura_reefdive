<?php
require 'db.php';

$gear = [
    ['item' => 'Full Scuba Set (BCD, regulator, wetsuit, fins, mask)', 'price' => '₱800 / day'],
    ['item' => 'Dive Computer',                                       'price' => '₱300 / day'],
    ['item' => 'Underwater Camera',                                   'price' => '₱500 / day'],
    ['item' => 'Snorkel Set (mask, snorkel, fins)',                   'price' => '₱250 / day'],
    ['item' => 'Wetsuit Only',                                        'price' => '₱200 / day'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Premium Gear Pricing — Azura Reef Dive</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
  .page-wrap{max-width:760px;margin:0 auto;padding:96px 24px;}
  .page-wrap h1{font-size:2.1rem;color:var(--teal-900);margin-bottom:12px;}
  .page-wrap > p{color:var(--muted);margin-bottom:36px;max-width:560px;}
  .back-link{display:inline-block;margin-bottom:24px;font-size:0.9rem;color:var(--teal-500);font-weight:600;}
  table{width:100%;border-collapse:collapse;margin-bottom:36px;}
  th, td{text-align:left;padding:14px 16px;border-bottom:1px solid var(--border);font-size:0.95rem;}
  th{color:var(--teal-900);font-weight:700;background:var(--mint-50);}
  td{color:var(--ink);}
  td:last-child{font-weight:600;color:var(--teal-700);}
  .note{color:var(--muted);font-size:0.88rem;margin-bottom:36px;}
</style>
</head>
<body>

<div class="page-wrap">
  <a href="index.php" class="back-link">&larr; Back to home</a>
  <h1>Premium Gear — Pricing</h1>
  <p>All our gear is well-maintained and checked before every rental. Prices below are per day; multi-day rentals get a discount.</p>

  <table>
    <thead>
      <tr><th>Item</th><th>Price</th></tr>
    </thead>
    <tbody>
      <?php foreach ($gear as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['item']) ?></td>
          <td><?= htmlspecialchars($row['price']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="note">Gear is also included free with any guided dive or course booking — this pricing is only for standalone rentals.</p>

  <a href="booking.php?service=<?= urlencode('Premium Gear') ?>" class="btn btn-primary">Reserve Gear</a>
</div>

</body>
</html>