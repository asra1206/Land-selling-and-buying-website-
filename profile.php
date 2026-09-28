<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isBuyer()) redirect('../login.php');
$page_title = 'Profile';
$root = '../';
$uid = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id='$uid'")->fetch_assoc();

if(isset($_POST['update_profile'])) {
    $full_name = sanitize($conn, $_POST['full_name']);
    $phone = sanitize($conn, $_POST['phone']);
    $conn->query("UPDATE users SET full_name='$full_name', phone='$phone' WHERE id='$uid'");
    $_SESSION['full_name'] = $full_name;
    $success = "Profile updated.";
    $user = $conn->query("SELECT * FROM users WHERE id='$uid'")->fetch_assoc();
}
if(isset($_POST['change_password'])) {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    if(password_verify($old, $user['password'])) {
        $hashed = password_hash($new, PASSWORD_BCRYPT);
        $conn->query("UPDATE users SET password='$hashed' WHERE id='$uid'");
        $pass_success = "Password changed.";
    } else { $pass_error = "Old password is incorrect."; }
}
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
      <li><a href="favorites.php"><span class="icon">❤️</span> Favorite Lands</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> My Inquiries</a></li>
      <li><a href="profile.php" class="active"><span class="icon">👤</span> Profile</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
  </aside>
  <main class="dashboard-main">
    <h1>My Profile</h1>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;max-width:800px;">
      <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);">
        <h3 style="margin-bottom:1.2rem;color:var(--green-dark);">Account Info</h3>
        <?php if(isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
        <form method="POST">
          <div class="form-group"><label>Full Name</label><input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required></div>
          <div class="form-group"><label>Email</label><input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly style="background:#f1f3f5;"></div>
          <div class="form-group"><label>Phone</label><input type="tel" name="phone" value="<?= htmlspecialchars($user['phone']) ?>"></div>
          <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form>
      </div>
      <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);">
        <h3 style="margin-bottom:1.2rem;color:var(--green-dark);">Change Password</h3>
        <?php if(isset($pass_success)): ?><div class="alert alert-success"><?= $pass_success ?></div><?php endif; ?>
        <?php if(isset($pass_error)): ?><div class="alert alert-danger"><?= $pass_error ?></div><?php endif; ?>
        <form method="POST">
          <div class="form-group"><label>Old Password</label><input type="password" name="old_password" required></div>
          <div class="form-group"><label>New Password</label><input type="password" name="new_password" required></div>
          <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
        </form>
      </div>
    </div>
  </main>
</div>
<?php include '../php/footer.php'; ?>
