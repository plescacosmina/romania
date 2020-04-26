<?php session_start();

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    header('Location: index.php');
}
include 'dbConfig.php';

if (isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    $query = $db->query("SELECT * FROM customers WHERE username = '" . $_COOKIE['username'] . "' and token = '" . $_COOKIE['token'] . "'");
    $row = $query->fetch_assoc();
    if (count($row)) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['sessCustomerID'] = $row['id'];

        setcookie('username', '', time() - 3600);
        setcookie('token', '', time() - 3600);

        $token = rand(10, 1000);
        setcookie('username', $_SESSION['username'], time() + (86400 * 30), "/");
        setcookie('token', $token, time() + (86400 * 30), "/");

        // $query = $db->query("UPDATE customers SET token = " . $token);

        // update
        $sql = 'CALL update_token(?, ?)';
        $stmt = $dbPDO->prepare($sql);
        $stmt->bindParam(1, $token, PDO::PARAM_INT);
        $stmt->bindParam(1, $row['id'], PDO::PARAM_INT);
        $stmt->execute();
        if ($query) {
            header('Location: index.php');
        }
    }
}
if (isset($_POST['Submit'])) {
    if ((!isset($_POST['username']) && empty($_POST['username'])) || (!isset($_POST['parola']) && empty($_POST['parola']))) {
        $msg = "<span style='color:red'>Date de logare incorecte.</span>";
        die($msg);
    } else {
        $username = $_POST['username'];
        $password = $_POST['parola'];

        $query = $db->query("SELECT * FROM customers WHERE username = '" . $username . "' and password = '" . $password . "'");
        $row = $query->fetch_assoc();
        if ($row && count($row)) {
            $_SESSION['username'] = $username;
            $_SESSION['sessCustomerID'] = $row['id'];

            if (isset($_POST['remember_me'])) {
                $remember = $_POST['remember_me'];
                if ($remember == 1) {

                    if (isset($_COOKIE['username'])) {
                        setcookie('username', '', time() - 3600);
                    }
                    if (isset($_COOKIE['token'])) {
                        setcookie('token', '', time() - 3600);
                    }

                    $token = rand(10, 1000);
                    setcookie('username', $username, time() + (86400 * 30), "/");
                    setcookie('token', $token, time() + (86400 * 30), "/");
                    //save token in database

                    $sql = "DROP TRIGGER IF EXISTS `before_update_token`;
                        CREATE  TRIGGER `before_update_token` BEFORE UPDATE ON `customers` FOR EACH ROW 
                        BEGIN
                        SET NEW.updated_at = Now();
                        END;";

                    $stmt = $dbPDO->prepare($sql);
                    $stmt->execute();

                    $query = $db->query("UPDATE customers SET token = " . $token . " WHERE id = " . $row['id']);
                    if ($query) {
                        header('Location: index.php');
                    }
                }
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <link href="css/style1.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login-style.css">
    <script type='text/javascript'>
        function refreshCaptcha() {
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        }
    </script>
</head>
<body>
<div class="login-page">
    <div class="form">
        <h2 class="text-center">Login</h2>
        <form class="login-form" action="" method="post" name="form1" id="form1">
            <?php if (isset($msg)) : ?>
                <p><?= $msg; ?></p>
            <?php endif; ?>
            <input type="text" id="username" name="username" placeholder="Username"/>
            <input type="password" id="parola" name="parola" placeholder="Parola"/>
            <div style="padding-top: 20px;">
                <label for="remember_me">Remember me</label>
                <input type="checkbox" id="remember_me" name="remember_me" value="1" style="width: 10%;">
            </div>
            <hr/>
            <button name="Submit" type="submit" onclick="return validate();">Login</button>
        </form>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>
</html>