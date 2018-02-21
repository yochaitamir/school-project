<?php
include_once "../data/data.php";
include_once "../view/adminclasses.php";
include_once "../view/adminview.php"; 
include_once "maincontroller.php";

 class AdminRouter{
     
      function Router(){
          if(isset($_GET['userdetails'])&&!isset($_POST['updateuser'])){
              echo "update1";
              $a=new AdminForm();
              $a->userDetails();
              //header("Location: ../view/adminview.php/?editadmin=edit&userid=".$_SESSION['userid']);
          }
          if(isset($_GET['editadmin'])){
            echo "update2";
            $a=new AdminForm();
            $a->userDetails();
          }

        if(isset($_GET['edituser'])&&$_GET['edituser']!='adduser'&&!isset($_POST['updateuser'])&&!isset($_POST['deleteuser'])){
            echo "update3";
            $a=new AdminForm();
            $a->editForm();
            
           
            
            
        }
        elseif(isset($_POST['updateuser'])&&$_POST['updateuser']=='save'){
            echo "update4";
            $a=new Admincontroller();
            $a->updateUser();
            $b=new MainController();
            if(isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])){
            $b->uploadProfilePic();
            }

            header("Location: ../view/adminview.php?userdetails=details&userid=".$_SESSION['userid']);
           
            
        }
        elseif(isset($_POST['adduser'])){
           echo "in";
            $a=new Admincontroller();
            $a->insertUser();
            $b=$a->getLastUser();
            foreach($b as $lastuserid){
                echo $lastuserid['id'];
            }
            $b=new MainController();
            $b->insertProfilePic($lastuserid['id']);
            header("Location: ../view/adminview.php?userdetails=details&userid=".$lastuserid['id']);
           
            
        }
        elseif(isset($_GET['admin'])&&$_GET['admin']=='addadmin'){
            echo "som";
            $a=new AdminForm();
            $a->editForm();
           
            
            
        }
        elseif(isset($_POST['deleteuser'])){
            echo $_SESSION['role'];
            if($_SESSION['role']=='manager'&&$_POST['role']=='sales'){
            $a=new Admincontroller();
            $a->deleteUser();
            header("Location: ../view/adminview.php");
            }
            elseif
                    ($_SESSION['role']=='owner'&&($_POST['role']=='sales'||$_POST['role']=='manager')){
                    $a=new Admincontroller();
                    $a->deleteUser();
                    header("Location: ../view/adminview.php");
                }
                else{
                    echo 'update';
                    header("Location: ../view/adminview.php?edituser=edit");
                }
            }
            

        
        




      }
      







 }
 




?>