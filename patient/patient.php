<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}

$usersession = $_SESSION['patientSession'];


$sql="SELECT * FROM patientinfo WHERE username='$usersession'";

$res = mysqli_query($con,$sql);

$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);
?>


<?php
$service = mysqli_query($con,"SELECT * from servicecontent where id ='1'");
$services = mysqli_fetch_array($service);
$service2 = mysqli_query($con,"SELECT * from servicecontent where id ='2'");
$services2 = mysqli_fetch_array($service2);
$service3 = mysqli_query($con,"SELECT * from servicecontent where id ='3'");
$services3 = mysqli_fetch_array($service3);
$service4 = mysqli_query($con,"SELECT * from servicecontent where id ='4'");
$services4 = mysqli_fetch_array($service4);
$service5 = mysqli_query($con,"SELECT * from servicecontent where id ='5'");
$services5 = mysqli_fetch_array($service5);
$service6 = mysqli_query($con,"SELECT * from servicecontent where id ='6'");
$services6 = mysqli_fetch_array($service6);
$service7 = mysqli_query($con,"SELECT * from servicecontent where id ='7'");
$services7 = mysqli_fetch_array($service7);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Patient Dashboard</title>
		<!-- Bootstrap -->
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="assets/img/Tooth.ico" rel="icon">
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		
	</head>
	<body>

        <?php
        $nav = mysqli_query($con,"SELECT * from header");
        $navv = mysqli_fetch_array($nav);
        ?>
        <style>
            .navbar
            {
                background:<?php echo $navv['color'];?>;
                
            }
            
        </style>
		<!-- navigation -->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
					<?php
                    $header = mysqli_query($con,"SELECT * from header");
                    $headers = mysqli_fetch_array($header);
                    ?>
                    <a class="navbar-brand" href="patient.php" style="color:<?php echo$headers['header_color'];?>;"><?php echo $headers['header_title'];?><img alt=""></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php"><img src="assets/img/Home_16.png">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Planner_16.png"> Appointment</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/Profile_16.png"> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Profile_16.png"> Profile</a>
								</li>
                                <li>
                                    <a href="dentalrecords.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Medical_16.png"> Dental Records</a>
                                </li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><img src="assets/img/logout_16.png"> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
					<!-- Modal for Prosthodontics-->
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo Fernandez</h4>
                                
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Prosthodontics'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";


                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Prosthodontics end -->

                                <!-- Modal for Cosmetic/Aesthetic-->
                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services2['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo/Mikee Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Cosmetic/Aesthetic'LIMIT 13");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Cosmetic/Aesthetic end -->

                                <!-- Modal for Surgery-->
                            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services3['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Dental Surgery'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Surgery end -->

                                <!-- Modal for Orthodontics-->
                            <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services4['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Susan Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Orthodontics'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Orthodontics end -->

                                <!-- Modal for TMJ specialist-->
                            <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services5['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Susan Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='TMJ specialist'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal TMJ specialist end -->

                                <!-- Modal for Preventive pediatric-->
                            <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services6['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Mikee Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Preventive pediatric'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Preventive pediatric end -->

                                <!-- Modal for Periodontics-->
                            <div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;"><?php echo $services7['service'];?></h3><h4 style="text-align: center;">Offered By: Dr.Mikee Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Periodontics'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                              
                            </div>
                        </div>
                    </div>
                </div>

		                    	<!-- Modal Periodontics end -->

		<!-- navigation -->
		
		<!-- 1st section start -->
        <?php
        $background = mysqli_query($con,"SELECT * from background where id ='1'");
        $backgrounds = mysqli_fetch_array($background);

        $background2 = mysqli_query($con,"SELECT * from background where id ='2'");
        $backgrounds2 = mysqli_fetch_array($background2);

        $background3 = mysqli_query($con,"SELECT * from background where id ='3'");
        $backgrounds3 = mysqli_fetch_array($background3);

        ?>
        <?php
        $welcome = mysqli_query($con,"SELECT * from welcome");
        $welcomes = mysqli_fetch_array($welcome);
        ?>
        <style>
.mySlides {display:none;}
</style>
        
        <div class="w3-content w3-section">
  <?php echo "<img class='mySlides' src='../doctor/uploads/".$backgrounds['background']."' style='width:1400px;height:680px;margin-left:-180px;'>"?>
 <?php echo "<img class='mySlides' src='../doctor/uploads/".$backgrounds2['background']."' style='width:1400px;height:680px;margin-left:-180px;'>"?>
  <?php echo "<img class='mySlides' src='../doctor/uploads/".$backgrounds3['background']."' style='width:1400px;height:680px;margin-left:-180px;'>"?>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}       
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 3000); // Change image every 3 seconds
}
</script>
		<section>
            <!-- <?php echo "<img src='../doctor/uploads/".$backgrounds['background']."' style='height:690px;width:100%;'>";
                                ?> -->
			<div class="container" >
				<div class="row"style="margin-top: -440px;">
					<div class="col-xs-12 col-md-8">
						
						
						<?php if ($userRow['patientMaritialStatus']=="") {
						// <!-- / notification start -->
						echo "<div class='row'>";
							echo "<div class='col-lg-12'>";
								echo "<div class='alert alert-danger alert-dismissable'>";
									echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
									echo " <i class='fa fa-info-circle'></i>  <strong>Please complete your profile.</strong>" ;
								echo "  </div>";
							echo "</div>";
							// <!-- notification end -->
							
							} else {
							}
							?>
							<!-- notification end -->
							<h2 style="margin-top: -10%;">Hi <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?>. Make an appointment today!</h2><br>

                      
                            <label class="label label-danger label-center">Services with estimated time of 1 hour and above should walk-in</label><br>
                            <label>Select service to do:</label> 
                            <select name="service_name" id="service_name" class="form-control input-md" style="width:50%;" onchange="showUser(this.value)">
                                <option></option>
                                <?php

                              $re = mysqli_query($con,"SELECT distinct service_name from service where service_time <='60'");
                              while ($rere = mysqli_fetch_array($re)) {

                             ?>
                             <option value="<?php echo $rere['service_name']; ?>"><?php echo $rere['service_name']; ?></option>
                              <?php }
                                    ?>
                            </select>
<!--                             <label>Prescribed Doctor :</label> 

                            <select id="prescribed" name="prescribed" class="form-control input-md" style="width: 50%;">
                            
                            <option id="pres"> </option>
                            </select>
 -->
                            <br>
                            <label>Select Date:</label>
							<div class="input-group" style="margin-bottom:10px;">

								<div class="input-group-addon">
									<img src="assets/img/Calendar_16.png">
									
								</div>

								<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
							</div>
						</div>
                       <!--  <script>
function showuser1(str1)
{
    if(str1 == "")
    {
        document.getElementById("pres").innerHTML = "no selected";
        return;

    }
    else

    {
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        }
    else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("pres").innerHTML = xmlhttp.responseText;
                        }
                        };
                        xmlhttp.open("GET","getservice.php?g="+str1,true);
                        console.log(str1);
                        xmlhttp.send();

                        

    }
}

