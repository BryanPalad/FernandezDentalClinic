<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (isset($_GET['appid'])) {

$appid = $_GET['appid'];

$res = mysqli_query($con, "SELECT a.*,b.*,c.* from schedule a join patientinfo b on a.icpatient = b.icPatient join doctor c on a.doctorid = c.doctorid where appointmentid =$appid");

$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);
}
?>
<script>
window.print();
</script>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Print Invoice</title>
        <link rel="icon" href="assets/img/tooth.ico">
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="assets/img/dental.png" style="width:100%; max-width:300px;">
                                </td>
                                
                                <td>
                                    Invoice #: <?php echo $userRow['appointmentid'];?><br>
                                    Created: <?php echo date("Y-m-d");?><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <?php echo $userRow['patientAddress'];?>
                                </td>
                                
                                <td>
                                    <?php echo $userRow['patientFirstName'];?> <?php echo $userRow['patientLastName'];?><br>
                                    <?php echo $userRow['patientEmail'];?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                
                <tr class="heading">
                    <td>
                        Appointment Details
                    </td>
                    
                    <td>
                       
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Appointment Date
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDate'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Appointment Time
                    </td>
                    
                    <td>
                        <?php echo date("h:i A", strtotime($userRow['startTime']));?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Service/s
                    </td>
                    
                    <td>
                        <?php echo $userRow['servicename'];?> 
                    </td>
                </tr>

                    <tr class="item">
                    <td>
                        Remark/s
                    </td>
                    
                    <td>
                        <?php echo $userRow['complain'];?> 
                    </td>
                </tr>


                <tr class="item">
                    <td>
                        Doctor Name
                    </td>
                    
                    <td>
                        <?php echo $userRow['doctorFirstName'];?> <?php echo $userRow['doctorLastName'];?> 
                    </td>
                </tr>
                
                
                
            </table>
        </div>
        <br>
        <div class="print">
        <!--<button onclick="myFunction()">Print this page</button>-->
</div>
<script>
function myFunction() {

    window.print();
    
}
</script>
    </body>
</html>