<?php

//include_once "header.php";
include_once "../controller/maincontroller.php";
include_once "../data/bl.php";
include_once "header.php";

class ListsController{
    private $studentId;
    function __construct(){
        
        
        
    }
    
    
    
    
    
    
    
    
                
            function studentDetails(){
                
                echo "<div class=titlebox><h1 class='top '>student</h1>
                 
                <form class='floatright' method='GET' action=''>
                <input  type=submit name=editstudent value=edit>
                </form>
               </div>
                <hr>
                ";
                
                $a=new BL();
                $stu=$a->getStudentDetail($_GET['studentid']);
                foreach($stu as $requestedStudent){
                    $studentsimg=$requestedStudent['profilepic'];
                    echo '
                    <img class="floatleft profilepic"  src="../images/'.$studentsimg.'?'.mt_rand().'"><br>';
                    echo "<div class='space'>Students Name:  ".$requestedStudent['studentname']."<br>
                        Students Phone:  ".$requestedStudent['phone']."<br>
                        Students Email:  ".$requestedStudent['email']."<br></div><br>";
                    echo "<br>";
                   
                 }
                
                 
               echo "<div class='clear center'>";
               echo "<h5 class=courselist>Courses</h5>";
               if(isset($_GET['studentid'])){
                 $b=new MainController();
                $b->getStudentsCourses();
               }}
               function studentEditForm(){
                   $a=new MainController();
                   if(!isset($_GET['school'])){
                   $studentdetails=$a->getStudentDetails();
                   }
                   echo "<div >Edit Student";
                   echo '<form  class="topformtest" action="" method="POST" enctype="multipart/form-data">
                   <br><br><div class=labelwidth><label>Student id</label></div>
                        <input type=text name=studentsid value="';
                        
                        if(isset($_GET['editstudent'])){echo $studentdetails['0'];}
                        echo'" required><br><br><div class=labelwidth><label>Student name</label></div>';
                       
                        echo '<input type=text name=studentsName value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['1'];}
                        echo '" required><br><br><div class=labelwidth><label>Student phone</label></div>';
                        echo '<input type=number name=studentsPhone value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['2'];}
                        echo '" required><br><br><div class=labelwidth><label>Student email</label></div>';
                        echo '<input type=text name=studentsemail value="';
                        if(isset($_GET['editstudent'])){echo $studentdetails['3'];}
                        echo '" required><br><br>';
                        echo '<div class="clear "><div class=" floatleft checkboxcontainer">';
                        foreach($a->courseList() as $courses){
                            echo '<input type="checkbox" name="courses[]" value="'.$courses['ID'].'" '.$a->isChecked($courses['ID']).'><label>'.$courses['coursename'].'<br>';
                        }
                        echo '</div>';
                        echo '<div id="wrapper">';
                        echo '<input  id="fileUpload"  type="file" name="imgfile"'; if(!isset($_GET['editstudent'])){echo 'required';}echo '><br>';
                        
                        echo '<div  id="image-holder"></div><br>';
                        echo '</div>';
                        
                        
                        if(isset($_GET['editstudent'])){
                        echo '<div class=clear><input type="submit" name="updatstudent" value="save">';
                        echo '<input type=submit name="delete" value=delete>';
                        }else{
                            echo '<div class=clear><input type="submit" name="add" value="add"></div>' ;  
                        }
                        
                        
                        echo '</form>';
                        echo   "</div>";

               }
               function affirmingDelete($student){
                   echo 'are you sure you want to delete student '.$student;
                   echo '<form action="" method="POST">';
                   echo  '<input type="submit" name="affirming" value="delete">';
                   echo '<input type=submit name="cancel" value="cancel">';
                   echo '</form>';
               }
               //course
               function courseDetails(){
                   $a=new MainController();
                   $course=$a->getCourseDetails();
                foreach($course as $requestedcourse){
                    echo "<div class=titlebox><h1 class='top'>course</h1>
                 
                <form class='floatright ' method='POST' action=''>
                <input  type=submit name=editcourse value=edit>
                </form></div>
               
                <hr>";
                    echo '<div class=maincontainer1>';
                    echo 'Course ID:  '.$requestedcourse['ID']."<br><br>";
                    echo  'Course Name:  '.$requestedcourse['coursename']."<br><br>";
                    echo 'Course Description:  '.$requestedcourse['description']."<br><br>";
                    echo '</div>';
                 }
                 


               }
               function editCourse(){
                   $a=new MainController();
                if(isset($_GET['school'])&&$_GET['school']=='editcourse'){
                    $courses=$a->getCourseDetails();
                    foreach($courses as $course){
                        $course=$course;
                    }
                }
                echo "<div>Edit Course";
                echo '<form class="topformtest" action="" method="POST">
                     <br><div class=labelwidth><label>course id</label></div>
                     <input type=text name=courseid value=>';
                     echo '<br><br>
                     <div class=labelwidth><label>course name</label></div>
                     <input type=text name=coursename value="'; if(isset($_GET['school'])&&$_GET['school']=='editcourse'){
                         echo $course['coursename'];} echo '"><br><br>
                     <div class=labelwidth><label>course description</label></div>
                     <textarea type=text name=coursedesc>'; if(isset($_GET['school'])&&$_GET['school']=='editcourse'){
                        echo $course['description'];} echo '</textarea><br>';
                        if(isset($_GET['course'])&&$_GET['course']=='addcourse'){echo '
                     <input type=submit name=coursecreate value=add>';}
                       if(isset($_GET['school'])&&$_GET['school']=='editcourse'){
                         echo '<input type=submit name=coursesave value=save>';
                         echo '<input type=submit name=coursedelete value=delete>';} 
                    echo '</form>';
                    }
                    function affirmingdeletecourse(){
                            echo 'are you sure you want to delete course:';$_SESSION['courseid']; 
                            echo '<form method=post action="">
                            <input type=submit name=deletecourse value="delete">
                            <input type=submit name=deletecancel value="cancel">';

                    }
               
        }
        // ;if(isset($_POST['editcourse'])){
        //     echo $course['courseid'];
        // }
            
            
           
        
        ?>