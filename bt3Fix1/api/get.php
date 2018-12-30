<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/ShareStock.php';
 
$database = new Database();
$db = $database->getConnection();
 
$shareStock = new ShareStock($db);

$stmt = $shareStock->getStock();
$num = $stmt->rowCount();
 
if($num>0){
 
    $sharestock_arr=array();
    $sharestock_arr["shareInfo"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $sharestock_item=array(
            "Thang" => $Thang,
            "MaCT" => $MaCT,
            "TenCT" => $TenCT,
            "Mua" => $Mua,
            "Ban" => $Ban
        );
 
        array_push($sharestock_arr["shareInfo"], $sharestock_item);
    }
 
    http_response_code(200);
 
    echo json_encode($sharestock_arr);

} else{
 
    http_response_code(404);
 
    echo 0;
}
?>
