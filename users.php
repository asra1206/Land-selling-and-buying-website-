<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isAdmin()) redirect('../login.php');
$page_title = 'Manage Users';
$root = '../';
$users = $conn->query("SELECT *, (SELECT COUNT(*) FROM lands WHERE seller_id=users.id) as land_count, (SELECT COUNT(*) FROM inquiries WHERE buyer_id=users.id) as inq_count FROM users ORDER BY created_at DESC");
include '../php/header.php';
?>
<div class="dashboard-layout">
  <aside class="sidebar">
    <div class="sidebar-brand">Land<span>Buy</span></div>
    <ul class="sidebar-nav">
      <li><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="users.php" class="active"><span class="icon">👥</span> Users</a></li>
      <li><a href="lands.php"><span class="icon">🏞️</span> Lands</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> Inquiries</a></li>
      <li><a href="reports.php"><span class="icon">📈</span> Reports</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
  </aside>
  <main class="dashboard-main">
    <h1>Manage Users</h1>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Lands</th><th>Inquiries</th><th>Joined</th></tr></thead>
        <tbody>
        <?php while($user = $users->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($user['full_name']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['phone']) ?></td>
          <td><span class="badge badge-<?= $user['role']==='admin'?'approved':($user['role']==='seller'?'pending':'sold') ?>"><?= ucfirst($user['role']) ?></span></td>
          <td><?= $user['land_count'] ?></td>
          <td><?= $user['inq_count'] ?></td>
          <td><?= date('Y-m-d', strtotime($user['created_at'])) ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<?php include '../php/footer.php'; ?>
