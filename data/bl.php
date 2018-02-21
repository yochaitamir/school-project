<?php
include_once "data.php";
class BL{
    function login($userName,$password){
$data= new Data();
$user=$data->fetch('SELECT * FROM `users` WHERE useremail="'.$userName.'" AND password="'.$password.'"');

foreach($user as $use){
    if($use['useremail']==$userName&&$use['password']==$password){
    
        $_SESSION['role']=$use['rolename'];
        $_SESSION['user']=$userName;
        header('Location: ../view/schoolview.php?school=school');
        
       
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
    function adminList(){
        $data= new Data();
        $users=$data->fetch('SELECT `id`, `useremail`, `password`, `role`, `rolename`, `profilepic`, `username`, `userphone` FROM `users`');
       return $users;
    }
    function getUser(){
        $data= new Data();
        $user=$data->fetch('SELECT `id`, `useremail`, `password`, `role`, `rolename`, `profilepic`, `username`, `userphone` FROM `users` WHERE `id`="'.$_SESSION['userid'].'"');
       return $user;
    }
    function updateUser(){
     
        $data= new Data();
        $data->fetch('UPDATE `users` SET `useremail`="'.$_POST['usersemail'].'",`username`="'.$_POST['usersName'].'",`userphone`="'.$_POST['usersPhone'].'",`rolename`="'.$_POST['role'].'" WHERE `id`="'.$_SESSION['userid'].'"');


    }
    function insertUser(){
        $data= new Data();
        $data->fetch('INSERT INTO `users`( `useremail`, `password`, `rolename`, `username`, `userphone`) VALUES ("'.$_POST['usersemail'].'","'.$_POST['userspassword'].'","'.$_POST['role'].'","'.$_POST['usersName'].'","'.$_POST['usersPhone'].'")');

    }
    function getLastUser(){
        $data= new Data();
        $user=$data->fetch("SELECT `id` FROM `users` WHERE id = (SELECT MAX(id) FROM `users`)");
        return $user;

    }
    function insertProfilepicUserName($destination,$a){
        $data= new Data();
        $data->fetch("UPDATE `users` SET `profilepic`='".$destination."' WHERE `id`='".$a."'");

    }
    function deleteUser(){
        $data= new Data();
        $data->fetch("DELETE FROM `users` WHERE `id`='".$_SESSION['userid']."'");

    }


}    // function insertUser(){
    //     $data= new Data();
    //     $data->fetch('INSERT INTO `users`(  `userphone`) VALUES ('".$_POST['usersPhone'].'")');

    // }
   
    
    
   


?>