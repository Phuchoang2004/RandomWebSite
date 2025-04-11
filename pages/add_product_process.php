<?php
include 'db.php';

if (isset($_POST['name'], $_FILES['image'], $_POST['price'], $_POST['category'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    // Read the image file
    $image = file_get_contents($_FILES['image']['tmp_name']);
    
    // Insert product into database with image as BLOB
    $stmt = $conn->prepare("INSERT INTO products (name, image, price, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sbds", $name, $image, $price, $category);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=products");
    exit();
}
?>