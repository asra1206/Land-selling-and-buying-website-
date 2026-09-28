<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isAdmin()) redirect('../login.php');
$page_title = 'Reports';
$root = '../';

$by_district = $conn->query("SELECT district, COUNT(*) as cnt, SUM(price) as total FROM lands WHERE status='Approved' GROUP BY district ORDER BY cnt DESC");
$by_type = $conn->query("SELECT land_type, COUNT(*) as cnt FROM lands WHERE status='Approved' GROUP BY land_type");
$monthly = $conn->query("SELECT DATE_FORMAT(created_at,'%Y-%m') as month, COUNT(*) as cnt FROM lands GROUP BY month ORDER BY month DESC LIMIT 12");
include '../php/header.php';
?>
<div class="dashboard-layout">
  <aside class="sidebar">
    <div class="sidebar-brand">Land<span>Buy</span></div>
    <ul class="sidebar-nav">
      <li><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="users.php"><span class="icon">👥</span> Users</a></li>
      <li><a href="lands.php"><span class="icon">🏞️</span> Lands</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> Inquiries</a></li>
      <li><a href="reports.php" class="active"><span class="icon">📈</span> Reports</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
  </aside>
  <main class="dashboard-main">
    <h1>Reports & Analytics</h1>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
      <!-- By District -->
      <div class="table-wrapper">
        <h3>Lands by District</h3>
        <table>
          <thead><tr><th>District</th><th>Listings</th><th>Total Value</th></tr></thead>
          <tbody>
          <?php while($row = $by_district->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['district']) ?></td>
            <td><?= $row['cnt'] ?></td>
            <td><?= formatPrice($row['total']) ?></td>
          </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      //By Type 
      <div class="table-wrapper">
        <h3>Lands by Type</h3>
        <table>
          <thead><tr><th>Land Type</th><th>Count</th></tr></thead>
          <tbody>
          <?php while($row = $by_type->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['land_type']) ?></td>
            <td><?= $row['cnt'] ?></td>
          </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    // Monthly
    <div class="table-wrapper" style="margin-top:1.5rem;">
      <h3>Monthly Land Listings</h3>
      <table>
        <thead><tr><th>Month</th><th>New Listings</th></tr></thead>
        <tbody>
        <?php while($row = $monthly->fetch_assoc()): ?>
        <tr><td><?= $row['month'] ?></td><td><?= $row['cnt'] ?></td></tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<?php include '../php/footer.php'; ?>
