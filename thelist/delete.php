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

input[type='radio'] { 
  transform: scale(2);
}


</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

<body>

<title>Delete Memory</title>

<div class="main_header" style="margin-left:1%;">Delete Memory </div>

<div class="topnav">
  <a href="index.php">Back to "The List"</a>

<?php
  include("config.php");

  if(isset($_POST['yesButton']) )
  {
    $id = $_GET['delete'];
    $sql = "DELETE FROM moments WHERE id='$id'";
    $result = $conn-> query($sql);
    header( "Location: index.php" );     
  }

  if(isset($_POST['noButton']) )
  {
    header( "Location: index.php" );     
  }


  if( isset($_GET['delete']) )
  {
    $id = $_GET['delete'];
    $sql = "SELECT * from moments WHERE id='$id'";
    $result = $conn-> query($sql);
    $row = $result->fetch_assoc();  

    echo "<a href='more.php?more=$row[id]'>". 'Back to "Memory Focus"' . "</a></div><br />";
    echo "<div class='container'><div class='element_header'>Are you sure you want to delete the moment " . '"' . $row["moment"] . '"' . "?</div></div>";
  }

  // if ( isset($_POST['submitButton'])){
  //   // $id = $_GET['delete'];
  //   $sql = "INSERT INTO moments (moment) VALUES ('Button Submitted')";
  //   $result = $conn-> query($sql);

  // }

  // if (isset($_POST['yesButton'])) {
  //       echo '<script>console.log(' . $result . ')</script>';
  //       $id = $_GET['delete'];
  //       $sql = "DELETE from moments WHERE id='$id'";
  //       $result = $conn-> query($sql) or die("Could not update".mysql_error());
  //       // echo "<meta http-equiv='refresh' content='0;url=index.php>";
  // }

  // if (isset($_POST['noButton'])) {
  //     echo '<script>console.log(' . $result . ')</script>';
  //     $id = $_GET['delete'];
  //     // echo "<meta http-equiv='refresh' content='0;url=index.php>";
  // }
?>

<div class='container'>
<div class="element_paragraph">
<form action="" method="POST">
<input type="submit" value=" Yes " name="yesButton"/>
<input type="submit" value=" No " name="noButton"/>
</form>
</div>

</body>
</html>