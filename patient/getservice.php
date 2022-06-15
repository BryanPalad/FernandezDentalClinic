

<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$g = $_GET['g'];
$res = mysqli_query($con,"SELECT * FROM service WHERE service_name = '$g'");
	
while($row = mysqli_fetch_array($res))
{

if (!$res) {
die("Error running $sql: " . mysqli_error());
}

  echo $row['doctorFirstName']." ".$row['doctorLastName']."  ";
}                           
       
      
       
        

                      

                         

                            
               

                   
                    // if ($rowapp['bookAvail']!="available") {
                    // $btnstate="disabled";
                    // } else {
                    // $btnstate="";
                    // }


                    // echo "<td><a href='appointment.php?&appid=" . $row['scheduleId'] . "&scheduleDate=".$q."'>Book</a></td>";
                    // <td><button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#exampleModal'>Book Now</button></td>";
                    //triggered when modal is about to be shown
                    ?>
                    
                 
                    <!-- ?> -->
                </tr>
                
                <?php
                
                
                ?>
            </tbody>
