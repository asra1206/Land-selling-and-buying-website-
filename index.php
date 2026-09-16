<?php
require_once 'php/config.php';
$page_title = 'Home';
$root = '';
include 'php/header.php';

// Fetch featured lands
$featured = $conn->query("SELECT l.*, u.full_name as seller_name,
  (SELECT image_path FROM land_images WHERE land_id=l.id LIMIT 1) as thumb
  FROM lands l JOIN users u ON l.seller_id=u.id
  WHERE l.status='Approved' ORDER BY l.created_at DESC LIMIT 6");
?>

 
<section class="hero">
  <div class="float-shape"></div>
  <div class="float-shape"></div>
  <div class="float-shape"></div>
  <div style="max-width:1200px;margin:0 auto;width:100%;padding:0 2rem;">
    <div class="hero-content">
      <h1>Find Your Dream <span>Land</span><br>Buy or Sell Land Easily</h1>
      <p>Discover verified lands across Sri Lanka.</p>
      <form action="search.php" method="GET" class="search-bar">
        <select name="district">
          <option value="">District</option>
          <?php foreach(['Colombo','Kandy','Galle','Jaffna','Matara','Anuradhapura','Kurunegala','Ratnapura','Badulla','Trincomalee','Batticaloa','Ampara','Hambantota','Nuwara Eliya','Polonnaruwa','Puttalam','Mannar','Vavuniya','Mullaitivu','Kilinochchi','Monaragala','Kegalle'] as $d): ?>
          <option value="<?= $d ?>"><?= $d ?></option>
          <?php endforeach; ?>
        </select>
        <select name="land_type">
          <option value="">Land Type</option>
          <option value="Residential">Residential</option>
          <option value="Commercial">Commercial</option>
          <option value="Agricultural">Agricultural</option>
          <option value="Industrial">Industrial</option>
        </select>
        <input type="number" name="min_price" placeholder="Min Price" min="0">
        <input type="number" name="max_price" placeholder="Max Price" min="0">
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
      <?php if (!isLoggedIn()): ?>
    <p style="color:#fff; margin-top:15px;
    font-size:25px; font-weight:590; text-shadow:2px 2px 5px rgba(0,0,0,0.5);">
        Stay logged in to continue.
    </p>
<?php endif; ?>
    </div>
  </div>
</section>


<div class="section">
  <div class="section-header">
    <h2 class="section-title" style="margin-bottom:0">Featured Lands</h2>
    <a href="search.php" class="btn btn-outline btn-sm">View All</a>
  </div>
  <div class="lands-grid">
    <?php while($land = $featured->fetch_assoc()): ?>
    <div class="land-card">
      <?php if($land['thumb']): ?>
        <img src="<?= htmlspecialchars($land['thumb']) ?>" alt="<?= htmlspecialchars($land['title']) ?>" class="land-card-img">
      <?php else: ?>
        <div class="land-card-img-placeholder">🏞️</div>
      <?php endif; ?>
      <div class="land-card-body">
        <h3><?= htmlspecialchars($land['title']) ?></h3>
        <div class="location">📍 <?= htmlspecialchars($land['location']) ?></div>
        <div class="size">📐 <?= $land['land_size'] ?> Perches &nbsp;|&nbsp; <?= htmlspecialchars($land['land_type']) ?></div>
        <div class="price"><?= formatPrice($land['price']) ?></div>
        <a href="land-detail.php?id=<?= $land['id'] ?>" class="btn btn-outline btn-sm btn-block">View Details</a>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<section class="why-section" style="background:var(--green-dark);padding:3rem 2rem;margin-top:2.5rem;border-radius:var(--radius-lg);max-width:1200px;margin-left:auto;margin-right:auto;box-shadow:var(--shadow-lg);">
  <div style="max-width:1200px;margin:0 auto;text-align:center;">
    <h2 style="font-family:'Playfair Display',serif;color:#fff;font-size:2rem;margin-bottom:2rem;">Why Choose LandBuy?</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:2rem;">
      <?php $features=[['🔍','Verified Listings','All lands are verified by our team before listing.'],['🔒','Secure Transactions','Your data and transactions are safe with us.'],['🌍','All Districts','Lands available from all 25 districts of Sri Lanka.'],['📞','24/7 Support','Our support team is always ready to help you.']]; ?>
      <?php foreach($features as $f): ?>
      <div style="background:rgba(255,255,255,.07);border-radius:14px;padding:2rem 1.5rem;">
        <div style="font-size:2.5rem;margin-bottom:.8rem;"><?= $f[0] ?></div>
        <h3 style="color:#fff;margin-bottom:.5rem;font-size:1rem;"><?= $f[1] ?></h3>
        <p style="color:rgba(255,255,255,.65);font-size:.88rem;"><?= $f[2] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'php/footer.php'; ?>
