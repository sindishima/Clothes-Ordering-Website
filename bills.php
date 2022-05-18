<?php 
$title = "Bills";
require_once 'common/headerAdmin.php';
require_once 'db/conn.php';


$rows = select_all('bill');
?>

<h2>Bills</h2>
<table class="table table-striped">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Bill</th>
    <th scope="col">User Id</th>
    <th scope="col">Price</th>
    </tr>
</thead>
<tbody>
<?php 
    $total_price = 0;
    foreach ($rows as $row) {
        $total_price+=$row['price'];
        echo '<tr>
            <th scope="row">'.$row['id'] . '</th>
            <td><a href="'.$row['file'].'">Bill'.$row['id'].'</a></td>
            <td>' .$row['userId']. '</td>
            <td>' .$row['price']. '</td>
        </tr>';
        }
    ?>
    <tr>
    <td><b>Total: </b> </td>
    <td>-------------------------------------------</td>
    <td>-------------------------------------------</td>
    <td><b id="total"><?php echo $total_price?></b></td>
    </tr>
</tbody>
</table>

<?php
require_once "common/footer.php" ;
?>