<?php
include 'db.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Delete product from database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=products");
    exit();
}
?>