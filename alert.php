<?php
session_start() ;
if (isset($_SESSION['role'])){
    $role = $_SESSION['role'] ;
    session_write_close() ;
    if(strcmp($role  ,"admin")==0){
        require_once "common/headerAdmin.php" ; 
    }
    else if(strcmp($role,"user")==0){
      require_once "common/headerUser.php" ; 
    }
    else{
      require_once "common/header.php" ; 
    }
      echo '<div class="alert alert-danger" role="alert">'
                    .$_GET['msg']. 
                    '</div>';
}else{
  header('Location: login.php');
}
 
?>


<?php
  require_once "common/footer.php" ; 
  
?>