<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isBuyer()) redirect('../login.php');
$page_title = 'Buyer Dashboard';
$root = '../';
$uid = $_SESSION['user_id'];
$total_inquiries = $conn->query("SELECT COUNT(*) as c FROM inquiries WHERE buyer_id='$uid'")->fetch_assoc()['c'];
$total_favorites = $conn->query("SELECT COUNT(*) as c FROM favorites WHERE user_id='$uid'")->fetch_assoc()['c'];
$recent_inq = $conn->query("SELECT i.*, l.title as land_title, u.full_name as seller_name FROM inquiries i JOIN lands l ON i.land_id=l.id JOIN users u ON i.seller_id=u.id WHERE i.buyer_id='$uid' ORDER BY i.created_at DESC LIMIT 5");
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
      <li><a href="dashboard.php" class="active"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="../search.php"><span class="icon">🔍</span> Browse Lands</a></li>
      <li><a href="favorites.php"><span class="icon">❤️</span> Favorite Lands</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> My Inquiries</a></li>
      <li><a href="profile.php"><span class="icon">👤</span> Profile</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
  </aside>
  <main class="dashboard-main">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h1>
    <div class="stats-grid">
      <div class="stat-card"><div class="stat-num"><?= $total_inquiries ?></div><div class="stat-label">My Inquiries</div></div>
      <div class="stat-card"><div class="stat-num"><?= $total_favorites ?></div><div class="stat-label">Saved Lands</div></div>
    </div>
    <div class="table-wrapper">
      <h3>Recent Inquiries</h3>
      <table>
        <thead><tr><th>Land Title</th><th>Seller</th><th>Message</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>
        <?php if($total_inquiries === 0): ?><tr><td colspan="5" style="text-align:center;color:var(--gray-400);">No inquiries yet. <a href="../search.php">Browse lands</a></td></tr><?php endif; ?>
        <?php while($inq = $recent_inq->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($inq['land_title']) ?></td>
          <td><?= htmlspecialchars($inq['seller_name']) ?></td>
          <td style="max-width:180px;"><?= htmlspecialchars(substr($inq['message'],0,60)) ?>...</td>
          <td><?= date('Y-m-d', strtotime($inq['created_at'])) ?></td>
          <td><span class="badge badge-<?= strtolower($inq['status']) ?>"><?= $inq['status'] ?></span></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<?php include '../php/footer.php'; ?>
