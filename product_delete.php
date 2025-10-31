<?php
include("config.php");
include("logged_in_check.php");

// Check if product ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    // Redirect to product list if ID is not provided
    header("Location: product_list.php");
    exit;
}

// Delete product from the database using a prepared statement
$stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Success message
    echo "Product successfully deleted.";
} else {
    // Error message
    echo "An error occurred while deleting the product.";
}

$stmt->close();

// Redirect to product list page
header("Location: product_list.php");
exit;
?>
