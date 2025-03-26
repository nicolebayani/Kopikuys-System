<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
    $conn->query("INSERT INTO products (category_id, name, price, image) VALUES ('$category_id', '$name', '$price', '$image')");
    header("Location: add_product.php");
}

$categories = $conn->query("SELECT * FROM categories");
?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <select name="category" required>
        <?php while($row = $categories->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="file" name="image" required>
    <button type="submit">Add Product</button>
</form>