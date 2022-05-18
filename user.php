<?php 
//view all users registered till now
$title = "Users";

require_once 'common/headerAdmin.php';
require_once 'db/conn.php';

$rows = select_all('user');
?>

<h2>All Users</h2>
<a class="btn btn-success" href="registration.php">Create User</a>
<table class="table table-striped">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Username</th>
    <th scope="col">Password</th>
    <th scope="col">Role</th>
    </tr>
</thead>
<tbody>
<?php 
    foreach ($rows as $row) {
        echo '<tr>
            <th scope="row">'. $row['id'] . '</th>
            <td>' . $row['username'] . '</td>
            <td>' . $row['password'] . '</td>
            <td>' . $row['role'] . '</td>
            <td>
                <a class="btn btn-primary" href="updateUser.php?user_id=' . $row['id'] .'">Update</a>
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
          const url = "api/user/delete.php" ;
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