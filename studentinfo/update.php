<?php
$title='Update Student Information';
require("header.php");
if (isset($_GET["pkey"]) && is_numeric($_GET["pkey"]) ) {
    $showData="SELECT * FROM students WHERE pkey={$_GET['pkey']}";
$r=@mysqli_query($dbc,$showData);
$row = mysqli_fetch_array($r);

print"<div class='greeting'>Hello, ".$_SESSION['user']."
| <span><a href='logout.php?logout=true'>Sign Out</a><span>
<br><a class='forgot'href='forgot.php' style=''> Change your password?</a></div>".'
<h1 class="header">Update Student Information</h1>
<div class="main">
<form method="POST" action="update.php">

<label for="name">Enter Name</label>
<br>
<input type="text" title="Student Name" name="name" class="form-control myInput" id="name" value="'.$row["name"].'">
<br>
<label for="grade">Enter Number Grade</label>
<br>
<input id="grade" title="Student Grade" min="0" class="form-control myInput" max="100" maxlength="3" name="grade" type="number" value="'.$row["grade"].'">
<br>
<label for="sDate">Enter Start Date</label>
<br>
<input type="date" title="Start Date" id="sDate" class="form-control myInput" name="sDate" value="'.$row["sDate"].'">
<br>
<label for="cDate"> Enter Completion Date</label>
<br>
<input type="date" title="Completion Date" id="cDate"class="form-control myInput" name="cDate" value="'.$row["cDate"].'">
<br>
<input type="hidden" name="pkey" value="' . $_GET["pkey"] . '"> 
<button class="myButton" type="submit" >Update Information</button>
<a href=\'home.php?delete=false&login=false&add=false&update=false\'>Cancel</a>
</form>
</div>
';
}else if(isset($_POST["pkey"]) && is_numeric($_POST["pkey"])) {
$name=($_POST["name"]);
$grade=($_POST["grade"]);
$cDate=($_POST['cDate']);
$sDate=($_POST['sDate']);
$pkey=($_POST['pkey']);
if( empty($name) || is_numeric($name)||(empty($grade)&& $grade != 0) || !is_numeric($grade)||empty($sDate)|| $grade<0 || $grade>100 ||(($cDate<=$sDate)&&($cDate !=''))){
    $error=[];       
    if(empty($name) || is_numeric($name)){
        array_push($error, "Please enter a valid Student Name");
    }
    if((empty($grade)&& $grade != 0) || !is_numeric($grade) || $grade<0 || $grade>100){
        array_push($error, "Please enter a valid Grade.");
    }
    if(empty($sDate)){
        array_push($error, "Please enter a valid Student Start Date.");
    }
    if(($cDate<=$sDate)&&($cDate!='')){
        array_push($error, "Please enter a valid Student Completion Date.");
    }
    if (isset($error)){
    for ($i=0;$i<count($error);$i++){
    print "<div class='error'> $error[$i]</div><br><br>";
    }
    print"<div><a href='update.php?pkey=". $_POST['pkey']."'><button title='Go Back' type='submit' class= 'myButton'>Back</button></a></div>";
}
} else{
if ($cDate==""){
$daysClass="To Be Determined";
}else{
      $sDatetime=$sDate;
    $cDatetime=$cDate;
    $sDatetime = strtotime($sDatetime);
    $cDatetime = strtotime($cDatetime);
    $secs = $cDatetime - $sDatetime;
    $days = $secs / 86400;
    $daysClass=round($days);
        }
$letter;
$aGrade=$grade*1.1;
 if($grade>=90){
        $letter='A';
 }
     else if ($grade>=80){
        $letter='B';
     }
        else if ($grade>=70){
            $letter='C';
        }
            else if ($grade>=60){
                $letter='D';
            }
                else{
                    $letter='F';
                }

$updateData= "Update students SET pkey='$pkey', name='$name',grade='$grade', cDate='$cDate', sDate='$sDate',letter='$letter', daysClass='$daysClass' WHERE pkey= '{$_POST['pkey']}'";
@mysqli_query($dbc,$updateData);
      print"<script>location.href='home.php?delete=false&login=false&add=false&update=true';

      </script>";
}
}

mysqli_close($dbc);
include("footer.php");
?>