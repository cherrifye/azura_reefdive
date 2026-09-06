<?php
require 'db.php';

$highlights = [
    'See sea turtles, colorful reef fish, and soft coral gardens just below the surface',
    'No certification or prior experience needed — suitable for all ages',
    'Full snorkel gear (mask, snorkel, fins, life vest) included',
    'Guided by a local instructor familiar with the safest, most scenic spots',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Snorkeling Tours — Azura Reef Dive</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
  .page-wrap{max-width:760px;margin:0 auto;padding:96px 24px;}
  .page-wrap h1{font-size:2.1rem;color:var(--teal-900);margin-bottom:12px;}
  .page-wrap > p{color:var(--muted);margin-bottom:32px;max-width:560px;}
  .back-link{display:inline-block;margin-bottom:24px;font-size:0.9rem;color:var(--teal-500);font-weight:600;}
  .highlight-list{list-style:none;margin-bottom:36px;}
  .highlight-list li{
    display:flex;gap:12px;
    padding:14px 0;
    border-bottom:1px solid var(--border);
    font-size:0.95rem;
    color:var(--ink);
  }
  .highlight-list li::before{
    content:"✓";
    color:var(--teal-500);
    font-weight:700;
    flex:none;
  }
</style>
</head>
<body>

<div class="page-wrap">
  <a href="index.php" class="back-link">&larr; Back to home</a>
  <h1>Snorkeling Tours</h1>
  <p>Not ready for scuba? Our guided snorkeling trips let you see Siquijor's marine life from the surface — no certification required.</p>

  <ul class="highlight-list">
    <?php foreach ($highlights as $h): ?>
      <li><?= htmlspecialchars($h) ?></li>
    <?php endforeach; ?>
  </ul>

  <a href="booking.php?service=<?= urlencode('Snorkeling Tours') ?>" class="btn btn-primary">Book This Tour</a>
</div>

</body>
</html>