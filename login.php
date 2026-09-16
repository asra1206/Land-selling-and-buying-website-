<?php
require_once 'php/config.php';
$page_title = 'Login';
$root = '';
require_once 'php/auth.php';
include 'php/header.php';
?>
<div class="back-container">
    <button type="button" class="back-btn" onclick="history.back()">
        ← Back
    </button>
</div>
<div style="min-height:80vh;display:flex;align-items:center;background:linear-gradient(135deg,#d8f3dc,#b7e4c7);">
  <div class="form-card fade-up" style="max-width:440px;width:100%;">
    <div style="text-align:center;margin-bottom:1.5rem;">
      <a href="index.php" style="font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--green-dark);text-decoration:none;">Land<span style="color:var(--green-light);">Buy</span></a>
    </div>
    <h2>Login to Your Account</h2>
    <?php if(isset($login_error)): ?><div class="alert alert-danger"><?= $login_error ?></div><?php endif; ?>
    <form method="POST" action="">
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="example@gmail.com" value="<?= isset($_POST['email'])?htmlspecialchars($_POST['email']):'' ?>" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>
      <div style="text-align:right;margin-bottom:1rem;">
        <a href="#" style="color:var(--green);font-size:.85rem;">Forgot Password?</a>
      </div>
      <div style="display:flex;gap:1rem;">
    <button type="submit" name="login" class="btn btn-primary btn-lg">
        Login
    </button>

    <button type="reset" class="btn btn-outline btn-lg">
        Clear
    </button>
</div>
      <div class="form-link">Don't have an account? <a href="register.php">Register</a></div>
    </form>
    
  </div>
</div>
<?php include 'php/footer.php'; ?>
