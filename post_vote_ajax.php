<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  //include("./htmlheader.php");
$obj = $_POST['myData'];

$id = $obj["id"];
$vote = $obj["vote"];
$v_type = $obj["v_type"];

if (logged_in()){

  if (vote_ins_upd($id,$vote,$v_type)){
     $votes = get_vote_count($id,$v_type);                                          
      echo $votes;
  }
}
else {
  echo '';
}

?>