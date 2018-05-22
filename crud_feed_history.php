<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require_once("config/db.php");
require_once("cmd/exec.php");


$db = new Database();
$strConn = $db->getConnection();
$strExe = new ExecSQL($strConn);

$str_date = $_GET['date'];
$str_qty = $_GET['qty'];

$sql = "  INSERT INTO feed_history (date, qty) 
                VALUES ( '".$str_date."', '".$str_qty."')  ";

$stmt = $strExe->dataTransection($sql);

if ($stmt == 1) {
    echo json_encode(['status' => 'ok','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
} else {
    echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
}

?>