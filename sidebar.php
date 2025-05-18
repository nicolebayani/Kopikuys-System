<div id="layoutSidenav_nav">
    <style>
        /* Sidebar nav links hover effect */
        #layoutSidenav_nav .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #layoutSidenav_nav .nav-link:hover {
            background-color: #d2c9b8; /* slightly darker beige */
            color: #3e342a !important; /* darker text on hover */
        }

        #layoutSidenav_nav .nav-link:hover .sb-nav-link-icon i {
            color: #3e342a !important; /* icon color on hover */
        }

        /* Also for nested links */
        #layoutSidenav_nav .sb-sidenav-menu-nested .nav-link:hover {
            background-color: #d2c9b8;
            color: #3e342a !important;
        }

        #layoutSidenav_nav .sb-sidenav-menu-nested .nav-link:hover .sb-nav-link-icon i {
            color: #3e342a !important;
        }
    </style>

    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="background-color: #f5f5dc;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Main</div>
                <a class="nav-link" href="dashboard.php" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-dashboard" style="color: #5a4a42;"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Manage Orders and Categories</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders" aria-expanded="false" aria-controls="collapsePages" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-coffee" style="color: #5a4a42;"></i></div>
                    Orders
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapseOrders" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="orders-create.php" style="color: #5a4a42;">Create Order</a>
                        <a class="nav-link" href="orders.php" style="color: #5a4a42;">View Orders</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapsePages" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-coffee" style="color: #5a4a42;"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapseCategories" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="categories-create.php" style="color: #5a4a42;">Create Category</a>
                        <a class="nav-link" href="categories.php" style="color: #5a4a42;">View Categories</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-coffee" style="color: #5a4a42;"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapseProduct" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="products-create.php" style="color: #5a4a42;">Create Products</a>
                        <a class="nav-link" href="products.php" style="color: #5a4a42;">View Products</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Manage Cashiers</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCashiers" aria-expanded="false" aria-controls="collapseCashiers" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-user" style="color: #5a4a42;"></i></div>
                    Cashiers/Staff
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapseCashiers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admins-create.php" style="color: #5a4a42;">Add Cashier</a>
                        <a class="nav-link" href="admins.php" style="color: #5a4a42;">View Cashiers</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Manage Sales</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSales" aria-expanded="false" aria-controls="collapseSales" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-bar-chart" style="color: #5a4a42;"></i></div>
                    Sales
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapseSales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="sales-report.php" style="color: #5a4a42;">View Sales</a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>
