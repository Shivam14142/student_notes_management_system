<?php
 $db_name = 'student_notes_management_system';
   $host = 'localhost';
   $user = 'root';
   $password = '';


    $db = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  

session_start();

?>
<!DOCTYPE html>
<html>
<style>
  body {
  background-image: url('images/branchback.jpg');
  background-attachment: fixed;
  background-size: cover;
}

.button {
  position: fixed;
  right: 10px;
  bottom: 40px;
}

.button {
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

.button:hover {background-color: #3e8e41}

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
.button1 {
    padding: 5px 30px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
    background-color: #4CAF50;
    border: none;
    height:10rem;
    width:10rem;
    box-shadow: 0 5px #999;
    border-radius:50%;
    margin-left:30%;
    
}
.button1:hover {background-color: #3e8e41}

.button1:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.scheme2 
{
position:absolute;
left:30%;
top:34%;
}

</style>

<div class="header">
  <center><img src="images/mitlogo.jpg" alt="logo" /></center>
</div>
<body bgcolor="white">
<h1 style="color:green; font-size:40px; "><center>Select Your Scheme</center></h1>


<body>
<form action="branch1.php" method="POST">
<button class="button1">2018 Scheme</button>

</form>


<form action="branch2.php" method="POST">
<button class="button1 scheme2">2017 Scheme</button>
</form>




</body> 

</div>
<h2 style="color:black; font-size:40px; font-style:italic;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp"Knowledge Is Power."</h2>
<div>
	<button class="button"><a href="login.php">Logout</a></button>
</div>

</html>
