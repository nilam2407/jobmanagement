<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
require_once 'login.php';
$conn = new mysqli($hn,$un,$pw,$db);
  if ($conn->connect_error) die($conn->connect_error);
 $counter=1;

if (  isset($_POST['sname']) &&
      isset($_POST['semail']) &&
      isset($_POST['cresume']))
      
  {
    $stmt = $conn->prepare("INSERT INTO seeker(sname,semail,sresume) VALUES(?, ?, ?)"); 
     $seekerid = $counter++;
     $seekername = get_post($conn, 'sname'); 
    $seekeremail = get_post($conn, 'semail');
    $seekerresume = get_post($conn, 'sresume'); 

    
    $stmt->bind_param("sss", $seekername, $seekeremail,$seekerresume); 
    $stmt->execute();
  if(!$stmt->error) 
    { 
     echo "uploaded resume successfully<br><br>"; 
    } 
    else 
    { 
     echo "upload profile is Failed. Please Try Again".$stmt->error; 
     } 

 }

echo '<form  method ="post" action ="jobseeker.php">';
echo'Name <input type="text" name="sname"><br>';
echo 'Email<input type="email" name="semail"><br>';
echo 'Resume<input type="file" name="sresume"><br>';
echo '<input type="submit" value="submit"><br>';
echo'</form>';
$query  = "SELECT * FROM company";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);


$conn->close();
function get_post($conn, $var)  { 
  return $conn->real_escape_string($_POST[$var]);
  }

?>
</body>
</html>

