<?php session_start();
// include database configuration file
include 'dbConfig.php';


if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // execute the stored procedure
    $sql = 'CALL add_contact(?,?,?,?)';

    $stmt = $dbPDO->prepare($sql);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $subject, PDO::PARAM_STR);
    $stmt->bindParam(4, $message, PDO::PARAM_STR);

    $stmt->execute();

    header('Location: contact.php');
}