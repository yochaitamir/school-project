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
        
    
    
    }elseif(isset($_GET['school'])&&$_GET['school']=='coursedetails'){
        $a=new MainController();
        $a->getCourseDetails();
    
    }
    // elseif(isset($_GET['studentid'])){
    //  }
    elseif(isset($_GET['editstudent'])||$_GET['school']=='addstudent'){
        $b=new ListsController();
        $this->studentEditForm();
        
        
    }
    elseif(isset($_GET['school'])&&$_GET['school']=="displayNewStudent"){
    //$b=new ListsController();
        
       $this->studentDetails();

    }

    }
}
?>