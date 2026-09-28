<?php
require_once 'config.php';

// ADD LAND
if (isset($_POST['add_land'])) {
    if (!isLoggedIn() || !isSeller()) redirect('../login.php');
    $seller_id = $_SESSION['user_id'];
    $title = sanitize($conn, $_POST['title']);
    $location = sanitize($conn, $_POST['location']);
    $district = sanitize($conn, $_POST['district']);
    $land_type = sanitize($conn, $_POST['land_type']);
    $land_size = (float)$_POST['land_size'];
    $price = (float)$_POST['price'];
    $road_access = sanitize($conn, $_POST['road_access']);
    $description = sanitize($conn, $_POST['description']);
    $latitude = sanitize($conn, $_POST['latitude']);
$longitude = sanitize($conn, $_POST['longitude']);

    $conn->query("INSERT INTO lands (seller_id,title,location,district,land_type,land_size,price,road_access,description,latitude,longitude,status)
                  VALUES ('$seller_id','$title','$location','$district','$land_type','$land_size','$price','$road_access','$description','latitude','longitude','Pending')");
    $land_id = $conn->insert_id;

    // Handle images
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = '../images/lands/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        foreach ($_FILES['images']['tmp_name'] as $k => $tmp) {
            if ($_FILES['images']['error'][$k] === 0) {
                $ext = pathinfo($_FILES['images']['name'][$k], PATHINFO_EXTENSION);
                $fname = 'land_' . $land_id . '_' . $k . '.' . $ext;
                move_uploaded_file($tmp, $upload_dir . $fname);
                $conn->query("INSERT INTO land_images (land_id,image_path) VALUES ('$land_id','images/lands/$fname')");
            }
        }
    }
    $add_success = "Land listing submitted for approval.";
}

// EDIT LAND
if (isset($_POST['edit_land'])) {
    if (!isLoggedIn()) redirect('../login.php');
    $land_id = (int)$_POST['land_id'];
    $title = sanitize($conn, $_POST['title']);
    $location = sanitize($conn, $_POST['location']);
    $district = sanitize($conn, $_POST['district']);
    $land_type = sanitize($conn, $_POST['land_type']);
    $land_size = (float)$_POST['land_size'];
    $price = (float)$_POST['price'];
    $road_access = sanitize($conn, $_POST['road_access']);
    $description = sanitize($conn, $_POST['description']);
    $conn->query("UPDATE lands SET title='$title',location='$location',district='$district',land_type='$land_type',
                  land_size='$land_size',price='$price',road_access='$road_access',description='$description' WHERE id='$land_id'");
    redirect('../seller/my_lands.php');
}

// DELETE LAND
if (isset($_GET['delete_land'])) {
    $land_id = (int)$_GET['delete_land'];
    $conn->query("DELETE FROM lands WHERE id='$land_id'");
    redirect('../seller/my_lands.php');
}

// ADMIN APPROVE/REJECT
if (isset($_GET['approve'])) {
    if (!isAdmin()) redirect('../login.php');
    $id = (int)$_GET['approve'];
    $conn->query("UPDATE lands SET status='Approved' WHERE id='$id'");
    redirect('../admin/lands.php');
}
if (isset($_GET['reject'])) {
    if (!isAdmin()) redirect('../login.php');
    $id = (int)$_GET['reject'];
    $conn->query("UPDATE lands SET status='Rejected' WHERE id='$id'");
    redirect('../admin/lands.php');
}
?>
