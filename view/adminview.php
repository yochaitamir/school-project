<?php
include_once "header.php";
include_once "../controller/admincontroller.php";
include_once "../controller/adminrouter.php";
if (!isset($_SESSION['role'])) {
    header("Location: ../view/index.php");
    return;
} elseif (isset($_SESSION['role'])&&$_SESSION['role']=='sales') {
    header('Location: ../view/schoolview.php?school=school');
    return;
}
?>
<div class=addbuttons>
                <label>Admin</label>
                <a href="../view/adminview.php?edituser=adduser&admin=addadmin">+</a>
            </div><br>
<div id=adminlist>

<?php 
function adminList()
{
    $a=new Admincontroller();
    $a->adminList();
}
adminList()
?>



</div>
<div class=maincontainer>

    <?php

    function mainContainerAdmin()
    {
        $a=new AdminRouter();
        $a->Router();
    }
    mainContainerAdmin();
?>
    </div>