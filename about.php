<?php
require_once 'php/config.php';
$page_title = 'About Us';
$root = '';
include 'php/header.php';
?>
<div class="back-container">
    <button type="button" class="back-btn" onclick="history.back()">
        ← Back
    </button>
</div>
<div class="section" style="max-width:900px;">
  <h1 class="section-title">About LandBuy</h1>
  <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);margin-bottom:2rem;">
    <p style="font-size:1.05rem;color:var(--gray-600);line-height:1.9;">LandBuy is Sri Lanka's trusted platform for buying and selling land. We connect verified sellers with serious buyers across all 25 districts of Sri Lanka. Our mission is to make land transactions transparent, simple, and safe for everyone.</p>
  </div>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;">
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);text-align:center;">
      <div style="font-size:2.5rem;margin-bottom:.5rem;">🌍</div>
      <h3 style="color:var(--green-dark);">All Districts</h3>
      <p style="color:var(--gray-600);font-size:.9rem;">Listings available from all 25 districts of Sri Lanka.</p>
    </div>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);text-align:center;">
      <div style="font-size:2.5rem;margin-bottom:.5rem;">✅</div>
      <h3 style="color:var(--green-dark);">Verified Listings</h3>
      <p style="color:var(--gray-600);font-size:.9rem;">Every land listing is manually reviewed by our admin team.</p>
    </div>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);text-align:center;">
      <div style="font-size:2.5rem;margin-bottom:.5rem;">🔒</div>
      <h3 style="color:var(--green-dark);">Secure & Safe</h3>
      <p style="color:var(--gray-600);font-size:.9rem;">Your personal data is encrypted and never shared.</p>
    </div>
  </div>
</div>
<?php include 'php/footer.php'; ?>
