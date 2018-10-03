<?php
include_once "../data/bl.php";
class Admincontroller
{
    public function adminList()
    {
        $a=new BL();
        $adminList=$a->adminList();
        foreach ($adminList as $user) {
            //$_SESSION['userid']=$user['id'];
            echo '<a href="./adminview.php?userdetails=userupdate&userid='.$user['id'].'">'.$user['username'].'</a><br>';
        }
    }
    public function getUser()
    {
        $a= new BL();
        $user= $a->getUser();
        
        
        return $user;
    }
    public function getUsers()
    {
        $a= new BL();
        $user= $a->getUsers();
        
        
        return $user;
    }
    public function getLastUser()
    {
        $a= new BL();
        $user=$a->getLastUser();
        return $user;
    }
    public function updateUser()
    {
        $a= new BL();
        $a->updateUser();
    }
    public function checkUserEmail()
    {
        $a= new BL();
        $b=$a->getUsers();
        foreach ($b as $useremail) {
            
            if ($useremail['useremail']==$_POST['usersemail']){
                return '1';
            }

        }
        
        return "0";
    }
    
    public function insertUser()
    {
        $a=new BL();
        $a->insertUser();
    }
    
    public function deleteUser()
    {
        $a=new BL();
        $a->deleteUser();
    }
    public function deleteProfilePic()
    {
        //$a=new BL();
        // $PPic=$a->getProfilePicName();
        $profilepic="../images/usersprofilepic".$_SESSION['userid']."*";
        $profilepicinfo=glob($profilepic);
        $ext = pathinfo($profilepicinfo['0'], PATHINFO_EXTENSION);
        $file="../images/usersprofilepic".$_SESSION['userid'].".".$ext;
        unlink($file);
    }
}
