<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'About Us';
$pageDesc  = 'Learn about Fiza e Haram Travel & Tours, a trusted Hajj and Umrah agency dedicated to providing safe, comfortable and affordable pilgrimage services.';
$activePage = 'about';
require_once __DIR__ . '/includes/header.php';

$aboutText   = get_setting($pdo, 'about_text', '');
$missionText = get_setting($pdo, 'mission_text', '');
?>

<section class="page-header">
  <div class="container">
    <h1>About Us</h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / About Us</div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="about-grid">
      <div class="about-media reveal">
        <div class="frame">
          <img src="<?= h($baseUrl) ?>/assets/images/hero-slide-1.svg" alt="About Fiza e Haram Travel & Tours">
        </div>
        <div class="badge">
          <strong>5000+</strong>
          Pilgrims Served
        </div>
      </div>
      <div class="reveal">
        <span class="section-tag">Who We Are</span>
        <h2 class="section-title">Fiza e Haram Travel & Tours</h2>
        <p style="color:var(--fh-muted)"><?= h($aboutText) ?></p>
        <p style="color:var(--fh-muted)"><?= h($missionText) ?></p>
      </div>
    </div>
  </div>
</section>

<section class="section" style="background:#fff;">
  <div class="container text-center">
    <span class="section-tag">Our Values</span>
    <h2 class="section-title">What Drives Us</h2>
    <div class="features-grid">
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-mosque"></i></div>
        <h4>Spiritual Focus</h4>
        <p>Every service we design keeps the sanctity and purpose of your journey at the center.</p>
      </div>
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-handshake"></i></div>
        <h4>Honesty</h4>
        <p>Transparent pricing and clear communication, with no hidden surprises.</p>
      </div>
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-star"></i></div>
        <h4>Excellence</h4>
        <p>We continuously improve our services based on pilgrim feedback and experience.</p>
      </div>
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-hands-helping"></i></div>
        <h4>Support</h4>
        <p>Our team stands by you from the first inquiry until you return home safely.</p>
      </div>
    </div>
  </div>
</section>

<section class="section-sm">
  <div class="container">
    <div class="cta-band reveal">
      <div>
        <h3>Have Questions About Our Services?</h3>
        <p>Our team is happy to walk you through every package and answer your questions.</p>
      </div>
      <a href="contact.php" class="btn btn-gold">Contact Us <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
