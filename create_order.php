<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$customerName = $data['customerName'];
$cart = $data['cart'];

$total_price = 0;
foreach ($cart as $item) {
    $total_price += $item['price'] * $item['qty'];
}
$total_price += $total_price * 0.03;

$conn->query("INSERT INTO orders (customer_name, total_price) VALUES ('$customerName', '$total_price')");
$order_id = $conn->insert_id;

foreach ($cart as $item) {
    $product_id = $item['id'];
    $quantity = $item['qty'];
    $price = $item['price'];
    $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)");
}

echo "Order placed successfully!";