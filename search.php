<?php
require_once 'php/config.php';
$page_title = 'Search Lands';
$root = '';
include 'php/header.php';

$district = isset($_GET['district']) ? sanitize($conn, $_GET['district']) : '';
$land_type = isset($_GET['land_type']) ? sanitize($conn, $_GET['land_type']) : '';
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 0;
$land_size = isset($_GET['land_size']) ? sanitize($conn, $_GET['land_size']) : '';

$where = "WHERE l.status='Approved'";
if($district) $where .= " AND l.district='$district'";
if($land_type) $where .= " AND l.land_type='$land_type'";
if($min_price > 0) $where .= " AND l.price >= $min_price";
if($max_price > 0) $where .= " AND l.price <= $max_price";
if($land_size === 'small') $where .= " AND l.land_size < 20";
elseif($land_size === 'medium') $where .= " AND l.land_size BETWEEN 20 AND 50";
elseif($land_size === 'large') $where .= " AND l.land_size > 50";

$total_q = $conn->query("SELECT COUNT(*) as cnt FROM lands l $where");
$total = $total_q->fetch_assoc()['cnt'];

$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 8;
$offset = ($page - 1) * $per_page;
$total_pages = ceil($total / $per_page);

$lands = $conn->query("SELECT l.*, u.full_name as seller_name,
  (SELECT image_path FROM land_images WHERE land_id=l.id LIMIT 1) as thumb
  FROM lands l JOIN users u ON l.seller_id=u.id
  $where ORDER BY l.created_at DESC LIMIT $per_page OFFSET $offset");

$districts = ['Colombo','Kandy','Galle','Jaffna','Matara','Anuradhapura','Kurunegala','Ratnapura','Badulla','Trincomalee','Hambantota','Nuwara Eliya'];
?>
<div class="back-container">
    <button type="button" class="back-btn" onclick="history.back()">
        ← Back
    </button>
</div>
<div class="search-layout">
  <div class="filter-sidebar">
    <h3>🔍 Filter Search</h3>
    <form method="GET" action="">
      <label>District</label>
      <select name="district">
        <option value="">All Districts</option>
        <?php foreach($districts as $d): ?>
        <option value="<?= $d ?>" <?= $district===$d?'selected':'' ?>><?= $d ?></option>
        <?php endforeach; ?>
      </select>
      <label>Land Type</label>
      <select name="land_type">
        <option value="">All Types</option>
        <?php foreach(['Residential','Commercial','Agricultural','Industrial'] as $t): ?>
        <option value="<?= $t ?>" <?= $land_type===$t?'selected':'' ?>><?= $t ?></option>
        <?php endforeach; ?>
      </select>
      <label>Min Price (Rs.)</label>
      <input type="number" name="min_price" placeholder="Min Price" value="<?= $min_price ?: '' ?>">
      <label>Max Price (Rs.)</label>
      <input type="number" name="max_price" placeholder="Max Price" value="<?= $max_price ?: '' ?>">
      <label>Land Size</label>
      <select name="land_size">
        <option value="">All Sizes</option>
        <option value="small" <?= $land_size==='small'?'selected':'' ?>>Below 20 Perches</option>
        <option value="medium" <?= $land_size==='medium'?'selected':'' ?>>20–50 Perches</option>
        <option value="large" <?= $land_size==='large'?'selected':'' ?>>Above 50 Perches</option>
      </select>
      <button type="submit" class="btn btn-primary btn-block">Search</button>
     
      <?php if($district||$land_type||$min_price||$max_price||$land_size): ?>
      <a href="search.php" class="btn btn-outline btn-block btn-sm" style="margin-top:.5rem;">Clear Filters</a>
      <?php endif; ?>
    </form>
  </div>

  <div class="search-results">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.2rem;">
      <h2 class="section-title" style="margin-bottom:0">All Lands</h2>
      <span class="search-results-header"><?= $total ?> listing<?= $total!==1?'s':'' ?> found</span>
    </div>
    <?php if($lands->num_rows === 0): ?>
    <div class="alert alert-info">No lands found matching your criteria. <a href="search.php">Clear filters</a></div>
    <?php else: ?>
    <div class="lands-grid">
      <?php while($land = $lands->fetch_assoc()): ?>
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
    // Pagination
    <?php if($total_pages > 1): ?>
    <div class="pagination">
      <?php if($page > 1): ?><a href="?<?= http_build_query(array_merge($_GET,['page'=>$page-1])) ?>">&laquo;</a><?php endif; ?>
      <?php for($i=1;$i<=$total_pages;$i++): ?>
      <a href="?<?= http_build_query(array_merge($_GET,['page'=>$i])) ?>" class="<?= $i===$page?'active':'' ?>"><?= $i ?></a>
      <?php endfor; ?>
      <?php if($page < $total_pages): ?><a href="?<?= http_build_query(array_merge($_GET,['page'=>$page+1])) ?>">&raquo;</a><?php endif; ?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
<?php include 'php/footer.php'; ?>
