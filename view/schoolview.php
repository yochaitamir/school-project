
        <?php
        include_once "header.php";
        ?>
        
        <form method="get" action="../view/schoolview.php">

            <div class=addbuttons>
                <label>Courses</label>
                <a href="../view/schoolview.php?school=school">+</a>
            </div>
            <div class=addbuttons>
                <label>students</label>
                <a href="../view/schoolview.php?school=addstudent">+</a>
            </div>
                <br>
            </div>
        </form>
        <div class="menu">
            <div class="list">
                <?php
                
                $list=new ListsController();
                $list->courseLists();
                
            ?>
            </div>
            <div class="list">
            <?php
            
                $list=new ListsController();
                $list->studentList();
            
            ?>  

            </div>
        </div>
        <div class="maincontainer">
            
            <?php
          $a= new Router();
          $a->mainContainerRouter();

    





?>




        </div>
        <?php
        include_once "footer.php";
?>