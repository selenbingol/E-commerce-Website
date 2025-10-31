<?php
include("config.php");
include("logged_in_check.php");

// Check if product ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    header("Location: product_list.php");
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "berkhoca_db";

$conn = new mysqli($servername, $username, $password, $dbname);
$category_sql = "SELECT category_id, category_name FROM categories";
$category_result = $conn->query($category_sql);
// Fetch product details from the database
$sql = "SELECT * FROM product WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: product_list.php");
    exit;
} else {
    $product = $result->fetch_assoc();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];
    $product_image = $_FILES['product_image']['name'];

    if (!empty($product_image)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['product_image']['name']);
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $product_image = $target_file;
        } else {
            $product_image = $product['product_image']; // Keep the old image if the upload fails
        }
    } else {
        $product_image = $product['product_image'];
    }

    $update_sql = "UPDATE product SET product_name = '$product_name', product_description = '$product_description', product_price = $product_price, product_quantity = $product_quantity, product_category = '$product_category', product_image = '$product_image' WHERE product_id = $product_id";
    $result = $conn->query($update_sql);

    if ($result) {
        header("Location: product_list.php");
        exit;
    } else {
        $error_message = "Failed to update product.";
    }
}

?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">
        <div id="content-header">
            <h1>Edit Product</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="product_description">Product Description:</label>
                            <textarea class="form-control" id="product_description" name="product_description" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Product Price:</label>
                            <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Product Quantity:</label>
                            <input type="number" step="1" class="form-control" id="product_quantity" name="product_quantity" value="<?php echo htmlspecialchars($product['product_quantity']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="product_image">Product Image:</label>
                            <input type="file" class="form-control-file" id="product_image" name="product_image">

                            <input type="hidden" name="existing_product_image" value="<?php echo ($product['product_image']); ?>">
                            <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="Current Image" style="max-width: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="product_category">Product Category:</label>
                            <select class="form-control" id="product_category" name="product_category" required>
                                <?php
                                if ($category_result && $category_result->num_rows > 0) {
                                    while ($row = $category_result->fetch_assoc()) {
                                        $selected = $row['category_id'] == $product['product_category'] ? "selected" : "";
                                        echo "<option value='" . htmlspecialchars($row['category_id']) . "' $selected>" . htmlspecialchars($row['category_name']) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No categories available</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <?php if (isset($error_message)) echo '<div class="alert alert-danger mt-3" role="alert">' . $error_message . '</div>'; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
