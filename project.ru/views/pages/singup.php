<?php
use App\Controllers\Auth;
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$email = $_POST['email'];
$full_name = $_POST['full_name'];
$res = Auth::bd();
$res = json_decode($res, true);


$response = Auth::registertest($username, $password, $password_confirm, $email, $full_name, $res);

echo json_encode($response, JSON_UNESCAPED_UNICODE);




?>