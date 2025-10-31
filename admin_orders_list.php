<?php
include("config.php");
include("logged_in_check.php");


// Fetch all orders from the database
$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">
        <div id="content-header">
            <h1>Orders List</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php if ($orders) { ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Order Date</th>
                                    <th>Total Price</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order) { ?>
                                    <tr>
                                        <td><?php echo $order['order_id']; ?></td>
                                        <td><?php echo $order['user_id']; ?></td>
                                        <td><?php echo $order['first_name']; ?></td>
                                        <td><?php echo $order['last_name']; ?></td>
                                        <td><?php echo $order['address']; ?></td>
                                        <td><?php echo $order['phone_number']; ?></td>
                                        <td><?php echo $order['order_date']; ?></td>
                                        <td><?php echo $order['total_price']; ?> USD</td>
                                        <td><img src="http://localhost/berkhoca_project/admin_panel/<?php echo $order['product_image']; ?>" alt="Product Image" style="width: 50px; height: auto;"></td>
                                        <td><?php echo $order['product_name']; ?></td>
                                        <td><?php echo $order['product_price']; ?> TL</td>
                                        <td><?php echo $order['product_quantity']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>No orders found.</p>
                    <?php } ?>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->

    </div> <!-- #content -->

</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
