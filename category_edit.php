<?php
include("config.php");
include("logged_in_check.php");

// Check if category ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $category_id = $_GET['id'];
} else {
    // Redirect to category list if ID is not provided
    header("Location: category_list.php");
    exit;
}

// Fetch category details from the database using prepared statement
$stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();
$stmt->close();

// Check if category exists
if(!$category) {
    // Redirect to category list if category does not exist
    header("Location: category_list.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $new_category_name = $_POST['category_name'];
    $new_category_description = $_POST['category_desc'];
    
    // Update category in the database using prepared statement
    $stmt = $conn->prepare("UPDATE categories SET category_name = ?, category_desc = ? WHERE category_id = ?");
    $stmt->bind_param("ssi", $new_category_name, $new_category_description, $category_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to category list
    header("Location: category_list.php");
    exit;
}

?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">
    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1>Edit Category</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="category_name">Category Name:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category['category_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Category Description:</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="3" required><?php echo $category['category_desc']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
