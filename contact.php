<?php
require_once 'php/config.php';
$page_title = 'Contact Us';
$root = '';
include 'php/header.php';
$sent = false;
if(isset($_POST['contact_send'])) { $sent = true; }
?>
<div class="back-container">
    <button type="button" class="back-btn" onclick="history.back()">
        ← Back
    </button>
</div>
<div class="section" style="max-width:700px;">
  <h1 class="section-title">Contact Us</h1>
  <?php if($sent): ?><div class="alert alert-success">✅ Message sent! We'll get back to you soon.</div><?php endif; ?>
  <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);">
    <form method="POST">
      <div class="form-row">
        <div class="form-group"><label>Full Name</label><input type="text" name="name" placeholder="Your name" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="Your email" required></div>
      </div>
      <div class="form-group"><label>Subject</label><input type="text" name="subject" placeholder="How can we help?"></div>
      <div class="form-group"><label>Message</label><textarea name="message" rows="5" placeholder="Your message..." required></textarea></div>
      <button type="submit" name="contact_send" class="btn btn-primary btn-lg">Send Message</button>
    </form>
  </div>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-top:2rem;">
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:1.5rem;box-shadow:var(--shadow);text-align:center;">
      <div style="font-size:2rem;margin-bottom:.5rem;">📍</div>
      <strong>Address</strong><br><small>Colombo 03, Sri Lanka</small>
    </div>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:1.5rem;box-shadow:var(--shadow);text-align:center;">
      <div style="font-size:2rem;margin-bottom:.5rem;">📞</div>
      <strong>Phone</strong><br><small>+94 77 123 4567</small>
    </div>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:1.5rem;box-shadow:var(--shadow);text-align:center;">
      <div style="font-size:2rem;margin-bottom:.5rem;">📧</div>
      <strong>Email</strong><br><small>info@landbuy.lk</small>
    </div>
  
  </div>
</div>
<?php include 'php/footer.php'; ?>
