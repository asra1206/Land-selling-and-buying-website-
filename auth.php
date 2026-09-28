<?php
require_once 'config.php';

// REGISTER
if (isset($_POST['register'])) {
    $full_name = sanitize($conn, $_POST['full_name']);
    $email = sanitize($conn, $_POST['email']);
    $phone = sanitize($conn, $_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = sanitize($conn, $_POST['role']);

    $check = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $reg_error = "Email already registered.";
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $reg_error = "Passwords do not match.";
    } else {
        $conn->query("INSERT INTO users (full_name,email,phone,password,role) VALUES ('$full_name','$email','$phone','$password','$role')");
        $reg_success = "Registration successful! Redirecting to login...";
    }
}

// LOGIN
if (isset($_POST['login'])) {
    $email = sanitize($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            if ($user['role'] === 'admin') redirect('../landbuy/admin/dashboard.php');
            elseif ($user['role'] === 'seller') redirect('../landbuy/seller/dashboard.php');
            else redirect('../landbuy/buyer/dashboard.php');
        } else { $login_error = "Invalid password."; }
    } else { $login_error = "Email not found."; }
}

// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    redirect('../index.php');
}
?>
