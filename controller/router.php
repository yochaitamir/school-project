<?php
        include_once "../view/classes.php";
        include_once "maincontroller.php";
        class Router extends ListsController{
            function mainContainerRouter(){
                
            if(isset($_GET['school'])&&$_GET['school']=='studentdetails'&&!isset($_post['editstudent'])){
                
                $a=new MainController();
                $a->getStudentDetails();
                //$b=new ListsController();  
                $this->studentDetails();
                $_SESSION['studentid']=$_GET['studentid'];
                $_SESSION['studentname']=$_GET['studentname'];
                
                } 
                // elseif(isset($_GET['studentid'])){
                //  }
                elseif (isset($_GET['school'])&&($_GET['school']=='addstudent'&&!isset($_POST['add']))){
                    echo "update3";
                    //$b=new ListsController();
                    $this->studentEditForm();
                }

                elseif ((isset($_GET['school'])&&$_GET['school']=="displayNewStudent")){
                    echo "updat4e";
                //$b=new ListsController();
                    
                $this->studentDetails();

                }
                elseif(isset($_POST['add'])){
                    echo "update5";
                    $a=new MainController();
                        $a->createStudent(); 
                    
                        $studentArray=$a->getLastStudentDetails();
                        
                        $a->insertStudentsCourses();
                        $a->insertProfilePic($studentArray['0']);
                        
                        header("Location: ../view/schoolview.php?school=displayNewStudent&studentid=".$studentArray['0']."&studentname=".$studentArray['1']."'");
                
                }
                elseif(isset($_POST['updatstudent'])){
                    echo "update6";
            
                    $a=new MainController();
                    //$this->studentDetails();
                    $a->updateStudent();
                    $a->insertStudentsCourses();
                    if(isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])){
                    $a->uploadProfilePic();
                    }
                    header("Location: ../view/schoolview.php?school=studentdetails&studentid=". $_SESSION['studentid']."&studentname=".$_SESSION['studentname']."'");
                }
                elseif (isset($_GET['editstudent'])&&!isset($_POST['delete'])){
                        echo "update7";
                    $this->studentEditForm();
                    $a=new MainController();
                    // $this->studentDetails();
                    // $a->updateStudent();
                    // $a->insertStudentsCourses();
                    if(isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])){
                    $a->uploadProfilePic();
                    }
                // header("Location: ../view/schoolview.php?school=studentdetails&studentid=". $_SESSION['studentid']."&studentname=".$_SESSION['studentname']."'");
                }
                elseif (isset($_POST['affirming'])){
                    echo "update8";
                    $a=new MainController();
                    $studentId=$_GET['studentid'];
                    $a->deleteStudent($studentId);
                    $profilepic="../images/profilepic".$studentId."*";
                    $profilepicinfo=glob($profilepic);
                    $ext = pathinfo($profilepicinfo['0'], PATHINFO_EXTENSION);
                    $file="../images/profilepic".$studentId.".".$ext;
                    unlink($file);
                    $this->affirmingDelete($_GET['studentid']);
                    header("Location: ../view/schoolview.php?school=school&studentid=".$_GET['studentId']);
                    }
                    elseif(isset($_POST['delete'])){
                        $studentId=$_POST['studentsid'];
                        $_SESSION['studentid']=$_GET['studentid'];
                $_SESSION['studentname']=$_GET['studentname'];
                        //$this->studentEditForm();
                        header("Location: ../view/schoolview.php?school=school&studentid=".$studentId."&delete=delete&studentname=".$_SESSION['studentname']."'");
                        
                    }
                    elseif(isset($_POST['cancel'])){
                        $studentId=$_POST['studentsid'];
                        $this->studentDetails();
                $_SESSION['studentid']=$_GET['studentid'];
                $_SESSION['studentname']=$_GET['studentname'];
                        
                        //$this->studentEditForm();
                        header("Location: ../view/schoolview.php?school=school&cancel=cancel&studentid=".$_SESSION['studentid']);
                        
                    }
                    elseif(isset($_GET['delete'])){
                        $this->affirmingDelete($_GET['studentid']);
                    }
                    elseif(isset($_GET['cancel'])){
                        $this->studentDetails();
                    }
                    //courses
                    elseif(isset($_GET['school'])&&isset($_GET['course'])&&$_GET['school']=='school'&&$_GET['course']=='addcourse'&&!isset($_POST['coursecreate'])){
                       echo "update11";
                        $this->editCourse();                       
                    }
                    
                    elseif(isset($_POST['coursecreate'])){
                        echo "update12";
                        $_SESSION['coursename']=$_POST['coursename'];
                        $_SESSION['coursedesc']=$_POST['coursedesc'];
                        $a=new MainController();
                        $a->getLastcourseDetails();
                        $a->insertNewCourse();
                        
                        header("Location: ../view/schoolview.php?school=displaynewcourse&courseid=".$_SESSION['courseid']); 
                    }
                    elseif($_GET['school']=='displaynewcourse'&&!isset($_POST['editcourse'])){
                        echo "update13";
                        $a=new MainController();
                        $a->getLastcourseDetails();
                        $this->courseDetails();
                    }
                    elseif(isset($_GET['school'])&&$_GET['school']=='coursedetails'&&!isset($_POST['editcourse'])){
                        echo "update14";
                        $_SESSION['courseid']=$_GET['courseid'];
                        $this->courseDetails();
                    }
                    elseif(isset($_POST['editcourse'])&&!isset($_POST['coursesave'])){
                        //$_SESSION['courseid']=$_GET['courseid'];
                        echo "update15";
                        header("Location: ../view/schoolview.php?school=editcourse&courseid=".$_SESSION['courseid']); 

                    }
                    
                    elseif(isset($_GET['school'])&&$_GET['school']=='editcourse'&&!isset($_POST['coursesave'])&&!isset($_POST['coursedelete'])){
                        echo "update16";
                        $this->editCourse();

                    }
                    elseif(isset($_POST['coursesave'])){
                        echo "update17";
                        $a=new MainController();
                        $a->updateCourseValues();
                        
                        header("Location: ../view/schoolview.php?school=displayupdatedcourse&courseid=".$_SESSION['courseid']); 

                    }
                    elseif(isset($_GET['school'])&&$_GET['school']=='displayupdatedcourse'){
                        echo 'update18';
                        $this->courseDetails();
                    }
                    elseif(isset($_POST['coursedelete'])){
                        echo "update19";
                        $a=new MainController();
                        //$a->deleteCourse();
                        
                        header("Location: ../view/schoolview.php?school=deletecourse&courseid=".$_SESSION['courseid']); 

                    }
                    elseif(isset($_GET['school'])&&$_GET['school']=='deletecourse'&&!isset($_POST['deletecourse'])&&!isset($_POST['deletecancel'])){
                        echo "update20";
                        $this->affirmingdeletecourse();
                    }
                    
                    elseif(isset($_POST['deletecourse'])){
                        echo "update21";
                        $a=new MainController();
                        $a->deleteCourse();
                        header("Location: ../view/schoolview.php?school=affirmdelete&courseid=".$_SESSION['courseid']); 
                    }
                    elseif(isset($_GET['school'])&&$_GET['school']=='affirmdelete'){
                        echo "update21";
                        //$a->deleteCourse();
                        
                    }
                    elseif(isset($_POST['deletecancel'])){
                        echo "update21";
                        
                        header("Location: ../view/schoolview.php?school=editcourse&courseid=".$_SESSION['courseid']); 
                    }
                   
                    

}
}
?>