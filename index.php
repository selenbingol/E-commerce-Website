<?php
include("config.php");
include("logged_in_check.php");
<?php





$sql = "SELECT * FROM categories";
$categories = berkhoca_query_parser($sql);
?>

<?php include('header.php'); ?>

<body>

<div id="wrapper">

    <?php include('top_bar.php'); ?>
    <?php include('left_sidebar.php'); ?>

    <div id="content">      
        <div id="content-header">
            <h1>Dashboard</h1>
        </div> <!-- #content-header --> 

        <div id="content-container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h1>Welcome to Dashboard, <?php echo $_SESSION['admin_username']; ?></h1>
                </div> <!-- /.col -->
            </div> <!-- /.row -->

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="categories-container">
                        <?php foreach ($categories as $category) { ?>
                            <div class="category-card">
                                <h3><?php echo $category['category_name']; ?></h3>
                                <p><?php echo $category['category_desc']; ?></p>
                                <a href="category_home.php?category_id=<?php echo $category['category_id']; ?>" class="btn btn-primary">View Products</a>
                            </div>
                        <?php } ?>
                    </div> <!-- /#categories-container -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->

    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

<style>
    .categories-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }
    .category-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 16px;
        margin: 10px;
        width: 200px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: #ffffff; /* Kartların arka plan rengini beyaz yapın */
    }
    .category-card h3 {
        margin: 0 0 10px 0;
        font-size: 1.5em;
        color: #333; /* Başlık rengini uygun şekilde değiştirin */
    }
    .category-card p {
        margin: 10px 0;
        color: #777; /* Açıklama metni rengini uygun şekilde değiştirin */
    }
    .category-card a {
        display: block;
        margin: 5px 0;
        color: #ffffff; /* Buton metni rengini beyaz yapın */
    }
    .btn-primary {
        background-color: #ff5a5f; /* Buton rengini uygun şekilde değiştirin */
        border-color: #ff5a5f; /* Buton kenarlık rengini uygun şekilde değiştirin */
    }
    .btn-primary:hover {
        background-color: #e74c3c; /* Buton hover rengini uygun şekilde değiştirin */
        border-color: #e74c3c; /* Buton hover kenarlık rengini uygun şekilde değiştirin */
    }
</style>

</body>
</html>
