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
<?php
    $sql = mysqli_query($con,"SELECT * from terms");
    $terms = mysqli_fetch_array($sql);
?>
<?php
if(isset($_POST['submitfaq']))
{   
    $faqid = $_POST['faqid'];
    $answer = $_POST['answer'];
    mysqli_query($con,"UPDATE faq set answer = '$answer',status='approved' where id ='$faqid'");

    ?>
    <script>
        alert('approved FAQ');
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Welcome Dr. <?php echo $userRow['doctorFirstName'];?> <?php echo $userRow['doctorLastName'];?></title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/img/tooth.ico" rel="icon">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <script src="../patient/assets/js/jquery.js"></script>

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
                    <form action="settings.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Settings
                            </h2>

                            <?php
                            $header = mysqli_query($con,"SELECT * from header");
                            $headers = mysqli_fetch_array($header);
                            ?>  
                            <h4>Header Content</h4>
                            <div class="col-md-3">  
                            <h5 style="color: blue;">Header Title</h5>
                            <input type="text" class="form-control input lg" name="header_title" value="<?php echo $headers['header_title'];?>">
                            <br>
                            <input type="submit"  name="submit1" value="Save changes" class="btn btn-success">
                            </div>

                             <div class="col-md-3">
                            <h5 style="color: blue;">Header Title Color</h5>
                            <select name="header_color" class="form-control input-lg">
                            <option value="<?php echo $headers['header_color'];?>"><?php echo $headers['header_color'];?></option> 
                            <option value="AliceBlue">AliceBlue</option>
                            <option value="AntiqueWhite">AntiqueWhite</option>
                            <option value="Aqua">Aqua</option>
                            <option value="Aquamarine">Aquamarine</option>
                            <option value="Black">Black</option>
                            <option value="BlanchedAlmond">BlanchedAlmond</option>
                            <option value="Blue">Blue</option>
                            <option value="BlueViolet">BlueViolet</option>
                            <option value="Brown">Brown</option>
                            <option value="CadetBlue">CadetBlue</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Coral">Coral</option>
                            <option value="CornflowerBlue">CornflowerBlue</option>
                            <option value="Cornsilk">Cornsilk</option>
                            <option value="DarkBlue">DarkBlue</option>
                            <option value="DarkCyan">DarkCyan</option>
                            <option value="DarkGray">DarkGray</option>
                            <option value="DarkGreen">DarkGreen</option>
                            <option value="DarkMagenta">DarkMagenta</option>
                            <option value="DarkOliveGreen">DarkOliveGreen</option>
                            <option value="DarkSeaGreen">DarkSeaGreen</option>
                            <option value="DarkSlateBlue">DarkSlateBlue</option>
                            <option value="DarkSlateGray">DarkSlateGray</option>
                            <option value="DarkTurquoise">DarkTurquoise</option>
                            <option value="DarkViolet">DarkViolet</option>
                            <option value="DeepPink">DeepPink</option>
                            <option value="DeepSkyBlue">DeepSkyBlue</option>
                            <option value="DodgerBlue">DodgerBlue</option>
                            <option value="FloralWhite">FloralWhite</option>
                            <option value="Gold">Gold</option>
                            <option value="Green">Green</option>
                            <option value="GreenYellow">GreenYellow</option>
                            <option value="Ivory">Ivory</option>
                            <option value="Lavender">Lavender</option>
                            <option value="LavenderBlush">LavenderBlush</option>
                            <option value="LightBlue">LightBlue</option>
                            <option value="OldLace">OldLace</option>
                            <option value="Orange">Orange</option>
                            <option value="Pink">Pink</option>
                            <option value="Plum">Plum</option>
                            <option value="Purple">Purple</option>
                            <option value="Red">Red</option>
                            <option value="Skyblue">Skyblue</option>
                            <option value="Snow">Snow</option>
                            <option value="SteelBlue">SteelBlue</option>
                            <option value="Teal">Teal</option>
                            <option value="Turquoise">Turquoise</option>
                            <option value="Violet">Violet</option>
                            <option value="White">White</option>
                            <option value="WhiteSmoke">WhiteSmoke</option>
                            <option value="Yellow">Yellow</option>
                            <option value="YellowGreen">YellowGreen</option>
                            </select>
                            <br>
                            <input type="submit"  name="submitcolor" value="Save changes" class="btn btn-success">
                            
                            </div>

                            <div class="col-md-3">
                            <h5 style="color: blue;">Navbar Color</h5>
                            <select name="color" class="form-control input-lg">
                            <option value="<?php echo $headers['color'];?>"><?php echo $headers['color'];?></option> 
                            <option value="AliceBlue">AliceBlue</option>
                            <option value="AntiqueWhite">AntiqueWhite</option>
                            <option value="Aqua">Aqua</option>
                            <option value="Aquamarine">Aquamarine</option>
                            <option value="Black">Black</option>
                            <option value="BlanchedAlmond">BlanchedAlmond</option>
                            <option value="Blue">Blue</option>
                            <option value="BlueViolet">BlueViolet</option>
                            <option value="Brown">Brown</option>
                            <option value="CadetBlue">CadetBlue</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Coral">Coral</option>
                            <option value="CornflowerBlue">CornflowerBlue</option>
                            <option value="Cornsilk">Cornsilk</option>
                            <option value="DarkBlue">DarkBlue</option>
                            <option value="DarkCyan">DarkCyan</option>
                            <option value="DarkGray">DarkGray</option>
                            <option value="DarkGreen">DarkGreen</option>
                            <option value="DarkMagenta">DarkMagenta</option>
                            <option value="DarkOliveGreen">DarkOliveGreen</option>
                            <option value="DarkSeaGreen">DarkSeaGreen</option>
                            <option value="DarkSlateBlue">DarkSlateBlue</option>
                            <option value="DarkSlateGray">DarkSlateGray</option>
                            <option value="DarkTurquoise">DarkTurquoise</option>
                            <option value="DarkViolet">DarkViolet</option>
                            <option value="DeepPink">DeepPink</option>
                            <option value="DeepSkyBlue">DeepSkyBlue</option>
                            <option value="DodgerBlue">DodgerBlue</option>
                            <option value="FloralWhite">FloralWhite</option>
                            <option value="Gold">Gold</option>
                            <option value="Green">Green</option>
                            <option value="GreenYellow">GreenYellow</option>
                            <option value="Ivory">Ivory</option>
                            <option value="Lavender">Lavender</option>
                            <option value="LavenderBlush">LavenderBlush</option>
                            <option value="LightBlue">LightBlue</option>
                            <option value="OldLace">OldLace</option>
                            <option value="Orange">Orange</option>
                            <option value="Pink">Pink</option>
                            <option value="Plum">Plum</option>
                            <option value="Purple">Purple</option>
                            <option value="Red">Red</option>
                            <option value="Skyblue">Skyblue</option>
                            <option value="Snow">Snow</option>
                            <option value="SteelBlue">SteelBlue</option>
                            <option value="Teal">Teal</option>
                            <option value="Turquoise">Turquoise</option>
                            <option value="Violet">Violet</option>
                            <option value="White">White</option>
                            <option value="WhiteSmoke">WhiteSmoke</option>
                            <option value="Yellow">Yellow</option>
                            <option value="YellowGreen">YellowGreen</option>
                            </select>
                            <br>
                            <input type="submit"  name="submit2" value="Save changes" class="btn btn-success">
                            
                            </div>

                              <?php
                            $welcome = mysqli_query($con,"SELECT * from welcome");
                            $welcomes = mysqli_fetch_array($welcome);
                            ?>

                            <div class="col-md-3">
                            <h5 style="color: blue;">Welcome Title</h5>
                            <input type="text" class="form-control input lg" name="welcome_title" value="<?php echo $welcomes['title'];?>">
                            <br>
                            <input type="submit"  name="submit3" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            </div>
                            <?php 
                            $background = mysqli_query($con,"SELECT * from background where id ='1'");
                            $backgrounds = mysqli_fetch_array($background);

                            $background2 = mysqli_query($con,"SELECT * from background where id ='2'");
                            $backgrounds2 = mysqli_fetch_array($background2);

                            $background3 = mysqli_query($con,"SELECT * from background where id ='3'");
                            $backgrounds3 = mysqli_fetch_array($background3);
                            ?>
                            <div class="col-md-4">
                            <h5 style="color: blue;">Background Image</h5>
                            <?php
                             echo "<img src='uploads/".$backgrounds['background']."' style='height:150px;width:100%;'>";
                            ?>
                            <input type="file" name="imagebackground">
                            <br>
                            <input type="submit"  name="uploadimage1" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            </div>

                            <div class="col-md-4">
                            <h5 style="color: blue;">Background Image</h5>
                            <?php
                             echo "<img src='uploads/".$backgrounds2['background']."' style='height:150px;width:100%;'>";
                            ?>
                            <input type="file" name="imagebackground2">
                            <br>
                            <input type="submit"  name="uploadimage2" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            </div>

                            <div class="col-md-4">
                            <h5 style="color: blue;">Background Image</h5>
                            <?php
                             echo "<img src='uploads/".$backgrounds3['background']."' style='height:150px;width:100%;'>";
                            ?>
                            <input type="file" name="imagebackground3">
                            <br>
                            <input type="submit"  name="uploadimage3" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            </div>

                            <?php
                            $about = mysqli_query($con,"SELECT * from aboutus where id='1'");
                            $aboutus = mysqli_fetch_array($about);
                             $about2 = mysqli_query($con,"SELECT * from aboutus where id='2'");
                            $aboutus2 = mysqli_fetch_array($about2);
                             $about3 = mysqli_query($con,"SELECT * from aboutus where id='3'");
                            $aboutus3 = mysqli_fetch_array($about3);

                            $location = mysqli_query($con,"SELECT * from location");
                            $locations = mysqli_fetch_array($location);
                            ?>
                            <!-- <h4>Location Content</h4>
                            <div class="col-md-6">
                                <?php echo $locations['map'];?>
                            </div>

                            <div class="col-md-6">
                            <textarea type="text" rows="18" name="map" class="form-control input-lg" value="<?php echo$locations['map'];?>"><?php echo$locations['map'];?></textarea>
                            <br>
                            <input type="submit"  name="upload" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            </div>

                            <div class="col-md-6">
                                <?php echo $locations['location'];?>
                            </div>
                            <div class="col-md-6">
                                <textarea type="text" rows="18" name="map" class="form-control input-lg" value="<?php echo$locations['map'];?>"><?php echo$locations['map'];?></textarea>
                                <br>
                                <input type="submit"  name="upload" value="Save changes" class="btn btn-success">
                                <br>
                                <br>
                            </div> -->
                            <h4>About Us Content</h4>
                            <div class="col-md-6">
                            <?php echo "<img src='uploads/".$aboutus['image']."' style='height:300px;'>";
                                ?>
                                <input type="file" name="aboutus">
                                <br>
                                <input type="submit"  name="upload1" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-6">
                            <textarea type="text" name="descriptions" class="form-control input-lg" rows='14'value="<?php echo$aboutus['descriptions'];?>"><?php echo$aboutus['descriptions'];?></textarea>
                            <br>
                            <input type="submit"  name="descriptions1" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            
                            <br>
                            <br>
                            </div>

                             <div class="col-md-6">
                            <?php echo "<img src='uploads/".$aboutus2['image']."' style='height:300px;'>";
                                ?>
                                <input type="file" name="aboutus2">
                                <br>
                                <input type="submit"  name="upload2" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-6">
                            <textarea type="text" name="aboutimg" class="form-control input-lg" rows='14'value="<?php echo$aboutus2['descriptions'];?>"><?php echo$aboutus2['descriptions'];?></textarea>
                            <br>
                            <input type="submit"  name="descriptions2" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            
                            <br>
                            <br>
                            </div>

                             <div class="col-md-6">
                            <?php echo "<img src='uploads/".$aboutus3['image']."' style='height:300px;'>";
                                ?>
                                <input type="file" name="aboutus3">
                                <br>
                                <input type="submit"  name="upload3" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-6">
                            <textarea type="text" name="aboutimage" class="form-control input-lg" rows='14'value="<?php echo$aboutus3['descriptions'];?>"><?php echo$aboutus3['descriptions'];?></textarea>
                            <br>
                            <input type="submit"  name="descriptions3" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            
                            <br>
                            <br>
                            </div>
                            <?php 
                            $slider = mysqli_query($con,"SELECT * from slider where id ='1'");
                            $sliders = mysqli_fetch_array($slider);

                            $slider2 = mysqli_query($con,"SELECT * from slider where id ='2'");
                            $sliders2 = mysqli_fetch_array($slider2);

                            $slider3 = mysqli_query($con,"SELECT * from slider where id ='3'");
                            $sliders3 = mysqli_fetch_array($slider3);
                            ?>

                            <h4 style="color: blue;">Advertisements</h4>
                            <div class="col-md-4">
                                
                                 <?php echo "<img src='uploads/".$sliders['slider']."' style='height:150px;width:100%;'>";
                                ?>
                                <input type="file" name="slider">
                                <input type="submit"  name="uploadslider" value="Save changes" class="btn btn-success">
                            </div>

                            <div class="col-md-4">
                                
                                 <?php echo "<img src='uploads/".$sliders2['slider']."' style='height:150px;width:100%;'>";
                                ?>
                                <input type="file" name="slider2">
                                <input type="submit"  name="uploadslider2" value="Save changes" class="btn btn-success">
                            </div>

                            <div class="col-md-4">
                                
                                 <?php echo "<img src='uploads/".$sliders3['slider']."' style='height:150px;width:100%;'>";
                                ?>
                                <input type="file" name="slider3">
                                <input type="submit"  name="uploadslider3" value="Save changes" class="btn btn-success">
                                <br>
                                <br>
                            </div>

                            <?php

            if(isset($_POST['uploadslider']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['slider']['name']);

                $image = $_FILES['slider']['name'];

                $sql = "UPDATE slider set slider ='$image' where id ='1'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['slider']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php

            if(isset($_POST['uploadslider2']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['slider2']['name']);

                $image = $_FILES['slider2']['name'];

                $sql = "UPDATE slider set slider ='$image' where id ='2'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['slider2']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php

            if(isset($_POST['uploadslider3']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['slider3']['name']);

                $image = $_FILES['slider3']['name'];

                $sql = "UPDATE slider set slider ='$image' where id ='3'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['slider3']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

                            <!-- SERVICES CONTENT-->
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

                            <h5>Services Offered Content</h5>
                            <?php 
                            $servicebackground = mysqli_query($con,"SELECT * from servicebackground");
                            $servicebackgrounds = mysqli_fetch_array($servicebackground);
                            ?>
                            
                            <div class="col-md-12">
                                <h4 style="color: blue;">Services Background</h4>
                                 <?php echo "<img src='uploads/".$servicebackgrounds['background']."' style='height:250px;'>";
                                ?>
                                <input type="file" name="servicebackground">
                                <input type="submit"  name="uploadbackground" value="Save changes" class="btn btn-success">
                                <br>
                                <br>
                            </div>
                            <h4 style="color: blue;">Services</h4>

                            <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name" value="<?php echo$services['service'];?>">
                                <input type="file" name="service">
                                <input type="submit"  name="uploadservice" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered1" class="form-control input-lg" value="<?php echo $services['offered_by'];?>">
                                <textarea type="text" name="serve" class="form-control input-lg" rows='5'value="<?php echo$services['descriptions'];?>"><?php echo$services['descriptions'];?></textarea>
                                <br>
                                <input type="submit"  name="servicename" value="Save changes" class="btn btn-success">
                            </div> 

                            <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services2['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name2" value="<?php echo$services2['service'];?>">
                                <input type="file" name="service2">
                                <input type="submit"  name="uploadservice2" value="Save changes" class="btn btn-success">
                            </div>


                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered2" class="form-control input-lg" value="<?php echo $services2['offered_by'];?>">
                                <textarea type="text" name="serve2" class="form-control input-lg" rows='5'value="<?php echo$services2['descriptions'];?>"><?php echo$services2['descriptions'];?></textarea>
                                <br>
                                <br>
                                <input type="submit"  name="servicename2" value="Save changes" class="btn btn-success">

                            </div> 

                            
                            <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services3['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name3" value="<?php echo$services3['service'];?>">
                                <input type="file" name="service3">
                                <input type="submit"  name="uploadservice3" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered3" class="form-control input-lg" value="<?php echo $services3['offered_by'];?>">
                                <textarea type="text" name="serve3" class="form-control input-lg" rows='5'value="<?php echo$services3['descriptions'];?>"><?php echo$services3['descriptions'];?></textarea>
                                <br>
                                <input type="submit"  name="servicename3" value="Save changes" class="btn btn-success">

                            </div> 
                     

                            <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services4['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name4" value="<?php echo$services4['service'];?>">
                                <input type="file" name="service4">
                                <input type="submit"  name="uploadservice4" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered4" class="form-control input-lg" value="<?php echo $services4['offered_by'];?>">
                                <textarea type="text" name="serve4" class="form-control input-lg" rows='5'value="<?php echo$services4['descriptions'];?>"><?php echo$services4['descriptions'];?></textarea>
                                <br>
                                <br>
                                <input type="submit"  name="servicename4" value="Save changes" class="btn btn-success">

                            </div> 
                            

                            <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services5['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name5" value="<?php echo$services5['service'];?>">
                                <input type="file" name="servicelima">
                                <input type="submit"  name="uploaded" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered5" class="form-control input-lg" value="<?php echo $services5['offered_by'];?>">
                                <textarea type="text" name="serve5" class="form-control input-lg" rows='5'value="<?php echo$services5['descriptions'];?>"><?php echo$services5['descriptions'];?></textarea>
                                <br>
                                <br>
                                <input type="submit"  name="servicename5" value="Save changes" class="btn btn-success">

                            </div> 
                     

                            <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services6['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name6" value="<?php echo$services6['service'];?>">
                                <input type="file" name="serviceanim">
                                <input type="submit"  name="uploaded2" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered6" class="form-control input-lg" value="<?php echo $services6['offered_by'];?>">
                                <textarea type="text" name="serve6" class="form-control input-lg" rows='5'value="<?php echo$services6['descriptions'];?>"><?php echo$services6['descriptions'];?></textarea>
                                <br>
                                <br>
                                <input type="submit"  name="servicename6" value="Save changes" class="btn btn-success">

                            </div> 

                             <div class="col-md-3">
                            <?php echo "<img src='uploads/".$services7['image']."' style='height:150px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="text" name="name7" value="<?php echo$services7['service'];?>">
                                <input type="file" name="servicepito">
                                <input type="submit"  name="uploaded3" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-3">
                                <h6>Offered By:</h6>
                                <input type="text" name="offered7" class="form-control input-lg" value="<?php echo $services7['offered_by'];?>">
                                <textarea type="text" name="serve7" class="form-control input-lg" rows='5'value="<?php echo$services7['descriptions'];?>"><?php echo$services7['descriptions'];?></textarea>
                                <br>
                                <input type="submit"  name="servicename7" value="Save changes" class="btn btn-success">

                            </div>

                            <div class="col-md-12">
                                <br>
                            <h4>FAQ Content</h4>
                            <div class="panel panel-primary filterable" style="width: auto;">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
                        <h3 class="panel-title">Frequently Asked Questions</h3>
                        
                        </div>
                        <div class="panel-body">
                        <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Question" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Answer" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Date Asked" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Action" disabled style="text-align: center;"></th>
                                </tr>
                            </thead>

                           
                            
                            <?php 

                            $faqsql=mysqli_query($con,"SELECT * from faq");
                                  if (!$faqsql) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            
                            while ($faqres=mysqli_fetch_array($faqsql)) {

                                if ($faqres['status']=='pending') {
                                    $status="warning";
                                    
                                } else 
                                {
                                    $status="success";
                                   
                                }

                                echo "<tbody>";
                                echo "<tr class='$status'>";

                                    echo "<td>" . $faqres['question'] . "</td>";
                                    echo "<td>" . $faqres['answer'] . "</td>";
                                    echo "<td>" . $faqres['status'] . "</td>";
                                    echo "<td>" . $faqres['faqdate'] . "</td>";
                                     echo "<td class='text-center'>
                                    <a style='margin: 2px' href='addanswer.php?appId=".$faqres['id']."' id='".$faqres['id']."' name='addanswer' class='addanswer' title='Add Answer'><img src='assets/img/edit_32.png' aria-hidden='true'></a>
                                    
                                    <a style='margin: 2px' href='#' id='".$faqres['id']."' name='deletefaq' class='deletefaq' title='Delete FAQ'><img src='assets/img/trash_32.png' aria-hidden='true'></a></td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                    </div>
                </div>
                            
                         </div>

                            <!-- END SERVICES CONTENT-->
                            <?php
                            $contact = mysqli_query($con,"SELECT * from contactuscontent");
                            $contactus = mysqli_fetch_array($contact);
                            ?>
                            <?php
                            $contactadd = mysqli_query($con,"SELECT * from contactaddress");
                            $contactusadds = mysqli_fetch_array($contactadd);

                            ?>
                            <?php 
                            $mission = mysqli_query($con,"SELECT * from missionvision");
                            $vision = mysqli_fetch_array($mission);
                            ?>
                            <div class="col-md-12">
                            <h4>Mission Vision Content</h4>
                            <h5 style="color: blue;">Mission</h5>
                            <h4><?php echo $vision['mission'];?></h4>
                            <textarea type="text" name="mission" class="form-control input-lg" rows='3'value="<?php echo$vision['mission'];?>"><?php echo $vision['mission'];?></textarea>
                            <br>
                            </div>
                            <div class="col-md-12">
                            <h5 style="color: blue;">Vision</h5>
                            <h4><?php echo $vision['vision'];?></h4>
                            <textarea type="text" name="vision" class="form-control input-lg" rows='3'value="<?php echo $vision['vision'];?>"><?php echo $vision['vision'];?></textarea>
                            <br>
                            <input type="submit"  name="visionsubmit" value="Save changes" class="btn btn-success">
                            <br>
                            <br>
                            </div>
                            <?php
                            if(isset($_POST['visionsubmit']))
                            {
                                $mission = $_POST['mission'];
                                $vision = $_POST['vision'];
                                mysqli_query($con,"UPDATE missionvision set mission='$mission', vision='$vision'");
                                ?>
                                <script type="text/javascript">
                                    alert('Successfully updated Mission Vision');
                                </script>
                                <?php
                            }

                            ?>
                            <h4 style="margin-top: 110%;">Contact us Content</h4>

                            <div class="col-md-12">
                            <h5 style="color: blue;">Contact us Background</h5>
                            <?php echo "<img src='uploads/".$contactus['background']."' style='height:200px;'>";
                                ?>
                                <br>
                                <br>
                                <input type="file" name="contactback">
                                <input type="submit"  name="uploadcontactback" value="Save changes" class="btn btn-success">
                            </div>
                            <div class="col-md-12">
                            <h5 style="color: blue;">Title</h5>
                            <h4><?php echo$contactus['title'];?></h4>
                            <textarea type="text" name="contact_title" class="form-control input-lg" rows='3'value="<?php echo$contactus['title'];?>"><?php echo$contactus['title'];?></textarea>
                            <br>
                            <input type="submit"  name="contactcontent" value="Save changes" class="btn btn-success"> 
                            </div>

                            
                            <div class="col-md-12">
                            <h5 style="color: blue;">Address</h5>
                            <h4><?php echo$contactusadds['address'];?></h4>
                            <textarea type="text" name="contactaddress" class="form-control input-lg" value="<?php echo$contactusadds['address'];?>"><?php echo$contactusadds['address'];?></textarea>
                            <br>
                            <input type="submit" name="contact_address" value="Save changes" class="btn btn-success"> 
                            </div>

                            <?php 
                            $contactno = mysqli_query($con,"SELECT * from contactusnumber where id ='1'");
                            $contactnos = mysqli_fetch_array($contactno);

                            $contactno1 = mysqli_query($con,"SELECT * from contactusnumber where id ='2'");
                            $contactnos1 = mysqli_fetch_array($contactno1);

                            $contactno2 = mysqli_query($con,"SELECT * from contactusnumber where id ='3'");
                            $contactnos2 = mysqli_fetch_array($contactno2);
                            ?>

                            <div class="col-md-2">
                            <h5 style="color: blue;">Contact #/Email</h5>
                            <h4><?php echo$contactnos['phone'];?></h4>
                            <input type="text" name="phone1" class="form-control input-lg" value="<?php echo$contactnos['phone'];?>">
                            <br>
                            <input type="submit" name="phone" value="Save changes" class="btn btn-success">
                            </div>

                             <div class="col-md-2">
                                <br>
                            <h4><?php echo$contactnos1['phone'];?></h4>
                            <input type="text" name="phone2" class="form-control input-lg" value="<?php echo$contactnos1['phone'];?>">
                            <br>
                            </div>

                             <div class="col-md-2">
                                <br>
                            <h4><?php echo$contactnos2['phone'];?></h4>
                            <input type="text" name="phone3" class="form-control input-lg" value="<?php echo$contactnos2['phone'];?>">
                            <br>
                            </div>

                            <?php
                            $phone = mysqli_query($con,"SELECT * from contactusemail");
                            $phones = mysqli_fetch_array($phone);

                            ?>
                             <div class="col-md-6">
                                <br>
                            <h4><?php echo$phones['email'];?></h4>
                            <input type="email" name="email" class="form-control input-lg" value="<?php echo$phones['email'];?>">
                            <br>
                            </div>
                            
                            <div class="col-md-12">
                            <h4 style="color: blue;">Terms and Conditions</h4>
                            <h5><?php echo $terms['terms'];?></h5>
                            <textarea name="textareaterms" style="width: 100%; height:100px;"value="<?php echo $terms['terms_id'];?>"><?php echo $terms['terms'];?></textarea>

                            <input type="submit"  name="terms" value="Save changes" class="btn btn-success">
                           </div>
                           <?php
                           if(isset($_POST['terms']))
                           {
                            $s1 = $_POST['textareaterms'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set terms='$s1'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>
                            <br>
                            <br>

                            <div class="col-md-12">
                                <h4 style="color: blue;">Late for appointments:</h4>
                                <h5><?php echo $terms['late'];?></h5>
                                <textarea name="textarealate" style="width: 100%; height:100px;"value="<?php echo $terms['late'];?>"><?php echo $terms['late'];?></textarea>
                                 <input type="submit" name="late" value="Save changes" class="btn btn-success">
                            </div>
                            <?php
                           if(isset($_POST['late']))
                           {
                            $s1 = $_POST['textarealate'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set late='$s1'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>
                             <div class="col-md-12">
                                <h4 style="color: blue;">Guarantee:</h4>
                                <h5><?php echo $terms['guarantee'];?></h5>
                                <textarea name="textareaguarantee" style="width: 100%; height:100px;"value="<?php echo $terms['guarantee'];?>"><?php echo $terms['guarantee'];?></textarea>
                                 <input type="submit" name="guarantee" value="Save changes" class="btn btn-success">
                            </div>

                            <?php
                           if(isset($_POST['guarantee']))
                           {
                            $s1 = $_POST['textareaguarantee'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set guarantee='$s1'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>
                             <div class="col-md-12">
                                <h4 style="color: blue;">Personal Details:</h4>
                                <h5><?php echo $terms['personal_details'];?></h5>
                                <textarea name="textareapersonal" style="width: 100%; height:100px;"value="<?php echo $terms['personal_details'];?>"><?php echo $terms['personal_details'];?></textarea>
                                 <input type="submit" name="personal" value="Save changes" class="btn btn-success">
                            </div>

                            <?php
                           if(isset($_POST['personal']))
                           {
                            $s2 = $_POST['textareapersonal'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set personal_details='$s2'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>
                            <div class="col-md-12">
                                <h4 style="color: blue;">No Tolerance/Abuse Policy:</h4>
                                <h5><?php echo $terms['abuse_policy'];?></h5>
                                <textarea name="textareapolicy" style="width: 100%; height:100px;"value="<?php echo $terms['abuse_policy'];?>"><?php echo $terms['abuse_policy'];?></textarea>
                                 <input type="submit" name="policy" value="Save changes" class="btn btn-success">
                            </div>

                            <?php
                           if(isset($_POST['policy']))
                           {
                            $s1 = $_POST['textareapolicy'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set abuse_policy='$s1'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>
                            <div class="col-md-12">
                                <h4 style="color: blue;">Data Protection Act:</h4>
                                <h5><?php echo $terms['data_protection'];?></h5>
                                <textarea name="textareaprotection" style="width: 100%; height:100px;"value="<?php echo $terms['data_protection'];?>"><?php echo $terms['data_protection'];?></textarea>
                                 <input type="submit" name="protection" value="Save changes" class="btn btn-success">
                            </div>

                            <?php
                           if(isset($_POST['protection']))
                           {
                            $s1 = $_POST['textareaprotection'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set data_protection='$s1'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>
                            <br>
                            <br>
                            <div class="col-md-12">
                             <h4 style="color: blue;">Privacy Policy</h4>
                             <h5><?php echo $terms['privacy'];?></h5>
                            <textarea name="textareaprivacy" style="width: 100%; height:100px;"value="<?php echo $terms['privacy'];?>"><?php echo $terms['privacy'];?></textarea>

                            <input type="submit" name="privacy" value="Save changes" class="btn btn-success">
                         </div>


                         <div class="col-md-12">
                         <h4 style="color: blue;">Testimonials</h4>
                         <div class="panel panel-primary filterable" style="width:auto;">
                        <!-- Default panel contents -->

                        <div class="panel-heading">
                        <h3 class="panel-title">Testimonials List</h3>
                        </div>

                        <div class="panel-body">
                        <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th>Image</th>
                                    <th><input type="text" class="form-control" placeholder="Patient Name" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Testimony" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Action" disabled style="text-align: center;"></th>
                                </tr>
                            </thead>

                           
                            
                            <?php 

                            $testimonial=mysqli_query($con,"SELECT * from testimonials");
                                  if (!$testimonial) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            
                            while ($testimonials=mysqli_fetch_array($testimonial)) {

                                if ($testimonials['status']=='pending') {
                                    $status="warning";
                                    $icon='remove';
                                    
                                } 
                                else if($testimonials['status']=='disapproved') 
                                {
                                    $status="danger";
                                    $icon='ok';
                                   
                                }
                                else 
                                {
                                    $status ='success';
                                    $icon='ok';
                                }

                                echo "<tbody>";
                                echo "<tr class='$status'>";
                                 echo "<form action='settings.php' method='POST'>";
                                     echo "<td> <img src='../patient/uploads/".$testimonials['image']."' style='height:60px;'></td>";
                                    echo "<td>" . $testimonials['fullname'] . "</td>";
                                    echo "<td>" . $testimonials['descriptions'] . "</td>";
                                    echo "<td><span class='fa fa fa-filter-".$icon."' aria-hidden='true'></span>".' '."". $testimonials['status'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'>
                                    <a style='margin: 2px' href='#' id='".$testimonials['id']."' name='approve' class='approve' title='Approve Testimonial'><img src='assets/img/approve_32.png' aria-hidden='true'></a>
                                    
                                    <a style='margin: 2px' href='#' id='".$testimonials['id']."' name='disapprove' class='disapprove' title='Disapprove Testimonial'><img src='assets/img/disapprove_32.png' aria-hidden='true'></a>
                                    
                                    <a style='margin: 2px' href='#' id='".$testimonials['id']."' name='delete' class='delete' title='Delete Testimonial'><img src='assets/img/trash_32.png' aria-hidden='true'></a></td>";
                                   ;
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                      
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                        ?>
                    </div>
                    <div class="modal fade" id="modalfaq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <h3 class="modal-title" style="text-align: center; color: skyblue;">Frequently Asked Questions</h3>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">

                                 <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                            <h4>Question:</h4>
                            <textarea rows="3" class="form-control input-lg" value="<?php $faqselected['question'];?>"><?php $faqselected['question'];?></textarea>
                            <h4>Answer:</h4>
                            <textarea rows="3" class="form-control input-lg" value="<?php $faqselected['answer'];?>"><?php $faqselected['answer'];?></textarea>
                            <br>

                              <input type="submit" value="Submit FAQ" name="add" class="btn btn-primary" style="margin-left: 2%;"> 
                                  <div class="modal-footer">
                                   <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top:-10%;padding-bottom: -10%;">Close
                                   </button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
               

    <script src="../patient/assets/js/jquery.js"></script>
        <script type="text/javascript">
$(function() {
$(".approve").click(function(){
var element = $(this);
var ic = element.attr("id");
var info = 'ic=' + ic;
if(confirm("Are you sure you want to approve this testimonial?"))
{
 $.ajax({
   type: "POST",
   url: "approvetestimonial.php",
   data: info,
   success: function(){
 }
});
 alert('Approved Testimonial');
  window.location.href = 'settings.php';
 }
return false;
});
});
</script>

<script type="text/javascript">
$(function() {
$(".disapprove").click(function(){
var element = $(this);
var ic = element.attr("id");
var info = 'id=' + ic;
if(confirm("Are you sure you want to disapprove this testimonial?"))
{
 $.ajax({
   type: "POST",
   url: "disapprovetestimonial.php",
   data: info,
   success: function(){
 }
});
 alert('Disapproved Testimonial');
  window.location.href = 'settings.php';
 }
return false;
});
});
</script>

<script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var ic = element.attr("id");
var info = 'ig=' + ic;
if(confirm("Are you sure you want to delete this testimonial?"))
{
 $.ajax({
   type: "POST",
   url: "deletetestimonial.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>

<script type="text/javascript">
$(function() {
$(".deletefaq").click(function(){
var element = $(this);
var ic = element.attr("id");
var info = 'if=' + ic;
if(confirm("Are you sure you want to delete this faq?"))
{
 $.ajax({
   type: "POST",
   url: "deletefaq.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>




                          <?php
                        $footer = mysqli_query($con,"SELECT * from footer");
                        $footers = mysqli_fetch_array($footer);
                        ?>
                         <div class="col-md-12">
                             <h5>Footer Content</h5>
                              <h5 style="color: blue;">Footer Title</h5>
                            <input type="text" name="footer_title" class="form-control input-lg" value="<?php echo $footers['title'];?>">
                            <br>
                            <input type="submit" name="save_title" value="Save changes" class="btn btn-success">
                         </div>

                         <div class="col-md-6">
                              <h5 style="color: blue;">Footer Title Color</h5>
                            <select name="color_footer" class="form-control input-lg">
                            <option value="<?php echo $footers['footer_color'];?>"><?php echo $footers['footer_color'];?></option> 
                            <option value="AliceBlue">AliceBlue</option>
                            <option value="AntiqueWhite">AntiqueWhite</option>
                            <option value="Aqua">Aqua</option>
                            <option value="Aquamarine">Aquamarine</option>
                            <option value="Black">Black</option>
                            <option value="BlanchedAlmond">BlanchedAlmond</option>
                            <option value="Blue">Blue</option>
                            <option value="BlueViolet">BlueViolet</option>
                            <option value="Brown">Brown</option>
                            <option value="CadetBlue">CadetBlue</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Coral">Coral</option>
                            <option value="CornflowerBlue">CornflowerBlue</option>
                            <option value="Cornsilk">Cornsilk</option>
                            <option value="DarkBlue">DarkBlue</option>
                            <option value="DarkCyan">DarkCyan</option>
                            <option value="DarkGray">DarkGray</option>
                            <option value="DarkGreen">DarkGreen</option>
                            <option value="DarkMagenta">DarkMagenta</option>
                            <option value="DarkOliveGreen">DarkOliveGreen</option>
                            <option value="DarkSeaGreen">DarkSeaGreen</option>
                            <option value="DarkSlateBlue">DarkSlateBlue</option>
                            <option value="DarkSlateGray">DarkSlateGray</option>
                            <option value="DarkTurquoise">DarkTurquoise</option>
                            <option value="DarkViolet">DarkViolet</option>
                            <option value="DeepPink">DeepPink</option>
                            <option value="DeepSkyBlue">DeepSkyBlue</option>
                            <option value="DodgerBlue">DodgerBlue</option>
                            <option value="FloralWhite">FloralWhite</option>
                            <option value="Gold">Gold</option>
                            <option value="Green">Green</option>
                            <option value="GreenYellow">GreenYellow</option>
                            <option value="Ivory">Ivory</option>
                            <option value="Lavender">Lavender</option>
                            <option value="LavenderBlush">LavenderBlush</option>
                            <option value="LightBlue">LightBlue</option>
                            <option value="OldLace">OldLace</option>
                            <option value="Orange">Orange</option>
                            <option value="Pink">Pink</option>
                            <option value="Plum">Plum</option>
                            <option value="Purple">Purple</option>
                            <option value="Red">Red</option>
                            <option value="Skyblue">Skyblue</option>
                            <option value="Snow">Snow</option>
                            <option value="SteelBlue">SteelBlue</option>
                            <option value="Teal">Teal</option>
                            <option value="Turquoise">Turquoise</option>
                            <option value="Violet">Violet</option>
                            <option value="White">White</option>
                            <option value="WhiteSmoke">WhiteSmoke</option>
                            <option value="Yellow">Yellow</option>
                            <option value="YellowGreen">YellowGreen</option>
                            </select>
                            <br>
                            <input type="submit" name="save_footercolor" value="Save changes" class="btn btn-success">
                         </div>

                         <div class="col-md-6">
                              <h5 style="color: blue;">Footer Color</h5>
                            <select name="footer_color" class="form-control input-lg">
                            <option value="<?php echo $footers['color'];?>"><?php echo $footers['color'];?></option> 
                            <option value="AliceBlue">AliceBlue</option>
                            <option value="AntiqueWhite">AntiqueWhite</option>
                            <option value="Aqua">Aqua</option>
                            <option value="Aquamarine">Aquamarine</option>
                            <option value="Black">Black</option>
                            <option value="BlanchedAlmond">BlanchedAlmond</option>
                            <option value="Blue">Blue</option>
                            <option value="BlueViolet">BlueViolet</option>
                            <option value="Brown">Brown</option>
                            <option value="CadetBlue">CadetBlue</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Coral">Coral</option>
                            <option value="CornflowerBlue">CornflowerBlue</option>
                            <option value="Cornsilk">Cornsilk</option>
                            <option value="DarkBlue">DarkBlue</option>
                            <option value="DarkCyan">DarkCyan</option>
                            <option value="DarkGray">DarkGray</option>
                            <option value="DarkGreen">DarkGreen</option>
                            <option value="DarkMagenta">DarkMagenta</option>
                            <option value="DarkOliveGreen">DarkOliveGreen</option>
                            <option value="DarkSeaGreen">DarkSeaGreen</option>
                            <option value="DarkSlateBlue">DarkSlateBlue</option>
                            <option value="DarkSlateGray">DarkSlateGray</option>
                            <option value="DarkTurquoise">DarkTurquoise</option>
                            <option value="DarkViolet">DarkViolet</option>
                            <option value="DeepPink">DeepPink</option>
                            <option value="DeepSkyBlue">DeepSkyBlue</option>
                            <option value="DodgerBlue">DodgerBlue</option>
                            <option value="FloralWhite">FloralWhite</option>
                            <option value="Gold">Gold</option>
                            <option value="Green">Green</option>
                            <option value="GreenYellow">GreenYellow</option>
                            <option value="Ivory">Ivory</option>
                            <option value="Lavender">Lavender</option>
                            <option value="LavenderBlush">LavenderBlush</option>
                            <option value="LightBlue">LightBlue</option>
                            <option value="OldLace">OldLace</option>
                            <option value="Orange">Orange</option>
                            <option value="Pink">Pink</option>
                            <option value="Plum">Plum</option>
                            <option value="Purple">Purple</option>
                            <option value="Red">Red</option>
                            <option value="Skyblue">Skyblue</option>
                            <option value="Snow">Snow</option>
                            <option value="SteelBlue">SteelBlue</option>
                            <option value="Teal">Teal</option>
                            <option value="Turquoise">Turquoise</option>
                            <option value="Violet">Violet</option>
                            <option value="White">White</option>
                            <option value="WhiteSmoke">WhiteSmoke</option>
                            <option value="Yellow">Yellow</option>
                            <option value="YellowGreen">YellowGreen</option>
                            </select>
                            <br>
                            <input type="submit" name="save_color" value="Save changes" class="btn btn-success">
                         </div>


                        </div>
                    </div> 

                     <?php

            if(isset($_POST['uploadimage1']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['imagebackground']['name']);

                $image = $_FILES['imagebackground']['name'];

                $sql = "UPDATE background set background ='$image' where id ='1'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['imagebackground']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php

            if(isset($_POST['uploadimage2']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['imagebackground2']['name']);

                $image = $_FILES['imagebackground2']['name'];

                $sql = "UPDATE background set background ='$image' where id ='2'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['imagebackground2']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php

            if(isset($_POST['uploadimage3']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['imagebackground3']['name']);

                $image = $_FILES['imagebackground3']['name'];

                $sql = "UPDATE background set background ='$image' where id ='3'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['imagebackground3']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
                    <?php
                           if(isset($_POST['save_title']))
                           {
                            $stitle = $_POST['footer_title'];
                            $sqlterms = mysqli_query($con,"UPDATE footer set title='$stitle'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>

                            <?php
                           if(isset($_POST['save_footercolor']))
                           {
                            $fcolor = $_POST['color_footer'];
                            $sqlterms = mysqli_query($con,"UPDATE footer set footer_color='$fcolor'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>

                    <?php
                           if(isset($_POST['save_color']))
                           {
                            $scolor = $_POST['footer_color'];
                            $sqlterms = mysqli_query($con,"UPDATE footer set color='$scolor'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>


                    <?php
                           if(isset($_POST['privacy']))
                           {
                            $s1 = $_POST['textareaprivacy'];
                            $sqlterms = mysqli_query($con,"UPDATE terms set privacy='$s1'");

                            ?>
                            <script type="text/javascript">
                                window.alert("Successfully Updated");
                                window.location.href = "settings.php";
                            </script>
                            <?php
                           }

                           ?>


                </form>
                    <!-- Page Heading end-->
                    <!-- panel start -->


               <!-- panel end -->
               <?php

            if(isset($_POST['uploadservice']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['service']['name']);

                $image = $_FILES['service']['name'];

                $sql = "UPDATE servicecontent set image ='$image' where id ='1'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['service']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php

            if(isset($_POST['uploadservice2']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['service2']['name']);

                $image = $_FILES['service2']['name'];

                $sql = "UPDATE servicecontent set image ='$image' where id ='2'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['service2']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php

            if(isset($_POST['uploadservice3']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['service3']['name']);

                $image = $_FILES['service3']['name'];

                $sql = "UPDATE servicecontent set image ='$image' where id ='3'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['service3']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php

            if(isset($_POST['uploadservice4']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['service4']['name']);

                $image = $_FILES['service4']['name'];

                $sql = "UPDATE servicecontent set image ='$image' where id ='4'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['service4']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            
            <?php

            if(isset($_POST['uploaded']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['servicelima']['name']);

                $images = $_FILES['servicelima']['name'];

                $sql = "UPDATE servicecontent set image ='$images' where id ='5'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['servicelima']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php

            if(isset($_POST['uploaded2']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['serviceanim']['name']);

                $images = $_FILES['serviceanim']['name'];

                $sql = "UPDATE servicecontent set image ='$images' where id ='6'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['serviceanim']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php

            if(isset($_POST['uploaded3']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['servicepito']['name']);

                $images = $_FILES['servicepito']['name'];

                $sql = "UPDATE servicecontent set image ='$images' where id ='7'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['servicepito']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
             
            
               <?php

            if(isset($_POST['upload']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['image']['name']);

                $image = $_FILES['image']['name'];

                $sql = "UPDATE header set background ='$image' where id ='1'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php
            if(isset($_POST['upload1']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['aboutus']['name']);

                $image = $_FILES['aboutus']['name'];

                $sql = "UPDATE aboutus set Image ='$image' where id ='1'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['aboutus']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php
               if(isset($_POST['descriptions1']))
               {
                $title = $_POST['descriptions'];

                mysqli_query($con,"UPDATE aboutus set descriptions='$title' where id='1'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>

                <?php
            if(isset($_POST['upload2']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['aboutus2']['name']);

                $image = $_FILES['aboutus2']['name'];

                $sql = "UPDATE aboutus set Image ='$image' where id ='2'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['aboutus2']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php
               if(isset($_POST['descriptions2']))
               {
                $titles = $_POST['aboutimg'];

                mysqli_query($con,"UPDATE aboutus set descriptions='$titles' where id='2'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>

                <?php
            if(isset($_POST['upload3']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['aboutus3']['name']);

                $image = $_FILES['aboutus3']['name'];

                $sql = "UPDATE aboutus set Image ='$image' where id ='3'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['aboutus3']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>

            <?php
               if(isset($_POST['descriptions3']))
               {
                $titless = $_POST['aboutimage'];

                mysqli_query($con,"UPDATE aboutus set descriptions='$titless' where id='3'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                

                <?php
               if(isset($_POST['submit1']))
               {
                $title = $_POST['header_title'];

                mysqli_query($con,"UPDATE header set header_title='$title'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                
                <?php
               if(isset($_POST['submit2']))
               {
                $color = $_POST['color'];

                mysqli_query($con,"UPDATE header set color='$color'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                 <?php
               if(isset($_POST['submitcolor']))
               {
                $color = $_POST['header_color'];

                mysqli_query($con,"UPDATE header set header_color='$color'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>

                <?php
               if(isset($_POST['submit3']))
               {
                $welcome = $_POST['welcome_title'];

                mysqli_query($con,"UPDATE welcome set title='$welcome'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>

                <!--Contact Us Content -->
                <?php
               if(isset($_POST['contactcontent']))
               {
                $contactcontent = $_POST['contact_title'];

                mysqli_query($con,"UPDATE contactuscontent set title='$contactcontent'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>

                <?php
               if(isset($_POST['contact_address']))
               {
                $contactaddress = $_POST['contactaddress'];

                mysqli_query($con,"UPDATE contactaddress set address='$contactaddress'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>

                <?php
                if(isset($_POST['phone']))
                {
                    $p1 = $_POST['phone1'];
                    $p2 = $_POST['phone2'];
                    $p3 = $_POST['phone3'];
                    $e = $_POST['email'];

                     mysqli_query($con,"UPDATE contactusnumber set phone ='$p1' where id ='1'");
                     mysqli_query($con,"UPDATE contactusnumber set phone ='$p2' where id ='2'");
                     mysqli_query($con,"UPDATE contactusnumber set phone ='$p3' where id ='3'");
                     mysqli_query($con,"UPDATE contactusemail set email ='$e'");
                    ?>
                    <script type="text/javascript">
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                
                <?php
                }
                ?>
                <?php
               if(isset($_POST['servicename']))
               {
                $service = $_POST['name'];
                $desc = $_POST['serve'];
                $offered1 = $_POST['offered1'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by ='$offered1' where id='1'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                 <?php
               if(isset($_POST['servicename2']))
               {
                $service = $_POST['name2'];
                $desc = $_POST['serve2'];
                $offered2 = $_POST['offered2'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by ='$offered2' where id='2'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                <?php
               if(isset($_POST['servicename3']))
               {
                $service = $_POST['name3'];
                $desc = $_POST['serve3'];
                $offered3 = $_POST['offered3'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by='$offered3' where id='3'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                <?php
               if(isset($_POST['servicename4']))
               {
                $service = $_POST['name4'];
                $desc = $_POST['serve4'];
                $offered4 = $_POST['offered4'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by='$offered4' where id='4'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                <?php
               if(isset($_POST['servicename5']))
               {
                $service = $_POST['name5'];
                $desc = $_POST['serve5'];
                $offered5 = $_POST['offered5'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by='$offered5' where id='5'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                <?php
               if(isset($_POST['servicename6']))
               {
                $service = $_POST['name6'];
                $desc = $_POST['serve6'];
                $offered6 = $_POST['offered6'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by='$offered6' where id='6'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                <?php
               if(isset($_POST['servicename7']))
               {
                $service = $_POST['name7'];
                $desc = $_POST['serve7'];
                $offered7 = $_POST['offered7'];
                mysqli_query($con,"UPDATE servicecontent set service='$service',descriptions = '$desc',offered_by='$offered7' where id='7'");
                ?>
                <script>
                    window.alert("Successfully Updated");
                   window.location.href = 'settings.php';
               </script>
               <?php
                }
                ?>
                <?php
            if(isset($_POST['uploadbackground']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['servicebackground']['name']);

                $image = $_FILES['servicebackground']['name'];

                $sql = "UPDATE servicebackground set background ='$image'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['servicebackground']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
            <?php
            if(isset($_POST['uploadcontactback']))
            {

                $targetdata = "uploads/";
                $target = $targetdata.basename($_FILES['contactback']['name']);

                $image = $_FILES['contactback']['name'];

                $sql = "UPDATE contactuscontent set background ='$image'";

                $result = mysqli_query($con,$sql);

                if(move_uploaded_file($_FILES['contactback']['tmp_name'],$target))
                {
                    $msg = "Image uploaded successfully";
                    ?>
                    <script>
                        window.alert("Successfully Updated");
                        window.location.href = 'settings.php';
                    </script>
                    <?php
                }
                else
                {
                    $msg = "There was a problem uploading image";
                }
            }

            ?>
               
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

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
       
        <!-- jQuery -->
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
                <!-- script for jquery datatable end-->

    </body>
</html>