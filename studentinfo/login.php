<?php
$title = "Sign In";
require 'header.php';
if($_POST){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$getData="SELECT * FROM `user` WHERE username = '".$username."'";
	$result= $dbc->query($getData)->fetch_array();
	$pass=$result['password']; 
	if($pass==md5($password)){
	$_SESSION['user']=$username;
	}
	else{
		print"<div class=\"alert alert-success success\" style='background-color:red;color:white;margin-left:35%;margin-top:2%;width:30%; position:absolute;' >
        Please provide valid credentials!
      </div> ";
	}
	}
	
	if(isset($_SESSION['user'])){

	print"
	
	<script>
	location.href='home.php?delete=false&login=true&add=false&update=false';
	</script>
	
	</a></div>";
	}else{	


if($_GET){
			if ($_GET['register']==='true'){
				print"<div class=\"alert alert-success success\" style='color:white;margin-left:35%;margin-top:3%;width:30%;background-color:green; position:absolute;' >
			Registration Successful!
			  </div> ";
			  }
			  if ($_GET['forgot']==='true'){
				print"<div class=\"alert alert-success success\" style='color:white;margin-left:35%;margin-top:3%;width:30%;background-color:green; position:absolute;' >
			Password Changed!
			  </div> ";
			  }

			}

		require "forms/loginform.php";

	
}
	require 'footer.php';

?>


