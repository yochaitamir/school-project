<html>
<head>
<style type="text/css">
.thumb-image{
 float:left;width:100px;
 position:relative;
 padding:5px;
}
</style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<div id="wrapper" style="margin-top: 20px;">
<form method="post" action="" enctype="multipart/form-data">
<input id="fileUpload"  type="file" name="imgfile"/> 
<input type=submit name=upload value="upload">
<form>
<div id="image-holder"></div>
</div>

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
 <?php
 if(isset($_POST['upload'])){
   $file=$_FILES['imgfile'];
   $filetmp=$_FILES['imgfile']['tmp_name'];
   list($width, $height,$path) = getimagesize($filetmp);
   //$extension = image_type_to_extension($path);
   echo $width."<br>";
   echo $height;
   $fileDestination="images/profilepic.jpg";
   move_uploaded_file($filetmp,$fileDestination);
   $ext = pathinfo($fileDestination, PATHINFO_EXTENSION);
   echo $ext."<br>";
   if(file_exists('your-filename.ext')) {
    chmod($fileDestination,0755); //Change the file permissions if allowed
    unlink($fileDestination); //remove the file
}

move_uploaded_file($_FILES['imgfile']['tmp_name'], $fileDestination);
 }
 
 
 ?>
</body>
</html>