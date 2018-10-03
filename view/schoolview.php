
        <?php 
        include_once "header.php";
        if(!isset($_SESSION['role'])){
            header("Location: ../view/index.php");
            return; 
        }
        ?>
        
        

            <div class=addbuttons>
                <label>Courses</label>
                <?php 
                if($_SESSION['role']!='sales'){
                echo '<a href="../view/schoolview.php?school=school&course=addcourse">+</a>';
                }?>
                </div>
            <div class=addbuttons>
                <label>students</label>
                <a href="../view/schoolview.php?school=addstudent">+</a>
            </div>
                <br>
            </div>
           
        <div class="menu">
            <div class="list" >
                <?php
                function courseLists(){
                    if(isset($_GET['school'])||isset($_GET['editstudent'])){
                        $a=new MainController();
                        foreach($a->courseList() as $courses){
                            echo "<a href=../view/schoolview.php?school=coursedetails&courseid=".$courses['ID']."&coursename=".$courses['coursename'].">".$courses['coursename']."</a><br>";
                        
                                }
                                }
                    
                    
                            }
                // $list=new ListsController();
                courseLists();
                
            ?>
            </div>
            <div class="list">
            <?php
            function studentList(){
                if(isset($_GET['school'])||isset($_GET['editstudent'])){
                    $a=new MainController();
                    foreach($a->studentsList() as $student){
                        echo "<a href=../view/schoolview.php?school=studentdetails&studentid=".$student['ID']."&studentname=".$student['studentname'].">".$student['studentname']."</a><br>";
                    
                            }
                    
                            }
                
                        }
            
                // $list=new ListsController();
               studentList();
            
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