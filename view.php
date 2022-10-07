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

session_start();
$error="";
function setComments($db)
{
  if(isset($_POST['submitbutton']))
  {
    $fid=$_POST['fid'];
    $USN=$_POST['USN'];
    $message=$_POST['message'];
    $sql="INSERT INTO comments (fid,USN,message) VALUES ('$fid','$USN','$message')";
    $result=$db->query($sql);
  }
  
}
function getReply($db)
{
if(isset($_POST['replybutton'])){
 $USN=$_POST['USN']; 
$sql="SELECT * FROM comments ";
$result=$db->query($sql);
while($row=$result->fetch_assoc() ) {
if($USN==$row['USN'])
{
echo "<div style=' margin-top:3rem; font-size:1.3rem;'>";
echo "<b>From :</b>".$row['fid']."<br>";
echo $row['reply'];
echo "</div>";
}
}
}
}
?>	
<!DOCTYPE html>
<html>
<head>
<style >
	 body {
  			background-image: url('images/loginbackground.jpg');
  			background-attachment: fixed;
  			background-size: cover;
		  }
	.pdf{
			width:32px;
  			height:32px;
 			background:url('images/pdf.png');
 			 display:inline-block;
  			content:' ';
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
		.button {
  position: fixed;
  right: 10px;
  bottom: 40px;
}

.button1 {
  padding: 5px 30px;
  font-size: 20px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 20px;
  box-shadow: 0 5px #999;
}

.button1:hover {background-color: #3e8e41}

.button1:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;

}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 1% auto 5% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%;/* Could be more or less, depending on screen size */
}
.container {
  padding: 16px;
}
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}
.button1 {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}
input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;

    }
    
    .replybutton
    {
      position:fixed;
      bottom:50px;
    }

</style>					
</head>
<body>
	<div class="header">
   <center><img src="images/mitlogo.jpg" alt="logo"></center>
  
</div>
   <button onclick="document.getElementById('id1').style.display='block'" style="width:auto;" class="button button1">
    Send Comments
  </button>


  <div id="id1" class="modal">
  
  <div class="modal-content animate" >
    
    

      <div class="container">
      <h2 style="color:green;">Comments</h2>
      <?php
      echo "<form  method='POST',action='".setComments($db)."'>
      <label for='fid'><b>Faculty id</b></label>
      <input type='text' placeholder='Enter Faculty id' name='fid' required>

      <label for='USN'><b>USN</b></label>
      <input type='text' placeholder='Enter Your USN' name='USN' required>
	    <label for='message'><b>Comment</b></label>
      <input type='text' placeholder='Enter Your comment' name='message' required>
        
      <button type='submit' class='button1' name='submitbutton'>Submit</button>
 </form>";
 ?>
  
    
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id1').style.display='none'" class="cancelbtn">Cancel</button>

      
    </div>
</div>

 </div>
 
    </div>
    <button onclick="document.getElementById('id2').style.display='block'" style="width:auto;" class="button1 replybutton">
    Faculty's reply
  </button>
    <div id="id2" class="modal">
  
  <div class="modal-content animate" >
    
    

      <div class="container">
      <h2 style="color:green;">Reply</h2>
   <?php
     echo" <form  method='POST'>
      <label for='USN'><b>USN</b></label>
      <input type='text' placeholder='Enter your USN' name='USN' required>
        
      <button type='submit' class='button1' name='replybutton'>Submit</button>
      </form>"; 
      getReply($db);
      ?>
  
    
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id2').style.display='none'" class="cancelbtn">Cancel</button>

      
    </div>
</div>

 </div>
 
    </div>

<script>
// Get the modal
var modal = document.getElementById('id1');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>

<div class="col-md-8">
			<h2 style="color:green; font-size:40px; font-style:;"> NOTES</h2>
			<br />
		            
					<?
					
					     $subcode=$_GET['subcode'];
					     $sql1="select * from notes where subcode='$subcode'";
					     $row=mysqli_fetch_assoc(mysqli_query($db,$sql1));
							unlink("C:\\xampp\\htdocs\\Student-Notes-Management-System\\files\\".$row['notes']);
					
					
					
					?>
		            
		    <table class="table table-hover">
		        <tr>
		            <th class="likes"><i class="fa fa-thumbs-up" aria-hidden="true"></i></th>
		            <th>Subcode</th>
		            <th>module</th>
		            <th>View</th>
		        </tr>
		        
		        <?php
		        $subcode=$_GET['subcode'];
				$q = "SELECT * FROM notes WHERE subcode='$subcode' ";				
				$r = mysqli_query($db, $q);
		        $i = 1;
		        while($row = mysqli_fetch_assoc($r)) { ?>
		                               
		        <tr>
		            <td class="likes">
		            <td><?php echo $row['subcode']; ?></td>
		            <td><?php echo $row['module']; ?></td>
		            <td><a href="view_file.php?notes=<?php echo $row['notes']; ?>" target="_blank">
		            	<div class='pdf'></div>
		            </a></td>
		        </tr>

		        <?php } ?>
		    
		    </table>
			
		</div>
		















