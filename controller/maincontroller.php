<?php
include_once "../data/bl.php";
class MainController
{
    public function __construct()
    {
    }
    public function createStudent()
    {
        $b=new BL();
       
        $b->insertNewStudent();
    }
    public function deleteStudent($studentId)
    {
        $a=new BL();
        $a->deleteStudent($studentId);
    }
    
    public function getStudentDetails()
    {
        $studentArray=[];
        $a=new BL();
        if ($a->getStudentDetail($_SESSION['studentid'])) {
            //$a->getStudentDetails($_SESSION['studentid']);
            foreach ($a->getStudentDetail($_SESSION['studentid']) as $student) {
                array_push($studentArray, $student['ID'], $student['studentname'], $student['phone'], $student['email']);
            
                return $studentArray;
            }
        } else {
        }
        return array();
    }
    // function rowCount(){
    //     $a=new BL();
    //     $a->rowCount();
    // }
    public function getLastStudentDetails()
    {
        $studentArray=[];
        $a=new BL();
    
        foreach ($a->getLastStudentDetails() as $student) {
            array_push($studentArray, $student['ID'], $student['studentname']);
            //echo $student['ID'];
            $_SESSION['studentid']=$student['ID'];
            return $studentArray;
        }
    }
    
    public function studentsList()
    {
        $a=new BL();
        return $a->studentsList();
    }
    public function getLastcourseDetails()
    {
        $a=new BL();
        foreach ($a->getLastcourseDetails() as $course) {
            $_SESSION['courseid']=$course['ID'];
            return $_SESSION['courseid'];
        }
    }
    public function courseList()
    {
        $a=new BL();
        return    $a-> courseList();
    }
    public function insertNewCourse()
    {
        $a=new BL();
        $a->insertNewCourse();
    }
    public function updateCourseValues()
    {
        $a=new BL();
        $a->updateCourseValues();
    }
    
    public function getCourseDetails()
    {
        $a=new BL();
        $courses=$a->getCourseDetails($_SESSION['courseid']);
        return $courses;
    }
    public function getStudentsCourses()
    {
        $student=$_GET['studentid'];
        $a=new BL();
        foreach ($a->getStudentsCourses($student) as $courses) {
            $s= $courses['courseid'];
            $this->getCourseById($s);
        }
    }
    public function getCourseById($s)
    {
        $a=new BL();
        $courseName=$a->getCourseById($s);
        foreach ($courseName as $courseToDisplay) {
            echo $courseToDisplay['coursename'].'<br>';
        }
    }
    public function updateStudent()
    {
        $a=new BL();
        $a->updateStudent();
    }
    public function isChecked($coursechecked)
    {
        $a=new BL();
        if (!isset($_GET['school'])) {
            $courses=$a->getStudentsCourses($_SESSION['studentid']);
            foreach ($courses as $course) {
                if ($course['courseid']==$coursechecked) {
                    return "checked";
                }
            }
        }
    }
    public function insertStudentsCourses()
    {
        $a=new BL();
        $a->erasestudentsCourses($_SESSION['studentid']);
            
        if (!empty($_POST['courses'])) {
            foreach ($_POST['courses'] as $course) {
                if (isset($course)) {
                    $a->insertCourseToStudentList($_SESSION['studentid'], $course);
                }
            }
        }
    }
    public function deleteCourse()
    {
        $a=new BL();
        $a->deleteCourse();
    }
        
    public function uploadProfilePic()
    {
        $file=$_FILES['imgfile'];
        $fileName=$_FILES['imgfile']['name'];
        $filetmp=$_FILES['imgfile']['tmp_name'];
        $tmpName = $_FILES['imgfile']['tmp_name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if (file_exists("../images/check.$ext")) {
            chmod("../images/check.$ext", 0755); //Change the file permissions if allowed
                //unlink("../images/check.$ext"); //remove the file
        }

        move_uploaded_file($_FILES['imgfile']['tmp_name'], "../images/check.$ext");
        //$fileDestination="../images/profilepic".$_SESSION['studentid'].".".$ext;
            
         
        list($width, $height, $type, $attr) = getimagesize("../images/check.$ext");

        if ($width>2000 || $height>2000) {
            echo "exceeded image dimension limits.";
            return;
        }
        
        $a=new BL();
        
        if (isset($_POST['updateuser'])) {
            $fileDestination="../images/usersprofilepic".$_SESSION['userid'].".".$ext;
            $a->insertProfilepicUserName($fileDestination, $_SESSION['userid']);
            copy("../images/check.$ext", $fileDestination);
        } else {
            $fileDestination="../images/profilepic".$_SESSION['studentid'].".".$ext;
            $a->insertProfilepicName($fileDestination, $_SESSION['studentid']);
        }
        copy("../images/check.$ext", $fileDestination);
             
             
       
        return $fileDestination;
    }
   
    public function insertProfilePic($studentId)
    {
        $a=new BL();
        $studentArray=$this->getLastStudentDetails();
        $file=$_FILES['imgfile'];
        $fileName=$_FILES['imgfile']['name'];
        $filetmp=$_FILES['imgfile']['tmp_name'];
        $tmpName = $_FILES['imgfile']['tmp_name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if (isset($_POST['adduser'])) {
            $destination="../images/usersprofilepic".$studentId.".".$ext;
        } else {
            $destination="../images/profilepic".$studentId.".".$ext;
        }
        move_uploaded_file($_FILES['imgfile']['tmp_name'], $destination);
        //move_uploaded_file($_FILES['imgfile']['tmp_name'], "../images/profilepic.$_SESSION['studentid']$ext.");
            
        if (isset($_POST['adduser'])) {
            $a->insertProfilepicUserName($destination, $studentId);
        } else {
            $a->insertProfilepicName($destination, $studentId);
        }
        //return $destination;
    }
}
