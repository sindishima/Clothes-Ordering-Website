<?php 
$title = 'Register';

require_once 'common/header.php';
require_once 'db/conn.php';
$reset_form = false;

if (isset($_POST['submit'])) {
    $clean = array();
    $validation_messages = array();

    
    if (!isset($_POST['username'])) {
        $validation_messages['username'] = 'Username cannot be empty!';
    } else if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['username']))) {
        $validation_messages['username'] = 'Username can only have digits, letters and _';
    } else {
        $trimmed_username = trim($_POST['username']);
        $sql = "select * from user where username = :username";
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(":username", $trimmed_username);
        $stmt -> execute();
        if ($stmt -> rowCount() > 0)
            $validation_messages['username'] = 'This username already exists!';
        else
            $clean['username'] = $trimmed_username;
    }
    
    $trimmed_password = trim($_POST['password']);
    if (strlen($trimmed_password) < 6)
        $validation_messages['password'] = 'Password cannot be less than 6 characters!';
    else{
        $clean['password'] = $trimmed_password;
        $clean["role"] = $_POST["role"] ;
        
    }
    
    if (count($validation_messages) === 0) {
        if (insert_record('user',  $clean)) {
            $reset_form = true;
            echo '<div class="alert alert-success" role="alert">
                    User registered successfully!
                </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    User registration failed!</div>';
        }
    }
}

?>

<h1>
    Register
</h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    
    <div class="mb-3">

    <!-- Username -->
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
    <!-- Password -->
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password"
    value="<?php echo (isset($_POST['password'])  && !$reset_form) ? 
                            htmlentities($_POST['password']) : 
                            ''; ?>">
    <div class="form-text" style="color: darkred">
        <?php
            if (isset($validation_messages['password']))
                echo $validation_messages['password'];
        ?>
    </div>

    <!-- Role -->
    <label for="role" class="form-label">Select Role</label>
    <select name="role" id="role" class="form-control">
        <option value="admin">ADMIN</option>
        <option value="user" selected>USER</option>
    </select>
    
  </div>
  <button name="submit" type="submit" class="btn btn-primary">Register</button>
</form>

<?php 
require_once "common/footer.php" ; 
?>
