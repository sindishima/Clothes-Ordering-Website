<?php 

$title = "All Clothes";

require_once 'common/headerAdmin.php';
require_once 'db/conn.php';


$rows = select_all('clothes');
?>

<h2>All Clothes</h2>
<a class="btn btn-success" href="addClothes.php">Add Cloth</a>
<table class="table table-striped">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Type</th>
    <th scope="col">Gender</th>
    <th scope="col">Size</th>
    <th scope="col">Price</th>
    <th scope="col">Stock</th>
    <th scope="col">Image</th>
    </tr>
</thead>
<tbody>
<?php 
    foreach ($rows as $row) {
        echo '<tr>
            <th scope="row">'. $row['id'] . '</th>
            <td>' . ucfirst($row['type']) . '</td>
            <td>' . ucfirst($row['gender']) . '</td>
            <td>' . ucfirst($row['size']) . '</td>
            <td>' . $row['price'] . '</td>
            <td>' . $row['stock'] . '</td>
            <td><img src=\''.trim($row['image']).'\' alt="Not Found" width="70" height="70"></td>
            <td>
                <a class="btn btn-primary" href="updateCloth.php?cloth_id=' . $row['id'] .'">Update</a>
                <button class="btn btn-danger delete" id="'. $row['id'] .'">Delete</button>
            </td>
        </tr>';
        }
    ?>
</tbody>
</table>

<script>
    const buttons = document.querySelectorAll(".delete") ; 
    buttons.forEach(btn => {
        btn.addEventListener("click", ()=>{
        const id = btn.getAttribute("id"); 
        const url = "api/clothes/delete.php" ;
        fetch(url , {
            method: "POST", 
            headers:{
                'Content-Type': 'application/json',
            },
            body : JSON.stringify({id}),
            }
            ).then((result)=>{
                console.log(result);
                if(result.status==204)
                btn.parentNode.parentNode.remove() ;
        }).catch(console.error);
    })
}) ;
</script>

<?php
require_once "common/footer.php" ;
?>