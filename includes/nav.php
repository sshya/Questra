    <!-- <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="./assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet"> -->

<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <!--  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
                <ul class="nav navbar-nav">
              
                        <li>
                        <a href="index.php">Questra</a>
                        </li>                            
                                                

                    <?php if(!logged_in()){ ?>

                        <li>
                        <a href="index.php">About Us</a>
                        </li>                     

                        <li>
                        <a href="#">Contact Us</a>
                        </li>                    

                        <li>
                        <a href="newuser_register.php">Register</a>
                        </li>

                        <li>
                        <a href="login.php">Sign In</a>
                        </li>
                        <li>
                        <img src="pics/Logomakr_8qqzZC.png" width="35" height="40" alt="">
                        </li>                        

                    <?php } ?>

                    <?php
                    if(logged_in()){ 
                    $userid= $_SESSION["uid"];
                    $uname = find_username($userid);
                    $row = mysqli_fetch_assoc($uname);
                    $user_name = $row["first_name"];
                    $result_user_nav = find_userdetails($_SESSION['uid']);
                        ?>
<!--
                        <li>
                        <a href="#">Contact Us</a>
                        </li>                        
-->                        
                        <li>
                            <form action="myprofile.php" method="get">
                            <input name="uid" class="typeahead" id="Search_form" type="text" data-provide="typeahead" autocomplete="off" placeholder = "Search Questra Users">
                            </form>
                        </li>

                        <li>
                        <a href="logout.php">Sign Out</a>
                        </li>
                        <li>
                        <?php $image_urlnav = getimageurl($result_user_nav['gravatar'], $result_user_nav['email'], $result_user_nav['user_image']);?>
                        <img src="<?php echo $image_urlnav; ?>" width="35" height="40" alt="">
                        </li>
                        <li>
                        <a id="userid" href="myprofile.php?uid=<?php echo $userid ?>"><?php echo $user_name ?></a>
                        </li>
                    <?php } ?>
                    
                </ul>
           <!-- </div> -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
</nav>
<br>
<div class="page-header">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <a href="index.php" class="header-brand">
            <img src="pics/Logomakr_7FCfRF.png" alt="" width="421" height="62">
            </a>
        </div>
        <div class="col-sm-8 hidden-xs">
        <ul class="nav navbar-nav">
                    <li class="hidden active">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php">Trending</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="view_my_questions.php">All Questions</a>
                    </li>
                                      
                    <li>
                        <a class="page-scroll" href="post_question.php">Ask Question</a>
                    </li>
                    <?php if(logged_in() && $result_user_nav['user_role'] =="Admin"){ ?>
                    <li>
                        <a class="page-scroll"  href="Admin.php">Administration</a>
                    </li>
                    <?php } ?>
        </ul>
        </div>
        
    </div>    
</div>
<br>
    <!-- Custom styles for this page -->
    <link href="css/nav.css" rel="stylesheet">
    <script src="./assets/jquery/jquery-3.1.1.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap3-typeahead.js"></script>
 
    <script type="text/javascript">
    var USER_ID = $('#userid').html()
    ga('set', 'userId', USER_ID);
      $(document).ready(function() {
        $('input.typeahead').typeahead({
          source: function (query, process) {
            $.ajax({
              url: 'data.php',
              type: 'POST',
              dataType: 'JSON',
              data: 'query=' + query,
              success: function(data) {
                console.log(data);
                process(data);
              }
            });
          }

        });
      });

      $(document).keyup(function(e) {
          if ($(".typeahead:focus") && (e.keyCode === 13)) {
              $( "form:first" ).submit();
          }
        ga('send', {
            hitType: 'event',
            eventCategory: 'Search',
            eventAction: 'Search',
            eventLabel: 'New Search'
          });
       });


    </script>