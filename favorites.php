<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isBuyer()) redirect('../login.php');
$page_title = 'Favorite Lands';
$root = '../';
$uid = $_SESSION['user_id'];
$favs = $conn->query("SELECT l.*, u.full_name as seller_name, (SELECT image_path FROM land_images WHERE land_id=l.id LIMIT 1) as thumb FROM favorites f JOIN lands l ON f.land_id=l.id JOIN users u ON l.seller_id=u.id WHERE f.user_id='$uid' ORDER BY f.created_at DESC");
include '../php/header.php';
?>
<div class="back-container">
    <button type="button" class="back-btn" onclick="history.back()">
        ← Back
    </button>
</div>
<div class="dashboard-layout">
  <aside class="sidebar">
    <div class="sidebar-brand">Land<span>Buy</span></div>
    <ul class="sidebar-nav">
      <li><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="../search.php"><span class="icon">🔍</span> Browse Lands</a></li>
      <li><a href="favorites.php" class="active"><span class="icon">❤️</span> Favorite Lands</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> My Inquiries</a></li>
      <li><a href="profile.php"><span class="icon">👤</span> Profile</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
  </aside>
  <main class="dashboard-main">
    <h1>Favorite Lands</h1>
    <?php if($favs->num_rows === 0): ?>
    <div class="alert alert-info">No favorites yet. <a href="../search.php">Browse lands</a> and save your favorites.</div>
    <?php else: ?>
    <div class="lands-grid">
      <?php while($land = $favs->fetch_assoc()): ?>
      <div class="land-card">
        <?php if($land['thumb']): ?>
          <img src="../<?= htmlspecialchars($land['thumb']) ?>" alt="<?= htmlspecialchars($land['title']) ?>" class="land-card-img">
        <?php else: ?>
          <div class="land-card-img-placeholder">🏞️</div>
        <?php endif; ?>
        <div class="land-card-body">
          <h3><?= htmlspecialchars($land['title']) ?></h3>
          <div class="location">📍 <?= htmlspecialchars($land['location']) ?></div>
          <div class="size">📐 <?= $land['land_size'] ?> Perches</div>
          <div class="price"><?= formatPrice($land['price']) ?></div>
          <div style="display:flex;gap:.5rem;">
            <a href="../land-detail.php?id=<?= $land['id'] ?>" class="btn btn-outline btn-sm" style="flex:1;">View</a>
            <a href="../php/inquiries.php?unfav=<?= $land['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove from favorites?')">♥</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>
  </main>
</div>
<?php include '../php/footer.php'; ?>
