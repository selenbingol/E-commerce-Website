<?php
session_start();
include("config.php");

// Fetch all orders
$sql = "SELECT o.order_id, o.cargo_info, o.billing_info, p.product_name, p.product_image, od.quantity 
        FROM orders o
        JOIN order_details od ON o.order_id = od.order_id
        JOIN products p ON od.product_id = p.product_id
        ORDER BY o.order_id";
$result = berkhoca_query_parser($sql);

// Prepare an array to organize the orders
$orders = [];
while ($row = $result->fetch_assoc()) {
    $order_id = $row['order_id'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'cargo_info' => $row['cargo_info'],
            'billing_info' => $row['billing_info'],
            'products' => []
        ];
    }
    $orders[$order_id]['products'][] = [
        'name' => $row['product_name'],
        'image' => $row['product_image'],
        'quantity' => $row['quantity']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Orders</h1>
    <div class="orders-container">
        <?php foreach ($orders as $order_id => $order): ?>
            <div class="order">
                <h2>Order Number: <?php echo $order_id; ?></h2>
                <p><strong>Cargo Information:</strong> <?php echo $order['cargo_info']; ?></p>
                <p><strong>Billing Information:</strong> <?php echo $order['billing_info']; ?></p>
                <div class="products">
                    <?php foreach ($order['products'] as $product): ?>
                        <div class="product">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <p><?php echo $product['name']; ?></p>
                            <p>Quantity: <?php echo $product['quantity']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
