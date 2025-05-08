<?php include('includes/header.php'); ?>

<style>
   body {
    background: rgb(252, 240, 216) url('admin/assets/img/cover.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}

.container {
        background:rgba(252, 240, 216, 0.41); 
        padding: 15px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
}

.brand-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.brand-container img {
    width: 400px; 
    height: auto;
}

.btn-primary {
    background-color: #8b5a2b; 
    border-color: #8b5a2b;
}

.btn-primary:hover {
    background-color:rgb(255, 255, 255);
    color: #8b5a2b;
    border-color: #6f4221;
}
</style>

<div class="py-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-container">
                    <img src="admin/assets/img/Kopikuys Logo.png" alt="Kopikuys Logo">
                </div>
                <a href="login.php" class="btn btn-primary mt-0">Login</a>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>