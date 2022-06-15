<?php
session_start();
include_once '../assets/conn/dbconnect.php';

$q = $_GET['q'];
$t = $_GET['t'];

$select = mysqli_query($con,"SELECT * from service where service_name ='$t'");
$fetched = mysqli_fetch_array($select);
$docid = $fetched['doctorId'];
$res = mysqli_query($con,"SELECT a.*,b.* FROM doctorschedule a INNER join service b on a.doctorId = b.doctorId WHERE a.scheduleDate='$q' and b.service_name='$t'");

if (!$res) {
die("Error running $sql: " . mysqli_error());
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>



        <?php
        if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-danger' role='alert'>There are no Doctor's Available at this moment. Please try again later.</div>";
        
        }    
        else if (strtotime('today') > strtotime($q))
        {
             echo "<div class='alert alert-danger' role='alert'>Schedule Date/Time is Passed. Please select an advance date.</div>";
        }
        else if (strtotime('today') == strtotime($q))
        {
             echo "<div class='alert alert-danger' role='alert'>You cant make an appointment today. Please select an advance date..</div>";
        }
        else {
        echo "   <table class='table table-hover'>";
            echo " <thead>";
                echo " <tr>";

                    echo " <th>Doctor</th>";
                    echo " <th>Date</th>";
                    echo "  <th>Start Time</th>";
                    echo "  <th>End Time</th>";
                    echo "  <th>Appointment!</th>";
                echo " </tr>";
            echo "  </thead>";
            echo "  <tbody>";
                while($row = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <?php
                    // $avail=null;
                    // $btnclick="";
                    if ($row['bookAvail']=='available') {
                    $avail="primary";
                    $btnstate="";
                    $btnclick="primary";    
                    }
                    else if ($row['bookAvail']=='halfday') {
                    $avail="primary";
                    $btnstate="";
                    $btnclick="primary";
                    }
                    else 
                    {
                    $avail="danger";
                    $btnstate="disabled";
                    $btnclick="danger";
                    }

                   
                    // if ($rowapp['bookAvail']!="available") {
                    // $btnstate="disabled";
                    // } else {
                    // $btnstate="";
                    // }

                     echo "<td>" . $row['doctorFirstName'] ." ".$row['doctorLastName']. "</td>";
                    echo "<td>" . $row['scheduleDate'] . "</td>";
                    echo "<td>" . date("h:i A", strtotime($row['startTime'])) . "</td>";
                    echo "<td>" . date("h:i A", strtotime($row['endTime'])) . "</td>";
                    // echo "<td> <span class='label label-".$avail."'>". $row['bookAvail'] ."</span></td>";
                    echo "<td><a href='appointment.php?&appid=" . $row['scheduleId'] . "&scheduleDate=".$q."&servicename=".$t."' class='btn btn-".$btnclick." btn-xs' role='button' ".$btnstate.">Book Now</a></td>";
                    // echo "<td><a href='appointment.php?&appid=" . $row['scheduleId'] . "&scheduleDate=".$q."'>Book</a></td>";
                    // <td><button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#exampleModal'>Book Now</button></td>";
                    //triggered when modal is about to be shown
                    ?>
                    
                    </script>
                    <!-- ?> -->
                </tr>
                
                <?php
                }
                }
                ?>
            </tbody>
            <!-- modal start -->
            
            
            
            
            
        </body>
    </html>