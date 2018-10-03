<?php
include_once "../data/bl.php";

$noun = $_GET['school'];

switch ($noun) {

    case 'students':
   
    $stuli=[];
$data=new BL();
$studentlist=$data->studentsList();
foreach ($studentlist as $student) {
    array_push($stuli, $student['studentname']);
}
    

    echo json_encode($stuli);
    break;


    

    }



 

?>