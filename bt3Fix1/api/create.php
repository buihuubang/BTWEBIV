<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/ShareStock.php';

$database = new Database();
$db = $database->getConnection();
 
$shareStock = new ShareStock($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->Thang) && !empty($data->MaCT) && !empty($data->TenCT) && !empty($data->Mua) && !empty($data->Ban) ){
    $shareStock->Thang = $data->Thang;
    $shareStock->MaCT = $data->MaCT;
    $shareStock->TenCT = $data->TenCT;
    $shareStock->Mua = $data->Mua;
    $shareStock->Ban = $data->Ban;

    if($shareStock->createStock()){
        //Tao thanh cong
        http_response_code(201);
        echo 1;
    } else {
        http_response_code(503);
        echo 0;
    }
} else {
    http_response_code(400);
    echo 0;
}