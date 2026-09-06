<?php
require 'db.php';

$schedule = [
    ['day' => 'Monday',    'time' => '8:00 AM', 'site' => 'Paliton Reef'],
    ['day' => 'Wednesday', 'time' => '8:00 AM', 'site' => 'Tulapos Marine Sanctuary'],
    ['day' => 'Friday',    'time' => '1:00 PM', 'site' => 'Salagdoong Wall'],
    ['day' => 'Saturday',  'time' => '8:00 AM', 'site' => 'Paliton Reef'],
    ['day' => 'Sunday',    'time' => '8:00 AM', 'site' => 'Tulapos Marine Sanctuary'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dive Schedule — Azura Reef Dive</title>
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
  .note{color:var(--muted);font-size:0.88rem;margin-bottom:36px;}
</style>
</head>
<body>

<div class="page-wrap">
  <a href="index.php" class="back-link">&larr; Back to home</a>
  <h1>Guided Fun Dives — Schedule</h1>
  <p>Join one of our scheduled guided dives around Siquijor's best sites. All dives include a certified divemaster, tanks, and weights.</p>

  <table>
    <thead>
      <tr><th>Day</th><th>Time</th><th>Dive Site</th></tr>
    </thead>
    <tbody>
      <?php foreach ($schedule as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['day']) ?></td>
          <td><?= htmlspecialchars($row['time']) ?></td>
          <td><?= htmlspecialchars($row['site']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="note">Schedule may shift slightly based on weather and tide conditions. We'll confirm final details after you book.</p>

  <a href="booking.php?service=<?= urlencode('Guided Fun Dives') ?>" class="btn btn-primary">Book This Dive</a>
</div>

</body>
</html>