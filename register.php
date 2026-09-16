<?php
require_once 'php/config.php';
$page_title = 'Register';
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
  <div class="form-card fade-up" style="max-width:500px;width:100%;">
    <div style="text-align:center;margin-bottom:1.5rem;">
      <a href="index.php" style="font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--green-dark);text-decoration:none;">Land<span style="color:var(--green-light);">Buy</span></a>
    </div>
    
    <h2>Create Account</h2>
    <?php if(isset($reg_error)): ?><div class="alert alert-danger"><?= $reg_error ?></div><?php endif; ?>
    <?php if(isset($reg_success)): ?><div class="alert alert-success"><?= $reg_success ?></div>
      <script>setTimeout(function () {
        window.location.href = "login.php";
      }, 2000);
      </script>
      <?php endif; ?>
    <form method="POST" action="">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Enter your full name" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input type="tel" name="phone" placeholder="07X XXXXXXX">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" placeholder="Confirm" required>
        </div>
      </div>
      <div class="form-group">
        <label>Select Role</label>
        <select name="role" required>
          <option value="buyer">Buyer</option>
          <option value="seller">Seller</option>
        </select>
      </div>
      <div style="display:flex;gap:1rem;">
    <button type="submit" name="register" class="btn btn-primary btn-lg">
       Rejister
    </button>

    <button type="reset" class="btn btn-outline btn-lg">
        Clear
    </button>
</div>
      <div class="form-link">Already have an account? <a href="login.php">Login</a></div>
    </form>
  </div>
</div>
<?php include 'php/footer.php'; ?>
