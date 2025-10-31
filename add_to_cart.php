<?php

include 'config.php'; // Assumes you have a separate file for database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assumes user is logged in and user_id is stored in session
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Check if item is already in cart
    $query = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update quantity if item already exists in cart
        $query = "UPDATE cart_items SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
    } else {
        // Insert new item into cart
        $query = "INSERT INTO cart_items (user_id, product_id, quantity, image, product_name, product_price) 
                  VALUES ($user_id, $product_id, $quantity, '$image', '$product_name', $product_price)";
    }

    if (mysqli_query($conn, $query)) {
        echo "Item added to cart successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
