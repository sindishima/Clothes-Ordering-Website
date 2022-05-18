<?php
$title = 'Update User';

require_once 'common/headerAdmin.php';
require_once 'db/conn.php';

$reset_form = false;


    if(isset($_GET['cloth_id'])){
        $cloth_id = $_GET['cloth_id'];
        $data = select_by_properties("clothes" ,array("id"=>$cloth_id))[0];
        
        if (isset($_POST['submit'])) {
            $clean = array();
            $validation_messages = array();
    
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


            if (count($validation_messages) === 0) {
                if (update_record('clothes', $clean, array("id"=>$cloth_id))) {
                    echo '<div class="alert alert-success" role="alert">
                            Cloth updated successfully!
                        </div>';   
                        header('Location: clothesAdmin.php'); 
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            Cloth updating failed!</div>';

                }
            }
        }
    }
?>

<form method="POST" >  
<div class="mb-3">
    <div class="row" style="margin-top: 50px;">
        <div class="col">
            <img src="<?php echo $data["image"] ?>" width="200" height="350">
        </div>
        <div class="col">

            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type"
            value="<?php echo ucfirst($data["type"])?>" readonly>

            <label for="gender" class="form-label">Gender</label>
            <input type="text" class="form-control" id="gender" name="gender"
            value="<?php echo ucfirst($data["gender"])?>" readonly>
            
            <label for="size" class="form-label">Size</label>
            <input type="text" class="form-control" id="size" name="size"
            value="<?php echo ucfirst($data["size"])?>" readonly>
            
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01"
            value="<?php echo (isset($_POST['price'])) ? 
                        htmlentities($_POST['price']) : 
                    ''; ?>" >

            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="stock" name="stock"
            min="1" value="<?php echo (isset($_POST['stock'])) ? 
                        htmlentities($_POST['stock']) : 
                    ''; ?>">
            <br><br>
            <button name="submit" type="submit" class="btn btn-primary" style="font-size: 36px;">Update</button>
        </div>
    </div>
</div>

</form> 

<?php
    require_once 'common/footer.php';
?>