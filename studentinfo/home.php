<?php
$title = "Home";
require 'header.php';  

          $count=$_SESSION['count']-1;
            $totalGrade=0;
    $totalAlt=0;
    $viewData = 'SELECT * FROM students';
    $r = mysqli_query($dbc, $viewData);
    while ($row = mysqli_fetch_array($r)) {
    $totalGrade+=$row["grade"];
    $pkey=$row["pkey"]; 
    
    }

$averageGrade= round($totalGrade/$count,2);
$averageAlt=round($totalAlt/$count,2);

    if ($_GET['login']==='true'){
      print"<div class=\"alert alert-success success\" style='color:white;margin-left:35%;margin-top:3%;width:30%;background-color:green; position:absolute;' >
 Sign in Successful!
    </div> ";
    }
    if ($_GET['delete']==='true'){
      print"<div class=\"alert alert-success success\" style='color:white;margin-left:35%;margin-top:3%;width:30%;background-color:green; position:absolute;' >
 Information Deleted!
    </div> ";
    }
    if ($_GET['add']==='true'){
      print"<div class=\"alert alert-success success\" style='color:white;margin-left:35%;margin-top:3%;width:30%;background-color:green; position:absolute;' >
  Information Added!
    </div> ";
    }
    if ($_GET['update']==='true'){
      print"<div class=\"alert alert-success success\" style='color:white;margin-left:35%;margin-top:3%;width:30%;background-color:green; position:absolute;' >
      Information Updated!
    </div> ";
    }

  print"   
  <div class='greeting'>Hello, ".$_SESSION['user']." | <span><a href='logout.php?logout=true'>Sign Out</a><span>
    <br><a class='forgot'href='forgot.php'> Change your password?</a></div>
    <h1>Student Information</h1>
    <table class='table'> 
    <tr> 

    <td>Student Name</td> 
    <td>Number Grade</td> 
    <td>Letter Grade</td> 
    <td>Start Date</td>
    <td>Completion Date</td>
    <td>Days in Class</td>
    <td></td>
    </tr>";
    
$viewData = 'SELECT * FROM students';
        $r = mysqli_query($dbc, $viewData);
        while ($row = mysqli_fetch_array($r)) {
            print "<tr>

            <td>{$row["name"]}</td>
            <td>{$row["grade"]}</td>
            <td>{$row["letter"]}</td>
            <td>{$row["sDate"]}</td>";
            if ($row["cDate"]=='0000-00-00'){
                print'<td>N/A</td>';
            }else {print "<td>{$row["cDate"]}</td>";
          }
            print" 
            <td>{$row["daysClass"]}</td>
            <td><a title='Update Student Information' href='update.php?pkey={$row["pkey"]}'>".'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg></a>'."
            <a title='Delete Student Information' href='delete.php?pkey={$row["pkey"]}'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
              </svg></a></td>
            </tr>";

                  
              
                
        }
        print"
        <tr>
        <td><a  href='add.php?pkey=";print $_SESSION['pkey']+1;
        print "'><svg xmlns".'="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
          </svg></a>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
                </table>';
            
            print"
        
            <div style='font-size:1.25em;padding-bottom:20px;'> Number of Students: <span class='bold'><br>$count</span> <br>
           Original Grade Average: <span class='bold'><br>$averageGrade</span><br></div>";



mysqli_close($dbc);
require 'footer.php';
?>
