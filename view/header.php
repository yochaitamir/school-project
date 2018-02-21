<?php
session_start();

//include_once "../controller/maincontroller.php";
//include_once "../controller/adminrouter.php";
include_once "../controller/router.php";
      if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['school'])||($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['editstudent']))) {
        $a= new Router();
        $a->mainContainerRouter();
         
        exit;
      }
      elseif ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['edituser'])) {
        include_once "../controller/adminrouter.php";
        $a= new AdminRouter();
        $a->router();
        
        exit;
      }
        
include_once "classes.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="../assets/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <style>
                
         
        
        



        </style>
        
        <title>Document</title>
    </head>

    <body>
    <script>
$(document).ready(function() {
        $("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
      });
</script>
        
        <div class=header>
        <div class="clear logo">
            <img class="floatleft" src="../images/images.jpg" width=200px height=150px>
            <span class="floatleft">|</span>
            <form method="GET" action="">
                <input class="floatleft" type="submit" name="school1" value="school">|
                <?php if($_SESSION['role']=='owner'||$_SESSION['role']=='manager'){echo '<input type="submit" name="administration" value="administration">|';}?>
            </form>
            <div class="right">
                <?php
              echo $_SESSION['user']."   ". $_SESSION['role'];
              if(isset($_GET['logout'])){
              header("Location: ../view/index.php");
              }
              if(isset($_GET['school1'])){
                header("Location: ../view/schoolview.php?school=school");
              }
              if(isset($_GET['administration'])){
              header("Location: ../view/adminview.php");
}
?>
<form method=get action="">
<input type=submit name=logout value=logout>
</form>
</div>
            </div>
        </div>
        <hr>