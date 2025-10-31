<?php
include("config.php");
include("logged_in_check.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve shipping details from session
$shipping_details = $_SESSION['shipping_details'];

// Get the current date and time for the order date
$order_date = date('Y-m-d H:i:s');

// Fetch the cart items for the logged-in user
$cart_items_sql = "SELECT * FROM cart_items WHERE user_id = '$user_id'";
$cart_items_result = mysqli_query($conn, $cart_items_sql);

if (!$cart_items_result) {
    die("Error fetching cart items: " . mysqli_error($conn));
}

// Calculate the total price
$total_price = 0;
$cart_items = [];
while ($item = mysqli_fetch_assoc($cart_items_result)) {
    $total_price += $item['product_price'] * $item['quantity'];
    $cart_items[] = $item;
}

// Insert each cart item into the orders table with order details
foreach ($cart_items as $item) {
    $insert_order_sql = "
        INSERT INTO orders (user_id, address, phone_number, first_name, last_name, order_date, total_price, product_image, product_name, product_id, product_price, product_quantity)
        VALUES ('$user_id', '{$shipping_details['address']}', '{$shipping_details['telephone']}', '{$shipping_details['name']}', '{$shipping_details['surname']}', '$order_date', '$total_price', '{$item['image']}', '{$item['product_name']}', '{$item['product_id']}', '{$item['product_price']}', '{$item['quantity']}')
    ";
    mysqli_query($conn, $insert_order_sql);

    // Update the product stock quantity in the product_table
    $update_quantity_sql = "
        UPDATE product
        SET product_quantity = product_quantity - {$item['quantity']}
        WHERE product_id = {$item['product_id']}
    ";
    mysqli_query($conn, $update_quantity_sql);
}

// Clear the cart for the user
$clear_cart_sql = "DELETE FROM cart_items WHERE user_id = '$user_id'";
mysqli_query($conn, $clear_cart_sql);

// Retrieve the latest order details
$new_order_sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC LIMIT " . count($cart_items);
$new_order_result = mysqli_query($conn, $new_order_sql);

if (!$new_order_result) {
    die("Error fetching order details: " . mysqli_error($conn));
}

$order_items = [];
while ($row = mysqli_fetch_assoc($new_order_result)) {
    $order_items[] = $row;
}
?>

<?php include('header.php'); ?>

<style>
    .order-success {
        text-align: center;
        margin-top: 50px;
    }
    .order-success h1 {
        color:  #008000;
    }
    .order-summary {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 20px;
    }
    .order-summary h2 {
        color: hotpink;
        margin-bottom: 20px;
    }
    .order-summary img {
        max-width: 100px;
        margin-right: 20px;
    }
    .order-summary .product-details {
        display: flex;
        align-items: center;
    }
    .order-summary .product-details p {
        margin: 0;
        font-size: 16px;
    }
    .order-summary .total-price {
        font-weight: bold;
        margin-top: 20px;
        font-size: 18px;
    }
</style>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1>Order Created Successfully</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="order-success">
                        <h1>Your order is completed successfully!</h1>
                        <div class="order-summary">
                            <h2>Order Summary</h2>
                            <p><strong>Name:</strong> <?php echo $shipping_details['name'] . ' ' . $shipping_details['surname']; ?></p>
                            <p><strong>Address:</strong> <?php echo $shipping_details['address']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $shipping_details['telephone']; ?></p>
                            <?php if (!empty($order_items)) { ?>
                                <?php foreach ($order_items as $item) { ?>
                                    <div class="product-details">
                                        <img src="http://localhost/berkhoca_project/admin_panel/<?php echo $item['product_image']; ?>" alt="Product Image">
                                        <p><?php echo $item['product_name']; ?> - $<?php echo number_format($item['product_price'], 2); ?> x <?php echo $item['product_quantity']; ?></p>
                                    </div>
                                <?php } ?>
                                <div class="total-price">
                                    Total Price: <?php echo number_format($total_price, 2); ?>TL</p>
                                </div>
                            <?php } else { ?>
                                <p>No order details available.</p>
                            <?php } ?>
                        </div>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>

<?php
mysqli_close($conn);
?>
