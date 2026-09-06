<?php
/**
 * Azura Reef Dive — Landing Page
 * Single-file PHP app: PHP drives the content (arrays below),
 * HTML/CSS renders it to match the provided design mock.
 */

$brand = [
    'name'    => 'Azura Reef',
    'tagline' => 'Siquijor\'s premier dive center',
];

$nav_links = ['Services', 'Lessons', 'Why Us', 'About'];

$services = [
    [
        'title' => 'Guided Fun Dives',
        'desc'  => 'Explore the best dive sites around Siquijor with our experienced local divemasters. Perfect for certified divers looking for adventure.',
        'link'  => 'View Schedule',
        'img'   => 'images/corals.jpg',
        'page'  => 'schedule.php',
    ],
    [
        'title' => 'Snorkeling Tours',
        'desc'  => 'Not ready for scuba? Join our guided snorkeling trips to see turtles, colorful reefs, and abundant marine life near the surface.',
        'link'  => 'Discover Tours',
        'img'   => 'images/waterdive.jpg',
        'page'  => 'tours.php',
    ],
    [
        'title' => 'Premium Gear',
        'desc'  => 'We provide top-of-the-line, well-maintained equipment for all our dives. Need gear for your own trip? Rentals are available.',
        'link'  => 'View Pricing',
        'img'   => 'images/watercorals.jpg',
        'page'  => 'pricing.php',
    ],
];

$journey_steps = [
    [
        'num'   => 1,
        'title' => 'Discover Scuba Diving',
        'desc'  => 'A quick, safe introduction to the underwater world. No prior experience required. Includes a shallow dive with an instructor.',
    ],
    [
        'num'   => 2,
        'title' => 'Open Water Certification',
        'desc'  => 'Get your globally recognized scuba certification. A 3–4 day course combining theory, confined water practice, and ocean dives.',
    ],
    [
        'num'   => 3,
        'title' => 'Advanced Courses',
        'desc'  => 'Take your skills to the next level with deep dives, night dives, and underwater navigation specialties.',
    ],
];

$why_us = [
    [
        'title' => 'Impeccable Safety',
        'desc'  => '100% safety record with expertly maintained gear and highly trained staff prioritizing your well-being.',
        'icon'  => 'shield',
    ],
    [
        'title' => 'Local Expertise',
        'desc'  => 'Born and raised in Siquijor, our guides know the hidden currents, secret reefs, and local marine life intimately.',
        'icon'  => 'compass',
    ],
    [
        'title' => 'Eco-Conscious',
        'desc'  => 'Dedicated to protecting Siquijor\'s reefs. We enforce zero-touch policies and organize regular clean-up dives.',
        'icon'  => 'heart',
    ],
];

$testimonial = [
    'quote'  => 'Absolutely incredible experience! The instructors at Azura were patient, knowledgeable, and made my first ocean dive completely stress-free. The reefs in Siquijor are breathtaking. Highly recommend!',
    'name'   => 'Sarah Jenkins',
    'role'   => 'Advanced Open Water Student',
];

$quick_links = ['Dive Sites', 'PADI Courses', 'Pricing', 'Equipment', 'FAQ'];

$contact = [
    'address' => 'San Juan Coast, Siquijor Island, Philippines 6227',
    'phone'   => '+63 912 345 6789',
    'email'   => 'hello@azurareefdive.com',
];

$year = date('Y');

