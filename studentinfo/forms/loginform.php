<?php

print'
<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<a href="demo.php">(Click here to skip login)<br>(username=demo, password=demo)</a>

			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
					<div style=\'background-color:red;color:white;position: absolute;\'id=\'myAlert\' class=\'alert alert-danger collapse\'>
					Error! Please provide valid credentials! </div>
		      	<h1 class="mb-4 text-center" style="padding-top:15%;">Please Sign In</h1>
		      	<form action="login.php" class="signin-form" method="POST">
				  <div class="errorLogin"></div>
		      		<div class="form-group">
					  <label for="username">Username</label>
		      			<input type="text" id="username" name="username" class="form-control myLoginInput" value="';
						  if (isset($_POST['username'])){
							  echo $_POST['username'];
							}
						  print'"  required>
		      		</div>
	            <div class="form-group">
				<label for="password">Password</label>
	              <input id="password-field" type="password" name="password" class="form-control myLoginInput"  required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btnSubmit px-3 myButton">Sign In</button><a style="padding-left:3%;" href=\'index.php\'>Cancel</a>
	            </div>
				<a href="register.php">Create an account</a><br><br>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>';

?>