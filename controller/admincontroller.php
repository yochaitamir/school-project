<?php
include_once "../data/bl.php";
class Admincontroller{
     function adminList(){
         $a=new BL();
         $adminList=$a->adminList();
         foreach($adminList as $user){
             //$_SESSION['userid']=$user['id'];
             echo '<a href="./adminview.php?userdetails=userupdate&userid='.$user['id'].'">'.$user['username'].'</a><br>';
         }
    }
     function getUser(){
        $a= new BL();
        $user= $a->getUser();
        
        
        return $user;
    }
     function getLastUser(){
        $a= new BL();
        $user=$a->getLastUser();
        return $user;
     }
     function updateUser(){
        $a= new BL();
        $a->updateUser();
        
}
function insertUser(){
    echo "some";
    $a=new BL();
    $a->insertUser();
}
function deleteUser(){
    $a=new BL();
    $a->deleteUser();
}




}





?>