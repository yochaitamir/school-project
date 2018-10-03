<?php
include_once "../data/data.php";
include_once "../view/adminclasses.php";
include_once "../view/adminview.php";
include_once "maincontroller.php";

 class AdminRouter
 {
     public function Router()
     {
         if (isset($_GET['userdetails'])&&!isset($_POST['updateuser'])) {
             $a=new AdminForm();
             $a->userDetails();
         }
         if (isset($_GET['editadmin'])) {
             $a=new AdminForm();
             $a->userDetails();
         }

         if (isset($_GET['edituser'])&&$_GET['edituser']!='adduser'&&$_GET['edituser']!='deleteuser'&&!isset($_POST['updateuser'])&&!isset($_POST['deleteuser'])) {
             $a=new AdminForm();
             $a->editForm();
         } elseif (isset($_POST['updateuser'])&&$_POST['updateuser']=='save') {
             $a=new Admincontroller();
             $a->updateUser();
             $b=new MainController();
             if (isset($_FILES['imgfile'])&&!empty($_FILES['imgfile']['name'])) {
                 $b->uploadProfilePic();
             }

             header("Location: ../view/adminview.php?userdetails=details&userid=".$_SESSION['userid']);
         } elseif (isset($_POST['adduser'])) {

             $a=new Admincontroller();
             if($a->checkUserEmail()=='1'){
              
              header("Location: ../view/adminview.php?user=exists");
              
             }else{
                 $a->insertUser();
                 $b=$a->getLastUser();
                 foreach ($b as $lastuserid) {
                     echo $lastuserid['id'];
                 }
                
             
                 $b=new MainController();
                 $b->insertProfilePic($lastuserid['id']);
                 header("Location: ../view/adminview.php?userdetails=details&userid=".$lastuserid['id']);
             }} elseif (isset($_GET['admin'])&&$_GET['admin']=='addadmin') {
             $a=new AdminForm();
             $a->editForm();
         } elseif (isset($_POST['deleteuser'])) {
             header("Location: ../view/adminview.php?edituser=deleteuser");
         } elseif (isset($_POST['affirmingdeleteuser'])) {
             echo $_SESSION['role'];
             if ($_SESSION['role']=='manager'&&$_SESSION['rolename']=='sales') {
                 $a=new Admincontroller();
                 $a->deleteUser();
                 $b=new Admincontroller();
             
                 $b->deleteProfilePic();
                 header("Location: ../view/adminview.php");
             } elseif ($_SESSION['role']=='owner'&&($_SESSION['rolename']=='sales'||$_SESSION['rolename']=='manager')) {
                 $a=new Admincontroller();
                 $a->deleteUser();
                 $b=new Admincontroller();
                 $b->deleteProfilePic();
                 header("Location: ../view/adminview.php");
             } else {
                 header("Location: ../view/adminview.php?edituser=edit");
             }
         } elseif (isset($_POST['canceldeleteuser'])) {
             header("Location: ../view/adminview.php?edituser=edit");
         } elseif (isset($_GET['edituser'])&&$_GET['edituser']=='deleteuser') {
             $a=new AdminForm();
             $a->affirmingDeleteUser();
         }
         elseif(isset($_GET['user'])){
             echo "user by this name already exists";
         }
     }
 }
