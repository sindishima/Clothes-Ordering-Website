<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__."/../../db/conn.php" ;

$data = json_decode(file_get_contents("php://input")) ; 

$id = $data->id ; 

$deleted = delete("user" ,$id) ; 

if($deleted) {
    http_response_code(204);
    echo json_encode("User deleted successfully");
}
else {
    http_response_code(400);
    echo "User deletion failed";
}

?>

