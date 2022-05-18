<?php 


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__."/../../db/conn.php" ;

$data = json_decode(file_get_contents("php://input")) ; 

$created_user = array("username"=>$data->username , "password"=>$data->password, "role"=>$data->role) ;

$inserted = insert_record("user", $created_user) ; 

if($inserted) {
    http_response_code(201) ; 
    echo "User added successfully"; 
} 

else {
    //fail
    http_response_code(400);
    echo "Error occured";
}


?>