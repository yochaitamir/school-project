<?php
        include_once "../view/classes.php";
        include_once "maincontroller.php";
        class Router extends ListsController
        {
            public function mainContainerRouter()
            {
                if (isset($_GET['school'])&&$_GET['school']=='studentdetails'&&!isset($_post['editstudent'])) {
                    $a=new MainController();
                    $a->getStudentDetails();
                
                    $this->studentDetails();
                    $_SESSION['studentid']=$_GET['studentid'];
                    $_SESSION['studentname']=$_GET['studentname'];
                } elseif (isset($_GET['school'])&&($_GET['school']=='addstudent'&&!isset($_POST['add']))) {
                    $this->studentEditForm();
                } elseif ((isset($_GET['school'])&&$_GET['school']=="displayNewStudent")) {
                    $this->studentDetails();
                } elseif (isset($_POST['add'])) {
                    $a=new MainController();
                    $a->createStudent();
                    
                    $studentArray=$a->getLastStudentDetails();
                        
                    $a->insertStudentsCourses();
                    $a->insertProfilePic($studentArray['0']);
                        
                    header("Location: ../view/schoolview.php?school=displayNewStudent&studentid=".$studentArray['0']."&studentname=".$studentArray['1']."'");
                } elseif (isset($_POST['updatstudent'])) {
                    $a=new MainController();
                    
                    $a->updateStudent();
                    $a->insertStudentsCourses();
                    if (isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])) {
                        $a->uploadProfilePic();
                    }
                    header("Location: ../view/schoolview.php?school=studentdetails&studentid=". $_SESSION['studentid']."&studentname=".$_SESSION['studentname']."'");
                } elseif (isset($_GET['editstudent'])&&!isset($_POST['delete'])) {
                    $this->studentEditForm();
                    $a=new MainController();
                    // $this->studentDetails();
                    // $a->updateStudent();
                    // $a->insertStudentsCourses();
                    if (isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])) {
                        $a->uploadProfilePic();
                    }
                } elseif (isset($_POST['affirming'])) {
                    $a=new MainController();
                    $studentId=$_SESSION['studentid'];
                    $a->deleteStudent($studentId);
                    $profilepic="../images/profilepic".$studentId."*";
                    $profilepicinfo=glob($profilepic);
                    $ext = pathinfo($profilepicinfo['0'], PATHINFO_EXTENSION);
                    $file="../images/profilepic".$studentId.".".$ext;
                    unlink($file);
                    $this->affirmingDelete($_GET['studentid']);
                    header("Location: ../view/schoolview.php?school=school&studentid=".$_GET['studentId']);
                } elseif (isset($_POST['delete'])) {
                    echo "delete";
                    //$studentId=$_GET['studentid'];
                    //         $_SESSION['studentid']=$_GET['studentid'];
                        
                    // $_SESSION['studentname']=$_GET['studentname'];
                        
                    header("Location: ../view/schoolview.php?school=school&studentid=".$_SESSION['studentid']."&delete=delete&studentname=".$_SESSION['studentname']."'");
                } elseif (isset($_POST['cancel'])) {
                    echo "caNCEL";
                    //         $this->studentDetails();
                    // $_SESSION['studentid']=$_GET['studentid'];
                    // $_SESSION['studentname']=$_GET['studentname'];
                        
                        
                    header("Location: ../view/schoolview.php?school=school&cancel=cancel&studentid=".$_SESSION['studentid']);
                } elseif (isset($_GET['delete'])) {
                    $this->affirmingDelete($_SESSION['studentid']);
                } elseif (isset($_GET['cancel'])) {
                    $this->studentDetails($_SESSION['studentid']);
                } elseif (isset($_GET['school'])&&isset($_GET['course'])&&$_GET['school']=='school'&&$_GET['course']=='addcourse'&&!isset($_POST['coursecreate'])) {
                    $this->editCourse();
                } elseif (isset($_POST['coursecreate'])) {
                    $_SESSION['coursename']=$_POST['coursename'];
                    $_SESSION['coursedesc']=$_POST['coursedesc'];
                    $a=new MainController();
                    $a->getLastcourseDetails();
                    $a->insertNewCourse();
                        
                    header("Location: ../view/schoolview.php?school=displaynewcourse&courseid=".$_SESSION['courseid']);
                } elseif (isset($_GET['school'])&&$_GET['school']=='displaynewcourse'&&!isset($_POST['editcourse'])) {
                    $a=new MainController();
                    $a->getLastcourseDetails();
                    $this->courseDetails();
                } elseif (isset($_GET['school'])&&$_GET['school']=='coursedetails'&&!isset($_POST['editcourse'])) {
                    $_SESSION['courseid']=$_GET['courseid'];
                    $this->courseDetails();
                } elseif (isset($_POST['editcourse'])&&!isset($_POST['coursesave'])) {
                    echo "update15";
                    header("Location: ../view/schoolview.php?school=editcourse&courseid=".$_SESSION['courseid']);
                } elseif (isset($_GET['school'])&&$_GET['school']=='editcourse'&&!isset($_POST['coursesave'])&&!isset($_POST['coursedelete'])) {
                    $this->editCourse();
                } elseif (isset($_POST['coursesave'])) {
                    $a=new MainController();
                    $a->updateCourseValues();
                        
                    header("Location: ../view/schoolview.php?school=displayupdatedcourse&courseid=".$_SESSION['courseid']);
                } elseif (isset($_GET['school'])&&$_GET['school']=='displayupdatedcourse') {
                    echo 'update18';
                    $this->courseDetails();
                } elseif (isset($_POST['coursedelete'])) {
                    $a=new MainController();
                        
                        
                    header("Location: ../view/schoolview.php?school=deletecourse&courseid=".$_SESSION['courseid']);
                } elseif (isset($_GET['school'])&&$_GET['school']=='deletecourse'&&!isset($_POST['deletecourse'])&&!isset($_POST['deletecancel'])) {
                    $this->affirmingdeletecourse();
                } elseif (isset($_POST['deletecourse'])) {
                    $a=new MainController();
                    $a->deleteCourse();
                    header("Location: ../view/schoolview.php?school=affirmdelete&courseid=".$_SESSION['courseid']);
                } elseif (isset($_GET['school'])&&$_GET['school']=='affirmdelete') {
                    $a=new MainController();
                } elseif (isset($_POST['deletecancel'])) {
                    header("Location: ../view/schoolview.php?school=editcourse&courseid=".$_SESSION['courseid']);
                }
            }
        }
