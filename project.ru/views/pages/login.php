<?php
use App\Services\Page;

session_start();

  if ($_SESSION['prem']['username']){
    header('Location: /profile');
  }
?>


<!doctype html>
<html lang="en">
<?php
	Page::part('head');
?>
<body>
<?php
	Page::part('navbar');
?>
<div class="container">
<h2 class="mt-4">Sing In</h2>
<form id="loginform">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" required id="username">
  </div>
  <p class="msg1"></p>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" required name="password">
  </div>
  <p class="msg2"></p>
  <button type="submit" id="elem" disabled class="btn btn-primary">Submit</button>
  <script>
          let elem = document.querySelector('#elem');
          elem.disabled = false;
        </script>
        <noscript>Извините, Ваш браузер не поддерживает JS. Регистрация не возможна!</noscript>
</form>
</div>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>