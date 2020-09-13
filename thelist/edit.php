<!DOCTYPE html>  
<html> 
<style>

/* Style the header */
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
  font-size: 140%; 
  padding-left : 1%;
  padding-right: 1%;
}


/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  font-size: 140%;
  text-align: center;
  padding: 1% 1%;
  text-decoration: none;  
  font-family: times, Times New Roman, times-roman, georgia, serif;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.container{
  margin: 0 auto;
  width: auto; /* optional */
  height: auto;
}

input[type=text] {
    width: 90%;
}


</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

<body>

<title>Edit Memory</title>

<div class="main_header" style="margin-left:1%;">Edit Memory </div>

<div class="topnav">
  <a href="index.php">Back to "The List"</a>

<?php
  include("config.php");

	if( isset($_GET['edit']) )
	{
		$id = $_GET['edit'];
		$sql = "SELECT * from moments WHERE id='$id'";
		$result = $conn-> query($sql);
		$row = $result->fetch_assoc();
    // echo '<script>console.log("' . mysqli_real_escape_string($conn, $row['location']) . '")</script>';
    // echo '<script>console.log("Entered Edit Loop")</script>';
		echo "<a href='more.php?more=$row[id]'>". 'Back to "Memory Focus"' . "</a></div><br />";
	}
 
	if( isset($_POST['newMoment']) )
	{
		$newMoment = mysqli_real_escape_string($conn, $_POST['newMoment']);
		$newLocation = mysqli_real_escape_string($conn, $_POST['newLocation']);
		$newTime = mysqli_real_escape_string($conn, $_POST['newTime']);
		$newStory = mysqli_real_escape_string($conn, $_POST['newStory']);
		$id  	 = $_POST['id'];
		$sql = "UPDATE moments SET moment='$newMoment',  location='$newLocation',  time='$newTime', story='$newStory'  WHERE id='$id'";
		$result = $conn-> query($sql) or die("Could not update".mysql_error());
		echo "<meta http-equiv='refresh' content='0;url=more.php?more=$id'>";
	}
 
  echo '<div class="container">
  <form action="edit.php" method="POST">
  <div class="element_header" >Moment:</div> 
  <input class="element_paragraph" type="text" name="newMoment" value="' . htmlspecialchars($row['moment'], ENT_QUOTES) . '"/><br/><br/>
  <div class="element_header" >Location:</div> 
  <input class="element_paragraph" type="text" name="newLocation" value="' . htmlspecialchars($row['location'], ENT_QUOTES) . '"/><br/><br/>
  <div class="element_header" >Time:</div> 
  <input class="element_paragraph" type="text" name="newTime" value="' . htmlspecialchars($row['time'], ENT_QUOTES) . '"/><br/><br/>
  <div class="element_header" >Story:</div> 
  <input class="element_paragraph" type="text" name="newStory" value="' . htmlspecialchars($row['story'], ENT_QUOTES) . '"/><br/><br/>
  <input type="hidden" name="id" value="' . $row["id"] . '">
  <input type="submit" value=" Update "/>
  </form>
  </div>';

?>

</body>
</html>