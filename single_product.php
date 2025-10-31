<?php
include("config.php");
include("logged_in_check.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get product ID
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Fetch product details from the database
$sql = "SELECT * FROM product WHERE product_id = $product_id";
$product_result = berkhoca_query_parser($sql);
$product = $product_result ? $product_result[0] : null;

// Add product to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $cart_item = [
        'id' => $product['product_id'],
        'name' => $product['product_name'],
        'price' => $product['product_price'],
        'quantity' => 1,
        'image' => $product['product_image']
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product['product_id']) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $cart_item;
    }

    // Insert or update cart items in the database
    $user_id = $_SESSION['user_id'];
    $product_id = $cart_item['id'];
    $quantity = $cart_item['quantity'];
    $image = $cart_item['image'];
    $product_name = $cart_item['name'];
    $product_price = $cart_item['price'];

    // Check if item already exists in the database
    $query = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update quantity if item already exists
        $query = "UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
    } else {
        // Insert new item
        $query = "INSERT INTO cart_items (user_id, product_id, quantity, image, product_name, product_price)
                  VALUES ($user_id, $product_id, $quantity, '$image', '$product_name', $product_price)";
    }

    mysqli_query($conn, $query);

    header("Location: cart.php");
    exit();
}

// Add product to favorites
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_favorites'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $product['product_id'];

    // Check if item already exists in favorites
    $query = "SELECT * FROM favourites WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Insert new favorite item
        $query = "INSERT INTO favourites (user_id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($conn, $query);
    }

    header("Location: favourites.php");
    exit();
}
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1><?php echo $product ? $product['product_name'] : 'Product Not Found'; ?></h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <?php if ($product) { ?>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="product-detail">
                            <img src="http://localhost/berkhoca_project/admin_panel/<?php echo $product['product_image']; ?>" alt="Product Image" class="product-detail-img">
                            <div class="product-detail-info">
                                <h2><?php echo $product['product_name']; ?></h2>
                                <p><?php echo $product['product_description']; ?></p>
                                <p>Price: <?php echo $product['product_price']; ?> TL</p>
                                <p>Quantity: <?php echo $product['product_quantity']; ?></p>
                                <form method="POST" action="">
                                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                </form>
                                <form method="POST" action="add_to_favourites.php">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" name="add_to_favourites" class="btn btn-secondary">Add to Favourites</button>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            <?php } else { ?>
                <p>Product not found.</p>
            <?php } ?>
        </div> <!-- /#content-container -->

    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

<style>
    .product-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .product-detail-img {
        max-width: 300px;
        height: auto;
        margin: 20px;
    }
    .product-detail-info {
        max-width: 600px;
        margin: 20px;
        text-align: left;
    }
    .product-detail-info h2 {
        margin-top: 0;
    }
</style>

</body>
</html>
