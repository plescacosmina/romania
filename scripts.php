<?php session_start();

include 'dbConfig.php';
// triggers
$sql = "
    DROP TRIGGER IF EXISTS `add_email`; 
    CREATE DEFINER=`root`@`localhost` TRIGGER `add_email` BEFORE INSERT ON `contacts` FOR EACH ROW 
    BEGIN
        INSERT INTO emails(email, date) VALUES(NEW.email, NOW());
    END";

$stmt = $dbPDO->prepare($sql);
$stmt->execute();

$sql = "DROP TRIGGER IF EXISTS `insert_message_length`;
    CREATE DEFINER=`root`@`localhost` TRIGGER `insert_message_length` AFTER INSERT ON `contacts` FOR EACH ROW 
    BEGIN
        INSERT INTO contacts_message_length(length, created_at) VALUES (LENGTH(NEW.message), NOW());
    END";

$stmt = $dbPDO->prepare($sql);
$stmt->execute();


$sql = "DROP TRIGGER IF EXISTS `before_update_token`;
    CREATE DEFINER=`root`@`localhost` TRIGGER `before_update_token` BEFORE UPDATE ON `customers` FOR EACH ROW
    BEGIN
        SET NEW.updated_at = Now();
    END";

$stmt = $dbPDO->prepare($sql);
$stmt->execute();

// procedures
$sql = "DROP PROCEDURE IF EXISTS `add_contact`;
    CREATE DEFINER=`root`@`localhost` PROCEDURE `add_contact`(IN `name` VARCHAR(256), IN `email` VARCHAR(256), IN `subject` VARCHAR(256), IN `message` LONGTEXT)
    NO SQL
BEGIN
	INSERT INTO contacts (name, email, subject, message, created_at)
	VALUES (name, email, subject, message, NOW());
END";

$stmt = $dbPDO->prepare($sql);
$stmt->execute();



$sql = "DROP PROCEDURE IF EXISTS `select_customer_details`;
    CREATE DEFINER=`root`@`localhost` PROCEDURE `select_customer_details`(IN `customer_id` INT)
        NO SQL
    BEGIN
    SELECT * FROM customers WHERE id = customer_id;
    END";

$stmt = $dbPDO->prepare($sql);
$stmt->execute();



$sql = "DROP PROCEDURE IF EXISTS `update_token`;
    CREATE DEFINER=`root`@`localhost` PROCEDURE `update_token`(IN new_token INT(8), IN customer_id INT(8))
    NO SQL
    BEGIN
        UPDATE customers 
        SET token = new_token
        WHERE
        id = customer_id;
    END";

$stmt = $dbPDO->prepare($sql);
$stmt->execute();

echo 'Succes!';