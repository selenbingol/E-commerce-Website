<?php
include("config.php");
include("logged_in_check.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_size = $_POST['product_size'];
    $product_image = $_FILES['product_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($product_image);

    $just_file_name = preg_replace('/\s+/', '', $_FILES['product_image']['name']);

    // Check if the uploads directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
        // Insert new product into the database
        $sql = "INSERT INTO product (product_name, product_description, product_category, product_price, product_quantity, product_size, product_image) 
                VALUES ('$product_name', '$product_description', '$product_category', '$product_price', '$product_quantity', '$product_size', '$target_file')";
        $result = berkhoca_query_parser($sql);

        if ($result) {
            // Redirect to dashboard
            header("Location: product_list.php");
            exit;
        } else {
            // Handle error
            $error_message = "Failed to add new product.";
        }
    } else {
        // Handle file upload error
        $error_message = "Failed to upload product image.";
    }
}

// Retrieve categories from database
$sql = "SELECT * FROM categories";
$categories = berkhoca_query_parser($sql);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1>Add Product</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>
                    <form method="post" action="add_product.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="product_description">Product Description:</label>
                            <textarea class="form-control" id="product_description" name="product_description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_category">Product Category:</label>
                            <select class="form-control" id="product_category" name="product_category" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Product Price:</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" required>
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Product Quantity:</label>
                            <input type="number" class="form-control" id="product_quantity" name="product_quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="product_size">Product Size:</label>
                            <input type="text" class="form-control" id="product_size" name="product_size" required>
                        </div>
                        <div class="form-group">
                            <label for="product_image">Product Image:</label>
                            <input type="file" class="form-control" id="product_image" name="product_image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
