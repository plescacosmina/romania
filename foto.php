<?php session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: login.php');
}
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

if (isset($_POST['submit'])) {
    if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
        $msg = "selecteaza o imagine.";
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imageProperties = getimagesize($_FILES['image']['tmp_name']);
        $name = addslashes($_FILES['image']['name']);
        if ($image) {
            $msg = saveImage($name, $imageProperties['mime'], $image);
        }
    }
}

$images = getImages();

function saveImage($name, $type, $image) {
    $connection = mysqli_connect('localhost', 'root', '', 'romania');
    $query = "INSERT INTO images (name, type, image) VALUES ('{$name}', '{$type}', '{$image}')";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $msg = 'Imagine incarcata in baza de date.';
    } else {
        $msg ='Imaginea nu a fost incarcata in baza de date';
    }
    mysqli_close($connection);
    return $msg;
}

function getImages() {
    $connection = mysqli_connect('localhost', 'root', '', 'romania');
    $query = "SELECT * FROM images";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
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
                        <li><a href="#portfolio" class="smoothScroll">GALERIE FOTO</a></li>
                        <li><a href="magazin.php" class="smoothScroll">MAGAZIN</a></li>
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
        <!-- social icons section -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h2>Incarca imagini</h2>
                    </div>
                    <div class="col-md-12 col-sm-12 contact-form wow fadeInRight" data-wow-delay="0.9s">
                        <form method="post" enctype="multipart/form-data">
                            <input class="form-control" type="file" name="image" id="image" />
                            <br />
                            <input type="submit" name="submit" value="upload" />
                        </form>
                    </div>
                </div>
            </div>

        <!-- portfolio section -->
        <section id="portfolio" class="tm-portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h2>Galerie foto</h2>
                        </div>
                        <div class="iso-section">
                            <div class="iso-box-section wow fadeIn" data-wow-delay="0.9s">
                                <div class="iso-box-wrapper col4-iso-box">
                                    <?php if ($images) :
                                        while ($row = mysqli_fetch_array($images)) : ?>
                                            <div class="iso-box html wordpress mobile col-md-4 col-sm-4">
                                                <a href="data:<?= $row['type'] ?>;base64,<?= base64_encode( $row['image'] ) ?>" data-lightbox-gallery="portfolio-gallery">
                                                    <img src="data:<?= $row['type'] ?>;base64,<?= base64_encode( $row['image'] ) ?>" alt="portfolio img">
                                                </a>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer section -->
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