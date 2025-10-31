<?php
include("config.php");
include("logged_in_check.php");

// Fetch category list from the database
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
            <h1>Category List</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category) { ?>
                                <tr>
                                    <td><?php echo $category['category_name']; ?></td>
                                    <td><?php echo $category['category_desc']; ?></td>
                                    <td>
                                        <a href="category_edit.php?id=<?php echo $category['category_id']; ?>" class="btn btn-info">Edit</a>
                                    </td>
                                    <td>
                                        <a href="category_delete.php?id=<?php echo $category['category_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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