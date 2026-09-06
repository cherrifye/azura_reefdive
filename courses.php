<?php
require 'db.php';

$courses = [
    [
        'title' => 'Discover Scuba Diving',
        'desc'  => 'A quick, safe introduction to the underwater world. No prior experience required. Includes a shallow dive with an instructor.',
        'length'=> 'Half-day',
    ],
    [
        'title' => 'Open Water Certification',
        'desc'  => 'Get your globally recognized scuba certification. A 3–4 day course combining theory, confined water practice, and ocean dives.',
        'length'=> '3–4 days',
    ],
    [
        'title' => 'Advanced Courses',
        'desc'  => 'Take your skills to the next level with deep dives, night dives, and underwater navigation specialties.',
        'length'=> '2–3 days',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Courses — Azura Reef Dive</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
  .page-wrap{max-width:820px;margin:0 auto;padding:96px 24px;}
  .page-wrap h1{font-size:2.1rem;color:var(--teal-900);margin-bottom:12px;}
  .page-wrap > p{color:var(--muted);margin-bottom:40px;max-width:600px;}
  .back-link{display:inline-block;margin-bottom:24px;font-size:0.9rem;color:var(--teal-500);font-weight:600;}
  .course-card{
    border:1px solid var(--border);
    border-radius:var(--radius-lg);
    padding:28px;
    margin-bottom:20px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:24px;
    flex-wrap:wrap;
  }
  .course-card h3{font-size:1.2rem;color:var(--teal-900);margin-bottom:8px;}
  .course-card p{color:var(--muted);font-size:0.94rem;margin-bottom:10px;max-width:440px;}
  .course-length{
    display:inline-block;
    font-size:0.8rem;
    font-weight:600;
    color:var(--teal-700);
    background:var(--mint-100);
    padding:4px 12px;
    border-radius:999px;
  }
</style>
</head>
<body>

<div class="page-wrap">
  <a href="index.php" class="back-link">&larr; Back to home</a>
  <h1>All Courses</h1>
  <p>Azura Reef Dive is an authorized training center offering courses from beginner to advanced levels, with small class sizes for personalized instruction.</p>

  <?php foreach ($courses as $c): ?>
    <div class="course-card">
      <div>
        <h3><?= htmlspecialchars($c['title']) ?></h3>
        <p><?= htmlspecialchars($c['desc']) ?></p>
        <span class="course-length"><?= htmlspecialchars($c['length']) ?></span>
      </div>
      <a href="booking.php?service=<?= urlencode($c['title']) ?>" class="btn btn-primary">Book This Course</a>
    </div>
  <?php endforeach; ?>
</div>

</body>
</html>