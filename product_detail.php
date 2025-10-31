<?php
include("config.php");
include("logged_in_check.php");

// Kategori ID'sini al
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Kategoriye ait ürünleri veritabanından çekme
$sql = "SELECT p.product_id, p.product_name, p.product_description, p.product_image, p.product_quantity, p.product_price, c.category_name
        FROM product p
        JOIN categories c ON p.product_category = c.category_id
        WHERE p.product_category = $category_id"; // Belirli bir kategoriye ait ürünleri filtrele
$result = berkhoca_query_parser($sql);

// Kategori adını almak için sorgu
$sql_category = "SELECT category_name FROM categories WHERE category_id = $category_id";
$category_result = berkhoca_query_parser($sql_category);
$category_name = $category_result ? $category_result[0]['category_name'] : "Unknown Category";

?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1>Products in <?php echo $category_name; ?></h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="products-container">
                        <?php if ($result) { ?>
                            <?php foreach ($result as $product) { 
                                $img_src= $product['product_image'];
                                $full_img_path= "http://localhost/berkhoca_project/admin_panel/" . $img_src;
                                ?>
                                <a href="single_product.php?product_id=<?php echo $product['product_id']; ?>" class="product-link">
                                <div class="product-card">
                                    <img class="product-img-top" src="<?php echo $full_img_path; ?>" alt="Product Image">
                                    <div class="product-card-body">
                                        <h3><?php echo $product['product_name']; ?></h3>
                                        
                                        <p>Price: <?php echo $product['product_price']; ?> TL</p>
                                        
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p>No products found in this category.</p>
                        <?php } ?>
                    </div> <!-- /#products-container -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->

    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

<style>
    .products-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }
    .product-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 16px;
        margin: 10px;
        width: 200px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: #ffffff; /* Kartların arka plan rengini beyaz yapın */
    }
    .product-img-top {
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
    }
    .product-card h3 {
        margin: 0 0 10px 0;
        font-size: 1.5em;
        color: #333; /* Başlık rengini uygun şekilde değiştirin */
    }
    .product-card p {
        margin: 10px 0;
        color: #777; /* Açıklama metni rengini uygun şekilde değiştirin */
    }
</style>

</body>
</html>
