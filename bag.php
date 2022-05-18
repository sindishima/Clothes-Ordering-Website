<?php 

$title = "Bag";

require_once 'common/headerUser.php';
require_once 'db/conn.php';


$rows = select_all('bag');
$totalPrice = 0 ;
if (isset($_POST['submit'])){

    header('Location: createBill.php');
}
?>

<h2>Bag</h2>

<table class="table table-striped">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Image</th>
    <th scope="col">Type</th>
    <th scope="col">Gender</th>
    <th scope="col">Size</th>
    <th scope="col">Price</th>
    <th scope="col">Amount</th>
    <th scope="col">Total Price</th>
    </tr>
</thead>
<tbody>
<?php 
    foreach ($rows as $row) {
        $totalPrice = $totalPrice + $row['total_price'] ;
        echo '<tr>
                <th scope="row">'. $row['id'] . '</th>
                <td><img src=\''.trim($row['image']).'\' alt="Not Found" width="70" height="70"></td>
                <td>' .ucfirst($row['type']) . '</td>
                <td>' . ucfirst($row['gender']) . '</td>
                <td>' . ucfirst($row['size']) . '</td>
                <td>' . $row['price'] . '</td>
                <td>' . $row['amount'] . '</td>
                <td>' . $row['total_price'] . '</td></tr>';
        }
    ?>

    <tr>
    <td><b>Total: </b> </td>
    <td colspan="2">-------------------------------------------</td>
    <td colspan="2">-------------------------------------------</td>
    <td colspan="2">-------------------------------------------</td>
    <td><b><?php echo $totalPrice?></b></td>
    </tr>

</tbody> 
</table> 

<br>
<form action="<?php echo "createBill.php"?>" method="POST">
    <button name="submit" type="submit" class="btn btn-primary">Print Bill</button>
</form>



<?php
require_once "common/footer.php" ;
?>