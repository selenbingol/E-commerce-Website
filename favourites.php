<?php
include("config.php");
include("logged_in_check.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch favorite items for the logged-in user
$favourites_sql = "SELECT f.*, p.product_name, p.product_image, p.product_price 
                  FROM favourites f 
                  JOIN product p ON f.product_id = p.product_id 
                  WHERE f.user_id = $user_id";
$favourites_result = mysqli_query($conn, $favourites_sql);

$favourites = [];
if ($favourites_result) {
    while ($row = mysqli_fetch_assoc($favourites_result)) {
        $favourites[] = $row;
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
            <h1>My Favourites</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <?php if (!empty($favourites)) { ?>
                <div class="row">
                    <?php foreach ($favourites as $item) { ?>
                        <div class="col-md-4 col-xs-12">
                            <div class="product-item">
                                <img src="http://localhost/berkhoca_project/admin_panel/<?php echo $item['product_image']; ?>" alt="Product Image" class="product-item-img">
                                <div class="product-item-info">
                                    <h2><?php echo $item['product_name']; ?></h2>
                                    <p>Price: <?php echo $item['product_price']; ?> TL</p>
                                    <form method="POST" action="remove_favourites.php">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                        <button type="submit" name="remove_favourite" class="btn btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- /.col -->
                    <?php } ?>
                </div> <!-- /.row -->
            <?php } else { ?>
                <p>You have no favorite products.</p>
            <?php } ?>
        </div> <!-- /#content-container -->

    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

<style>
    .product-item {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .product-item-img {
        max-width: 300px;
        height: auto;
        margin: 20px;
    }
    .product-item-info {
        max-width: 600px;
        margin: 20px;
        text-align: left;
    }
    .product-item-info h2 {
        margin-top: 0;
    }
</style>

</body>
</html>
