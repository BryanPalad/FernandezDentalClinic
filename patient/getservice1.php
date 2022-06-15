<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$w = $_GET['w'];
$res = mysqli_query($con,"SELECT * FROM service WHERE service_name = '$w'");

$row = mysqli_fetch_array($res);
if (!$res) {
die("Error running $sql: " . mysqli_error());
}

   

                              
                               while ($row = mysqli_fetch_array($res)){


  echo $row['doctorFirstName']." ".$row['doctorLastName'];
                               
}
 ?>
                    
                 
                    <!-- ?> -->
                </tr>
                
                <?php
                
                
                ?>
            </tbody>