<!DOCTYPE html>
<html>
<head>
<title>The Destroyed List</title>
<style>
table {
  border-collapse: collapse;
  width: 97%;
  color: #588c7e;
  text-align: left;
  font-family: times, Times New Roman, times-roman, georgia, serif;
  color: #444;
  font-size: 120%;
}
th {
  background-color: #588c7e;
  color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
tr:hover {background-color: #ffffb3;}

.main_header {
  font-family: times, Times New Roman, times-roman, georgia, serif;
  color: #444;
  margin: 0;
  margin-left:1%;
  font-size: 300%;
  line-height: 150%;
  letter-spacing: -2px;
  font-weight: bold;
}

.element_header {
  font-family: times, Times New Roman, times-roman, georgia, serif;
  color: #444;
  font-size: 250%;
  line-height: 130%;
  letter-spacing: -2px;
  font-weight: bold;
}

.element_paragraph {
  font-family: times, Times New Roman, times-roman, georgia, serif;
  color: #444;
  font-size: 120%;
}


input[type=text] {
    width: 80%;
    padding:5px; 
    border:2px solid #ccc; 
    -webkit-border-radius: 5px;
    border-radius: 5px;
    font-family: times, Times New Roman, times-roman, georgia, serif;
    color: #444;
    font-size: 70%;
}

input[type=submit] {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    font-family: times, Times New Roman, times-roman, georgia, serif;
    color: #444;
    font-size: 80%;
  }

</style>
</head>
<body>

<!-- <div class="tab">
  <button class="tablinks" onclick="location.href='index.php'">The List</button>
  <button class="tablinks" onclick="location.href='news.php'">News</button>
</div>

<div id="News" class="tabcontent">
  <h3>News</h3>
</div>

<div id="TheList" class="tabcontent">
  <<h3>The List</h3>
</div> -->

<?php
include("config.php");

if(isset($_POST['memory']))
{
  $moment = mysqli_real_escape_string($conn, $_POST['memory']);
  $location = mysqli_real_escape_string($conn, $_POST['location']);
  $time = mysqli_real_escape_string($conn, $_POST['time']);
  // $sub = $_POST['subMit'];

  $result = $conn-> query("INSERT INTO moments (moment, location, time) values ('$moment', '$location', '$time')");

  	if($result){
    echo "Successful Insertion!";
    }
    else {
    	echo "Please try again";
	}

	if (!isset($_SESSION)) {
	    session_start();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    $_SESSION['postdata'] = $_POST;
	    unset($_POST);
	    header("Location: ".$_SERVER['PHP_SELF']);
	    exit;
	}
}

?>

<div class="container">
<div class="element_header">Insert New Memory</div>
<form class = "element_paragraph" action="." method="POST">
  <table>
    <tr><th>Moment</th><th>Location</th><th>Time</th><th>Enter?</th></tr>
    <tr>
      <td><input type="text" name="memory"/></td>
      <td><input type="text" name="location"/></td>
      <td><input type="text" name="time"/></td>
      <td><input type="submit" name="subMit" value=" Yes "/></td>
    </tr>
  </table>
</form>
</div><br /><br />

<div class="element_header">The List</div>
<table>
<tr>
<th>Moment</th>
<th>Location</th>
<th>Time</th>
</tr>

<?php

$sql = "SELECT * from moments";
$result = $conn-> query($sql);

while($row = $result->fetch_assoc()) {
echo "<tr><td><a href='more.php?more=$row[id]'>" .  $row["moment"] . "</a></td><td>"
. $row["location"] . "</td><td>" . $row["time"]. "</td></tr>";
}

?>

</table>
</body>
</html>