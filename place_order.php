<?php
include('includes/header.php'); 
include('../../config/dbcon.php');

if (isset($_POST['place_order'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
    $products = $_POST['products'];

    $total = 0;
    foreach ($products as $p) {
        $total += $p['price'] * $p['quantity'];
    }

    
    $order_query = "INSERT INTO orders (customer_name, payment_mode, total) 
                    VALUES ('$customer_name', '$payment_mode', '$total')";

    if (mysqli_query($conn, $order_query)) {
        $order_id = mysqli_insert_id($conn);

        foreach ($products as $p) {
            $prod_id = intval($p['id']);
            $qty = intval($p['quantity']);
            $price = floatval($p['price']);
            $product_name = mysqli_real_escape_string($conn, $p['name']);
            $category = isset($p['category']) ? mysqli_real_escape_string($conn, $p['category']) : '';

            
            $item_query = "INSERT INTO order_items (order_id, product_name, category, quantity, price)
                        VALUES ('$order_id', '$product_name', '$category', '$qty', '$price')";
            mysqli_query($conn, $item_query);

            
            $update_query = "UPDATE products SET quantity = quantity - $qty WHERE id = $prod_id";
            mysqli_query($conn, $update_query);
        }

        echo "<script>
            alert('Order placed successfully!');
            window.location.href='index.php';
        </script>";
    } else {
        echo "<script>alert('Failed to place order.');</script>";
    }
}
?>
