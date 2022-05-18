<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__."/../../db/conn.php" ;

$data = json_decode(file_get_contents("php://input")) ; 
$cloth_type = $data->type ; 

$sql = "select * from clothes where `type` = :type";
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(":type",$cloth_type );
$stmt -> execute();

if($stmt->rowCount()>0){
   
    $list = array() ;
    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($list, $row) ;
    }
    http_response_code(200);
    echo json_encode($list) ;
}

else {
    http_response_code(404);
    echo json_encode( "No such a cloth type");
}


?>