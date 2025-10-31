<?php
include("config.php");

// Oturumu başlat


// Hata mesajını tutmak için değişken
$error = '';

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Kullanıcıyı veritabanına ekle
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        // Kullanıcı başarıyla oluşturuldu, oturum aç
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;

        // Ana sayfaya yönlendir
        header("Location: index.php");
        exit;
    } else {
        // Hata oluştu
        $error = 'Error creating user: ' . $conn->error;
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
            <h1>Register</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php if ($error) { ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>

                    <form method="POST" action="register.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /#content-container -->
    </div> <!-- #content -->
</div> <!-- #wrapper -->

<?php include('footer.php'); ?>

</body>
</html>

