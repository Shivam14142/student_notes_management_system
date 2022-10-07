<?php
 // define database related variables
   $db_name = 'student_notes_management_system';
   $host = 'localhost';
   $user = 'root';
   $password = '';


    $db = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
function getComments($db)
{
if(isset($_POST['showcomments'])){
 $fid=$_POST['fid']; 
$sql="SELECT * FROM comments";
$result=$db->query($sql);
while($row=$result->fetch_assoc() ) {
if($fid==$row['fid'])
{
echo "<div style=' margin-top:3rem; font-size:1.3rem;'>";
echo "<b>From :</b>".$row['USN']."<br>";
echo $row['message'];
echo "</div>";
}
}
}
}
function setReply($db)
{
  if(isset($_POST['send']))
  {
    $USN=$_POST['USN'];
    $reply=$_POST['reply'];
    
    $sql="UPDATE comments SET reply='$reply' where USN='$USN'";
    $result=$db->query($sql);
  }
  
}
session_start();
$error="";
         if (isset($_POST['uploaded'])==1) {
              $file = $_FILES['notes'];

              $fileName = $_FILES['notes']['name'];
              $fileTmpName = $_FILES['notes']['tmp_name'];
              $fileSize = $_FILES['notes']['size'];
              $fileError = $_FILES['notes']['error'];
              $fileType = $_FILES['notes']['type'];


              $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
              $allowed = array('pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg');

              if (in_array($fileExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 104857601) {

                    $q = "SELECT * FROM notes WHERE notes='$fileName'";

                    if (mysqli_num_rows(mysqli_query($db, $q)) == 0) {

                      $fileDestination = 'C:\\xampp\\htdocs\\Student-Notes-Management-System\\files'.$fileName;
                      move_uploaded_file($fileTmpName, $fileDestination);
                    
                      $created = @date('Y-m-d H:i:s');
                      //$description = mysqli_real_escape_string($db, $_POST['description']);
                      
                      $sql = "INSERT INTO notes (subcode, module, notes,scheme) VALUES ('$_POST[subcode]','$_POST[module]','$fileName','$_POST[scheme]')";
                            mysqli_query($db, $sql);
                    
                      echo "<p class='alert alert-success'>File uploaded successfully</p><br>";
                    }
                    else{
                      echo "<p class='alert alert-warning'>File already exixts. Check it out OR Change your filename and try again...</p><br>";
                    }
                  }
                  else{
                    echo "<p class='alert alert-warning'>File too large</p><br>";
                  }
                }
                else{
                  echo "<p class='alert alert-danger'>Error uploading file</p><br>";
                }
              }
              else{
                echo "<p class='alert alert-danger'>Invalid file type</p><br>";
              }
        }

   elseif(isset($_POST['ok']))
    {
         $file = $_FILES['notes'];

              $fileName = $_FILES['notes']['name'];
              $fileTmpName = $_FILES['notes']['tmp_name'];
              $fileSize = $_FILES['notes']['size'];
              $fileError = $_FILES['notes']['error'];
              $fileType = $_FILES['notes']['type'];


              $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
              $allowed = array('pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg');

              if (in_array($fileExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 104857601) {

                    $q = "SELECT * FROM notes WHERE notes='$fileName'";

                    if (mysqli_num_rows(mysqli_query($db, $q)) == 0) {

                      $fileDestination = 'C:\\xampp\\htdocs\\Student-Notes-Management-System\\files\\'.$fileName;
                      move_uploaded_file($fileTmpName, $fileDestination);
                    
                      $created = @date('Y-m-d H:i:s');
                      //$description = mysqli_real_escape_string($db, $_POST['description']);
                      
                      $sql = "Update notes set notes='$fileName' where subcode='$_POST[subcode]' and module='$_POST[module]'";
                            mysqli_query($db, $sql);
                    
                      echo "<p class='alert alert-success'>File uploaded successfully</p><br>";
                    }
                    else{
                      echo "<p class='alert alert-warning'>Unable to Update. Check it out OR Change your filename and try again...</p><br>";
                    }
                  }
                  else{
                    echo "<p class='alert alert-warning'>File too large</p><br>";
                  }
                }
                else{
                  echo "<p class='alert alert-danger'>Error uploading file</p><br>";
                }
              }
              else{
                echo "<p class='alert alert-danger'>Invalid file type</p><br>";
              }
    }
   

     elseif(isset($_POST['Delete']))
    {
        if(empty($_POST['subcode']) || empty($_POST['module']) )
        {
            echo ' Please Fill in the Blanks ';
        }
        else
        {
            $subcode = $_POST['subcode'];
            $module = $_POST['module'];
            $query = " delete from notes where subcode='$subcode' and module='$module' ";
            $result = mysqli_query($db,$query);

            if($result)
            {
               echo "File Successfully Deleted";
            }
            else
            {
                echo 'Something Went Wrong';
            }
        }
    }




?>



