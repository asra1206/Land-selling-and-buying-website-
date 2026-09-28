<?php // php/footer.php ?>
<footer>
  <div class="footer-grid">
    <div>
      <div class="footer-brand">Land<span>Buy</span></div>
      <p style="font-size:.88rem;line-height:1.7;">Discover verified lands across Sri Lanka. Buy or sell with confidence.</p>
    </div>
    <div class="footer-col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="<?= $root ?? '' ?>index.php">Home</a></li>
        <li><a href="<?= $root ?? '' ?>search.php">Browse Lands</a></li>
        <li><a href="<?= $root ?? '' ?>register.php">Register</a></li>
        <li><a href="<?= $root ?? '' ?>login.php">Login</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Districts</h4>
      <ul>
        <li><a href="<?= $root ?? '' ?>search.php?district=Colombo">Colombo</a></li>
        <li><a href="<?= $root ?? '' ?>search.php?district=Kandy">Kandy</a></li>
        <li><a href="<?= $root ?? '' ?>search.php?district=Galle">Galle</a></li>
        <li><a href="<?= $root ?? '' ?>search.php?district=Jaffna">Jaffna</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Contact</h4>
      <ul>
        <li><a href="mailto:info@landbuy.lk">info@landbuy.lk</a></li>
        <li><a href="tel:+94771234567">+94 77 123 4567</a></li>
        <li><a href="#">Colombo, Sri Lanka</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; <?= date('Y') ?> LandBuy. All rights reserved.
  </div>
</footer>
<script src="<?= $root ?? '' ?>js/main.js"></script>
</body>
</html>
