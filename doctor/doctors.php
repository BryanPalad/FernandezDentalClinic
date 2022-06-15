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
        <title>Doctors</title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/img/tooth.ico" rel="icon">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
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
                        <li>
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
                        <li class="active">
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
                            Doctors
                            </h2>
                            
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
                        <h3 class="panel-title">Doctors List</h3>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Search</button>
                        </div>
                        </div>
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
                                    <th><input type="text" class="form-control" placeholder="Birthdate" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Address" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM doctor where stats ='Active'");
                            

                                  
                            while ($doctorrow=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";
                                  echo "<td> <img src='uploads/".$doctorrow['image']."' style='height:60px;'></td>";
                                    echo "<td>" . $doctorrow['doctorFirstName'] ." ". $doctorrow['doctorLastName'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorPhone'] . "</td>";
                                     echo "<td>" . $doctorrow['doctorEmail'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorGender'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorDOB'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorAddress'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><a href='#' id='".$doctorrow['doctorid']."' class='delete'><img src='assets/img/Archive_16.png' aria-hidden='true'></span></a>
                            </td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                      
                        echo "</div>";
                        echo "</div>";
                        ?>
                        Add New Doctor?<a data-toggle="modal" data-target="#modaldoctor"><img src="assets/img/Addservice_32.png" style="cursor: pointer;"></a>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                </div>



                <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
                        <h3 class="panel-title">Inactive Doctors List</h3>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Search</button>
                        </div>
                        </div>
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
                                    <th><input type="text" class="form-control" placeholder="Birthdate" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Address" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM doctor where stats ='Inactive'");
                            

                                  
                            while ($doctorrow=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td> <img src='uploads/".$doctorrow['image']."' style='height:60px;'></td>";
                                    echo "<td>" . $doctorrow['doctorFirstName'] ." ". $doctorrow['doctorLastName'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorPhone'] . "</td>";
                                     echo "<td>" . $doctorrow['doctorEmail'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorGender'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorDOB'] . "</td>";
                                    echo "<td>" . $doctorrow['doctorAddress'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><a href='#' id='".$doctorrow['doctorid']."' class='act'><img src='assets/img/Archive_16.png' aria-hidden='true'></span></a>
                            </td>";
                               
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
                 <div class="modal fade" id="modaldoctor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <h3 class="modal-title" style="text-align: center; color: skyblue;">Add New Doctor</h3>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">

                                 <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">

                                  <div class="col-md-6">
                                  <input type="text" name="lname" placeholder="LastName" class="form-control input-lg" required="">
                                  <br>
                                  </div>
                                  <div class="col-md-6">
                                  <input type="text" name="fname" placeholder="FirstName" class="form-control input-lg" required="">
                                  <br>
                                  </div>


                            <div class="col-md-6">
                                <input type="password" name="pass" id="passpass" class="form-control input-lg" placeholder="Password" required="">
                            </div>


                        
                            <div class="col-md-6">
                                
                                 <input type="password" name="cpass" id="confirm" class="form-control input-lg" placeholder="Confirm Password" onkeyup="checkPasswordMatch();" required="">
                                  <div class="registrationFormAlert" id="divCheckPasswordMatch">
                            </div>

                                <br>
                            </div>


                               <div class="col-md-6">
                                
                                <input type="email" name="email" placeholder="Email Address" class="form-control input-lg" required="">
                              </div>

                                  <div class="col-md-4">
                                  
                                  <input type="number" name="contact" placeholder="Contact no" class="form-control input-lg" required="">
                                </div>
                               <div class="col-md-2">
                                
                                <select name="gender" class="form-control input-lg" required="">
                                    <option>Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <br>
                                </select>
                              </div>

                               <label><strong>Select Birth Date:</strong></label>
                                            <br>
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
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Year</option>
                                                    
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
                                        
                                <br>
                                <div class="col-md-12">
                                <input type="text" name="address" placeholder="Address" class="form-control input-lg" required="">
                                <br>
                            </div>
                              <input type="submit" value="Add Doctor" name="add" class="btn btn-primary" style="margin-left: 2%;"> 
                                  <div class="modal-footer">
                                   <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top:-10%;padding-bottom: -10%;">Close
                                   </button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- panel end -->


                    <?php

if(isset($_POST['add']))
{

$FirstName = $_POST['fname'];
$LastName  = $_POST['lname'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$email = $_POST['email'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$DOB = $year . "-" . $month . "-" . $day;
$Gender = $_POST['gender'];
$address = $_POST['address'];
$contact = $_POST['contact'];


    $sqld = "SELECT doctorFirstName from doctor where doctorFirstName = '$FirstName'";
    $sqlres = mysqli_query($con,$sqld);

    $count = mysqli_num_rows($sqlres);

    if($pass != $cpass)
    {
        ?>
        <script>
            window.alert('Password does not Match');
            window.location.href = 'doctors.php';
        </script>
        <?php
    }
    else if($count == 1)    
    {
        ?>
        <script>
            window.alert('Doctor already exists');
            window.location.href = 'doctors.php';
        </script>
        <?php
    }
    else
    {

    mysqli_query($con,"INSERT into doctor values (default,'$pass','$FirstName','$LastName','$address','$contact','$email','$DOB','$Gender','Active','not-available.png')") or die(mysql_error());

    ?>
    <script>
        window.alert("Successfully added Doctor");
        window.location.href = 'doctors.php';
    </script>
    <?php
        
}
}
?>




<script type="text/javascript">

    function checkPasswordMatch() {
    var password = $("#passpass").val();
    var confirmPassword = $("#confirm").val();


    if(password.length < 8)
        $("#divCheckPasswordMatch").html("<div class ='iddd'>*Password must be above 8 characters*</div>");
    else if(password == "" || confirmPassword == "")
        $("#divCheckPasswordMatch").html("");

    else if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<div class ='id'>*Password does not Match*</div>");
    else
        $("#divCheckPasswordMatch").html("<div class='idd'>*Password Match*</div>");
}
    $(document).ready(function () {
   $("#passpass, #confirm").keyup(checkPasswordMatch);
});


</script>

<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
}
</script>

<style type="text/css">
        .id 
        {
            color:red;
        }
        .idd
        {
            color: green;
        }
        .iddd
        {
            color: orange;
        }
    </style>

 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->


       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var appid = element.attr("id");
var info = 'id=' + appid;
if(confirm("Are you sure you want to set this doctor to Inactive?"))
{
    
 $.ajax({
   type: "POST",
   url: "deletedoctor.php",
   data: info,

   success: function(){

 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
  window.location.href = 'doctors.php';
 }
return false;

});
});
</script>

<script type="text/javascript">
$(function() {
$(".act").click(function(){
var element = $(this);
var ig = element.attr("id");
var info = 'ig=' + ig;
if(confirm("Are you sure you want to set this doctor to Active?"))
{
 $.ajax({
   type: "POST",
   url: "activedoctor.php",
   data: info,

   success: function(){
   
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
  window.location.href = 'doctors.php';
 }
return false;
});
});
</script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
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