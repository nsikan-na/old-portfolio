<?php
$title = "Home";
require 'header.php';  
$_SESSION['user']='demo';
$updateData="UPDATE `user` SET `password`=md5('demo') WHERE username= 'demo';";
    $dbc->query($updateData);
print'<script> location.href="home.php?delete=false&login=true&add=false&update=false"</script>';
require 'footer.php';
?>
