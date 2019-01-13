<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/SinhVien.php';
 
$database = new Database();
$db = $database->getConnection();
 
$sinhvien = new SinhVien($db);

$stmt = $sinhvien->getSV();
$num = $stmt->rowCount();
 
if($num>0){
 
    $sinhvien_arr=array();
    $sinhvien_arr["svInfo"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $sinhvien_item=array(
            "MaSV" => $MaSV,
            "TenSV" => $TenSV,
            "DiaChi" => $DiaChi,
            "HocKi" => $HocKi,
            "Nam" => $Nam,
            "Diem" => $Diem,
            "TenMH" => $TenMH,
            "XepLoai" => ($Diem >= 5)? "1" : "0"
        );
 
        array_push($sinhvien_arr["svInfo"], $sinhvien_item);
    }
 
    http_response_code(200);
 
    echo json_encode($sinhvien_arr);

} else{
 
    http_response_code(404);
 
    echo 0;
}
?>
