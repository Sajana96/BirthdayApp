<?php 

require_once("navbar.php");

if(!isset($_SESSION['name'])){
    exit( "<h1>You must logged in First!!!!!<h1><a href='login.php'>Return</a>");
}
     $fname = $lname = $DOB = $pEmail = $mobile = $category = $food = "";
isset($_GET['userid'])
    or exit("Error: user id required.");

    $userId = $_GET['userid'];

    $con = mysqli_connect('localhost', 'root', '', 'birthday');

    if(!$con) {
        echo "Error: cannot connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugginh error: " . mysqli_connect_error() . PHP_EOL;
        exit;
      }
    
      $query = "SELECT * FROM userdetails WHERE user_id='$userId'";
    
      $result = mysqli_query($con, $query);
    
      if(!$result){
        echo "Error: unable to execute query - " . $query . PHP_EOL;
        echo "Debugging error: " . mysqli_error($con) . PHP_EOL;
        exit;
      }

      $row = mysqli_fetch_assoc($result);

      $fname = $row['fname'];
      $lname = $row['lname'];
      $dob = $row['DOB'];
      $pEmail = $row['pemail'];
      $mobile = $row['mobile'];
      $category = $row['category'];
      $food = $row['food'];

      $fullName = $fname." ".$lname;

      if(isset($_POST['update'])){
        $fname = $_POST['fName'];
        $lname = $_POST['lName'];
        $dob = $_POST['dob'];
        $pEmail = $_POST['pEmail'];
        $mobile = $_POST['mobile'];
        $food = $_POST['food'];
    
        $query1="Update userdetails set fname='$fname', lname='$lname', DOB='$dob', pemail='$pEmail', mobile='$mobile', food='$food' where user_id='$userId'";
        $results1 = mysqli_query($con,$query1);
    
       
        if($results1){
           
            header("Location:userprofile.php?userid=$userId");
        }
    }
    if(isset($_POST['delete'])){
        $refCode = $_POST['code'];
        
    
        $query2="Delete from userdetails where user_id='$userId'";
        $results2 = mysqli_query($con,$query2);
    
       
        if($results2){
            echo"Successfully deleted!! Redirecting.....";
            header('refresh:3; URL=viewuser.php');
        }
    }

    if(isset($_POST['startTreat'])){
        $sheduleDate = $_POST['sheduleDate'];
        $sheduleTime = $_POST['time'];
        $venue = $_POST['venue'];
        $state = $_POST['state'];
        $notes = $_POST['notes'];



        $query3="INSERT INTO treats(user_id, sheduleDate, sheduleTime, venue, state, treatNotes) values('$userId', '$sheduleDate','$sheduleTime', '$venue', '$state', '$notes')";

        $result3 = mysqli_query($con, $query3);

        if( !$result3 ) {
          exit("Error: failed to execute query. " . mysqli_error($con));
        }
      
        mysqli_close($con);
        echo "User added to database. Redirecting now..." . PHP_EOL;
        header('refresh:3; URL=treatshedule.php');
        
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>User View</title>
</head>

<body>
<?php
  require_once("navbar.php");
  ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1><?php echo $fullName?></h1>

        </div>
    </div>
    <div style="width: 600px; margin-left: 2cm">
        <form>
            <strong>First Name: </strong><input type="text" name="fName" class="form-control form-control"
                value="<?php echo $fname ?>">
            <strong>Last Name: </strong><input type="text" name="lName" class="form-control form-control"
                value="<?php echo $lname ?>">
            <strong>Date of Birth: </strong><input type="text" name="dob" class="form-control form-control"
                value="<?php echo $dob ?>">
            <strong>Personal Email: </strong><input type="text" name="pEmail" class="form-control form-control"
                value="<?php echo $pEmail ?>">
            <strong>Mobile Number: </strong><input type="text" name="mobile" class="form-control form-control"
                value="<?php echo $mobile ?>">
            <strong>Category: </strong><input type="text" name="category" class="form-control form-control" readonly
                value="<?php echo $category ?>">
            <strong>Food Preference: </strong><input type="text" name="food" class="form-control form-control"
                value="<?php echo $food ?>"><br>
            <button type="submit" class="btn btn-primary btn-lg" name="update">Update</button>
            <button type="submit" class="btn btn-danger btn-lg" name="delete">Delete</button>
            <a href="viewbirthdays.php" class="btn btn-dark btn-lg" role="button">Home</a>
        </form>
    </div>


    <div id="flip" style="width: 600px; float: right; margin-top: -13cm"><span id="treat">Organize a
            Treat</span></div>
    <div id="panel" style="width: 600px; float: right; margin-top: -11.75cm;text-align: left ">
        <form name="frmTreat" action="#" method="POST">
            <strong class="treatfont">Shedule Date </strong> <input type="date" id="sheduleDate" name="sheduleDate" value="2019-01-01"
                min="1920-01-01" max="2200-12-31" class="form-control" required>
            <strong class="treatfont">Time: </strong> <input type="time" name="time" class="form-control form-control"
                required>
            <strong class="treatfont">Venue: </strong><input type="text" name="venue" class="form-control form-control"
                required>

            <strong class="treatfont">Notes: </strong><input type="text" name="notes"
                class="form-control form-control"><br>
            <div class="form-group">
                <label class="treatfont" style="font-weight: bold" for="Category">Category:</label>
                <br>
                <div class="form-check-inline">
                    <label class="form-check-label treatfont">
                        <input type="radio" class="form-check-input" value="pending" name="state" checked>Pending
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label treatfont">
                        <input type="radio" class="form-check-input" value="confirmed" name="state">Confirmed
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label treatfont">
                        <input type="radio" class="form-check-input" value="celebrated" name="state">Celebrated
                        
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label treatfont">
                        <input type="radio" class="form-check-input" value="cancelled" name="state">Cancelled
                    </label>
                </div>
                <button type="submit" class="btn btn-success " name="startTreat">Start Treat</button>
        </form>





    </div>



</body>

</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./js/functions.js"></script>