<?php
include("config.php");
include("logged_in_check.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_favourite'])) {
    $product_id = intval($_POST['product_id']);

    // Delete the favorite item based on user_id and product_id
    $sql = "DELETE FROM favourites WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: favourites.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
