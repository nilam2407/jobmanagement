<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"  href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/webjob.js"></script>

</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="webjobhome.html" class="active">WebJob</a>
  <a href="findjob.html">Find A Job</a>
  <a href="jobprofile.php">Recruiter</a>
  <a href="signin.html">Sign In</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>



<?php
$email = $_REQUEST['email'];
$password = $_REQUEST['pwd'];
//connecting to database to check whether the login combo (username and password //) exists or not.
require_once 'login.php';
$conn = new mysqli($hn,$un,$pw,$db);
  if ($conn->connect_error) die($conn->connect_error);
$sql    = 'SELECT email,password FROM user WHERE email ="'.$email.'"and password ="'.$password.'"';
$result = mysql_query($sql, $link);
$hint .= "welcome, please insert job profile";
 $result = $conn->query($sql);
 if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

if ($rows ==1)
$hint = "ok";
echo $hint;

if (isset($_POST['cid'])   &&
      isset($_POST['cname'])    &&
      isset($_POST['caddress']) &&
      isset($_POST['cdesc']) &&
      isset($_POST['cemail']))
  {
    $stmt1 = $conn->prepare("INSERT INTO company(cid, cname, caddress, cdesc, cemail) VALUES(?, ?, ?, ?, ?)"); 
     
    $companyid = get_post($conn, 'cid'); 
    $companyname = get_post($conn, 'cname'); 
    $companyaddress = get_post($conn, 'caddress'); 
    $companydescription = get_post($conn, 'cdesc');
    $companyemail = get_post($conn, 'cemail');
    
    $stmt1->bind_param("sssss", $companyid, $companyname, $companyaddress, $companydescription, $companyemail); 
    $stmt1->execute();
   if(!$stmt1->error) 
    { 
     echo "Inserted company info successfully<br><br>"; 
    } 
    else 
    { 
     echo "INSERT failed".$stmt1->error; 
   } 
 



 }
if (isset($_POST['jobtitle']) &&
      isset ($_POST['salary']) &&
      isset ($_POST['jobdesc']) &&
      isset($_POST['jobtype']) &&
      isset($_POST['education']) &&
      isset ($_POST['experience']))
{
    $stmt2 = $conn->prepare("INSERT INTO job(jobtitle, salary, jobdesc, jobtype, education, experience) VALUES(?, ?, ?, ?, ?,?)"); 
    $jobtitle = get_post($conn,'jobtitle');
    $salary = get_post($conn,'salary');
    $jobdesc = get_post($conn,'jobdesc');
    $jobtype = get_post($conn, 'jobtype');
    $education =get_post($conn, 'education');
    $experience = get_post($conn, 'experience'); 
   
   $stmt2->bind_param("ssssss", $jobtitle, $salary, $jobdesc, $jobtype, $education, $experience); 
  $stmt2->execute();   
if(!$stmt2->error) 
    { 
     echo "Inserted job info successfully<br><br>"; 
    } 
    else 
    { 
     echo "INSERT failed".$stmt2->error; 
   } 


} 


echo '<form  method ="post" action ="jobprofile.php">';
echo 'Company Id           <input type="text"  name="cid"><br>';
echo'Company Name         <input type="text" name="cname"><br>';
echo'Company Address      <input type="text" name="caddress"><br>';
echo'Job Title            <input type="text" name="jobtitle"><br>';
echo'Salary               <input type="text" name="salary"><br>';
echo'Company Description  <input type="text" name="cdesc"><br>';
echo 'Job description      <input type = "text" name="jobdesc"><br>';
echo'Job Type             <input type ="text" name="jobtype"><br>';
echo 'Education            <input type ="text" name="education"><br>';
echo 'Experience           <input type ="text" name="experience"><br>';
echo 'Comany Email        <input type="email" name="cemail"><br>';
echo '<input type="submit" value="submit"><br>';
echo'</form>';



$conn->close();
function get_post($conn, $var)  { 
  return $conn->real_escape_string($_POST[$var]);
  }

?>
</body>
</html>