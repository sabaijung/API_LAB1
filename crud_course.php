<?
require_once("config/db.php");
require_once("cmd/exec.php");
require_once("cmd/utilities.php");

$db = new Database();
$strConn = $db->getConnection();
$strExe = new ExecSQL($strConn);
$utilities = new Utilities();

$action = $_GET['cmd'];

switch ($action){
    case "select" :
        $stmt = $strExe->readAll("courses");
        $num = $strExe->rowCount("courses");
        if($num>0){
            $data_arr['rs'] = array();
            foreach($stmt as $row){
                $item = array(
                    'code' => $row['code'],
                    'name' => $row['name'],
                    'img_path' => $row['img_path'],
                    'speaker_name' => $row['speaker_name'],
                    'detail' => $row['detail'], 
                    'course_outline' => $utilities->planText($row['course_outline']),
                    'date_open' => $row['date_open'], 
                    'date_end' => $row['date_end'], 
                    'place' => $row['place'],
                    'seat_num' => $row['seat_num'],
                    'cost' => $row['cost'],
                    'comment' => $row['comment']
                   
                );
                array_push($data_arr['rs'], $item);
            }
            echo json_encode($data_arr);
        }else{
            echo json_encode( array('msg' => 'result not found.') );
        } 

    break;

    default :
   
   
}


?>