
<?php
include("config.php");
include("logged_in_check.php");

$sql = "SELECT p.product_id, p.product_name, p.product_description, p.product_image, p.product_quantity, p.product_price, p.product_size,c.category_name
        FROM product p
        JOIN categories c ON p.product_category = c.category_id";
        

   
$result = berkhoca_query_parser($sql);
// Fetch product list from the database


?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1>Product List</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $product) { ?>
                                <tr>
                                    <td><?php echo $product['product_id']; ?></td>
                                    <td><?php echo $product['product_name']; ?></td>
                                    <td><?php echo $product['product_description']; ?></td>
                                    <td><img src="<?php echo $product['product_image']; ?>" alt="Product Image" width="100"></td>
                                    <td><?php echo $product['category_name']; ?></td>
                                    <td><?php echo $product['product_quantity']; ?></td>
                                    <td><?php echo $product['product_price']; ?></td>
                                    <td><?php echo $product['product_size']; ?></td>
                                    <td>
                                        <a href="product_edit.php?id=<?php echo $product['product_id']; ?>" class="btn btn-info">Edit</a>
                                        <a href="product_delete.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
