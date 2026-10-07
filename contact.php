<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phoneN  = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $msg     = trim($_POST['message'] ?? '');

    if ($name === '') $errors[] = 'Please enter your name.';
    if ($msg === '') $errors[] = 'Please enter your message.';
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (?,?,?,?,?)");
            $stmt->execute([$name, $email, $phoneN, $subject, $msg]);
            $success = true;
        } catch (Exception $e) {
            $errors[] = 'Something went wrong while sending your message. Please try again or contact us on WhatsApp.';
        }
    }
}

$pageTitle = 'Contact Us';
$pageDesc  = 'Get in touch with Fiza e Haram Travel & Tours for Hajj, Umrah packages and travel enquiries.';
$activePage = 'contact';
require_once __DIR__ . '/includes/header.php';
$address = get_setting($pdo, 'address', 'Pakistan');
?>

<section class="page-header">
  <div class="container">
    <h1>Contact Us</h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / Contact</div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-grid">
      <div class="contact-info-card reveal">
        <h3>Get In Touch</h3>
        <p style="color:#cfe0d5;margin-bottom:30px;">We'd love to help plan your Hajj or Umrah journey. Reach out anytime.</p>

        <div class="contact-info-item">
          <div class="ic"><i class="fas fa-phone"></i></div>
          <div><h5>Phone</h5><a href="tel:<?= h($phone) ?>"><?= h($phone) ?></a></div>
        </div>
        <div class="contact-info-item">
          <div class="ic"><i class="fas fa-envelope"></i></div>
          <div><h5>Email</h5><a href="mailto:<?= h($email) ?>"><?= h($email) ?></a></div>
        </div>
        <div class="contact-info-item">
          <div class="ic"><i class="fas fa-map-marker-alt"></i></div>
          <div><h5>Address</h5><p><?= h($address) ?></p></div>
        </div>
        <div class="contact-info-item">
          <div class="ic"><i class="fab fa-whatsapp"></i></div>
          <div><h5>WhatsApp</h5><a href="https://wa.me/<?= h($whatsapp) ?>" target="_blank" rel="noopener">Chat with us</a></div>
        </div>

        <h5 style="margin-top:30px;">Follow Us</h5>
        <div class="social-row">
          <a href="<?= h($facebook) ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="<?= h($instagram) ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://wa.me/<?= h($whatsapp) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>

      <div class="form-card reveal">
        <h3>Send Us a Message</h3>

        <?php if ($success): ?>
          <div class="alert alert-success"><i class="fas fa-check-circle"></i> Thank you! Your message has been sent successfully. We'll get back to you shortly.</div>
        <?php elseif ($errors): ?>
          <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= h(implode(' ', $errors)) ?></div>
        <?php endif; ?>

        <form method="POST" action="contact.php">
          <div class="form-row">
            <div class="form-group">
              <label>Full Name *</label>
              <input type="text" name="name" required value="<?= h($_POST['name'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input type="text" name="phone" value="<?= h($_POST['phone'] ?? '') ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" value="<?= h($_POST['email'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label>Subject</label>
              <input type="text" name="subject" value="<?= h($_POST['subject'] ?? '') ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Message *</label>
            <textarea name="message" rows="5" required><?= h($_POST['message'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Message <i class="fas fa-paper-plane"></i></button>
        </form>
      </div>
    </div>

    <div class="map-embed reveal">
      <iframe src="https://www.google.com/maps?q=Pakistan&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Location Map"></iframe>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
