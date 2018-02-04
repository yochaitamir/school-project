<?php
include_once "../data/bl.php";
class MainController{



    function __construct(){
      
        
       

    }
    
    function createStudent(){
            
        $a=new BL();
        $a->insertNewStudent();
    }
    function getStudentDetails(){
        $studentArray=[];
        $a=new BL();
        //$a->getStudentDetails($_SESSION['studentid']);
        foreach($a->getStudentDetail($_SESSION['studentid']) as $student){
            array_push($studentArray,$student['ID'],$student['studentname'],$student['phone'],$student['email']);
            
            return $studentArray;

        }
    }
    function rowCount(){
        $a=new BL();
        $a->rowCount(); 
    }
    function getLastStudentDetails(){
         $studentArray=[];
         $a=new BL();
    
         foreach($a->getLastStudentDetails() as $student){
             array_push($studentArray,$student['ID'],$student['studentname']);
             //echo $student['ID'];
             $_SESSION['studentid']=$student['ID'];
                return $studentArray;
         }
     }
    
function  studentsList(){
    $a=new BL();
     return $a->studentsList();
    
    

    }
    function courseList(){
                $a=new BL();
      return    $a-> courseList();  
    }
    
    function getCourseDetails(){
        $a=new BL();
        $stu=$a->getCourseDetail($_GET['courseid']);
        foreach($stu as $requestedStudent){
            echo $requestedStudent['courseid']."<br>";
            echo  $requestedStudent['coursename'];
            
         }
        }
        function getStudentsCourses(){
            $student=$_GET['studentid'];
            $a=new BL();
            foreach($a->getStudentsCourses($student) as $courses){
                echo $courses['courseid']."<br>";
            }
            } 
            function updateStudent(){
                $a=new BL();
                $a->updateStudent();

            }
            function isChecked($coursechecked){
                $a=new BL();
                $courses=$a->getStudentsCourses($_SESSION['studentid']);
                foreach($courses as $course){
                    if($course['courseid']==$coursechecked){
                        return "checked";
                    }

                }
        }
         function insertStudentsCourses(){
            
            $a=new BL();
            $a->erasestudentsCourses($_SESSION['studentid']);
            
            if(!empty($_POST['courses'])){
            foreach($_POST['courses'] as $course){
            if (isset($course)){
                $a->insertCourseToStudentList($_SESSION['studentid'],$course);
                
                }
          }
        }
        }
        
            function uploadProfilePic(){
            $file=$_FILES['imgfile'];
            $fileName=$_FILES['imgfile']['name'];
            $filetmp=$_FILES['imgfile']['tmp_name'];
            $tmpName = $_FILES['imgfile']['tmp_name'];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            if(file_exists("../images/check.$ext")) {
                chmod("../images/check.$ext",0755); //Change the file permissions if allowed
                //unlink("../images/check.$ext"); //remove the file
            }

            move_uploaded_file($_FILES['imgfile']['tmp_name'], "../images/check.$ext");
            //$fileDestination="../images/profilepic".$_SESSION['studentid'].".".$ext;
            
         
            list($width, $height, $type, $attr) = getimagesize("../images/check.$ext"); 

            if($width>1000 || $height>1000) 
            { 
            echo "exceeded image dimension limits.";
            return; 
            } 
            //    //$extension = image_type_to_extension($path);
                //  echo $width."<br>";
                //  echo $height;
            
            //$ext = pathinfo($fileName, PATHINFO_EXTENSION);
             $fileDestination="../images/profilepic".$_SESSION['studentid'].".".$ext;
             copy("../images/check.$ext",$fileDestination);
             $a=new BL();
             $a->insertProfilepicName($fileDestination,$_SESSION['studentid']);
            // echo $ext."<br>";
            // if(file_exists("../images/profilepic".$_SESSION['studentid'].".".$ext)) {
            //     chmod($fileDestination,0755); //Change the file permissions if allowed
            //     unlink($fileDestination); //remove the file
            // }

            // move_uploaded_file("../images/check.$ext", $fileDestination);
            return $fileDestination;
    
}
            function insertProfilePic($studentId){
                $a=new BL();
                $studentArray=$this->getLastStudentDetails();
                $file=$_FILES['imgfile'];
                $fileName=$_FILES['imgfile']['name'];
                $filetmp=$_FILES['imgfile']['tmp_name'];
                $tmpName = $_FILES['imgfile']['tmp_name'];
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $destination='../images/profilepic.'.$studentId.$ext."'";
                move_uploaded_file($_FILES['imgfile']['tmp_name'], $destination);
                //move_uploaded_file($_FILES['imgfile']['tmp_name'], "../images/profilepic.$_SESSION['studentid']$ext.");
                $a->insertProfilepicName($destination,$studentId);
                //return $destination;
            }
        }
 










?>