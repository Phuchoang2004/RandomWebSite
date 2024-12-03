<?php

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}

include 'db.php';
require 'vendor/autoload.php';
use ColorThief\ColorThief;

function fetch_products($conn) {
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    return $products;
}

function getMainColors($imagePath) {
    $palette = ColorThief::getPalette($imagePath, 5);
    return [$palette[0], $palette[1]]; // Get the main color and the second main color
}

function rgbToHsl($r, $g, $b) {
    $r /= 255;
    $g /= 255;
    $b /= 255;
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $h = 0;
    $s = 0;
    $l = ($max + $min) / 2;

    if ($max == $min) {
        $h = $s = 0; // achromatic
    } else {
        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
        switch ($max) {
            case $r:
                $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                break;
            case $g:
                $h = ($b - $r) / $d + 2;
                break;
            case $b:
                $h = ($r - $g) / $d + 4;
                break;
        }
        $h /= 6;
    }

    return [$h * 360, $s * 100, $l * 100];
}
$search = isset($_GET['search']) ? $_GET['search'] : '';
$products = fetch_products($conn);
?>

<style>
* {
    box-sizing: border-box;
}

/* body {
    font-family: "Open Sans", sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    gap: 2rem;
    justify-content: center;
    align-items: center;
    background: hsl(187 40% 98%);
} */

img {
    display: block;
    width: 100%;
    height: auto; 
}

h2 {
    margin: 0;
    font-size: 1.4rem;
}

@media (min-width: 50em) {
    h2 {
        font-size: 1.8rem;
    }
}

.cta {
    --shadowColor: 187 60% 40%;
    display: flex;
    flex-direction: column;
    background: hsl(187 70% 85%);
    width: 100%;
    box-shadow: 0.65rem 0.65rem 0 hsl(var(--shadowColor) / 1);
    border-radius: 0.8rem;
    overflow: hidden;
    border: 0.5rem solid;
    transition: transform 0.3s ease;
}

.cta:hover {
    transform: translateY(-5px);
}

.cta img {
    object-fit: cover;
    width: 100%;
    height: auto; 
}

.cta__text-column {
    padding: min(1rem, 3vw) min(1rem, 3vw) min(1.5rem, 3vw);
    flex: 1 0 auto;
}

.cta__text-column > * + * {
    margin: min(1rem, 2vw) 0 0 0;
}

.cta a {
    display: inline-block;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 0.6rem;
    font-weight: 700;
    border: 0.35rem solid;
}

.product-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px; 
    min-height: 200px; 
    transition: all 0.3s ease;
}

.product-grid .cta {
    flex: 1 1 calc(30% - 30px);
    box-sizing: border-box;
    max-width: calc(30% - 30px);
}

@media (max-width: 768px) {
    .product-grid .cta {
        flex: 1 1 calc(45% - 30px); 
        max-width: calc(45% - 30px);
    }
}

@media (max-width: 480px) {
    .product-grid .cta {
        flex: 1 1 100%; 
        max-width: 100%;
    }
}

.search-form {
    max-width: 600px;
    margin: 0 auto;
}
.search-form .form-group {
    display: flex;
    gap: 10px;
}
.search-form input[type="text"] {
    flex: 1;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.alert {
    text-align: center;
    padding: 15px;
    margin: 20px auto;
    max-width: 600px;
    border-radius: 4px;
}
.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}
</style>

<?php
if ($_SESSION['userlevel'] == 1) {
    echo '<div style="visibility:hidden; height: 40px;"></div>';
    echo '<div class="form-container">';
    echo '<h1>Add Product</h1>';
    echo '<form action="index.php?page=add_product_process" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <div class="form-group">
            <label for="price">Product Price:</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="Electronics">Electronics</option>
                <option value="Clothing">Clothing</option>
                <option value="Home">Home & Garden</option>
            </select>
        </div>
        <input type="submit" value="Add Product" class="btn btn-primary">
    </form>';
    echo '</div>';

    echo '<div style="visibility:hidden; height: 40px;"></div>';
    echo '<div class="form-container">';
    echo '<h1>Delete Product</h1>';
    echo '<form action="index.php?page=delete_product_process" method="post">
        <div class="form-group">
            <label for="product_id">Product ID:</label>
            <input type="number" name="product_id" id="product_id" required>
        </div>
        <input type="submit" value="Delete Product" class="btn btn-danger">
    </form>';
    echo '</div>';
} else {
    
    // Search form
    echo '<div style="visibility:hidden; height: 40px;"></div>';
    echo '<div class="form-container">';
    echo '<h1>Search Products</h1>';
    echo '<form id="searchForm" class="search-form">
        <div class="form-group">
            <input type="text" name="search" id="searchInput" placeholder="Search by name or category..." 
                   value="' . htmlspecialchars($search) . '" class="form-control">
            <input type="submit" value="Search" class="btn btn-primary">
        </div>
    </form>';
    echo '</div>';
    echo '<div style="visibility:hidden; height: 40px;"></div>';
    echo '<div id="productResults" class="product-grid"></div>';
    
    echo '<div style="visibility:hidden; height: 40px;"></div>';
    
    if ($search) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ?");
        $searchParam = "%{$search}%";
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

}
?>

<script>
document.getElementById("searchForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const searchTerm = document.getElementById("searchInput").value;
    searchProducts(searchTerm);
});

document.getElementById("searchInput").addEventListener("input", function(e) {
    const searchTerm = e.target.value;
    searchProducts(searchTerm);
});

function searchProducts(searchTerm) {
    fetch(`index.php?page=search_products&search=${encodeURIComponent(searchTerm)}`, {
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById("productResults").innerHTML = html;
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById("productResults").innerHTML = 
            "<div class='alert alert-danger'>Error loading products.</div>";
    });
}

searchProducts("");
</script>
