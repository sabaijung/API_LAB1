<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require_once("config/db.php");
require_once("cmd/exec.php");


$db = new Database();
$strConn = $db->getConnection();
$strExe = new ExecSQL($strConn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get post body content
$content = file_get_contents('php://input');
    // parse JSON
$user = json_decode($content, true);

$action = $user['cmd'];
$name = $user['fullName'];
$emaiil = $user['email'];
$password = $user['password'];

switch ($action){
    case "insert" :
        $sql = " INSERT INTO users (email, password, name) 
                VALUES ('".$emaiil."', '".$password."', '".$name."') ";
        $stmt = $strExe->dataTransection($sql);

        if ($stmt == 1) {
            echo json_encode(['status' => 'ok','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    break;

    case "select" :
        $sql = " SELECT * FROM users ";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("users");
        $usersArray = array();
        if($row_count >0) {
            foreach($stmt as $row){
                $usersArray[] = $row;
            }
        }
        echo json_encode($usersArray);
    break;

    default :
   
    }
}


?>