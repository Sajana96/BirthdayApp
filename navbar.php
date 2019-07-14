<?php
session_start();
if(!isset($_SESSION['name'])){
    //exit( "<h1>You must logged in First!!!!!<h1><a href='login.php'>Return</a>");
    $user = "You must logged in";
}
else{
$user = $_SESSION['name'];
}

?>




<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
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
  <li><a class="active" href="viewuser.php">View Users</a></li>
  <li><a href="viewbirthdays.php">Birthdays</a></li>
  <li><a href="treatshedule.php">Treats</a></li>
  <li><a href="logout.php">Logout</a></li>
  <li style="color:white; margin-left:17cm; margin-top:0.36cm">User :<?php echo $user?> </li>
</ul>

</body>
</html>
