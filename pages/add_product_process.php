<?php
include 'db.php';

if (isset($_POST['name'], $_FILES['image'], $_POST['price'], $_POST['category'])) {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    // Insert product into database
    $stmt = $conn->prepare("INSERT INTO products (name, image, price, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $target_file, $price, $category);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=products");
    exit();
}
?>