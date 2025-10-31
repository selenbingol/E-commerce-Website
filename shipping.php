<?php
include("config.php");
include("logged_in_check.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assumes user is logged in and user_id is stored in session
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];

    // Validate input
    if (empty($name) || empty($surname) || empty($address) || empty($telephone)) {
        $error = "All fields are required.";
    } else {
        // Save shipping details in session
        $_SESSION['shipping_details'] = [
            'name' => $name,
            'surname' => $surname,
            'address' => $address,
            'telephone' => $telephone
        ];

        // Redirect to payment page
        header("Location: payment.php");
        exit();
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
            <h1>Shipping Details</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->

    </div> <!-- #content -->

</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
