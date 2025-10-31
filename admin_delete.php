<?php
include("config.php");
include("logged_in_check.php");

// Check if admin ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $admin_id = $_GET['id'];
} else {
    // Redirect to admin list if ID is not provided
    header("Location: admin_list.php");
    exit;
}

// Delete admin from the database
$sql = "DELETE FROM admin_table WHERE admin_id = '$admin_id'";
$result = berkhoca_query_parser($sql);

if ($result) {
    // Success message
    echo "Admin başarıyla silindi.";
} else {
    // Error message
    echo "Admin silinirken bir hata oluştu.";
}

// Redirect to admin list page
header("Location: admin_list.php");
exit;
?>
