<?php
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode){
$url = 'https://www.itexmo.com/php_api/api.php';
$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
$param = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($itexmo),
    ),
);
$context  = stream_context_create($param);
return file_get_contents($url, false, $context);}
//##########################################################################

if($_POST)
{
    $number = $_POST['number'];
    $name = $_POST['name'];
    $msg = $_POST['msg'];
    $text = "From:".$name." 
".$msg;
    $api = "TR-BRYAN151340_PHZVM";
    

    if(!empty($_POST['name']) && ($_POST['number']) && ($_POST['msg']))
    {
    $result = itexmo($number,$text,$api);
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
Please CONTACT US for help. ";  
}else if ($result == 0){
echo "Message Sent!";
}
else{   
echo "Error Num ". $result . " was encountered!";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>SMS Module</title>
        <!-- Bootstrap -->
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/img/Tooth.ico" rel="icon">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
        <link href="assets/css/material.css" rel="stylesheet">
    </head>
    <body>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4 col-sm-6 col-xs-12">
    				<form method="POST" action="sms.php">
    					<div class="form-group">
    						<label for="name">Your Name</label>
    						<input type="text" class="form-control" id="name" placeholder="Name" name="name" required="">	
    					</div>

    					<div class="form-group">
    						<label for="number">Recipient's Mobile Number</label>
    						<input type="text" maxlength="11" class="form-control" id="number" placeholder="Mobile Number" name="number" required="">	
    					</div>

                        <div class="form-group">
                            <label for="msg">Your Message</label>
                            <textarea class="form-control" rows="3" onkeyup="countChar(this)" name="msg" placeholder="Message Here" required=""></textarea>
                        </div>
                        <p class="text-right" id="charNum">85</p>
                            <button type="submit" class="btn btn-success">Send</button>
                       
    		</div>
    	</div>
	</div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

    <script>
        function countChar(val) {
            var len = val.value.length;

            if(len >=85){
                val.value = val.value.substring(0,85);
            }else{
                $('#charNum').text(85-len)
            }
        }
    </script>
    </body>
</form>