<!DOCTYPE html>
<html>
    <body bgcolor="white">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

          body {
  background-image: url('images/loginbackground.jpg');
  background-attachment: fixed;
  background-size: cover;
}
        	<style>
               
              .button:active {
              background-color: #3e8e41;
              box-shadow: 0 5px #666;
              transform: translateY(4px);
            }
                    .header img {
                      float: center;
                      width: 100%;
                      height: 150px;
                      background: #555;
                    }
                    
                    .header h1 {
                      position: relative;
                      top: 18px;
                      left: 10px;
                    }
                    </style>
                    </head>
                    <body>
                    <div class="header">
                       <center><img src="images/mitlogo.jpg" alt="logo"></center>
  
                    </div>
                      <style>
                        ul {
                          list-style-type: none;
                          margin:0px;
                          padding: 0px;
                          overflow: hidden;
                          background-color: #333;
                          bottom: 0;
                          width: 100%;
                        }
                        
                        li {
                          float: left;
                        }
                        li {
                            float: left;
            }



                        
                        li a {
                          display: block;
                          color: white;
                          text-align: center;
                          padding: 14px 16px;
                          text-decoration: none;
                        }
                        
                        li a:hover {
                          background-color: #111;
                        }
                        </style>
                        </head>
                        <body>
                        
            <ul>
              <li><a class="tablinks" onclick="openCity(event, 'view')" id="defaultOpen">$</a></li>
              <li><a class="tablinks" onclick="openCity(event, 'Insert')">Insert Notes</a></li>
              <li><a class="tablinks" onclick="openCity(event, 'Update')">Update Notes</a></li>
              <li><a class="tablinks" onclick="openCity(event, 'Delete')">Delete Notes</a></li>
              <li><a class="tablinks" href="scheme.php" >Notes</a></li>
              <li><a class="tablinks" onclick="openCity(event, 'Comments')">Comments</a></li>
              <li><a class="tablinks" onclick="openCity(event, 'reply')">Reply</a></li>
              <li style="float:right"><a class="active" href="login.php">Logout</a></li>
            </ul>
        <div id="view" class="tabcontent">
           
          
          
       </div>

        <div id="Insert" class="tabcontent">
  				  <h3 style="color:green; font-size:45px; ">Insert Notes</h3>
            <form method="POST" enctype="multipart/form-data">
  				    <p>
                <label style="font-size:30px">Subject Code &nbsp &nbsp:</label>
                <input type="text" name="subcode" placeholder="Enter SubCode" class="form-control mb-2" required>
              </p>	
              <p>
                 <label  style="font-size:30px">Scheme   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</label>
                 <input type="text" name="scheme" placeholder="Enter Scheme" class="form-control mb-2" required>
              </p>
              <p>
                 <label  style="font-size:30px">Module   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</label>
                 <input type="text" name="module" placeholder="Enter Module Number" class="form-control mb-2" required>
              </p>
              
              <div class="form-group">
                <div class="input-group">
                 <label for="file" style="font-size:30px">Upload Notes &nbsp  :</label>
                 <span class="input-group-addon">
                   <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Supported File Format: pdf, txt, doc, docx, png, jpg, jpeg" aria-hidden="true"></i>
                 </span>
                 <input type="file" class="btn btn-default" style="width: 225px" id="notes" name="notes" required>
                </div>
              </div>
              <input type="submit" class="btn btn-success" name="uploaded" value="Upload">
           
            <img src="images/in.png" alt="in" style="float:right;margin:-150px 100px">
            </form>
		   	</div>
		   


	 <div id="Update" class="tabcontent">
  	 	<h3 style="color:green; font-size:45px; ">Update Notes</h3>
          <form method="POST" enctype="multipart/form-data">
  			<p>
           		<label style="font-size:30px">Subject Code &nbsp &nbsp:</label>
          		<input type="text" name="subcode" placeholder="Enter SubCode" class="form-control mb-2" required>
            </p>	
            <p>
           		<label style="font-size:30px">Module   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</label>
           		<input type="text" name="module" placeholder="Enter Module Number" class="form-control mb-2" required>
            </p>
            <div class="form-group">
                <div class="input-group">
                	 <label for="file" style="font-size:30px">Upload Notes &nbsp  :</label>
                 	 <span class="input-group-addon">
                   		<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Supported File Format: pdf, txt, doc, docx, png, jpg, jpeg" aria-hidden="true"></i>
                 	 </span>
                      <input type="file" class="btn btn-default" style="width: 225px" id="notes" name="notes" required>
                </div>
             </div>
              <input type="submit" class="btn btn-success" name="ok" value="Upload">
          
          <img src="images/up.png" alt="up" style="float:right;margin:-150px 100px">
         </form>
     </div>

			<div id="Delete" class="tabcontent">
  				<h3 style="color:green; font-size:45px; ">Delete Notes</h3>
          <form method="POST">
  				<p>
           <label style="font-size:30px">Subject Code &nbsp &nbsp:</label>
           <input type="text" name="subcode" placeholder="Enter SubCode" class="form-control mb-2" required>
            </p>	
            <p>
           <label style="font-size:30px">Module   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</label>
           <input type="text" name="module" placeholder="Enter Module Number" class="form-control mb-2" required>
            </p>
            <input type="submit" value="Delete" name="Delete">
            </form>	
            <img src="images/dlt.png" alt="dlt" style="float:right;margin:-150px 100px">
			</div>
      <div id="Comments" class="tabcontent">
      <h3 style="color:green; font-size:45px; ">Comments</h3>
      <?php
      echo "<form method='POST'>
      <label style='font-size:30px'>Enter your FID &nbsp; &nbsp;:</label>
      <input type='text' name='fid' class='form-control mb-2' placeholder='Enter FID' required=''>
      <button type='submit' name='showcomments'>Submit</button>
      </form>";
      
      getComments($db);
     ?>


      </div>
      <div id="reply" class="tabcontent">
      <h3 style="color:green; font-size:45px; ">Reply</h3>
      <p>
      <?php
      echo "<form method='POST' action='".setReply($db)."'>
      <label style='font-size:30px'>Enter USN &nbsp; &nbsp;:</label>
      <input type='text' name='USN' class='form-control mb-2' placeholder='Enter USN' required=''>
      </p>
      <p>
      <label style='font-size:30px'>Enter reply &nbsp; &nbsp;:</label>
      <input type='text' name='reply' class='form-control mb-2' placeholder='Enter reply' required=''>
      </p>
      <button type='submit' name='send'>send</button> 
      </form>";
      ?>
      </div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
            
            
            
            
</html>