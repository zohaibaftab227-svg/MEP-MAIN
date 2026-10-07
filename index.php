<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'Home';
$pageDesc  = 'Fiza e Haram Travel & Tours - Trusted Hajj and Umrah packages, visa processing, flight booking, hotel reservations and Ziyarat tours.';
$activePage = 'home';
require_once __DIR__ . '/includes/header.php';

$heroTitle    = get_setting($pdo, 'hero_title', 'Begin Your Sacred Journey with Fiza e Haram');
$heroSubtitle = get_setting($pdo, 'hero_subtitle', 'Trusted Hajj & Umrah packages, guided by experience, delivered with care.');
$aboutText    = get_setting($pdo, 'about_text', '');

$services = [];
$blogs = [];
try {
    $services = $pdo->query("SELECT * FROM services WHERE status=1 ORDER BY sort_order ASC LIMIT 6")->fetchAll();
    $blogs = $pdo->query("SELECT * FROM blogs WHERE status=1 ORDER BY created_at DESC LIMIT 3")->fetchAll();
} catch (Exception $e) { /* first run before DB import */ }
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-slides">
    <div class="hero-slide" style="background-image:url('<?= h($baseUrl) ?>/assets/images/hero-slide-1.svg')"></div>
    <div class="hero-slide" style="background-image:url('<?= h($baseUrl) ?>/assets/images/hero-slide-2.svg')"></div>
    <div class="hero-slide" style="background-image:url('<?= h($baseUrl) ?>/assets/images/hero-slide-3.svg')"></div>
  </div>
  <div class="crescent-decor"></div>
  <div class="container">
    <div class="hero-content">
      <span class="section-tag"><i class="fas fa-kaaba"></i> Fiza e Haram Travel & Tours</span>
      <h1><?= h($heroTitle) ?></h1>
      <p><?= h($heroSubtitle) ?></p>
      <div class="hero-btns">
        <a href="services.php" class="btn btn-gold">Explore Packages <i class="fas fa-arrow-right"></i></a>
        <a href="contact.php" class="btn btn-outline">Get Free Consultation</a>
      </div>
      <div class="hero-stats">
        <div><strong>10+</strong><span>Years of Trust</span></div>
        <div><strong>5000+</strong><span>Happy Pilgrims</span></div>
        <div><strong>24/7</strong><span>Support Available</span></div>
      </div>
    </div>
  </div>
</section>

<!-- MARQUEE -->
<div class="marquee-strip">
  <div class="marquee-track">
    <span>Hajj Packages</span><span>•</span><span>Umrah Packages</span><span>•</span>
    <span>Visa Processing</span><span>•</span><span>Flight Booking</span><span>•</span>
    <span>Hotel Reservations</span><span>•</span><span>Ziyarat Tours</span><span>•</span>
    <span>Hajj Packages</span><span>•</span><span>Umrah Packages</span><span>•</span>
    <span>Visa Processing</span><span>•</span><span>Flight Booking</span><span>•</span>
    <span>Hotel Reservations</span><span>•</span><span>Ziyarat Tours</span><span>•</span>
  </div>
</div>

<!-- ABOUT -->
<section class="section">
  <div class="container">
    <div class="about-grid">
      <div class="about-media reveal">
        <div class="frame">
          <img src="<?= h($baseUrl) ?>/assets/images/hero-slide-2.svg" alt="Fiza e Haram - Hajj and Umrah services">
        </div>
        <div class="badge">
          <strong>10+</strong>
          Years Experience
        </div>
      </div>
      <div class="reveal">
        <span class="section-tag">About Us</span>
        <h2 class="section-title">Guiding Every Pilgrim with Care & Commitment</h2>
        <p style="color:var(--fh-muted)"><?= h($aboutText) ?></p>
        <ul class="about-list">
          <li><i class="fas fa-check"></i> Government-approved Hajj & Umrah operator</li>
          <li><i class="fas fa-check"></i> Experienced multilingual guides</li>
          <li><i class="fas fa-check"></i> Transparent pricing, no hidden costs</li>
          <li><i class="fas fa-check"></i> 24/7 dedicated support before, during & after travel</li>
        </ul>
        <a href="about.php" class="btn btn-primary" style="margin-top:16px;">Learn More About Us</a>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="section" style="background:#fff;">
  <div class="container text-center">
    <span class="section-tag">What We Offer</span>
    <h2 class="section-title">Our Services</h2>
    <p class="section-desc">From visa processing to guided Ziyarat tours, we take care of every detail of your sacred journey.</p>
    <div class="services-grid">
      <?php foreach ($services as $s): ?>
      <div class="service-card reveal">
        <div class="icon"><i class="fas <?= h($s['icon']) ?>"></i></div>
        <h3><?= h($s['title']) ?></h3>
        <p><?= h($s['short_desc']) ?></p>
        <a class="more" href="service-detail.php?slug=<?= h($s['slug']) ?>">Read More <i class="fas fa-arrow-right"></i></a>
      </div>
      <?php endforeach; ?>
      <?php if (empty($services)): ?>
        <p style="grid-column:1/-1;color:var(--fh-muted)">Services will appear here once added from the Admin Panel.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="section">
  <div class="container text-center">
    <span class="section-tag">Why Choose Us</span>
    <h2 class="section-title">Travel With Confidence</h2>
    <div class="features-grid">
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-shield-alt"></i></div>
        <h4>Trusted & Licensed</h4>
        <p>A fully registered agency with a proven track record of safe travel.</p>
      </div>
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-hand-holding-dollar"></i></div>
        <h4>Affordable Packages</h4>
        <p>Flexible options to suit every budget without compromising quality.</p>
      </div>
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-headset"></i></div>
        <h4>24/7 Support</h4>
        <p>Our team is available around the clock to assist you at every step.</p>
      </div>
      <div class="feature-box reveal">
        <div class="icon"><i class="fas fa-user-check"></i></div>
        <h4>Experienced Guides</h4>
        <p>Knowledgeable guides who ensure a smooth and meaningful journey.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA BAND -->
<section class="section-sm">
  <div class="container">
    <div class="cta-band reveal">
      <div>
        <h3>Ready to Plan Your Sacred Journey?</h3>
        <p>Talk to our travel experts today and get a customized package designed just for you.</p>
      </div>
      <a href="https://wa.me/<?= h($whatsapp) ?>" target="_blank" rel="noopener" class="btn btn-gold"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
    </div>
  </div>
</section>

<!-- BLOG PREVIEW -->
<section class="section" style="background:#fff;">
  <div class="container text-center">
    <span class="section-tag">Latest Updates</span>
    <h2 class="section-title">From Our Blog</h2>
    <p class="section-desc">Tips, guides and stories to help you prepare for your Hajj & Umrah journey.</p>
    <div class="blog-grid">
      <?php foreach ($blogs as $b): ?>
      <div class="blog-card reveal">
        <div class="img">
          <img src="<?= $b['image'] ? h($baseUrl.'/uploads/blogs/'.$b['image']) : h($baseUrl.'/assets/images/hero-slide-3.svg') ?>" alt="<?= h($b['title']) ?>">
        </div>
        <div class="content">
          <div class="meta"><?= date('d M, Y', strtotime($b['created_at'])) ?> • <?= h($b['author']) ?></div>
          <h3><?= h($b['title']) ?></h3>
          <p><?= h($b['excerpt'] ?: excerpt($b['content'], 18)) ?></p>
          <a class="read-more" href="blog-detail.php?slug=<?= h($b['slug']) ?>">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($blogs)): ?>
        <p style="grid-column:1/-1;color:var(--fh-muted)">Blog posts will appear here once added from the Admin Panel.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
