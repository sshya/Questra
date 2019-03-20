
  <script src="js/functions.js"></script>
  <script src="js/bootstrap.js"></script>
  <link href="css/sticky-footer.css" rel="stylesheet">
  <!-- <link href="css/site.css" rel="stylesheet"> -->
  <link href="css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

  <footer class="footer" style="background-color: #222222"  >
      <div class="container"  >
        <p class="text-muted">        
                      <a href="index.php">Home</a> | <a href="help.php">Help</a> | <a href="#">Contact us</a> | <a href="#">Feedback</a> | <a href="#">Policy & Terms</a> | <a href="index.php">© 2016 Questra Community, Inc.</a>

        </p>
      </div>
   </footer>
  </body>
</html>
<?php
  // 5. Close database connection
  if (isset($connection)) {
	  mysqli_close($connection);
	}
?>