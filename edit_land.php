<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isSeller()) redirect('../login.php');
$page_title = 'Edit Land';
$root = '../';
$uid = $_SESSION['user_id'];
$land_id = (int)($_GET['id'] ?? 0);
$land = $conn->query("SELECT * FROM lands WHERE id='$land_id' AND seller_id='$uid'")->fetch_assoc();
if(!$land) { redirect('my_lands.php'); }
require_once '../php/lands.php';
include '../php/header.php';
$districts = ['Colombo','Kandy','Galle','Jaffna','Matara','Anuradhapura','Kurunegala','Ratnapura','Badulla','Trincomalee','Hambantota','Nuwara Eliya'];
?>
<div class="dashboard-layout">
  <aside class="sidebar">
    <div class="sidebar-brand">Land<span>Buy</span></div>
    <ul class="sidebar-nav">
      <li><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="my_lands.php" class="active"><span class="icon">🏞️</span> My Lands</a></li>
      <li><a href="add_land.php"><span class="icon">➕</span> Add Land</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> Inquiries</a></li>
      <li><a href="profile.php"><span class="icon">👤</span> Profile</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
  </aside>
  <main class="dashboard-main">
    <h1>Edit Land</h1>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);max-width:800px;">
      <form method="POST" action="">
        <input type="hidden" name="land_id" value="<?= $land_id ?>">
        <div class="form-row">
          <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" value="<?= htmlspecialchars($land['title']) ?>" required>
          </div>
          <div class="form-group">
            <label>District *</label>
            <select name="district" required>
              <?php foreach($districts as $d): ?>
              <option value="<?= $d ?>" <?= $land['district']===$d?'selected':'' ?>><?= $d ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Location / Area *</label>
          <input type="text" name="location" value="<?= htmlspecialchars($land['location']) ?>" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Land Type *</label>
            <select name="land_type" required>
              <?php foreach(['Residential','Commercial','Agricultural','Industrial'] as $t): ?>
              <option value="<?= $t ?>" <?= $land['land_type']===$t?'selected':'' ?>><?= $t ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Land Size (Perches) *</label>
            <input type="number" name="land_size" value="<?= $land['land_size'] ?>" min="1" step="0.01" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Price (Rs.) *</label>
            <input type="number" name="price" value="<?= $land['price'] ?>" min="0" required>
          </div>
          <div class="form-group">
            <label>Road Access</label>
            <input type="text" name="road_access" value="<?= htmlspecialchars($land['road_access']) ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="4"><?= htmlspecialchars($land['description']) ?></textarea>
        </div>
        <div style="display:flex;gap:1rem;">
          <button type="submit" name="edit_land" class="btn btn-primary btn-lg">Update Land</button>
          <a href="my_lands.php" class="btn btn-outline btn-lg">Cancel</a>
        </div>
      </form>
    </div>
  </main>
</div>
<?php include '../php/footer.php'; ?>
