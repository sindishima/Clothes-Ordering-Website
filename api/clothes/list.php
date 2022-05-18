<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__."/../../db/conn.php" ;

$data = select_all("clothes") ; 

if($data->rowCount()>0){
   
    $list = array() ;
    while($row= $data->fetch(PDO::FETCH_ASSOC)){
        array_push($list, $row) ;
    }
    http_response_code(200);
    echo json_encode($list) ;
}

else {
    http_response_code(404);
    echo json_encode( "No cloth to select");
}


?>