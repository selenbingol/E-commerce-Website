<?php
include("config.php");

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if not already started


// Variable to store error message
$error = '';
$success = '';

// When the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user details using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $username, $password, $email); // No password hashing here
        if ($stmt->execute()) {
            $success = "Sign up successful! You can now <a href='login.php'>log in</a>.";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Database query failed: " . $conn->error;
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
            <h1>Sign Up</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($success)) { ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                    <?php } ?>

                    <form method="POST" action="sign_in.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
