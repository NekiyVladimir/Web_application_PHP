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
		} elseif(empty($username)){
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
		} elseif (!ctype_alnum($password)){
			$_SESSION['message3'] = 'Пароль должен пароль должен содержать цифры и буквы';
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