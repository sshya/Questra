
<?php
  define("DB_SERVER", "localhost");
  define("DB_USER", "admin");
  define("DB_PASS", "M0n@rch$");
  define("DB_NAME", "question_forum");

  // 1. Create a database connection
  $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
 
  // check connection
  
  if ($mysqli->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }
  
 
  $query = 'SELECT user_id FROM ptl_users';
 
  if(isset($_POST['query'])){
    $query .= ' WHERE first_name LIKE "%'.$_POST['query'].'%"';
  }
 
  $return = array();
 
  if($result = $mysqli->query($query)){
    // fetch object array
    while($obj = $result->fetch_object()) {
      //$return[] = $obj->u_id;
      $return[] = $obj->user_id;

     }
    // free result set
    $result->close();
  }
 
  // close connection
  $mysqli->close();
 
  $json = json_encode($return);
  print_r($json);