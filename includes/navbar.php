<nav class="sb-topnav navbar navbar-expand navbar-light" style="background-color: #f5f5dc;">

    <a class="navbar-brand ps-3 d-flex align-items-center" href="index.html" style="color: #5a4a42; font-weight: bold;">
        <img src="img/Kopikuys Logo.png" alt="KOPIKUYS Logo" style="width: 80px; height: 80px; margin-right: 0px;">
        KOPIKUYS
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars" style="color: #5a4a42;"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn" id="btnNavbarSearch" type="button" style="background-color: #d2b48c; color: white;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw" style="color: #5a4a42;"></i>
                <?= $_SESSION['loggedInUser']['username'];?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: #f5f5dc;">

                <li><a class="dropdown-item" href="../../logout.php" style="color: #5a4a42;">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>