</script> -->
    					<!-- date textbox end -->
						<!-- script start -->
                        <script>
                        function showUsers() {
    // Retrieve values from the selects
    var t = document.getElementByID('service_name').value;
    var q = document.getElementByID('date').value;

    if (t=="" || q == "") {
        document.getElementById("txtHint").innerHTML="No data to be shown";
        return;
    } 

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET","getservicename.php?q="+q+"&t="+t,true);
    xmlhttp.send();
}
            </script>
						<script>
						function showUser(str,strs) {
					       var q = document.getElementById('date').value;
                           var t = document.getElementById('service_name').value;
                           strs = t;
                           str = q;
						if (str == "" || strs == "") {
						document.getElementById("txtHint").innerHTML = "No data to be shown";
						return;
						} else {
						if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
						};
						xmlhttp.open("GET","getservicename.php?q="+str+"&t="+strs,true);
						console.log(str,strs);
						xmlhttp.send();
						}
						}
						</script>



                        <!-- <script>
                        function showdoctor(str) {
                        
                        if (str == "") {
                        document.getElementById("prescribed").innerHTML = "No data to be shown";
                        return;
                        } else {
                        if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                        } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("prescribed").innerHTML = xmlhttp.responseText;
                        }
                        };
                        xmlhttp.open("GET","getservice.php?g="+str,true);
                        console.log(str);
                        xmlhttp.send();
                        }
                        }
                        </script> -->
						
						<!-- script start end -->
						
						<!-- table appointment start -->
						<!-- <div class="container"> -->
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div id="txtHint"></div>
								</div>

							</div>
						</div>
						<!-- </div> -->
						<!-- table appointment end -->
					</div>
				</div>
				<!-- /.row -->
			</div>
		</section>
		<br>
		<!-- first section end -->
		<!-- forth sections start -->
		<style>
			.underlined-title h1
			{
			    color: #2c3e50;
			    margin: 0;
			}

			.underlined-title h2
			{
			    font-size: 20px;
			    text-transform: uppercase;
			    font-weight: 700;
			    color: #95a5a6;
			}

			.underlined-title hr
			{
			    width: 10%;
			    border-width: 2px;
			    border-color: #16a085;
			}
		</style>
		<br>
        
		<div class="service-bg">
            <div class="container" id="SERVICES">
                <div class="underlined-title">
                    <br>
                    <h1>Services Offered</h1>
                    
                    <h2>We provide a better service</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2"> 
                        </div>
                        <div class="col-xs-10">
                            <?php echo "<img src='../doctor/uploads/".$services['image']."'>";?>
                            <h4><?php echo $services['service'];?></h4>
                            <p><?php echo $services['descriptions'];?></p>
                            <button type="button" data-toggle="modal" data-target="#myModal1"class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                             <?php echo "<img src='../doctor/uploads/".$services2['image']."'>";?>
                            <h4><?php echo $services2['service'];?></h4>
                            <p><?php echo $services2['descriptions'];?></p>
                            <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">      
                        </div>
                        <div class="col-xs-10"> 
                            <?php echo "<img src='../doctor/uploads/".$services3['image']."'>";?>
                            <h4><?php echo $services3['service'];?></h4>
                            <p><?php echo $services3['descriptions'];?></p>
                            <button type="button" data-toggle="modal" data-target="#myModal3" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <?php echo "<img src='../doctor/uploads/".$services4['image']."'>";?>
                            <h4><?php echo $services4['service'];?></h4>
                            <p><?php echo $services4['descriptions'];?></p>
                            <button type="button" data-toggle="modal" data-target="#myModal4" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <?php echo "<img src='../doctor/uploads/".$services5['image']."'>";?>
                            <h4><?php echo $services5['service'];?></h4>
                            <p><?php echo $services5['descriptions'];?></p>
                            <button type="button" data-toggle="modal" data-target="#myModal5" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <?php echo "<img src='../doctor/uploads/".$services6['image']."'>";?>
                            <h4><?php echo $services6['service'];?></h4>
                            <p><?php echo $services6['descriptions'];?></p>
                            <button type="button"data-toggle="modal" data-target="#myModal6" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <?php echo "<img src='../doctor/uploads/".$services7['image']."'>";?>
                            <h4><?php echo $services7['service'];?></h4>
                            <p><?php echo $services7['descriptions'];?></p>
                            <button type="button" data-toggle="modal" data-target="#myModal7" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <br>
        </div>

		<!-- forth section end -->
		<style>
			.copyright-bar
            {
                background:#00679A;
            }
		</style>
		<!-- footer start -->
        <?php 
        $footer = mysqli_query($con,"SELECT * from footer");
        $footers = mysqli_fetch_array($footer);
        ?>
        <div class="copyright-bar">
    <div class="container">
        <p class="pull-left small" style="color:<?php echo$footers['footer_color'];?>"><?php echo $footers['title']?></p>
        
    </div>
</div>

        <!-- footer end -->
		<!-- footer end -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- date start -->
		<script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script>
		<!-- date end -->
		
		
	</body>
</html>