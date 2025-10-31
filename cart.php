<?php
include("config.php");
include("logged_in_check.php");

// Start the session if not already started


$user_id = $_SESSION['user_id']; // Assumes user is logged in and user_id is stored in session

// Handle actions
$redirect = false;

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'clear') {
        $query = "DELETE FROM cart_items WHERE user_id = $user_id";
        mysqli_query($conn, $query);
        $redirect = true;
    } elseif (isset($_GET['id'])) {
        $product_id = intval($_GET['id']);

        if ($action == 'remove') {
            $query = "DELETE FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
            mysqli_query($conn, $query);
            $redirect = true;
        } elseif ($action == 'increase') {
            $query = "UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
            mysqli_query($conn, $query);
            $redirect = true;
        } elseif ($action == 'decrease') {
            $query = "SELECT quantity FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            if ($row['quantity'] > 1) {
                $query = "UPDATE cart_items SET quantity = quantity - 1 WHERE user_id = $user_id AND product_id = $product_id";
                mysqli_query($conn, $query);
            } else {
                $query = "DELETE FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
                mysqli_query($conn, $query);
            }

            $redirect = true;
        }
    }
}

if ($redirect) {
    // Redirect to the same page without the parameters
    header("Location: cart.php");
    exit();
}

$query = "SELECT * FROM cart_items WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$cart = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">
        <div id="content-header">
            <h1>Shopping Cart</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php if ($cart) { ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $item) { ?>
                                    <tr>
                                        <td><img src="http://localhost/berkhoca_project/admin_panel/<?php echo $item['image']; ?>" alt="Product Image" style="width: 50px; height: auto;"></td>
                                        <td><?php echo $item['product_name']; ?></td>
                                        <td><?php echo $item['product_price']; ?> TL</td>
                                        <td>
                                            <a href="cart.php?action=decrease&id=<?php echo $item['product_id']; ?>" class="btn btn-sm btn-primary">-</a>
                                            <?php echo $item['quantity']; ?>
                                            <a href="cart.php?action=increase&id=<?php echo $item['product_id']; ?>" class="btn btn-sm btn-primary">+</a>
                                        </td>
                                        <td><?php echo $item['product_price'] * $item['quantity']; ?> TL</td>
                                        <td>
                                            <a href="cart.php?action=remove&id=<?php echo $item['product_id']; ?>" class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="cart.php?action=clear" class="btn btn-warning">Clear Cart</a>
                        <a href="shipping.php" class="btn btn-success">Proceed to Shipping</a>
                    <?php } else { ?>
                        <p>Your cart is empty.</p>
                    <?php } ?>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->

    </div> <!-- #content -->

</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
