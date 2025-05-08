<?php include('includes/header.php'); ?>

<style>
    .product-card {
        background-color: #f8f1e3;
        border: 1px solid #d9c8b4;
        border-radius: 10px;
        overflow: hidden;
        transition: 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        cursor: pointer;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }
    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .product-info {
        padding: 15px;
    }
    .product-name {
        font-size: 1.2rem;
        font-weight: bold;
        color: #5a4a42;
        margin-bottom: 5px;
    }
    .product-category {
        font-size: 0.9rem;
        color: #8c7355;
        margin-bottom: 10px;
    }
    .card-header {
        background-color: #d9c8b4 !important;
        color: #3b2f2f;
    }
    .btn-outline-secondary.rounded-circle {
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary {
        background-color: #8c7355;
        border-color: #a97d5d;
    }
    .btn-primary:hover {
        background-color:rgb(255, 255, 255);
        color: #8c7355;
    }
    .btn-secondary {
        background-color: #8c7355;
        border-color: #a97d5d;
    }
</style>

<h4>Create New Order</h4>

<form action="place_order.php" method="POST">
    <div class="mb-5">
        <h4 class="mb-3">☕ Choose Your Flavor:</h4>
        <div class="d-flex flex-wrap gap-3">
            <a href="orders-create.php" class="btn btn-light border rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                <i class="fas fa-mug-hot"></i> All
            </a>
            <?php 
                $categories = getAll('categories');
                if ($categories && mysqli_num_rows($categories) > 0):
                    while ($cat = mysqli_fetch_assoc($categories)):
            ?>
                <a href="orders-create.php?category=<?= htmlspecialchars($cat['id']) ?>" class="btn btn-light border rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                    <i class="fas fa-mug-hot"></i> <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php 
                    endwhile;
                else:
            ?>
                <p class="text-muted">No categories found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-coffee"></i> Products
                    <a href="products-create.php" class="btn btn-primary float-end"> Add Products </a>
                </h4>
            </div>
            <div class="card-body">
                <?php 
                    alertMessage();
                    $products = [];
                    if (isset($_GET['category']) && is_numeric($_GET['category'])) {
                        $categoryId = intval($_GET['category']);
                        $products = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $categoryId");
                    } else {
                        $products = getAll('products');
                    }

                    if ($products && mysqli_num_rows($products) > 0):
                ?>
                    <div class="row g-4">
                        <?php foreach ($products as $item): ?>
                        <div class="col-md-3">
                            <div class="product-card" 
                                 data-id="<?= $item['id'] ?>" 
                                 data-name="<?= htmlspecialchars($item['name']) ?>" 
                                 data-price="<?= $item['price'] ?>">
                                <img src="../<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-image">
                                <div class="product-info">
                                    <div class="product-name"><?= htmlspecialchars($item['name']) ?></div>
                                    <div class="product-category">
                                        <strong>
                                            <?php 
                                                $category = getById('categories', $item['category_id']);
                                                echo htmlspecialchars($category['name'] ?? '');
                                            ?>
                                        </strong>       
                                    </div>
                                    <div class="product-quantity">
                                        Quantity: <strong><?= htmlspecialchars($item['quantity']) ?></strong>
                                    </div>
                                    <div class="product-price">
                                        Price: <strong>₱<?= number_format($item['price'], 2) ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card shadow-sm my-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Selected Products</h5>
        </div>
        <div class="card-body" id="selectedProducts">
            <p class="text-muted">No products selected.</p>
        </div>
    </div>

    <div class="card shadow-sm my-4">
        <div class="card-body">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" required class="form-control mb-3">
            <label class="form-label">Payment Mode</label>
            <select name="payment_mode" class="form-select" required>
                <option value="Cash">Cash</option>
                <option value="GCash">GCash</option>
            </select>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Total: ₱<span id="grandTotal">0.00</span></h5>
            <button type="submit" name="orders-view.php" class="btn btn-success px-4">Place Order</button>
        </div>
    </div>
</form>

<?php include('includes/footer.php'); ?>
