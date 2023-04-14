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
      <form class="mt-4" action="/auth/register" method="post"  enctype="multipart/form-data">
        <div class="form-group">
          <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php
              if ($_SESSION['email']) {
                echo $_SESSION['email'];
              }
              unset($_SESSION['email']);
            ?>" >
        </div>
        <?php
          if ($_SESSION['message0']) {
            echo '<p>' . $_SESSION['message0'] . '</p>';
          }
          unset($_SESSION['message0']);
        ?>
        <div class="form-group">
          <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?php
              if ($_SESSION['username']) {
                echo $_SESSION['username'];
              }
              unset($_SESSION['username']);
            ?>">
            <?php
              if ($_SESSION['message1']) {
                echo '<p>' . $_SESSION['message1'] . '</p>';
              }
              unset($_SESSION['message1']);
            ?>
        </div>
        <div class="form-group">
          <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" id="full_name" value="<?php
              if ($_SESSION['full_name']) {
                echo $_SESSION['full_name'];
              }
              unset($_SESSION['full_name']);
            ?>">
        </div>
        <?php
          if ($_SESSION['message2']) {
            echo '<p>' . $_SESSION['message2'] . '</p>';
          }
          unset($_SESSION['message2']);
        ?>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="<?php
              if ($_SESSION['password']) {
                echo $_SESSION['password'];
              }
              unset($_SESSION['password']);
            ?>">
        </div>
        <?php
          if ($_SESSION['message3']) {
            echo '<p>' . $_SESSION['message3'] . '</p>';
          }
          unset($_SESSION['message3']);
        ?>
        <div class="mb-3">
          <label for="password_confirm" class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="<?php
              if ($_SESSION['password_confirm']) {
                echo $_SESSION['password_confirm'];
              }
              unset($_SESSION['password_confirm']);
            ?>">
        </div>
        <?php
          if ($_SESSION['message4']) {
            echo '<p>' . $_SESSION['message4'] . '</p>';
          }
          unset($_SESSION['message4']);
        ?>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>