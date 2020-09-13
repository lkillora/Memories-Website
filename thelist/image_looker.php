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


tr {
  text-align: center;
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

<body>

<br/>
<div class="main_header" style="margin-left:1%;">Memory Focus </div>


<div class="topnav">
  <a href="index.php">Back to "The List"</a>

<?php
  include("config.php");

  if(isset($_GET['more']) )
  {
    $id = $_GET['more'];
    $sql = "SELECT * from moments WHERE id='$id'";
    $result = $conn-> query($sql);
    $row = $result->fetch_assoc();  

    echo "<a href='edit.php?edit=$row[id]'> Edit This Memory </a>";
    // echo "<form id='delete_form' action='.' method='POST'><input type='submit' class='del' name='DeleteButton' onclick='clicked();' value='Delete Memory'/></form>";
    echo "<a href='delete.php?delete=$row[id]'> Delete This Memory </a></div><br />";
    echo "<title>Moment: " . $row['moment'] . "</title>";
		echo "<div class='container'><div class='element_header'>Moment: " .  $row["moment"] . "</div><p class='element_paragraph'>Location: " . $row['location'] . "</p>"
    . "<p class='element_paragraph'>Time: " . $row['time'] . "</p>" . "<p class='element_paragraph'>Story: " . $row['story'] . "</p></div>";
	}

	if(isset($_POST["insert"]))  
	 {
		$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
		$moment_id = $_GET['more'];
    // $sql = "INSERT INTO images(moment_id, pic) VALUES ('$file')";
    $sql = "INSERT INTO images(moment_id, pic) VALUES ('$moment_id', '$file')";
		$result = $conn-> query($sql);

	 } 

   if(isset($_POST['but_upload'])){
      $maxsize = 40000000; // 40MB
       // $maxsize = 5242880; // 5MB
 
       $moment_id = $_GET['more'];
       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];

       // Select file type
       $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($videoFileType,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
            echo "File too large. File must be less than 40MB.";
          }else{
            // Upload
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
              // Insert record
              $query = "INSERT INTO videos(moment_id, name,location) VALUES('$moment_id', '".$name."','".$target_file."')";

              mysqli_query($conn,$query);
              echo "Upload successfully.";
            }
          }

       }else{
          echo "Invalid file extension.";
       }
     }

   if (!isset($_SESSION)) {
      session_start();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $moment_id = $_GET['more'];
      echo '<script>console.log("' . $moment_id . '")</script>';
      $_SESSION['postdata'] = $_POST;
      header("Location: ". $_SERVER['PHP_SELF'] . "?more=" . $_GET['more']);
      unset($_POST);
      exit;
  }
 
?>


<section>
   <br /><br />  
   <div class="container">  
        <div class="element_header">Insert Images</div>  
        <br />  
        <form method="post" enctype="multipart/form-data">  
             <input type="file" name="image" id="image" /><br />
             <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
        </form>  
        <br />  
        <br />  
        <table class="table table-bordered">  
             <tr>  
                  <th><div class="element_header" style="text-align:center;">Already Uploaded Images</div></th>  
             </tr>  
        <?php 
        $moment_id = $_GET['more'];
        $sql = "SELECT * FROM images WHERE moment_id = '$moment_id'";  
        // $sql = "SELECT * FROM images";  
        $result = $conn-> query($sql); 
        while($row = $result->fetch_assoc())  
        {  
             echo '  
                  <tr>  
                       <td>  
                            <img src="data:image/jpeg;base64,'.base64_encode($row['pic'] ).'" style="max-height: 100%; max-width: 100%" class="img-thumnail" />  
                       </td>  
                  </tr>  
             ';  
        }  
        ?>  
        </table> <br /><br /><br /> 
   </div> 

</section>
</body>  
</html>  
 <script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  