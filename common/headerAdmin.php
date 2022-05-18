<?php
    session_start() ;
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Shop</title>
</head>
<body>
<div class="container" >
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand"  href="clothesAdmin.php">Clothes Panel</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="user.php">Users</a>
        </li>  
        
       

        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="bills.php">Bills</a>
        </li>

        <li class="nav-item">
            <div class="position-absolute top-50 start-100 translate-middle">
                <?php 
                if(isset($_SESSION["username"]))
                    echo '<a class="btn btn-danger"  aria-current="page" href="logout.php" >LogOut</a>' ;   
            ?>
        </div>
        </li>
            <?php 
            if(!isset($_SESSION["authenticated"])){
                header('Location: login.php');   
            }
            if( strcmp($_SESSION['role'],"admin")!=0){
                header('Location: alert.php?msg=You are not a Admin! You should login as a Admin.');   
            }
        ?>
    </ul>
    </div>
</div>
</nav>