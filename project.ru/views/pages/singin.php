<?php
use App\Controllers\Auth;
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$res = Auth::bd();
$res = json_decode($res, true);


$response = Auth::logintest($username, $password, $res);

echo json_encode($response, JSON_UNESCAPED_UNICODE);




?>