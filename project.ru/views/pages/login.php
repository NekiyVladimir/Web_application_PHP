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
<form class="mt-4" action="/auth/login" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" id="username"value="<?php
              if ($_SESSION['username']) {
                echo $_SESSION['username'];
              }
              unset($_SESSION['username']);
            ?>">
  </div>
  <?php
          if ($_SESSION['message']) {
            echo '<p>' . $_SESSION['message'] . '</p>';
          }
          unset($_SESSION['message']);
        ?>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password"value="<?php
              if ($_SESSION['password']) {
                echo $_SESSION['password'];
              }
              unset($_SESSION['password']);
            ?>">
  </div>
  <?php
          if ($_SESSION['message0']) {
            echo '<p>' . $_SESSION['message0'] . '</p>';
          }
          unset($_SESSION['message0']);
        ?>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>