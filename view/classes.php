<?php
include_once "header.php";
include_once "../controller/maincontroller.php";
include_once "../data/bl.php";


class ListsController{
    private $studentId;
    function __construct(){
        
        if(isset($_POST['updatstudent'])&&isset($_GET['editstudent'])){
            echo "some"; 
            $a=new MainController();
            
            $a->updateStudent();
            $a->insertStudentsCourses();
            if(isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])){
            $a->uploadProfilePic();
            }
            header("Location: ../view/schoolview.php?school=studentdetails&studentid=". $_SESSION['studentid']."&studentname=".$_SESSION['studentname']."'");
    }
            if(isset($_POST['add'])){
                $a=new MainController();
               $a->createStudent(); 
                $studentArray=$a->getLastStudentDetails();
               
                $a->insertStudentsCourses();
                $a->insertProfilePic($studentArray['0']);
                header("Location: ../view/schoolview.php?school=displayNewStudent&studentid=".$studentArray['0']."&studentname=".$studentArray['1']."'");
                
            }
        
    }
    
    
    
    
    function courseLists(){
        if(isset($_GET['school'])||isset($_GET['editstudent'])){
            $a=new MainController();
            foreach($a->courseList() as $courses){
                echo "<a href=../view/schoolview.php?school=coursedetails&courseid=".$courses['courseid']."&coursename=".$courses['coursename'].">".$courses['coursename']."</a><br>";
            
                    }
                    }
        
        
                }
    function studentList(){
        if(isset($_GET['school'])||isset($_GET['editstudent'])){
            $a=new MainController();
            foreach($a->studentsList() as $student){
                echo "<a href=../view/schoolview.php?school=studentdetails&studentid=".$student['ID']."&studentname=".$student['studentname'].">".$student['studentname']."</a><br>";
            
                    }
            
                    }
        
                }
                
            function studentDetails(){
                
                echo "<p class='top'>student</p>
                 
                <form class='floatright' method='GET' action=''>
                <input  type=submit name=editstudent value=edit>
                </form>
               
                <hr>
                ";
                
                $a=new BL();
                $stu=$a->getStudentDetail($_SESSION['studentid']);
                foreach($stu as $requestedStudent){
                    $studentsimg=$requestedStudent['profilepic'];
                    echo '
                    <img class="floatleft thumb-image"  src="../images/'.$studentsimg.'?'.mt_rand().'"><br>';
                    echo "<div class='space'><h3>".$requestedStudent['studentname']."</h3></div><br>";
                    echo "<br>";
                   
                 }
                
                 
               echo "<div class='clear'>";
               echo "<h1>Courses</h1>";
               if(isset($_GET['studentid'])){
                 $b=new MainController();
                $b->getStudentsCourses();
               }}
               function studentEditForm(){
                   $a=new MainController();
                   $studentdetails=$a->getStudentDetails();
                   
                   echo "<div>Edit Student";
                   echo '<form class="top1" action="" method="POST" enctype="multipart/form-data">
                        <label>Student id</label>
                        <input type=text name=studentsid value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['0'];}
                        echo'" required><br><label>Student name</label>';
                       
                        echo '<input type=text name=studentsName value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['1'];}
                        echo '" required><br><label>Student phone</label>';
                        echo '<input type=number name=studentsPhone value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['2'];}
                        echo '" required><br><label>Student email</label>';
                        echo '<input type=text name=studentsemail value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['3'];}
                        echo '" required><br>';
                        echo '<div id="wrapper" style="margin-top: 20px;">';
                        echo '<input id="fileUpload"  type="file" name="imgfile"'; if(!isset($_GET['editstudent'])){echo 'required';}echo '><br>';
                        
                        echo '<div id="image-holder"></div><br>';
                        echo '</div>';
                        echo '<div class=clear>';
                        foreach($a->courseList() as $courses){
                            echo '<input type="checkbox" name="courses[]" value="'.$courses['courseid'].'" '.$a->isChecked($courses['courseid']).'><label>'.$courses['coursename'].'<br>';
                        }
                        echo '</div>';
                        if(!isset($_GET['editstudent'])){
                            echo '<input type=submit name=delete value=delete>';
                        }
                        if(isset($_GET['editstudent'])){
                        echo '<input type="submit" name="updatstudent" value="save">';
                        }else{
                            echo '<input type="submit" name="add" value="add">' ;  
                        }
                        
                        echo '</form>';
                        echo   "</div>";

               }
               
               
               

               
               
               
               //echo "</div>";

                
                
                
                
                
                
                
                
                
                
                
            }
            $test=new ListsController();
        
        ?>