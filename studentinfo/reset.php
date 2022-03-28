<?php
include('header.php');

    $_SESSION['pkey'] = 4;
    $_SESSION['count']=5;
$trashTable="Truncate Table students";
@mysqli_query($dbc,$trashTable);
  $name=['Emily','Jordan','Dexter','Morgan'];
  $grade=['85','57','82','76'];
  $sDate=['2015-05-22','2014-06-18','2013-01-17','2010-10-25'];
  $cDate=['2015-10-22','2015-01-05','','2011-04-22'];
  $daysClass=[];
  
  for($i=0;$i<4;$i++){
    if ($cDate[$i]==""){
        array_push($daysClass,"To Be Determined");
        }else{
    $sDatetime=$sDate[$i];
    $cDatetime=$cDate[$i];
    $sDatetime = strtotime($sDatetime);
    $cDatetime = strtotime($cDatetime);
    $secs = $cDatetime - $sDatetime;
    $days = $secs / 86400;
    $days=round($days);
    array_push($daysClass, $days);
    }}
    $letter=[];
    $aGrade=[];
    $aLetter=[];
    $studentCount=count($name);
    $totalGrade=0;
    $totalAlt=0;
    for($i=0;$i<=count($name)-1; $i++){
        $aGrade[$i]=($grade[$i]*1.10);
         if($grade[$i]>=90){
                $letter[$i]='A';
         }
             else if ($grade[$i]>=80){
                $letter[$i]='B';
             }
                else if ($grade[$i]>=70){
                    $letter[$i]='C';
                }
                    else if ($grade[$i]>=60){
                        $letter[$i]='D';
                    }
                        else{
                            $letter[$i]='F';
                        }
       if($aGrade[$i]>=90){
            $aLetter[$i]='A';
        }
            else if ($aGrade[$i]>=80){
                $aLetter[$i]='B';
            }
                else if ($aGrade[$i]>=70){
                    $aLetter[$i]='C';
                }
                    else if ($aGrade[$i]>=60){
                        $aLetter[$i]='D';
                    }
                        else{
                            $aLetter[$i]='F';
                        }
      
        $totalGrade+=$grade[$i];
        $totalAlt+=$aGrade[$i];
    }     
     
    $averageGrade=$totalGrade/$studentCount;
    $averageAlt=$totalAlt/$studentCount;

    for($i=0;$i<4; $i++){
        $pkey=$i+1;
      $insertData="INSERT INTO students (pkey, name,grade,letter, sDate, cDate,daysClass) Values ('$pkey', '$name[$i]', '$grade[$i]', '$letter[$i]', '$sDate[$i]', '$cDate[$i]', '$daysClass[$i]')";
      @mysqli_query($dbc,$insertData);
      }

      print"<script>location.href='index.php?reset=true';
      </script>";
mysqli_close($dbc);
require 'footer.php';
?>