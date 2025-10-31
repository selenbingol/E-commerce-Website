<?php
include("config.php");
include("logged_in_check.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Validate input
    if (empty($card_name) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
        $error = "All fields are required.";
    } else {
        // Save payment details in session (for demonstration purposes, usually not saved in session)
        $_SESSION['payment_details'] = [
            'card_name' => $card_name,
            'card_number' => $card_number,
            'expiry_date' => $expiry_date,
            'cvv' => $cvv
        ];

        // Redirect to order success page
        header("Location: order_success.php");
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
            <h1>Payment Details</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="card_name">Name on Card</label>
                            <input type="text" class="form-control" id="card_name" name="card_name" required>
                        </div>
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" required>
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Buy</button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->

    </div> <!-- #content -->

</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>
