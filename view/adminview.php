<?php
include_once "header.php";
include_once "../controller/admincontroller.php";
include_once "../controller/adminrouter.php";
?>
<div class=addbuttons>
                <label>Admin</label>
                <a href="../view/adminview.php?edituser=adduser&admin=addadmin">+</a>
            </div><br>
<div id=adminlist>

<?php 
function adminList(){




$a=new Admincontroller();
    $a->adminList();
}
adminList()
?>



</div>
<div class=maincontainer>

    <?php
    
    function mainContainerAdmin(){
    $a=new AdminRouter();
    $a->Router();
    }
    mainContainerAdmin();
?>
    </div>