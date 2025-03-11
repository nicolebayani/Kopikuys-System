<nav class="navbar navbar-expand-lg bg-light shadow" style="background-color:rgb(252, 240, 216) !important;">
  <div class="container">
    
    <a class="navbar-brand" href="#" style="color: #8b5a2b; font-weight: bold;">
        Kopikuys
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="index.php" style="color: #8b5a2b;">Home</a>
        </li>
        
        <?php if(isset($_SESSION['loggedIn'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color: #8b5a2b;"><?= $_SESSION['loggedInUser']['name'];?></a>
        </li>
        <li class="nav-item">
          <a class="btn btn-danger" href="logout.php" style="background-color: #8b5a2b; border-color: #8b5a2b;">
            Logout
          </a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php" style="color: #8b5a2b;">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>