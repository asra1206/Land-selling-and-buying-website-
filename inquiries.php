<?php
require_once 'config.php';

// SEND INQUIRY
if (isset($_POST['send_inquiry'])) {
    if (!isLoggedIn()) redirect('../login.php');
    $land_id = (int)$_POST['land_id'];
    $buyer_id = $_SESSION['user_id'];
    $message = sanitize($conn, $_POST['message']);
    $your_name = sanitize($conn, $_POST['your_name']);
    $phone = sanitize($conn, $_POST['phone']);

    $land = $conn->query("SELECT seller_id FROM lands WHERE id='$land_id'")->fetch_assoc();
    $seller_id = $land['seller_id'];

    $conn->query("INSERT INTO inquiries (land_id,buyer_id,seller_id,message) VALUES ('$land_id','$buyer_id','$seller_id','$message')");
    $inq_success = "Inquiry sent successfully!";
}

// ADD TO FAVORITES
if (isset($_GET['fav'])) {
    if (!isLoggedIn()) redirect('../login.php');
    $land_id = (int)$_GET['fav'];
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT IGNORE INTO favorites (user_id,land_id) VALUES ('$user_id','$land_id')");
    redirect('../land-detail.php?id=' .$land_id);
}

// REMOVE FAVORITE
if (isset($_GET['unfav'])) {
    if (!isLoggedIn()) redirect('../login.php');
    $land_id = (int)$_GET['unfav'];
    $user_id = $_SESSION['user_id'];
    $conn->query("DELETE FROM favorites WHERE user_id='$user_id' AND land_id='$land_id'");
    redirect('../land-detail.php?id=' .$land_id);
}
?>
