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
    <h2 class="mt-4">Sing Up</h2>
      <form id="registerform">
        <div class="form-group">
          <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" required id="email">
        </div>
        <p class="msg1"></p>
        <div class="form-group">
          <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <p class="msg2"></p>
        <div class="form-group">
          <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" id="full_name" required>
        </div>
        <p class="msg3"></p>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <p class="msg4"></p>
        <div class="mb-3">
          <label for="password_confirm" class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" required>
        </div>
        <p class="msg5"></p>
        <button type="submit" id="elem2" disabled class="btn btn-primary">Submit</button>
        <script>
          let elem2 = document.querySelector('#elem2');
          elem2.disabled = false;
        </script>
        <noscript>Извините, Ваш браузер не поддерживает JS. Регистрация не возможна!</noscript>
      </form>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>