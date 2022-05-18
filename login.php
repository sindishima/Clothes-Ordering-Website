<?php
$title = 'Login';

require_once 'common/header.php';
require_once 'db/conn.php';
$reset_form = false;

    if (isset($_POST['submit'])) {
        $clean = array();
        $validation_messages = array();

        $trimmed_username = trim($_POST['username']);
        if (strlen($trimmed_username) == 0)
            $validation_messages['username'] = 'Fill in your username!';
        else 
            $clean['username'] = $trimmed_username;

        $trimmed_password = trim($_POST['password']);
        if (strlen($trimmed_password) === 0)
            $validation_messages['password'] = 'Fill in your password!';
        else
            $clean['password'] = $trimmed_password;


        if (count($validation_messages) === 0) {
            $sql = 'select * from user where username = :username';
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindParam(":username", $trimmed_username);
            $stmt -> execute();
            if ($stmt -> rowCount() === 1) {
                $user_row = $stmt -> fetch(PDO::FETCH_ASSOC);
                if (strcmp($trimmed_password, $user_row['password'])==0) {
                    $_SESSION['authenticated'] = true;
                    $_SESSION['role'] = $user_row['role'];
                    $_SESSION['username'] = $user_row['username'];
                    $_SESSION['id'] =  $user_row['id'];
                    $reset_form = true ;

                    if( strcmp($_SESSION['role'],"admin")==0){
                        header('Location: clothesAdmin.php?username='.$_SESSION['username']);
                    }
                    else{
                        header('Location: clothes.php?username='.$_SESSION['username']);
                    }
                } else {
                    $validation_messages['password'] = 'Incorrect username or password';
                }
            } else {
                $validation_messages['password'] = 'No record found in db';
            }
        }
    }
?>

<h1>
    Login
</h1>

<form action="" method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username"
    value="<?php echo (isset($_POST['username'])  && !$reset_form) ? 
                            htmlentities($_POST['username']) : 
                            ''; ?>">
    <div class="form-text" style="color: darkred">
        <?php
            if (isset($validation_messages['username']))
                echo $validation_messages['username'];
        ?>
    </div>

    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <div class="form-text" style="color: darkred">
        <?php
            if (isset($validation_messages['password']))
                echo $validation_messages['password'];
        ?>
    </div>
  </div>
  <button name="submit" type="submit" class="btn btn-primary">Login</button>
</form>

<a href="registration.php">Create a new account</a>
<?php
require_once "common/footer.php" ;
?>
