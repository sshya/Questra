<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  //include("./htmlheader.php");
$obj = $_POST['myData'];
$check = $_POST['param'];


$q_id = $obj["q_id"];


if ($check == "freeze"){
	$state = $obj["state"];
	update_state($q_id,$state);
  }
if ($check == "delete"){
	$active = $obj["active"];
	update_active($q_id,$active);
  }


?>