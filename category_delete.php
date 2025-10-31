<?php
include("config.php");
include("logged_in_check.php");

// Check if admin ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $category_id = $_GET['id'];
} else {
    // Redirect to admin list if ID is not provided
    header("Location: category_list.php");
    exit;
}

// Delete admin from the database
$sql = "DELETE FROM categories WHERE category_id = '$category_id'";
$result = berkhoca_query_parser($sql);

if ($result) {
    // Success message
    echo "Category deleted.";
} else {
    // Error message
    echo "There was an error.";
}

// Redirect to admin list page
header("Location: category_list.php");
exit;
?>
