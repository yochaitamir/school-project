<?php
include_once "../data/data.php";
include_once "../controller/adminrouter.php";
include_once "../controller/admincontroller.php";

class AdminForm{
    function __construct(){
        



    }
    function userDetails(){
        echo "<div class=titlebox><h1 class='top '>Admin User</h1>
                 
                <form class='floatright' method='GET' action=''>
                <input  type=submit name=edituser value=edit>
                </form>
               </div>
                <hr>
                ";
                $_SESSION['userid']=$_GET['userid'];
                echo $_SESSION['userid'];
                $a=new Admincontroller();
                $user=$a->getUser();
                foreach($user as $use){
                $use=$use;
                }
                echo 
                    '<img class="floatleft profilepic"  src="../images/'.$use['profilepic'].'?'.mt_rand().'"><br>';
                echo '<div class="space">';
                echo "<h1>username:".$use['username']."</h1>";
                echo "<h1>phone:".$use['userphone']."</h1>";
                echo "<h1>user email:".$use['useremail']."</h1>";
                echo "<h1>role:".$use['rolename']."</h1>";
                $_SESSION['userid']=$use['id'];
                
                echo '</div>';


    }
    function editForm(){
        
        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){
        $a=new Admincontroller();
        $user=$a->getUser();
        foreach($user as $use){
            $use=$use;
            $_SESSION['userid']=$use['id'];
            echo  $_SESSION['userid'];
        }
    }
        
        
        
        echo "<div>Edit User";
                   echo '<form  class="topformtest" action="" method="POST" enctype="multipart/form-data">
                   <br><br><div class=labelwidth><label>User id</label></div>
                        <input type=text name=studentsid value="';
                        
                        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){echo $use['id'];}
                        echo'" required><br><br><div class=labelwidth><label>User name</label></div>';
                       
                        echo '<input type=text name=usersName value="';
                        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){echo $use['username'];}
                        echo '" required><br><br><div class=labelwidth><label>User phone</label></div>';
                        echo '<input type=number name=usersPhone value="';
                        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){echo $use['userphone'];}
                        echo '" required><br><br><div class=labelwidth><label>User email</label></div>';
                        echo '<input type=text name=usersemail value="';
                        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){echo $use['useremail'];}
                        echo '" required><br><br><div class=labelwidth><label>User password</label></div>';
                        echo '<input type=password name=userspassword value="';
                        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){echo $use['password'];}
                        echo '" required><br><br>';
                        if((isset($_GET['edituser'])&&$_GET['edituser']=='adduser')||$_SESSION['role']=='owner'){
                        echo '<div><p>role:</p>';
                       
                        
                        echo '<label>manager </label><input type="radio" name="role" value="manager"'; if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'&&$use['rolename']=='manager'){echo 'checked="checked"';}'><br>';
                        echo '<label>salesman</label><input type="radio" name="role" value="sales"';if($_GET['edituser']!='edit'){echo 'required="required"';} if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'&&$use['rolename']=='sales'){echo 'checked="checked"';}' ><br>';
                        echo '</div><br>';
                        }
                        echo '<div id="wrapper">';
                        echo '<input  id="fileUpload"  type="file" name="imgfile"'; if($_GET['edituser']!='edit'){echo 'required';}echo '><br>';
                        
                        echo '<div  id="image-holder"></div><br>';
                        echo '</div>';
                        
                        
                        if(isset($_GET['edituser'])&&$_GET['edituser']=='edit'){
                           
                        echo '<div class="clear mar"><input type="submit" name="updateuser" value="save">';
                        echo '<input type=submit name="deleteuser" value=delete>';
                        }else{
                            echo '<div class="clear mar"><input type="submit" name="adduser" value="add">' ;  
                        }
                        
                        echo   "</div>";
                        echo '</form>';
                        echo   "</div>";
     }










}







?>