<?php
include_once "data.php";
class BL{
    function login($userName,$password){
$data= new Data();
$user=$data->fetch('SELECT * FROM `users` WHERE username="'.$userName.'" AND password="'.$password.'"');

if($user->rowCount()>0){
    foreach($user as $role){
    if(isset($role['role'])){
        header('Location: ../view/schoolview.php?school=school');
        $_SESSION['role']=$role['role'];
        $_SESSION['user']=$userName;
       
        }   
        }
    }
    }
    function insertNewStudent(){
      
        // $p=new MainController();
        // $a=$p->insertProfilePic();
        $data= new Data();
        //$data->fetch("DELETE FROM `students` WHERE `studentname`='".$_POST['studentsName']."'&& `phone`='".$_POST['studentsPhone']."'");
        $data->fetch("INSERT INTO `students`( `studentname`, `phone`, `email`) VALUES ('".$_POST['studentsName']."','".$_POST['studentsPhone']."','".$_POST['studentsemail']."')");
        
        
    
    
    

    }
    function studentsList(){
        $data= new Data();
        $user=$data->fetch('SELECT `ID`, `studentname` FROM `students`');
        return $user;
    }
    function updateStudent(){
        
        $data= new Data();
        $data->fetch('UPDATE `students` SET `studentname`="'.$_POST['studentsName'].'",`phone`="'.$_POST['studentsPhone'].'",`email`="'.$_POST['studentsemail'].'" WHERE `ID`="'.$_POST['studentsid'].'"'); 
        }
    function courseList(){
        $data= new Data();
        $user=$data->fetch('SELECT `ID`, `coursename` FROM `courses`');
        return $user;



    }
    function getStudentDetail($student){
        $data= new Data();
        $user=$data->fetch("SELECT `ID`, `studentname`, `phone`, `email`,`profilepic` FROM `students` WHERE `ID`=$student");
          
          
        
        return $user;
     
        
        }  
    
    // function rowCount(){
    //     $data= new Data();
    //     $user=$data->fetch("SELECT count(*) FROM `students`"); 
    //     return $user; 
    // }
    function getLastStudentDetails(){
        $data= new Data();
        $user=$data->fetch("SELECT `ID`,`studentname` FROM `students` WHERE ID = (SELECT MAX(ID) FROM `students`)");
        return $user;
    }
    function getCourseDetails($course){
        $data= new Data();
        $user=$data->fetch("SELECT `ID`, `coursename`,`description` FROM `courses` WHERE ID='".$_SESSION['courseid']."'");
        return $user;


    }
    function getStudentsCourses($student){
        //$student=$_GET['studentid'];
        $data= new Data();
        $user=$data->fetch("SELECT `studentid`, `courseid` FROM `studentcourse` WHERE studentid=$student");
        return $user; 
    }
    function getCourseById($a){
        $data= new Data();
        $user=$data->fetch("SELECT `coursename` FROM `courses` WHERE ID='".$a."'");
        return $user;
    }
    
    function erasestudentsCourses($student){
        
        $data= new Data();
        $data->fetch("DELETE FROM `studentcourse` WHERE `studentid`='$student'");
    }
    function insertCourseToStudentList($student,$course){
       
        $data= new Data();
        $data->fetch("INSERT INTO `studentcourse`(`studentid`, `courseid`) VALUES ('$student','$course')");

    }
    function insertProfilepicName($picName,$student){
      
        $data= new Data();
       
        $data->fetch('UPDATE `students` SET `profilepic`="'.$picName.'" WHERE `ID`="'.$student.'"');
    }
    function deleteStudent($studentId){
        $data= new Data();
       
        $data->fetch('DELETE FROM `students` WHERE `ID`="'.$studentId.'"');
    }
    function insertNewCourse(){
        $data= new Data();
       
        $data->fetch('INSERT INTO `courses`( `coursename`, `description`) VALUES ("'.$_SESSION['coursename'].'","'.$_SESSION['coursedesc'].'")');

    }
    function getLastcourseDetails(){
        $data= new Data();
        $user=$data->fetch("SELECT `ID` FROM `courses` WHERE ID = (SELECT MAX(ID) FROM `courses`)");
        return $user;
    }
    function updateCourseValues(){
        $data= new Data();
        $data->fetch('UPDATE `courses` SET `coursename`="'.$_POST['coursename'].'",`description`="'.$_POST['coursedesc'].'" WHERE `ID`="'.$_GET['courseid'].'"');
        
    }
    function deleteCourse(){
        $data= new Data();
        $data->fetch('DELETE FROM `courses` WHERE `ID`="'.$_SESSION['courseid'].'"');
        
    }
    
   

}
?>