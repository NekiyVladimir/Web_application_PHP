<?php
use App\Services\Page;
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
<h2 class="mt-4">404: Page not found</h2>
</div>
</body>
</html>