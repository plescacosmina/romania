<?php session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: login.php');
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
                        <li><a href="#home" class="smoothScroll">HOME</a></li>
                        <li><a href="foto.php" class="smoothScroll">GALERIE FOTO</a></li>
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
                        <h1 class="wow fadeInUp tm-home-header" data-wow-delay="1.3s">Romania</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- social icons section -->
        <section id="tm-icons" class="tm-icons" style="margin-top: 100px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <iframe width="100%" height="600" src="https://www.youtube.com/embed/N2CAlzGrqmE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <!-- about section -->
        <section id="about" class="tm-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 about-bottom-des wow bounceIn">
                        <div class="col-md-12 col-sm-12">
                            <p>România este un stat situat în sud-estul Europei Centrale, pe cursul inferior al Dunării, la nord de peninsula Balcanică și la țărmul nord-vestic al Mării Negre.</p>
                            <p>Pe teritoriul ei este situată aproape toată suprafața Deltei Dunării și partea sudică și centrală a Munților Carpați.</p>
                            <p>Pe teritoriul ei este situată aproape toată suprafața Deltei Dunării și partea sudică și centrală a Munților Carpați.</p>
                            <h4 class="tm-about-header">Etimologia</h4>
                            <p>
                                Numele de "România" provine de la "român", cuvânt derivat din latinescul romanus care semnifică cetățean al Romei. Cele mai vechi atestări documentare ale termenului de "rumân/român" cunoscute în mod cert sunt conținute în relatări, jurnale și rapoarte de călătorie redactate de umaniști renascentiști din secolul al XVI-lea care, fiind în majoritate trimiși ai Sfântului Scaun, au călătorit în Țara Românească, Moldova și Transilvania.
                            </p>
                            <h4 class="tm-about-header">Turism</h4>
                            <p>
                                Traversată de apele Dunării, România are un relief variat, incluzând împăduriții Munți Carpați, coasta Mării Negre și Delta Dunării, cea mai bine păstrată deltă europeană[293]. Satele românești păstrează în general un mod de viață tradițional. România se bucură de o abundență a arhitecturii religioase și păstrează câteva orașe medievale și castele.
                            </p>
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