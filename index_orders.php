<?php
include 'db.php';

// Fetch categories
$categories = $conn->query("SELECT * FROM categories");

// Default category
$default_category_id = $categories->fetch_assoc()['id'] ?? 1;

// Fetch products based on category if selected
$selected_category = isset($_GET['category']) ? $_GET['category'] : $default_category_id;
$products = $conn->query("SELECT * FROM products WHERE category_id = $selected_category");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-card img { width: 100%; height: 150px; object-fit: cover; }
        .category-tabs { margin-bottom: 20px; }
        .cart-item { border-bottom: 1px solid #ddd; padding: 5px 0; }
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8">
            <ul class="nav nav-tabs category-tabs">
                <?php
                $categories_all = $conn->query("SELECT * FROM categories");
                while ($cat = $categories_all->fetch_assoc()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($cat['id'] == $selected_category) ? 'active' : '' ?>"
                           href="?category=<?= $cat['id'] ?>"><?= $cat['name'] ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>

            <div class="row">
                <?php
                $products = $conn->query("SELECT * FROM products WHERE category_id = $selected_category");
                while ($product = $products->fetch_assoc()): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card product-card">
                            <img src="uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                            <div class="card-body text-center">
                                <h6><?= $product['name'] ?></h6>
                                <p>₱<?= $product['price'] ?></p>
                                <button class="btn btn-success btn-sm" onclick="addToCart(<?= $product['id'] ?>, '<?= $product['name'] ?>', <?= $product['price'] ?>)">Add</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="col-md-4">
            <h4>Order Details</h4>
            <input type="text" id="customerName" class="form-control mb-3" placeholder="Customer's Name">

            <div id="cart"></div>
            <p class="mt-3">Sub Total: ₱<span id="subTotal">0.00</span></p>
            <p>Tax (3%): ₱<span id="tax">0.00</span></p>
            <h5>Total: ₱<span id="totalAmount">0.00</span></h5>

            <button onclick="finishOrder()" class="btn btn-primary w-100 mt-3">Finish Order</button>
            <button onclick="clearCart()" class="btn btn-danger w-100 mt-2">Cancel</button>
        </div>
    </div>
</div>

<script>
let cart = [];

function addToCart(id, name, price) {
    let item = cart.find(item => item.id === id);
    if (item) {
        item.qty += 1;
    } else {
        cart.push({id, name, price, qty: 1});
    }
    renderCart();
}

function renderCart() {
    let cartDiv = document.getElementById('cart');
    cartDiv.innerHTML = '';
    let subTotal = 0;

    cart.forEach((item, index) => {
        let lineTotal = item.price * item.qty;
        subTotal += lineTotal;
        cartDiv.innerHTML += `
            <div class="cart-item d-flex justify-content-between align-items-center">
                <span>${item.name} x ${item.qty}</span>
                <div>
                    ₱${lineTotal.toFixed(2)}
                    <button class="btn btn-sm btn-danger" onclick="removeItem(${index})">x</button>
                </div>
            </div>`;
    });

    let tax = subTotal * 0.03;
    let total = subTotal + tax;

    document.getElementById('subTotal').innerText = subTotal.toFixed(2);
    document.getElementById('tax').innerText = tax.toFixed(2);
    document.getElementById('totalAmount').innerText = total.toFixed(2);
}

function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}

function clearCart() {
    cart = [];
    renderCart();
    document.getElementById('customerName').value = '';
}

function finishOrder() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    let customerName = document.getElementById('customerName').value;
    if (customerName.trim() === '') {
        alert("Please enter the customer's name.");
        return;
    }

    fetch('create_order.php', {
        method: 'POST',
        body: JSON.stringify({ customerName, cart }),
        headers: {'Content-Type': 'application/json'}
    })
    .then(response => response.text())
    .then(result => {
        alert(result);
        clearCart();
    });
}
</script>
</body>
</html>