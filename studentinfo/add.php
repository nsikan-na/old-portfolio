<?php
$title='Add Student Information';
require 'header.php';

if (isset($_GET["pkey"]) && is_numeric($_GET["pkey"]) ){
    print"<div class='greeting'>Hello, ".$_SESSION['user']."
    | <span><a href='logout.php?logout=true'>Sign Out</a><span>
    <br><a class='forgot'href='forgot.php' style=''> Change your password?</a></div>".'
    <h1 style="margin-top:-3%;"class="header">Add Student Information</h1>
    <div class="main">
    <form method="POST" action="add.php">


    <label for="name">Enter Name</label>
    <br>
    <input type="text"title="Student Name"class="form-control myInput" name="name" id="name" value="';
    if (isset($_GET['name'])) { print($_GET['name']); } 
    print '">
    <br>
    <label for="grade">Enter Number Grade</label>
    <br>
    <input min="0" max="100" maxlength="3" id="grade"title="Student Grade"class="form-control myInput" name="grade" type="number" value="';
    if (isset($_GET['grade'])) { print($_GET['grade']); } 
    print '">
    <br>
    <label for="sDate">Enter Start Date</label>
    <br>
    <input type="date" title="Start Date" id="sDate"class="form-control myInput" name="sDate" value="';
    if (isset($_GET['sDate'])) { print($_GET['sDate']); }
    print'">
    <br>
    <label for="cDate"> Enter Completion Date</label>
    <br>
    <input type="date"class="form-control myInput" title="Completion Date" id="cDate" name="cDate" value="';
    if (isset($_GET['cDate'])) { print($_GET['cDate']); }
    print'">
    <br>
    <input id="pkey"class="form-control myInput" name="pkey" type="hidden" value="' .$_GET['pkey']. '">
   <button class="myButton" type="submit" name="submit" >Add Information</button>
    <a href=\'home.php?delete=false&login=false&add=false&update=false\'>Cancel</a>

    </form>
    </div>
    
    ';
        
    }else {
        if (isset($_POST["pkey"]) && is_numeric($_POST["pkey"]) ){
$name=($_POST['name']);
$grade=($_POST['grade']);
$cDate=($_POST['cDate']);
$sDate=($_POST['sDate']);
$pkey=($_POST['pkey']);
if(empty($name) || is_numeric($name)||(empty($grade)&& $grade != 0) || !is_numeric($grade)||empty($sDate)|| $grade<0 || $grade>100 ||(($cDate<=$sDate)&&($cDate !=''))){
    $error=[];   
    print"<h1>Submission Failed!</h1>";        
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
    print "<div style='margin:0 auto;border-radius:1em;width:30%;font-size:1.5em;background-color:rgba(0, 0, 0, 0.5);color:red;'class='error'> $error[$i]</div><br><br>";
    }

    print "<div><a href='add.php?name=".$name."&grade=".$grade."&sDate=".$sDate."&cDate=".$cDate."&pkey=".$pkey."'><button title='Go Back' type=\"submit\" class= 'myButton'>Back</button></a></div>";
}}
else{
   
$pkey=$_POST['pkey'];

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


$addData="INSERT INTO students (pkey, name,grade,letter, sDate, cDate,daysClass) Values ('$pkey', '$name', '$grade', '$letter', '$sDate', '$cDate', '$daysClass')";
@mysqli_query($dbc,$addData);
$_SESSION['count']+=1;
$_SESSION['pkey']+=1;
      print"<script>location.href='home.php?delete=false&login=false&add=true&update=false';
     </script>";
}    
    }}
mysqli_close($dbc);
require('footer.php');
?>