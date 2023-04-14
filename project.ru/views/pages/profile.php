<?php
  use App\Services\Page;

  session_start();

  if (!$_SESSION['prem']['username']){
    header('Location: /login');
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
<div class="container mt-4">
<div class="p-5 mb-4 bg-body-tertiary rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Привет, <?php print_r($_SESSION['prem']['full_name']); ?>!</h1>
      <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>

 </div>
</div>
</div>
</body>
</html>