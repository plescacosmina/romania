<?php session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: login.php');
}
include 'dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <title>Romania</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/nivo-lightbox.css">
        <link rel="stylesheet" href="css/nivo_themes/default/default.css">
        <link rel="stylesheet" href="css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <style>
            .cart-link{
                margin-top: 15px;
                text-align: right;
            }
        </style>
    </head>
    <body data-spy="scroll" data-target=".navbar-collapse">
        <div class="preloader">
            <div class="sk-spinner sk-spinner-rotating-plane"></div>
        </div>
        <nav class="navbar navbar-default navbar-fixed-top sticky-navigation" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="#"><h3>Romania</h3></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right main-navigation">
                        <li><a href="index.php" class="smoothScroll">HOME</a></li>
                        <li><a href="foto.php" class="smoothScroll">GALERIE FOTO</a></li>
                        <li><a href="#magazin" class="smoothScroll">MAGAZIN</a></li>
                        <li><a href="contact.php" class="smoothScroll">CONTACT</a></li>
                        <li><a href="<?= isset($_SESSION['username']) ? 'logout.php' : 'login.php' ?>" class="smoothScroll"><?= isset($_SESSION['username']) ? 'Logout' : 'Login' ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- home section -->
        <section id="home" class="tm-home">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h1 class="wow fadeIn tm-home-header" data-wow-delay="1.3s">Romania</h1>
                    </div>
                </div>
            </div>
        </section>

        <section id="magazin" class="tm-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 text-center">
                        <h1>Produse</h1>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="viewCart.php" class="cart-link btn btn-primary" title="Vezi cos"><i class="fa fa-shopping-cart"></i> Vezi cos</a>
                    </div>
                    <div class="col-md-12 text-center">
                        <hr />
                    </div>
                    <div id="products" class="col-md-12 list-group">
                        <?php
                        //get rows query
                        $query = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 10");
                        if($query && $query->num_rows > 0) :
                            while($row = $query->fetch_assoc()) :
                            ?>
                            <div class="item col-lg-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h4 class="list-group-item-heading"><?= $row["name"]; ?></h4>
                                        <p class="list-group-item-text"><?= $row["description"]; ?></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="lead"><?= $row["price"].' RON'; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?= $row["id"]; ?>"> <i class="fa fa-cart-plus"></i> Adauga in cos</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>Product(s) not found.....</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <p>Copyright &copy; <?= date('Y') ?> | Romania</p>
                        <hr>
                        <ul class="social-icon">
                            <li class="wow bounceIn" data-wow-delay="0.3s"><a href="https://www.facebook.com/" class="fa fa-facebook"></a></li>
                            <li class="wow bounceIn" data-wow-delay="0.6s"><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                            <li class="wow bounceIn" data-wow-delay="0.9s"><a href="https://www.instagram.com/" class="fa fa-instagram"></a></li>
                            <li class="wow bounceIn" data-wow-delay="1s"><a href="https://www.pinterest.com/" class="fa fa-pinterest"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/smoothscroll.js"></script>
        <script src="js/jquery.nav.js"></script>
        <script src="js/isotope.js"></script>
        <script src="js/imagesloaded.min.js"></script>
        <script src="js/nivo-lightbox.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>