function icon_svg($name) {
    $icons = [
        'shield'  => '<path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
        'compass' => '<circle cx="12" cy="12" r="10"/><path d="m16 8-2 6-6 2 2-6 6-2Z"/>',
        'heart'   => '<path d="M12 21s-7.5-4.7-10-9.3C.4 8.1 2 4.5 5.6 4c2-.3 3.8.7 6.4 3.2C14.6 4.7 16.4 3.7 18.4 4c3.6.5 5.2 4.1 3.6 7.7C19.5 16.3 12 21 12 21Z"/>',
    ];
    return $icons[$name] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($brand['name']) ?> Dive — Discover the Depths of Siquijor</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="nav-wrap">
    <a href="#" class="brand">
      <span class="brand-icon">
        <img src="images/daybbb .png" alt="Azura Reef logo">
      </span>
      <span class="brand-name"><?= htmlspecialchars($brand['name']) ?></span>
    </a>

    <nav class="nav-links">
      <?php foreach ($nav_links as $link): ?>
        <a href="#<?= strtolower(str_replace(' ', '-', $link)) ?>"><?= htmlspecialchars($link) ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="nav-cta">
      <a href="booking.php" class="btn btn-dark">Book a Dive</a>
    </div>

    <button class="menu-toggle" aria-label="Open menu">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
    </button>
  </div>
</header>

<section class="hero">
  <div class="hero-inner">
    <h1>Discover the Depths of<br>Siquijor</h1>
    <p>Join <?= htmlspecialchars($brand['name']) ?> Dive for unforgettable underwater adventures. From vibrant coral gardens to majestic marine life, dive into crystal clear waters with our expert guides.</p>
    <div class="hero-actions">
      <a href="#services" class="btn btn-primary">Explore Dives</a>
      <a href="#lessons" class="btn btn-outline">Learn to Dive</a>
    </div>
  </div>
</section>

<section id="services" class="section services">
  <div class="container">
    <div class="section-head">
      <h2>Our Services</h2>
      <p>Whether you're a seasoned diver or looking for a relaxing boat tour, we offer tailored experiences to make your Siquijor trip extraordinary.</p>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $s): ?>
        <div class="service-card">
          <div class="img-wrap">
            <img src="<?= htmlspecialchars($s['img']) ?>" alt="<?= htmlspecialchars($s['title']) ?>" loading="lazy">
          </div>
          <div class="card-body">
            <h3><?= htmlspecialchars($s['title']) ?></h3>
            <p><?= htmlspecialchars($s['desc']) ?></p>
            <a href="<?= htmlspecialchars($s['page']) ?>" class="link-arrow">
              <?= htmlspecialchars($s['link']) ?>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="lessons" class="section journey">
  <div class="container">
    <div class="journey-grid">
      <div class="journey-text">
        <span class="eyebrow-line">Start Your Journey</span>
        <h2>Start Your Journey</h2>
        <p><?= htmlspecialchars($brand['name']) ?> Dive is an authorized training center. We offer comprehensive courses from beginner to professional levels, with small class sizes for personalized instruction.</p>

        <?php foreach ($journey_steps as $step): ?>
          <div class="step">
            <div class="step-num"><?= (int) $step['num'] ?></div>
            <div>
              <h3><?= htmlspecialchars($step['title']) ?></h3>
              <p><?= htmlspecialchars($step['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>

        <a href="courses.php" class="btn btn-dark">Browse All Courses</a>
      </div>

      <div class="journey-img">
        <img src="images/scubawoman.jpg" alt="Diver descending underwater">
      </div>
    </div>
  </div>
</section>

<section id="why-us" class="section why-us">
  <div class="container">
    <div class="section-head">
      <h2>Why <?= htmlspecialchars($brand['name']) ?> Dive?</h2>
      <p>We are passionate about the ocean and committed to safety, conservation, and providing unforgettable experiences.</p>
    </div>

    <div class="why-grid">
      <?php foreach ($why_us as $w): ?>
        <div class="why-card">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><?= icon_svg($w['icon']) ?></svg>
          </div>
          <h3><?= htmlspecialchars($w['title']) ?></h3>
          <p><?= htmlspecialchars($w['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="testimonial">
      <div class="stars">★★★★★</div>
      <blockquote>&ldquo;<?= htmlspecialchars($testimonial['quote']) ?>&rdquo;</blockquote>
      <div class="name"><?= htmlspecialchars($testimonial['name']) ?></div>
      <div class="role"><?= htmlspecialchars($testimonial['role']) ?></div>
    </div>
  </div>
</section>

<footer id="about">
  <div class="footer-top">
    <div class="container footer-grid">
      <div class="footer-brand">
        <a href="#" class="brand">
      <span class="brand-icon">
        <img src="images/daybbb .png" alt="Azura Reef logo">
      </span>
          <span class="brand-name"><?= htmlspecialchars($brand['name']) ?></span>
        </a>
        <p>Founded in 2018, <?= htmlspecialchars($brand['name']) ?> Dive is Siquijor's premier dive center. We are dedicated to providing safe, thrilling, and eco-friendly diving experiences while preserving the natural beauty of our oceans.</p>
        <div class="socials">
          <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" stroke-width="1.8"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v6h3v-6h3l1-3h-4V9c0-.5.5-1 1-1Z"/></svg></a>
          <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" stroke-width="1.8"><rect x="4" y="4" width="16" height="16" rx="4"/><circle cx="12" cy="12" r="3.2"/><circle cx="16.5" cy="7.5" r="0.6" fill="#fff"/></svg></a>
        </div>
      </div>

      <div class="footer-quick">
        <h4>Quick Links</h4>
        <ul class="footer-links">
          <?php foreach ($quick_links as $ql): ?>
            <li><a href="#"><?= htmlspecialchars($ql) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="footer-contact">
        <h4>Contact Us</h4>
        <ul class="contact-list">
          <li>
            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.4 7-12a7 7 0 1 0-14 0c0 4.6 7 12 7 12Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <span><?= htmlspecialchars($contact['address']) ?></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 2.9a2 2 0 0 1-.4 2.1L8 10a16 16 0 0 0 6 6l1.3-1.4a2 2 0 0 1 2.1-.4c.9.4 1.9.6 2.9.7a2 2 0 0 1 1.7 2Z"/></svg>
            <span><?= htmlspecialchars($contact['phone']) ?></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg>
            <span><?= htmlspecialchars($contact['email']) ?></span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <span>&copy; <?= htmlspecialchars($year) ?> <?= htmlspecialchars($brand['name']) ?> Dive. All rights reserved.</span>
      <div class="footer-bottom-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>