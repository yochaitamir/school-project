<?php
include_once "../data/bl.php";
session_start();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assets/main.css" >
    <title>Document</title>
</head>
<body>
<div>
<img src="../images/images.jpg" width=200px height=150px>
<hr>
<form class="login" action="" method="POST">
<label>username</label>
<input type="text" name="name"><br><br>
<label>password</label>
<input type="password" name="password"><br><br>
<input class="submtbutton" type="submit" name="loginsubmit" value="login">
</form>
</div>
    
</body>
</html>
<?php
if (isset($_POST['loginsubmit'])) {
    $userName=$_POST['name'];
    $password=$_POST['password'];
    $bl= new BL();
    $bl->login($userName, $password);
}


?>