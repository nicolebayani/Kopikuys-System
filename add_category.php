<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $conn->query("INSERT INTO categories (name) VALUES ('$name')");
    header("Location: add_category.php");
}
?>
<form method="POST">
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Add Category</button>
</form>