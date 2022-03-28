<?php
$title = "Register";
require 'header.php';
if (!$_POST){
    require 'forms/registerform.php';
}else{
$email= $_POST['email'];
$username= $_POST['username'];
$password= $_POST['password'];
$confirmPass=$_POST['confirmPass'];
if ($confirmPass!=$password){
print"<div class=\"alert alert-success success\" style='background-color:red;color:white;margin-left:35%;margin-top:3%;width:30%; position:absolute;' >
Passwords do not match!
  </div> ";
require 'forms/registerform.php';
}else{
$insertData="Insert Into user (username, password, email)Values ('$username',md5('$password'),'$email')";
@mysqli_query($dbc,$insertData);
print"<script>location.href='login.php?register=true&forgot=false'</script>";
}
}
require 'footer.php';
?>