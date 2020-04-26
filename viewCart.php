<?php
// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
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
        <style>
            input[type="number"]{width: 20%;}
        </style>
        <script>
            function updateCartItem(obj,id){
                $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
                    if(data == 'ok'){
                        location.reload();
                    }else{
                        alert('Cart update failed, please try again.');
                    }
                });
            }
        </script>
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
-                    <a href="#"><h3>Romania</h3></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right main-navigation">
                        <li><a href="index.php" class="smoothScroll">HOME</a></li>
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
                        <h1 class="wow fadeIn tm-home-header" data-wow-delay="1.6s">Romania</h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="cart" class="tm-about">
            <div class="container">
                <h1>Cosul tau</h1>
                <table class="table">
                <thead>
                    <tr>
                        <th>Produs</th>
                        <th>Pret</th>
                        <th>Cantitate</th>
                        <th>Subtotal</th>
                        <th>Sterge/Checkout</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($cart->total_items() > 0) :
                        //get cart items from session
                        $cartItems = $cart->contents();
                        foreach($cartItems as $item) :
                    ?>
                            <tr>
                                <td><?= $item["name"]; ?></td>
                                <td><?= $item["price"].' RON'; ?></td>
                                <td><input type="number" class="form-control text-center" value="<?= $item["qty"]; ?>" onchange="updateCartItem(this, '<?= $item["rowid"]; ?>')"></td>
                                <td><?= $item["subtotal"].' RON'; ?></td>
                                <td>
                                    <a href="cartAction.php?action=removeCartItem&id=<?= $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5"><p>Cosul tau este gol.</p>
                        </td>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="magazin.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Magazin</a></td>
                        <td colspan="2"></td>
                        <?php if($cart->total_items() > 0){ ?>
                        <td class="text-center"><strong>Total <?= $cart->total().' RON'; ?></strong></td>
                        <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-check-circle-o"></i></a></td>
                        <?php } ?>
                    </tr>
                </tfoot>
                </table>
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