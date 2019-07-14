<?php
if(!isset($_SESSION['name'])){
  exit( "<h1>You must logged in First!!!!!<h1><a href='login.php'>Return</a>");
}

isset($_POST['submit'])
    or exit("Error: need to log in.");

$fName = $_POST['firstName'];
$lName = $_POST['lastName'];
$pName = $_POST['preferredName'];
$dob = $_POST['dob'];
$oEmail = $_POST['oEmail'];
$pEmail = $_POST['pEmail'];
$mobile = $_POST['mobile'];
$facebook = $_POST['facebook'];
$designation = $_POST['designation'];
$category = $_POST['category'];
$nic = $_POST['nic'];
$indexNo = $_POST['index'];
$food = $_POST['food'];
$note = $_POST['note'];

$con = mysqli_connect('localhost', 'root', '', 'birthday');

if(!$con) {
    echo "Error: failed to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
  }

  $query = "INSERT INTO userdetails (fname, lname, pname, DOB, oemail, pemail, mobile, facebook, designation, category, NIC, indexNO, food, note) VALUES('$fName', '$lName', '$pName', '$dob', '$oEmail', '$pEmail', '$mobile', '$facebook', '$designation', '$category', '$nic', '$indexNo', '$food', '$note' )";

  $result = mysqli_query($con, $query);

  if( !$result ) {
    exit("Error: failed to execute query. " . mysqli_error($con));
  }

  mysqli_close($con);
  echo "User added to database. Redirecting now..." . PHP_EOL;
  header('refresh:3; URL=viewuser.php');




?>