<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isSeller()) redirect('../login.php');
$page_title = 'My Lands';
$root = '../';
$uid = $_SESSION['user_id'];
$my_lands = $conn->query("SELECT * FROM lands WHERE seller_id='$uid' ORDER BY created_at DESC");
include '../php/header.php';
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
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
      <h1 style="margin-bottom:0;">My Lands</h1>
      <a href="add_land.php" class="btn btn-primary">➕ Add Land</a>
    </div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Title</th><th>Price</th><th>Size</th><th>District</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php while($land = $my_lands->fetch_assoc()): ?>
        <tr>
          <td><strong><?= htmlspecialchars($land['title']) ?></strong></td>
          <td><?= formatPrice($land['price']) ?></td>
          <td><?= $land['land_size'] ?> Perches</td>
          <td><?= htmlspecialchars($land['district']) ?></td>
          <td><span class="badge badge-<?= strtolower($land['status']) ?>"><?= $land['status'] ?></span></td>
          <td class="table-actions">
            <a href="edit_land.php?id=<?= $land['id'] ?>" class="btn btn-accent btn-sm">Edit</a>
            <a href="#" onclick="confirmDelete('../php/lands.php?delete_land=<?= $land['id'] ?>','Delete this land listing?')" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<?php include '../php/footer.php'; ?>
