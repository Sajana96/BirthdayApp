<?php
if(!isset($_SESSION['name'])){
    exit( "<h1>You must logged in First!!!!!<h1><a href='login.php'>Return</a>");
}
$msg="";

function rangeWeekNext ($datestr) {
    date_default_timezone_set (date_default_timezone_get());
    $dt = strtotime ($datestr);
    return array (
      "start" => date ('N', $dt) == 1 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('last monday', $dt)),
      "end" => date('N', $dt) == 7 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('next sunday', $dt))
    );
  }

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    






    <?php
                    
                        $con = mysqli_connect("localhost", "root", "", "birthday");
                
                    if(!$con) {
                        echo "Error: unable to connect to MySQL." . PHP_EOL;
                        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                        echo "Debugging error:" . mysqli_connect_error() . PHP_EOL;
                        exit;
                      }
                     
                      $datetime = new DateTime('tomorrow + 6days');
                      $datetimeStandard = $datetime->format("Y-m-d");
                      $arrayThisWeek = (rangeWeekNext(date($datetimeStandard)));
                      echo $arrayThisWeek['start']."   ".$arrayThisWeek['end']."<br>";
                      $firstDayMonth = date("m",strtotime($arrayThisWeek['start']));;
                      $lastDayMonth = date("m",strtotime($arrayThisWeek['end']));;
                      $firstDay = date("d",strtotime($arrayThisWeek['start']));
                      $lastDay = date("d",strtotime($arrayThisWeek['end']));
                      echo $firstDay."-".$firstDayMonth." to ".$lastDay."-".$lastDayMonth;
                      $query = "SELECT * FROM userdetails where month(DOB) BETWEEN '$firstDayMonth' and '$lastDayMonth' and day(DOB) BETWEEN '$firstDay' AND '$lastDay' ORDER BY `userdetails`.`DOB` DESC";

                      
                    $results = mysqli_query($con,$query);
                    
                    if(mysqli_num_rows($results)==0){
                        $msg = "No Birthdays for next week";
                    }

                    else{
                        echo"<div class='container' id='alluser'>
                        <h2>All Users</h2>
                
                        <table class='table table-dark table-hover' id='viewUserTbl'>
                            <thead>
                                <tr>
                                    <th style='display:none'>userID</th>
                                    <th>Full Name</th>
                                    <th>Date of Birth</th>
                                    <th>Age</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Group</th>
                
                
                
                
                                </tr>
                            </thead>
                            <tbody>";
                while($row = mysqli_fetch_assoc($results)){
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
                    <td style='display:none'>".$row['user_id']."</td>
                    <td>".$row['fname']." ".$row['lname']."</td>
                    <td>".$row['DOB']."</td>
                    <td>".$age."</td>
                    <td>".$row['pemail']."</td>
                    <td>".$row['mobile']."</td>
                    <td>".$row['category']."</td>
                    </tr>";
                }
                echo"</tbody>
                </table>
            </div>";
            }
        
                ?>
    <h5 class="text-danger text-center" id="error"><?php echo $msg; ?></h5>


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
<script src="./js/functions.js"></script>