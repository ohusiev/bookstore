<?php

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";
require_once("internal/dbconnect.php");
	if(isset($_POST) & !empty($_POST)){

$username  = mysqli_real_escape_string($mysqli, $q);
$sql = "SELECT * FROM customer WHERE uname='$username'";
$result = mysqli_query($mysqli,$sql);
$count = mysqli_num_rows($result);
if($count>0){
    $hint = "Name is not available";
}else{
    $hint = "Okay";
}
    }
//echo $hint;
echo json_encode($hint);
?>