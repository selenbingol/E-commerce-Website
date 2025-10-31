<?php
include("config.php");
include("logged_in_check.php");

// Check if admin ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $admin_id = $_GET['id'];
} else {
    // Redirect to admin list if ID is not provided
    header("Location: admin_list.php");
    exit;
}

// Fetch admin details from the database using prepared statement
$stmt = $conn->prepare("SELECT * FROM admin_table WHERE admin_id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

// Check if admin exists
if(!$admin) {
    // Redirect to admin list if admin does not exist
    header("Location: admin_list.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $new_admin_name = $_POST['admin_name'];
    $new_admin_surname = $_POST['admin_surname'];
    $new_admin_username = $_POST['admin_username'];
    
    // Update admin in the database using prepared statement
    $stmt = $conn->prepare("UPDATE admin_table SET admin_name = ?, admin_surname = ?, admin_username = ? WHERE admin_id = ?");
    $stmt->bind_param("sssi", $new_admin_name, $new_admin_surname, $new_admin_username, $admin_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to admin list
    header("Location: admin_list.php");
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
            <h1>Edit Admin</h1>
        </div>

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="admin_name">Admin Name:</label>
                            <input type="text" class="form-control" id="admin_name" name="admin_name" value="<?php echo $admin['admin_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="admin_surname">Admin Surname:</label>
                            <input type="text" class="form-control" id="admin_surname" name="admin_surname" value="<?php echo $admin['admin_surname']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="admin_username">Admin Username:</label>
                            <input type="text" class="form-control" id="admin_username" name="admin_username" value="<?php echo $admin['admin_username']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
