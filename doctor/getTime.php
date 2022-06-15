<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session= $_SESSION['patientSession'];

    if(isset($_GET['startDate']) && isset($_GET['docID'])){
        $docId = $_GET['docID'];
        $scheduleDate = $_GET['startDate'];

        if(strtotime('today') > strtotime($scheduleDate))
        {
            ?>
            <script type="text/javascript">
                alert('Schedule Date/Time is Passed. Please select an advance date.');
            </script>
            <?php
        }
        else
        {
        $queryGetDocSched = "select * from doctorschedule where doctorId=$docId and scheduleDate='$scheduleDate'";
        $prepare1 = mysqli_query($con, $queryGetDocSched);
        $result1 = mysqli_fetch_array($prepare1, MYSQLI_ASSOC);

        $docStartTime = $result1['startTime'];
        $docEndTime = $result1['endTime'];
        $docTimeToRender = round(abs(strtotime($docStartTime) - strtotime($docEndTime)) / 3600,2); // Get hours that will be rendered by the doctor
        $scheduleDate = date("Y-m-d", strtotime($scheduleDate));
        $statement = "select * from schedule where doctorId = $docId and scheduleDate = '$scheduleDate' and status !='cancelled'";
        $prepare = mysqli_query($con, $statement);
        $availableTime =  date("h:i A", strtotime($docStartTime)); //display time in HH:MM A manner
        $notAvailableTime = [];

        while($row = mysqli_fetch_array($prepare))
        {
            $notAvailableTime[] = $row['startTime'];
        }
        for($i = 1; $i <=$docTimeToRender; $i++){
            if(!in_array(date("H:i:s", strtotime($availableTime)),$notAvailableTime)){
                echo '<option value="' . date("H:i:s", strtotime($availableTime)) . '"' . '>' . $availableTime .'</option>';
            }
            $availableTime = date("h:i A",strtotime($availableTime) + 3600);
        }

    }
    }
?>
<style type="text/css">
    .style
    {
        color: red;
    }
</style>