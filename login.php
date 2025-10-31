<?php
include("config.php");

// When the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = berkhoca_query_parser($sql);

    // Debugging: print the query result
   

    // Check if the result is not empty and access the first element
    if (!empty($result) && isset($result[0])) {
        $user = $result[0];

        // Verify the password
        if ($password === $user['password']) {
            // User is authenticated, store session data
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_logged_in'] = true;

           
            // Redirect to category_detail.php
            header("Location: category_detail.php");
            exit;
        } else {
            // Invalid password
            $error = 'Invalid username or password';
        }
    } else {
        // Invalid username or password
        $error = 'Invalid username or password';
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
            <h1>Login</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>

                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
