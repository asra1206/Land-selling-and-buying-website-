<?php
// php/header.php - shared navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($page_title) ? $page_title . ' | LandBuy' : 'LandBuy - Find Your Dream Land' ?></title>
  <link rel="stylesheet" href="<?= $root ?? '' ?>css/style.css">
</head>
<body>
<nav class="navbar">
  <a href="<?= $root ?? '' ?>index.php" class="navbar-brand">Land<span>Buy</span></a>
  <ul class="navbar-nav">
    <li><a href="<?= $root ?? '' ?>index.php">Home</a></li>
    <li><a href="<?= $root ?? '' ?>search.php">Lands</a></li>
    <li><a href="<?= $root ?? '' ?>about.php">About Us</a></li>
    <li><a href="<?= $root ?? '' ?>contact.php">Contact Us</a></li>
  </ul>
  <div class="navbar-actions">
    <?php if (isLoggedIn()): ?>
      <a href="<?= $root ?? '' ?><?= $_SESSION['role'] ?>/dashboard.php" class="btn btn-outline btn-sm">Dashboard</a>
      <a href="<?= $root ?? '' ?>php/auth.php?logout=1" class="btn btn-primary btn-sm">Logout</a>
    <?php else: ?>
      <a href="<?= $root ?? '' ?>login.php" class="btn btn-outline btn-sm">Login</a>
      <a href="<?= $root ?? '' ?>register.php" class="btn btn-primary btn-sm">Register</a>
    <?php endif; ?>
  </div>
  <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
</nav>
<div class="navbar-mobile" id="mobileNav">
  <a href="<?= $root ?? '' ?>index.php">Home</a>
  <a href="<?= $root ?? '' ?>search.php">Lands</a>
  <a href="<?= $root ?? '' ?>about.php">About Us</a>
  <a href="<?= $root ?? '' ?>contact.php">Contact Us</a>
  <?php if (isLoggedIn()): ?>
    <a href="<?= $root ?? '' ?><?= $_SESSION['role'] ?>/dashboard.php">Dashboard</a>
    <a href="<?= $root ?? '' ?>php/auth.php?logout=1">Logout</a>
  <?php else: ?>
    <a href="<?= $root ?? '' ?>login.php">Login</a>
    <a href="<?= $root ?? '' ?>register.php">Register</a>
  <?php endif; ?>
</div>
