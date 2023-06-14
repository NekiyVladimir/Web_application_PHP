<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="/">Home</a>
      </div>
    </div>
    <?php
    if (!$_SESSION['prem']['username']){?>
      <a class="nav-link" href="/login">Login</a>
      <?php
    }else {?>
      <a class="nav-link" href="/profile">Hello, <?php print_r($_SESSION['prem']['username']); ?></a>
      <?php
    }
    ?>
  </div>
  <div style="margin-left:20px">
    <?php
    if (!$_SESSION['prem']['username']){?>
      <a class="nav-link" style="margin-right:20px" href="/register">Register</a>
      <?php
    }else {?>
      <form action="/auth/logout" method="post">
        <button type="submit" style="margin-right:20px" class="btn btn-danger">Logout</button>
      </form>
      <?php
    }
    ?>
  </div>

</nav>