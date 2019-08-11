<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"  href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/webjob.js">  </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
   ['jobtitle', 'cnt'],
   
 <?php


  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query = "SELECT jobtitle, count(1) as cnt FROM job group by jobtitle";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
  for ($j = 0 ; $j < $rows ; ++$j)  {  
  $result->data_seek($j);    
  $row = $result ->fetch_array(MYSQLI_NUM);
echo <<<_END
    ['$row[0]' ,$row[1]],
_END;
}
$result->close();
$conn->close(); 
?>
]);

var options = {'title':'pie chart - percentage of the availabe jobs based on the jobtitle'};
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script> 
</head>
<body>
<div class="topnav" id="myTopnav">
  <a href="webjobhome.html" class="active">WebJob</a>
  <a href="findjob.html">Find A Job</a>
  <a href="recruiter.html">Recruiter</a>
  <a href="signin.html">Sign In</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

    <div id="piechart" style ="width: 900px; height: 500px;"></div>
</html>