<?php
include("config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Insert new category into the database
    $sql = "INSERT INTO categories (category_name, category_desc) VALUES ('$category_name', '$category_description')";
    $result = berkhoca_query_parser($sql);
    

    if ($result) {
        // Redirect to category list page
        header("Location: category_list.php");
        exit;
    } else {
        // Handle error
        $error_message = "Failed to add new category.";
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
            <h1>Add New Category</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="category_name">Category Name:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_description">Category Description:</label>
                            <textarea class="form-control" id="category_description" name="category_description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>