<?php
$title='Delete Student Information';
require("header.php");
if (isset($_GET["pkey"]) && is_numeric($_GET["pkey"]) ) {
$showData="SELECT * FROM students WHERE pkey={$_GET["pkey"]}";
$r=@mysqli_query($dbc,$showData);
$row = mysqli_fetch_array($r);
print"<div class='greeting'>Hello, ".$_SESSION['user']."
| <span><a href='logout.php?logout=true'>Sign Out</a><span>
<br><a class='forgot'href='forgot.php' style=''> Change your password?</a></div>".'
<h1>
Delete Student Information</h1><form action="delete.php" method="post">
		<p style="font-size:1.5em;">Are you sure you want to delete this information?</p>
            <table> 
      <tr> 

      <td>Student Name</td> 
      <td>Number Grade</td> 
      <td>Letter Grade</td> 
      <td>Start Date</td>
      <td>Completion Date</td>
      <td>Days in Class</td>
      </tr>
      <tr>

            <td>'.$row["name"].'</td>
            <td>'.$row["grade"].'</td>
            <td>'.$row["letter"].'</td>
            <td>'.$row["sDate"].'</td>';
            if ($row["cDate"]=='0000-00-00'){
                print'<td>N/A</td>';
            }else {print "<td>{$row["cDate"]}</td>";
          }
           print'<td>'.$row["daysClass"].'</td>
            </tr>
            </table>
		<input type="hidden" name="pkey" value="' . $_GET["pkey"] . '"> 
        <br>
		<button type="submit"class="myButton" name="submit" >Delete Information!</button>
            <a href=\'home.php?delete=false&login=false&add=false&update=false\'>Cancel</a>

		</form>';
}else if(isset($_POST["pkey"]) && is_numeric($_POST["pkey"])) {
$_SESSION['count']=$_SESSION['count']-1;
$deleteData= "DELETE FROM students WHERE pkey={$_POST["pkey"]} LIMIT 1";
@mysqli_query($dbc,$deleteData);
      print"<script>location.href='home.php?delete=true&login=false&add=false&update=false';
     
      </script>";
}

mysqli_close($dbc);
require 'footer.php';
?>