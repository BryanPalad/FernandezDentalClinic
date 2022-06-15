<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Walk-in</title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/img/tooth.ico" rel="icon">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
         <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Custom Fonts -->
        
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="doctordashboard.php" style="color: white;">Welcome Dr. <?php echo $userRow['doctorFirstName'];?> <?php echo $userRow['doctorLastName'];?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/Profile_16.png"> <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php"><img src="assets/img/Profile_16.png"> Profile</a>
                            </li>
                            <li>
                                <a href="settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><img src="assets/img/logout_16.png"> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li  class="active">
                            <a href="walkin.php"><i class="fa fa-fw fa-user"></i> Walk-in </a>
                        </li>
                        <li>
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Doctor Schedule</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> Patient List</a>
                        </li>
                        <li>
                            <a href="services.php"><i class="fa fa-fw fa-th-list"></i> Services </a>
                        </li>
                         <li>
                            <a href="doctors.php"><i class="fa fa-fw fa-stethoscope"></i> Doctors </a>
                        </li>
                        <li>
                            <a href="reports.php"><i class="fa fa-fw fa-folder"></i> Reports </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <!-- navigation end -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Walk-in 
                            </h2>
                        </div>
                    </div>
                   
                   <h5>Add Patient's Information</h5>
                   <form action="walkin.php" method="POST" onsubmit="return('Are you sure you want to submit this appointment information?')">
                   <div class="col-md-4">
                    <input type="text" name="lastname" class="form-control input-lg" placeholder="Enter Last Name" required="">
                   </div>
                   <div class="col-md-4">
                    <input type="text" name="firstname" class="form-control input-lg" placeholder="Enter First Name" required="">
                   </div>
                   <div class="col-md-4">
                    <input type="email" name="patientEmail" id="patientEmail" class="form-control input-lg" placeholder="Enter Email Address">

                   </div>
                   <div class="col-md-12">
            <br>
         <label><strong>Select Birth Date:</strong></label>
         
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Month</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>

                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">Day</option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required >
                                                    <option value="">Year</option>
                                                    
                                                    <option value="1950">1950</option>
                                                    <option value="1951">1951</option>
                                                    <option value="1952">1952</option>
                                                    <option value="1953">1953</option>
                                                    <option value="1954">1954</option>
                                                    <option value="1955">1955</option>
                                                    <option value="1956">1956</option>
                                                    <option value="1957">1957</option>
                                                    <option value="1958">1958</option>
                                                    <option value="1959">1959</option>
                                                    <option value="1960">1960</option>
                                                    <option value="1961">1961</option>
                                                    <option value="1962">1962</option>
                                                    <option value="1963">1963</option>
                                                    <option value="1964">1964</option>
                                                    <option value="1965">1965</option>
                                                    <option value="1966">1966</option>
                                                    <option value="1967">1967</option>
                                                    <option value="1968">1968</option>
                                                    <option value="1969">1969</option>
                                                    <option value="1970">1970</option>
                                                    <option value="1971">1971</option>
                                                    <option value="1972">1972</option>
                                                    <option value="1973">1973</option>
                                                    <option value="1974">1974</option>
                                                    <option value="1975">1975</option>
                                                    <option value="1976">1976</option>
                                                    <option value="1977">1977</option>
                                                    <option value="1978">1978</option>
                                                    <option value="1979">1979</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                </select>
                                            </div>
                                        </div>
                                    


    </div>


    <div class="col-md-12">
         
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <input type="text" onkeypress="return alpha(event)" name="occupation" class="form-control input-lg" placeholder="Occupation">

                                            </div>

                                            <div class="col-xs-4 col-md-4">
                                                <div class="gender" style="margin-top: 2%;">
                                                <select name="patientGender" class="form-control input-lg">
                                                    <option>Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>

                                                </select>
                                         </div>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="status" class = "form-control input-lg" required>
                                                    <option value="">Civil Status</option>
                                                    
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Separated">Separated</option>
                                                    <option value="Divorced">Divorced</option>
                                                         <option value="Widowed">Widowed</option>
                                                                                       </select>
                                            </div>
                                        </div>
                                    


    </div>

    <div class="span6">
    
    <div class="col-md-12">
        <div class="control-group">
            <div class="controls">
            <input type="text" name="patientAddress" class="form-control input-lg" value="<?php if (isset($_POST['signup'])){echo $address;} ?>" placeholder="*Current Address" required>

            </div>
        </div>
    </div>

        
        <div class="col-md-12">
        <div class="control-group">
            <div class="controls">
            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "11" name="contactno" class="form-control input-lg"value="<?php if (isset($_POST['signup'])){echo $contact;} ?>"placeholder="*Contact No" required>
            <br>
            </div>
        </div>
        </div>
    </div>

                                <div class="col-md-4">
                                <button type="submit" name='walkinsubmit' class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                <!-- /.container-fluid -->
            </div>
            <div class="panel panel-primary filterable">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Patient List</h3>
                            <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Search</button>
                        </div>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                           <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                   
                                    <th>Image</th>
                                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Contact No." disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Email Address" disabled></th>
                                    <!-- <th><input type="text" class="form-control" placeholder="Email" disabled></th> -->
                                    <th><input type="text" class="form-control" placeholder="Gender" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Birthdate" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Address" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 

                            $result=mysqli_query($con,"SELECT * FROM patientinfo where status ='Active'");
                            

                                  
                            while ($patientRow=mysqli_fetch_array($result)) {
                                 $_SESSION['patientSession'] = $patientRow['icPatient'];
                              
                                echo "<tbody>";
                                echo "<tr>";
                                    echo "<td> <img src='../patient/uploads/".$patientRow['image']."' style='height:60px;'></td>";
                                    echo "<td>" . $patientRow['patientFirstName'] . " ". $patientRow['patientLastName'] . "</td>";
                                    echo "<td>" . $patientRow['patientPhone'] . "</td>";
                                     echo "<td>" . $patientRow['patientEmail'] . "</td>";
                                    echo "<td>" . $patientRow['patientGender'] . "</td>";
                                    echo "<td>" . $patientRow['patientMaritialStatus'] . "</td>";
                                    echo "<td>" . $patientRow['patientDOB'] . "</td>";
                                    echo "<td>" . $patientRow['patientAddress'] . "</td>";
                                    echo "<form method='POST'>";
                                     echo "<td class='text-center'><a href='walkappointment.php?walk=".$patientRow['icPatient']."' title='Make an appointment'><img src='assets/img/edit_16.png' aria-hidden='true'></span></a></td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                       
                        echo "</div>";
                        echo "</div>";
                        ?>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>

            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <?php
        if(isset($_POST['walkinsubmit']))
        {
            // for patient info //
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $patientEmail = $_POST['patientEmail'];
            $month = $_POST['month'];
            $day = $_POST['day'];
            $year = $_POST['year'];
            $patientDOB = $year . "-" . $month . "-" . $day;
            $occupation = $_POST['occupation'];
            $Gender = $_POST['patientGender'];
            $status = $_POST['status'];
            $address = $_POST['patientAddress'];
            $contact = $_POST['contactno'];
            // for appointment info //
            $service = $_POST['services'];
            $addservice = $_POST['addservice'];
            $services = $service." ".$addservice;
            $startDate = $_POST['startDate']; 
            $startTime = $_POST['startTime'];

            $sql = mysqli_query($con,"INSERT into patientinfo (icPatient,username,password,patientFirstName,patientLastName,patientMaritialStatus,patientDOB,patientGender,patientAddress,patientPhone,patientEmail,verified,patient,status,image,patientOccupation) values (default,'none','none','$firstname','$lastname','$status','$patientDOB','$Gender','$address','$contact','$patientEmail','0','New','Active','not-available.png','$occupation')");
            ?>
            <script type="text/javascript">
                alert('Successfully added patient');
                window.location.href = 'walkin.php';
            </script>
            <?php
        }
 
        ?>

       
        <!-- jQuery -->
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <script src="../patient/assets/js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/date/bootstrap-datepicker.js"></script>
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        
        <script>
        $(document).ready(function(){
        var date_input=$('input[name="startDate"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        })
        })
        </script>
        <script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
<script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function(){
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                    }
                });
            });
        </script>
        <!-- script for jquery datatable end-->

    </body>
</html>