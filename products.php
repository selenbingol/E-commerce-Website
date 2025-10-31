<?php
include("config.php");
include("logged_in_check.php");



// Fetch all products from the database
$sql_products = "SELECT * FROM product";
$all_products = berkhoca_query_parser($sql_products);
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
                    <h2>All Products</h2>
                    <div class="products-container">
                        <?php if ($all_products) { ?>
                            <?php foreach ($all_products as $product) { 
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
                            <p>No products found.</p>
                        <?php } ?>
                    </div> <!-- /#products-container -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<style>
    .categories-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 40px; /* Kategoriler ve ürünler arasında boşluk bırakmak için */
    }
    .category-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 16px;
        margin: 10px;
        width: 200px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .category-card h3 {
        margin: 0 0 10px 0;
        font-size: 1.5em;
    }
    .category-card p {
        margin: 10px 0;
    }
    .category-card a {
        display: block;
        margin: 5px 0;
    }
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
        width: 220px; /* Genişliği biraz artırarak düzgün bir görünüm sağlayın */
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
        font-size: 1.2em; /* Başlık boyutunu biraz küçültün */
        color: #333; /* Başlık rengini uygun şekilde değiştirin */
    }
    .product-card p {
        margin: 5px 0; /* Paragraf aralarını daraltın */
        color: #777; /* Açıklama metni rengini uygun şekilde değiştirin */
    }
    .product-card-body {
        padding: 10px;
    }
</style>

</body>
</html>
