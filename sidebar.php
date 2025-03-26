<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="background-color: #f5f5dc;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Core</div>
                <a class="nav-link" href="index.html" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: #5a4a42;"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Interface</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts" style="color: #5a4a42;">
                     <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: #5a4a42;"></i></div>
                    Create Order
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    </div>


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open" style="color: #5a4a42;"></i></div>
                    View Orders
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="orders-view.php" style="color: #5a4a42;">All Orders</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading" style="color: #5a4a42;">Manage Cashiers</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCashiers" aria-expanded="false" aria-controls="collapseCashiers" style="color: #5a4a42;">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: #5a4a42;"></i></div>
                    Cashiers/Staff
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #5a4a42;"></i></div>
                </a>
                <div class="collapse" id="collapseCashiers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admins-create.php" style="color: #5a4a42;">Add Cashier</a>
                        <a class="nav-link" href="admins.php" style="color: #5a4a42;">View Cashiers</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer" style="background-color:rgb(224, 207, 184); color: black;">
            <div class="small">Logged in as:</div>
            Cashier
        </div>
    </nav>
</div>