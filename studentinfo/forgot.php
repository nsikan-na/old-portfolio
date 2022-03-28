<?php
$title='Update Student Information';
require("header.php");

if($_POST){
    $username= $_POST['username'];
    $oldPass= $_POST['oldPass'];
    $newPass= $_POST['newPass'];
    $confirmPass= $_POST['confirmPass'];
    $getData="SELECT * FROM `user` WHERE username = '".$username."'";
    $result= $dbc->query($getData)->fetch_array();
    $pass=$result['password']; 
    if(($pass==md5($oldPass))&&($confirmPass==$newPass)){
    $updateData="UPDATE `user` SET `password`='".md5($newPass)."' WHERE username= '".$username."';";
    $dbc->query($updateData);
    unset($_SESSION['user']);
    print"<script>location.href='login.php?forgot=true&register=false';
    ;
    </script>";
    }else{
    if ($pass!=md5($oldPass)){
        print"<div class=\"alert alert-success success\" style='background-color:red;color:white;margin-left:35%;margin-top:2%;width:30%; position:absolute;' >
        Invalid password!
      </div> ";
    }else{
        print"<div class=\"alert alert-success success\" style='background-color:red;color:white;margin-left:35%;margin-top:2%;width:30%; position:absolute;' >
        New passwords do not match!
      </div> ";
    }
    }
    }
print"<div>(If you skipped the login form, old password: demo)</div><div class='greeting'>Hello, ".$_SESSION['user']."
| <span><a href='logout.php?logout=true'>Sign Out</a><span>
<br></div>";
print"<div class=\"main\">";

print"
<h1> Change Password</h1>
<form action='forgot.php' method='POST' >
<label for='oldPass'>Old Password</label>
<br>
<input id='oldPass' name='oldPass' class=\"form-control myForgotInput\" type='password' required>
<br><br>
<label for='newPass'>New Password</label>
<br>
<input id='newPass' name='newPass'class=\"form-control myForgotInput\" type='password'required>
<br><br>
<label for='confirmPass'>Confirm Password</label>
<br>
<input id='confirmPass'class=\"form-control myForgotInput\" name='confirmPass' type='password' required>
<br><br>
<input hidden name='username' value='".$_SESSION['user']."'>
<button type='submit2' class='myButton' name='submit2'>Change Password</button>
<a href='home.php?delete=false&login=false&add=false&update=false'>Cancel</a>

</form>
";

print"</div>";
require 'footer.php';
?>