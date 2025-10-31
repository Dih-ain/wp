<?php
include('includes/db_connect.inc');
session_start();

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$stmt = mysqli_prepare($conn,'SELECT user_id,password FROM users WHERE username=?');
mysqli_stmt_bind_param( $stmt,'s', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$user_id, $hash);
mysqli_stmt_fetch($stmt);

if($user_id && password_verify($password, $hash)){
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['flash_message'] = "Logged in Successfully as: ".$username.'.';
    header('Location: index.php');
    exit();
}else{
    $_SESSION['flash_error'] = "Failed to login. Please check username and password.";
    header('Location: login.php');
    exit();
}