<?php
require_once 'php/config.php';
$page_title = 'Land Details';
$root = '';
require_once 'php/inquiries.php';
include 'php/header.php';

$id = (int)($_GET['id'] ?? 0);
if(!$id) { redirect('search.php'); }

$land = $conn->query("SELECT l.*, u.full_name as seller_name, u.phone as seller_phone, u.email as seller_email
  FROM lands l JOIN users u ON l.seller_id=u.id
  WHERE l.id='$id' AND l.status='Approved'")->fetch_assoc();
if(!$land) { echo "<div class='section'><div class='alert alert-danger'>Land not found.</div></div>"; include 'php/footer.php'; exit; }

$images = $conn->query("SELECT image_path FROM land_images WHERE land_id='$id'");
$imgs = [];
while($img = $images->fetch_assoc()) $imgs[] = $img['image_path'];

$is_fav = false;
if(isLoggedIn()) {
  $uid = $_SESSION['user_id'];
  $fq = $conn->query("SELECT id FROM favorites WHERE user_id='$uid' AND land_id='$id'");
  $is_fav = $fq->num_rows > 0;
}
?>
<div class="breadcrumb">
  <a href="index.php">Home</a> &rsaquo;
  <a href="search.php">Lands</a> &rsaquo;
  <?= htmlspecialchars($land['title']) ?>
</div>

<div class="back-container">
    <button type="button" class="back-btn" onclick="history.back()">
        ← Back
    </button>
</div>
<div class="land-detail">
  <div>
    <div class="land-images">
      <?php if(!empty($imgs)): ?>
      <img id="main-land-img" src="<?= htmlspecialchars($imgs[0]) ?>" alt="Land Image">
      <?php if(count($imgs) > 1): ?>
      <div class="land-thumbs">
        <?php foreach($imgs as $i => $img): ?>
        <img src="<?= htmlspecialchars($img) ?>" class="<?= $i===0?'active':'' ?>" onclick="switchImage('<?= htmlspecialchars($img) ?>',this)">
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php else: ?>
      <div class="land-card-img-placeholder" style="height:350px;border-radius:14px;">🏞️</div>
      <?php endif; ?>
    </div>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:1.8rem;box-shadow:var(--shadow);margin-top:1.5rem;">
      <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:.8rem;color:var(--green-dark);">Description</h3>
      <p style="color:var(--gray-600);line-height:1.8;"><?= nl2br(htmlspecialchars($land['description'])) ?></p>
    </div>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:1.8rem;box-shadow:var(--shadow);margin-top:1.5rem;">
    <h3>📍 Land Location</h3>

    <div id="map" style="height:400px;border-radius:10px;"></div>
</div>

  </div>

  <div>
    <div class="land-info-card">
      <h2><?= htmlspecialchars($land['title']) ?></h2>
      <div style="color:var(--gray-600);font-size:.9rem;margin-bottom:.5rem;">📍 <?= htmlspecialchars($land['location']) ?>, <?= htmlspecialchars($land['district']) ?></div>
      <div class="price"><?= formatPrice($land['price']) ?></div>
      <div class="land-specs">
        <div class="land-spec-row"><span class="key">Land Size</span><span class="val"><?= $land['land_size'] ?> Perches</span></div>
        <div class="land-spec-row"><span class="key">Land Type</span><span class="val"><?= htmlspecialchars($land['land_type']) ?></span></div>
        <div class="land-spec-row"><span class="key">District</span><span class="val"><?= htmlspecialchars($land['district']) ?></span></div>
        <div class="land-spec-row"><span class="key">Location</span><span class="val"><?= htmlspecialchars($land['location']) ?></span></div>
        <div class="land-spec-row"><span class="key">Road Access</span><span class="val"><?= htmlspecialchars($land['road_access']) ?></span></div>
        <div class="land-spec-row"><span class="key">Seller</span><span class="val"><?= htmlspecialchars($land['seller_name']) ?></span></div>
        <div class="land-spec-row"><span class="key">Listed</span><span class="val"><?= date('Y-m-d', strtotime($land['created_at'])) ?></span></div>
      </div>
      <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-top:1rem;">
      <?php if(isLoggedIn()): ?>

<a href="#inquiry" class="btn btn-primary">📩Contact Seller</a>

<?php if($is_fav): ?>
<a href="php/inquiries.php?unfav=<?= $id ?>" class="btn btn-outline btn-sm">♥️ Unfavorite</a>
<?php else: ?>
<a href="php/inquiries.php?fav=<?= $id ?>" class="btn btn-outline btn-sm">♡ Favorite</a>
<?php endif; ?>

<?php else: ?>
<a href="login.php" class="btn btn-primary">Login to Contact</a>
<?php endif; ?>
       
      </div>
    </div>

    <div class="inquiry-card" id="inquiry">
      <h3>📩 Send Inquiry</h3>
      <?php if(isset($inq_success)): ?><div class="alert alert-success"><?= $inq_success ?></div><?php endif; ?>
      <?php if(isLoggedIn()): ?>
      <form method="POST" action="">
        <input type="hidden" name="land_id" value="<?= $id ?>">
        <div class="form-group">
          <label>Land Title</label>
          <input type="text" value="<?= htmlspecialchars($land['title']) ?>" readonly style="background:#f1f3f5;">
        </div>
        <div class="form-group">
          <label>Seller</label>
          <input type="text" value="<?= htmlspecialchars($land['seller_name']) ?>" readonly style="background:#f1f3f5;">
        </div>
        <div class="form-group">
          <label>Your Name</label>
          <input type="text" name="your_name" value="<?= htmlspecialchars($_SESSION['full_name']) ?>" placeholder="Your name" required>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="tel" name="phone" placeholder="Your phone number">
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea name="message" placeholder="Enter your message" required></textarea>
        </div>
        <button type="submit" name="send_inquiry" class="btn btn-primary btn-block">Send Inquiry</button>
      </form>
      <?php else: ?>
      <div class="alert alert-info">Please <a href="login.php">login</a> to send an inquiry.</div>
      <?php endif; ?>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var map = L.map('map').setView([<?= $land['latitude'] ?>, <?= $land['longitude'] ?>], 15);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);

L.marker([<?= $land['latitude'] ?>, <?= $land['longitude'] ?>])
.addTo(map)
.bindPopup("<?= htmlspecialchars($land['title']) ?>")
.openPopup();
</script>

<?php include 'php/footer.php'; ?>
