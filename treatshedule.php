<?php
$con = mysqli_connect('localhost', 'root', '', 'birthday');

if(!$con) {
  echo "Error: unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error:" . mysqli_connect_error() . PHP_EOL;
  exit;
}

$query = "SELECT t.treat_id, u.user_id, u.fname, u.lname, u.DOB, u.category, t.sheduleDate, t.sheduleTime, t.venue, t.state FROM treats t, userdetails u where t.user_id = u.user_id";

$result = mysqli_query($con, $query);

if(!$result) {
  echo "Error: failed to execute query - $query" . PHP_EOL;
  echo "Debugging error: " . mysqli_error() . PHP_EOL;
  exit;

}
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php
  require_once("navbar.php");
  ?>

    <div class="container" id="alluser" >
        <h2>Treats</h2>

        <table class="table table-dark table-hover" id="treatTbl">
            <thead>
                <tr>
                    <th style='display:none'>treatID</th>
                    <th style='display:none'>userID</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Age</th>
                    <th>Category</th>
                    <th>Treat Date</th>
                    <th>Treat Time</th>
                    <th>Treat Venue</th>
                    <th>State</th>




                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)){
                    //date in mm/dd/yyyy format; or it can be in other formats as well
                    $birthDate = $row['DOB'];
                    //explode the date to get month, day and year
                     $birthDate = explode("-", $birthDate);
                    //echo $birthDate[2]." ".$birthDate[1]." ".$birthDate[0];
                        //get age from date or birthdate
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
                            ? ((date("Y") - $birthDate[0]) - 0)
                                : (date("Y") - $birthDate[0]));
  
                echo"<tr>
                    <td style='display:none'>".$row['treat_id']."</td>
                    <td style='display:none'>".$row['user_id']."</td>
                    <td>".$row['fname']." ".$row['lname']."</td>
                    <td>".$row['DOB']."</td>
                    <td>".$age."</td>
                    <td>".$row['category']."</td>
                    <td>".$row['sheduleDate']."</td>
                    <td>".$row['sheduleTime']."</td>
                    <td>".$row['venue']."</td>
                    <td>".$row['state']."</td>
                    </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
                <?php
                
                if(!isset($_SESSION['name'])){
                    exit( "<h1>You must logged in First!!!!!<h1><a href='login.php'>Return</a>");
                }
                if(isset($_GET['treatid'])){
                    $treatId = $_GET['treatid'];
                    $query1 = "SELECT t.treat_id, u.user_id, u.fname, u.lname, u.DOB, u.category, t.sheduleDate, t.sheduleTime, t.venue, t.state FROM treats t, userdetails u where t.user_id = u.user_id and treat_id='$treatId'";
    
                    $result1 = mysqli_query($con, $query1);
                    $row1 = mysqli_fetch_assoc($result1);

                    $fullName = $row1['fname']." ".$row1['lname'];
                    $date = $row1['sheduleDate'];
                    $time = $row1['sheduleTime'];
                    $venue = $row1['venue'];
                    $state = $row1['state'];


                    echo" <div id='flip' style='width: 600px; float: left; margin-top: 0cm; margin-left:8cm'><span id='treat'>Update Treat</span></div>
            <div id='panel' style='width: 600px; float: left; margin-top: 0cm;margin-left:8cm;text-align: left; display:inline '>
                <form name='frmUpdateTreat' action='#' method='POST'>

                <strong class='treatfont'>Name: </strong><input type='text' name='name' readonly
                class='form-control form-control' value='$fullName'><br>

                    <strong class='treatfont'>Shedule Date </strong> <input type='date' id='sheduleDate' name='sheduleDate' value='$date'
                        min='1920-01-01' max='2200-12-31' class='form-control' required>

                    <strong class='treatfont'>Time: </strong> <input type='time' name='time' class='form-control form-control' value='$time'
                        required>

                    <strong class='treatfont'>Venue: </strong><input type='text' name='venue' class='form-control form-control' value='$venue'
                        required>

                        <strong class='treatfont'>Category: </strong><input type='text' name='categoryR' readonly
                        class='form-control form-control' value='$state'><br>
        
                   <br>
                    <div class='form-group'>
                        <label class='treatfont' style='font-weight: bold' for='Category'>Category:</label>
                        <br>
                        <div class='form-check-inline'>
                            <label class='form-check-label treatfont'>
                                <input type='radio' class='form-check-input' value='pending' name='state' >Pending
                            </label>
                        </div>
                        <div class='form-check-inline'>
                            <label class='form-check-label treatfont'>
                                <input type='radio' class='form-check-input' value='confirmed' name='state'>Confirmed
                            </label>
                        </div>
                        <div class='form-check-inline'>
                            <label class='form-check-label treatfont'>
                                <input type='radio' class='form-check-input' value='celebrated' name='state'>Celebrated
                                
                            </label>
                        </div>
                        <div class='form-check-inline'>
                            <label class='form-check-label treatfont'>
                                <input type='radio' class='form-check-input' value='cancelled' name='state'>Cancelled
                            </label>
                        </div>
                        <br><br>
                        <button type='submit' class='btn btn-success ' name='updateTreat'>Update</button>&nbsp;&nbsp;
                        <button type='submit' class='btn btn-danger ' name='delete'>Delete</button>
                </form>
        
        
        
        
        
            </div>";
                        if(isset($_POST['updateTreat'])){
                            $uDate = $_POST['sheduleDate'];
                            $uTime = $_POST['time'];

                            $uVenue = $_POST['venue'];
                            if(empty($_POST['state'])){
                                $uState = $_POST['categoryR'];
                            }
                            else{
                            $uState = $_POST['state'];
                            }
                            $queryUpdate="Update treats set sheduleDate='$uDate', sheduleTime='$uTime', venue='$uVenue', state='$uState' where treat_id='$treatId'";
                            $resultUpdate = mysqli_query($con,$queryUpdate);
    
       
                            if($resultUpdate){
                                exit( "<h1>Updated<h1><a href='treatshedule.php'>Return</a>");

                            }
                        }
                        if(isset($_POST['delete'])){
                           
                            
                        
                            $queryDelete="Delete from treats where treat_id='$treatId'";
                            $resultsDelete = mysqli_query($con,$queryDelete);

                            if($resultDelete){
                                exit( "<h1>Deleted<h1><a href='treatshedule.php'>Return</a>");

                            }
                           
                          
                        }



                }
                
                
                
                
                
                ?>
   
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script >
document.querySelectorAll('#treatTbl tr')
    .forEach(e => e.addEventListener("click", function () {
        if (this.rowIndex > 0) {
            var treatId = this.cells[0].innerHTML;
            var redirectUrl = "treatshedule.php?treatid=";
            window.location.href = redirectUrl.concat(treatId);
        }
    }));

   
</script>


</html>