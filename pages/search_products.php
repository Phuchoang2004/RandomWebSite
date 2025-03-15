<?php
include 'db.php';
require 'vendor/autoload.php';
use ColorThief\ColorThief;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ?");
$searchParam = "{$search}%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

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
// Generate HTML for products
echo '<div style="visibility:hidden; height: 40px;"></div>';
$html = '';
if (!empty($products)) {
    echo '<div style="visibility:hidden; height: 40px;"></div>';
    foreach ($products as $product) {
        list($mainColor, $secondMainColor) = getMainColors($product['image']);
        list($h, $s, $l) = rgbToHsl($secondMainColor[0], $secondMainColor[1], $secondMainColor[2]);
        list($mainR, $mainG, $mainB) = $mainColor;
        
        $html .= '<div class="cta" style="background: hsl(' . $h . ', ' . $s . '%, ' . $l . '%);">';
        $html .= '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">';
        $html .= '<div class="cta__text-column">';
        $html .= '<h2 style="color: rgb(' . $mainR . ', ' . $mainG . ', ' . $mainB . ');">' . htmlspecialchars($product['name']) . '</h2>';
        $html .= '<p style="color: rgb(' . $mainR . ', ' . $mainG . ', ' . $mainB . ');">Price: $' . htmlspecialchars($product['price']) . '</p>';
        $html .= '<p style="color: rgb(' . $mainR . ', ' . $mainG . ', ' . $mainB . ');">Category: ' . htmlspecialchars($product['category']) . '</p>';
        $html .= '<a href="index.php?page=checkout&id=' . $product['id'] . '" style="background: rgb(' . $secondMainColor[0] . ', ' . $secondMainColor[1] . ', ' . $secondMainColor[2] . '); color: rgb(' . $mainR . ', ' . $mainG . ', ' . $mainB . ');">Buy Now</a>';
        $html .= '</div></div>';
    }
} else {
    $html = '<div class="alert alert-info">No products found matching your search.</div>';
}

echo $html;