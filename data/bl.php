<?php
include_once "data.php";
class BL
{
    public function login($userName, $password)
    {
        $data= new Data();
        $user=$data->fetch('SELECT * FROM `users` WHERE useremail="'.$userName.'" AND password="'.$password.'"');

        foreach ($user as $use) {
            if ($use['useremail']==$userName&&$use['password']==$password) {
                $_SESSION['role']=$use['rolename'];
                $_SESSION['user']=$userName;
                $_SESSION['profileimg']=$use['profilepic'];
                header('Location: ../view/schoolview.php?school=school');
            }
        }
    }
    
    public function insertNewStudent()
    {
      
        // $p=new MainController();
        // $a=$p->insertProfilePic();
        $data= new Data();
        //$data->fetch("DELETE FROM `students` WHERE `studentname`='".$_POST['studentsName']."'&& `phone`='".$_POST['studentsPhone']."'");
        $data->fetch("INSERT INTO `students`( `studentname`, `phone`, `email`) VALUES ('".$_POST['studentsName']."','".$_POST['studentsPhone']."','".$_POST['studentsemail']."')");
    }
    public function studentsList()
    {
        $data= new Data();
        $user=$data->fetch('SELECT `ID`, `studentname` FROM `students`');
        return $user;
    }
    public function updateStudent()
    {
        $data= new Data();
        $data->fetch('UPDATE `students` SET `studentname`="'.$_POST['studentsName'].'",`phone`="'.$_POST['studentsPhone'].'",`email`="'.$_POST['studentsemail'].'" WHERE `ID`="'.$_SESSION['studentid'].'"');
    }
    public function courseList()
    {
        $data= new Data();
        $user=$data->fetch('SELECT `ID`, `coursename` FROM `courses`');
        return $user;
    }
    public function getStudentDetail($student)
    {
        $data= new Data();
        $user=$data->fetch("SELECT `ID`, `studentname`, `phone`, `email`,`profilepic` FROM `students` WHERE `ID`=$student");
          
          
        
        return $user;
    }
    
    // function rowCount(){
    //     $data= new Data();
    //     $user=$data->fetch("SELECT count(*) FROM `students`");
    //     return $user;
    // }
    public function getLastStudentDetails()
    {
        $data= new Data();
        $user=$data->fetch("SELECT `ID`,`studentname` FROM `students` WHERE ID = (SELECT MAX(ID) FROM `students`)");
        return $user;
    }
    public function getCourseDetails($course)
    {
        $data= new Data();
        $user=$data->fetch("SELECT `ID`, `coursename`,`description` FROM `courses` WHERE ID='".$_SESSION['courseid']."'");
        return $user;
    }
    public function getStudentsCourses($student)
    {
        //$student=$_GET['studentid'];
        $data= new Data();
        $user=$data->fetch("SELECT `studentid`, `courseid` FROM `studentcourse` WHERE studentid=$student");
        return $user;
    }
    public function getCourseById($a)
    {
        $data= new Data();
        $user=$data->fetch("SELECT `coursename` FROM `courses` WHERE ID='".$a."'");
        return $user;
    }
    
    public function erasestudentsCourses($student)
    {
        $data= new Data();
        $data->fetch("DELETE FROM `studentcourse` WHERE `studentid`='$student'");
    }
    public function insertCourseToStudentList($student, $course)
    {
        $data= new Data();
        $data->fetch("INSERT INTO `studentcourse`(`studentid`, `courseid`) VALUES ('$student','$course')");
    }
    public function insertProfilepicName($picName, $student)
    {
        $data= new Data();
       
        $data->fetch('UPDATE `students` SET `profilepic`="'.$picName.'" WHERE `ID`="'.$student.'"');
    }
    public function deleteStudent($studentId)
    {
        $data= new Data();
       
        $data->fetch('DELETE FROM `students` WHERE `ID`="'.$studentId.'"');
    }
    public function insertNewCourse()
    {
        $data= new Data();
       
        $data->fetch('INSERT INTO `courses`( `coursename`, `description`) VALUES ("'.$_SESSION['coursename'].'","'.$_SESSION['coursedesc'].'")');
    }
    public function getLastcourseDetails()
    {
        $data= new Data();
        $user=$data->fetch("SELECT `ID` FROM `courses` WHERE ID = (SELECT MAX(ID) FROM `courses`)");
        return $user;
    }
    public function updateCourseValues()
    {
        $data= new Data();
        $data->fetch('UPDATE `courses` SET `coursename`="'.$_POST['coursename'].'",`description`="'.$_POST['coursedesc'].'" WHERE `ID`="'.$_GET['courseid'].'"');
    }
    public function deleteCourse()
    {
        $data= new Data();
        $data->fetch('DELETE FROM `courses` WHERE `ID`="'.$_SESSION['courseid'].'"');
    }
    public function adminList()
    {
        $data= new Data();
        $users=$data->fetch('SELECT `id`, `useremail`, `password`, `role`, `rolename`, `profilepic`, `username`, `userphone` FROM `users`');
        return $users;
    }
    public function getUser()
    {
        $data= new Data();
        $user=$data->fetch('SELECT `id`, `useremail`, `password`, `role`, `rolename`, `profilepic`, `username`, `userphone` FROM `users` WHERE `id`="'.$_SESSION['userid'].'"');
        return $user;
    }
    public function getUsers()
    {
        $data= new Data();
        $user=$data->fetch('SELECT  `useremail` FROM `users`');
        return $user;
    }
    public function updateUser()
    {
        $data= new Data();
        $data->fetch('UPDATE `users` SET `useremail`="'.$_POST['usersemail'].'",`username`="'.$_POST['usersName'].'",`userphone`="'.$_POST['usersPhone'].'",`rolename`="'.$_POST['role'].'" WHERE `id`="'.$_SESSION['userid'].'"');
    }
    
    public function insertUser()
    {
        $data= new Data();
        $data->fetch('INSERT INTO `users`( `useremail`, `password`, `rolename`, `username`, `userphone`) VALUES ("'.$_POST['usersemail'].'","'.$_POST['userspassword'].'","'.$_POST['role'].'","'.$_POST['usersName'].'","'.$_POST['usersPhone'].'")');
    }
    public function getLastUser()
    {
        $data= new Data();
        $user=$data->fetch("SELECT `id` FROM `users` WHERE id = (SELECT MAX(id) FROM `users`)");
        return $user;
    }
    public function insertProfilepicUserName($destination, $a)
    {
        $data= new Data();
        $data->fetch("UPDATE `users` SET `profilepic`='".$destination."' WHERE `id`='".$a."'");
    }
    public function deleteUser()
    {
        $data= new Data();
        $data->fetch("DELETE FROM `users` WHERE `id`='".$_SESSION['userid']."'");
    }
    public function getProfilePicName()
    {
        $data= new Data();
        $user=$data->fetch('SELECT  `profilepic` FROM `users` WHERE `id`="'.$_SESSION['userid'].'"');
        return $user;
    }
}    // function insertUser(){
    //     $data= new Data();
    //     $data->fetch('INSERT INTO `users`(  `userphone`) VALUES ('".$_POST['usersPhone'].'")');

    // }
