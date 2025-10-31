<?php
include("config.php");
include("logged_in_check.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    // Check if item already exists in favorites
    $query = "SELECT * FROM favourites WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Insert new favorite item
        $query = "INSERT INTO favourites (user_id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($conn, $query);
    }

    // Redirect to favorites page after adding
    header("Location: favourites.php");
    exit();
} else {
    header("Location: single_product.php?product_id=" . intval($_POST['product_id']));
    exit();
}
?>
