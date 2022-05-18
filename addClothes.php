<?php
$title= "Create colthes" ; 
include_once "common/headerAdmin.php" ;
include_once "db/conn.php" ; 


$reset_form = false;



if(isset($_POST['submit'])){
    $clean = array();
    $validation_messages = array();
    $clean['type'] = trim($_POST['type']);
    $clean['gender'] = trim($_POST['gender']);
    $clean['size'] = $_POST['size'];

    if($_POST["price"]<=0){
        $validation_messages["price"]= "Price can't be empty ore negative";
    }
    else{
        $clean['price'] =$_POST['price'];
    }

    if($_POST["stock"]<=0){
        $validation_messages["stock"]= "Stock can't be empty ore negative";
    }
    else{
        $clean['stock'] =$_POST['stock'];
    }
    

    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext= explode(".",$file_name);
        $file_ext = strtolower(end($file_ext));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
            $validation_messages["image"]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if (file_exists("images/{$file_name}")){
            $validation_messages["image"]='Image already exist';
        }

        if(!isset($validation_messages["image"])){
            $clean['image'] = "images//".$file_name ;
        }
    }
    if (count($validation_messages) === 0) {
        
        $data= array(
            "type" =>$clean['type'],
            "gender" => $clean["gender"],
            "size" =>$clean["size"],
            "price" =>$clean["price"],
            "stock" =>$clean["stock"],
            "image" =>$clean["image"]
        );
        $result = insert_record("clothes", $data) ;
        if ($result){
            $reset_form = true;
            move_uploaded_file($file_tmp,"images/".$file_name);
            echo '<div class="alert alert-success" role="alert">
                    Cloth added successfully!
                </div>';}
        else
            echo '<div class="alert alert-danger" role="alert">
                    Cloth insertion failed!
                </div>';
    }
}
?>

<h1>Add New Clothes</h1>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"  enctype="multipart/form-data">

<!-- Type -->
<div class= "mb-3">
    <label for="type" class="form-label">Type</label>
    <select name="type" id="type" class="form-control">
        <option value="dress">Dress</option>
        <option value="t-Shirt">T-Shirt</option>
        <option value="pants" selected>Pants</option>
    </select>
</div>
    
<!-- Gender -->
<div class= "mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select name="gender" id="gender" class="form-control">
        <option value="male">Male</option>
        <option value="female" selected>Female</option>
    </select>
    </div>

<!-- Size -->
<div class= "mb-3">
    <label for="size" class="form-label">Size</label>
    <select name="size" id="size" class="form-control">
        <option value="small">Small</option>
        <option value="medium" selected>Medium</option>
        <option value="large" >Large</option>
        <option value="xlarge" >XLarge</option>
    </select>
    </div>

<!-- Price -->
<div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" class="form-control" id="price" name="price" step="0.01"
    value="<?php echo (isset($_POST['price'])  && !$reset_form) ? 
                            htmlentities($_POST['price']) : 
                            ''; ?>">
    <div class="form-text" style="color: darkred">
        <?php
            if (isset($validation_messages['price']))
                echo $validation_messages['price'];
        ?>
    </div>
</div>

<!-- Stock -->
<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" class="form-control" id="stock" name="stock"
    value="<?php echo (isset($_POST['stock'])  && !$reset_form) ? 
                            htmlentities($_POST['stock']) : 
                            ''; ?>">
    <div class="form-text" style="color: darkred">
        <?php
            if (isset($validation_messages['stock']))
                echo $validation_messages['stock'];
        ?>
    </div>
</div>

<!-- Image -->
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image">
    <div class="form-text" style="color: darkred">
        <?php
            if (isset($validation_messages['image']))
                echo $validation_messages['image'];
        ?>
    </div>
    </div>

    <input name="submit" type="submit" class="btn btn-primary" value="Submit"/>
</form>


<?php
    include_once "common/footer.php"
?>