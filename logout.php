<?php

require_once "db/conn.php" ; 

$title = "Logout" ;
session_start() ;
unset($_SESSION['authenticated'] ) ;
unset($_SESSION['role'] ) ;
unset($_SESSION['username'] ) ;

$sql = "DROP TABLE IF EXISTS `bag` ;" ;
$pdo->exec($sql) ; 

$sql = "CREATE TABLE IF NOT EXISTS `bag` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255) NOT NULL , 
    gender VARCHAR(255) NOT NUll , 
    size VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    amount int NOT NUll,
    total_price float NOT NULL,
    image VARCHAR(255) NOT NULL 

)ENGINE=INNODB; " ;

$pdo->exec($sql) ; 

header('Location: login.php');
?>