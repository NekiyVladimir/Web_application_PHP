<?php
namespace App\Controllers;

use App\Services\Router;

session_start();


class Auth
{

	public function logout()
	{
		$_SESSION = array();
		header('Location: /login');

	}

	public static function bd()
	{
		$res=file_get_contents("database/db.json");
//		$res=json_decode($res, true);
		return $res;
	}

	public static function logintest($username, $password, $res)
	{
		if (!array_key_exists($username, $res)) {
		$response = [
			"status" => false,
			"msg1" => 'Пользователя с таким ником нету!'
		];
		return $response;

		} else {

			if (md5($res[$username]['salt'].$password) === $res[$username]['password']) {
				$response = [
					"status" => true
				];
				$_SESSION['prem'] = [
					"username" => $username
				];
				return $response;
			} else {
				$response = [
					"status" => false,
					"msg2" => 'Пароль неверный!',
					"msg1" => 'Отлично!'
				];
				return $response;
			}
		}
	}


	public static function registertest($username, $password, $password_confirm, $email, $full_name, $res)
	{

		function generateSalt() // соль для пароля
			{
				$salt = '';
				$saltLength = 8;

				for($i = 0; $i < $saltLength; $i++) {
					$salt .= chr(mt_rand(33, 126));
				}

				return $salt;
			}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$response = [
				"status" => false,
				"msg1" => 'E-mail адрес указан не верно!'
			];
			return $response;
		} elseif (strlen($username) < 6) {
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => 'Username должен быть не менее 6 символов!'
			];
			return $response;
		} elseif (preg_match("|\s|", $username) ){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => 'Пробелы в этом поле не допустимы!'
			];
			return $response;
		}elseif(empty($username)){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => 'Обязательное поле для заполнения!'
			];
			return $response;
		} elseif (array_key_exists($username, $res)) {
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => 'Такой пользователь уже существует!'
			];
			return $response;
		}
		if (strlen($full_name) < 2) {
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => 'Имя пользователя должно быть не менее 2 символов!'
			];
			return $response;
		} elseif (!ctype_alpha($full_name)){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => 'Имя пользователя должно содержать только буквы!'
			];
			return $response;
		} elseif (strlen($password) < 6){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => null,
				"msg4" => 'Пароль должен быть не менее 6 символов!'
			];
			return $response;
		} elseif (preg_match("|\s|", $password)) {
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => null,
				"msg4" => 'Пробелы не допустимы. Пароль должен содержать цифры и буквы!'
			];
			return $response;
		} elseif (!preg_match("/[0-9]{1}/", $password)){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => null,
				"msg4" => 'Цифр нет. Пароль должен содержать цифры и буквы!'
			];
			return $response;
		} elseif (!preg_match("/[a-zа-яё]{1}/i",$password)){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => null,
				"msg4" => 'Букв нет. Пароль должен содержать цифры и буквы!'
			];
			return $response;
		} elseif ($password !== $password_confirm){
			$response = [
				"status" => false,
				"msg1" => null,
				"msg2" => null,
				"msg3" => null,
				"msg4" => null,
				"msg5" => 'Пароли не совпадают!'
			];
			return $response;
		} else {
			$salt = generateSalt(); // соль
			$password = md5($salt . $password); // соленый пароль
			$people['full_name']=$full_name;
			$people['username']=$username;
			$people['email']=$email;
			$people['password']=$password;
			$people['salt']=$salt;
			$res1[$username]=$people;



			$new = array_merge($res, $res1);
			$new=json_encode($new, JSON_UNESCAPED_UNICODE);
			file_put_contents("database/db.json", $new);

			$response = [
				"status" => true,
				"msg5" => null
			];
			return $response;

		}
	}

	public function login($data)
	{

		$username=$data['username'];
		$password=$data['password'];


		$res=file_get_contents("database/db.json");
		$res=json_decode($res, true);

		if (!array_key_exists($username, $res)) {
			$_SESSION['message'] = 'Пользователя с таким ником нету!';
			header('Location: /login');
			exit;
		} else {
			$prem=$res[$username];
		}

		if (md5($prem['salt'].$password) === $prem['password']) {
			$_SESSION['prem'] = $prem;
			header('Location: /profile');
			exit;
		} else {
			$_SESSION['message0'] = 'Пароль неверный!';
			header('Location: /login');
		}

	}


	public function register($data)
	{
		$email=$data["email"];
		$username=$data["username"];
		$full_name=$data["full_name"];
		$password=$data["password"];
		$password_confirm=$data["password_confirm"];
		$_SESSION = $data;

		$res=file_get_contents("database/db.json");
		$res=json_decode($res, true);

		function generateSalt() // соль для пароля
			{
				$salt = '';
				$saltLength = 8;

				for($i = 0; $i < $saltLength; $i++) {
					$salt .= chr(mt_rand(33, 126));
				}

				return $salt;
			}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['message0'] = "E-mail адрес '$email' указан верно.";
    		header('Location: /register');
    		exit;
		}
		if (strlen($username) < 6) {
			$_SESSION['message1'] = 'Username должен быть не менее 6 символов';
			header('Location: /register');
			exit;
		} elseif (preg_match("|\s|", $username) ){
			$_SESSION['message1'] = 'Пробелы в этом поле не допустимы';
			header('Location: /register');
			exit;
		}elseif(empty($username)){
			$_SESSION['message1'] = 'Обязательное поле для заполнения';
			header('Location: /register');
			exit;
		} elseif (array_key_exists($username, $res)) {
			$_SESSION['message1'] = 'Такой пользователь уже существует';
			header('Location: /register');
			exit;
		}
		if (strlen($full_name) < 2) {
			$_SESSION['message2'] = 'Имя пользователя должно быть не менее 2 символов';
			header('Location: /register');
			exit;
		} elseif (!ctype_alpha($full_name)){
			$_SESSION['message2'] = 'Имя пользователя должно содержать только буквы';
			header('Location: /register');
			exit;
		}
		if (strlen($password) < 6){
			$_SESSION['message3'] = 'Пароль должен быть не менее 6 символов';
			header('Location: /register');
			exit;
		} elseif (preg_match("|\s|", $password)) {
			$_SESSION['message3'] = 'Пробелы не допустимы. Пароль должен содержать цифры и буквы';
			header('Location: /register');
			exit;
		} elseif (!preg_match("/[0-9]{1}/", $password)){
			$_SESSION['message3'] = 'Цифр нет. Пароль должен содержать цифры и буквы';
			header('Location: /register');
			exit;
		}elseif (!preg_match("/[a-zа-яё]{1}/i",$password)){
			$_SESSION['message3'] = 'Букв нет. Пароль должен содержать цифры и буквы';
			header('Location: /register');
			exit;
		}
		if ($password !== $password_confirm){
			$_SESSION['message4'] = 'Пароли не совпадают';
			header('Location: /register');
			exit;
		} else {
			$salt = generateSalt(); // соль
			$password = md5($salt . $password); // соленый пароль
			$people['full_name']=$full_name;
			$people['username']=$username;
			$people['email']=$email;
			$people['password']=$password;
			$people['salt']=$salt;
			$res1[$username]=$people;



			$new = array_merge($res, $res1);
			$new=json_encode($new, JSON_UNESCAPED_UNICODE);
			file_put_contents("database/db.json", $new);

			header('Location: /login');
		}
	}
}

?>