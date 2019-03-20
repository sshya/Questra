<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "admin");
	define("DB_PASS", "M0n@rch$");
	define("DB_NAME", "question_forum");

  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed" 
    );
  }
?>
