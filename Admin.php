<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
  include("./includes/nav.php");
?>
<link href="css/pagination.css" rel="stylesheet">
<script src="js/bootstrap-switch.js"></script>


<div class="container">
<div  id="errormsg" role="alert">
       <?php echo message(); ?>
    </div>

</div>

<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10 well">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class="active"><a href="#myans" aria-controls="profile" role="tab" data-toggle="tab"><h4>Users</h4></a></li>
    <li role="presentation"><a href="#myhome" aria-controls="home" role="tab" data-toggle="tab"><h4>Questions</h4></a></li>


  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="myans">
    <div class="row">
<?php  
      $user_result = find_alluserdetails();
      while($user_row = mysqli_fetch_assoc($user_result)) 
    {
      $first_name = $user_row["first_name"];
      $score = $user_row["SCORE"];
      $Total_Q = $user_row["Q_COUNT"];

      //$q_id = $user_row["q_id"];
      ?>
  
    <div class="col-md-3" style="background-color: #fff;border: 1px solid #ddd;border-radius: 1.25rem;padding: 5px 5px 5px 5px;">
      <a href="myprofile.php?uid=<?php echo $user_row["U_ID"]; ?>" class="thumbnail">
        <img src="userimages/<?php echo $user_row["user_image"]; ?>" style="width: 200px; height: 200px;" alt="...">
      </a>
      <p><?php echo $first_name; ?></p><p>SCORE:<?php echo $score; ?></p><p>Total Questions:<?php echo $Total_Q; ?></p>
      </div>
  
    <!-- <?php echo $first_name; ?> -->
    <!-- <?php echo $score; ?> -->
    <?php }?>
  </div></div>

    <div role="tabpanel" class="tab-pane" id="myhome">
    <p></p>

    <?php
    $user_id= $_SESSION["uid"];
    $page = '';
    $rec_limit = 5;
    if( isset($_GET{'page'} ) AND $_GET{'page'}>0) {
        $page = $_GET{'page'};
        $offset = $rec_limit * $page ;

        }
    elseif (isset($_GET{'page'} ) AND $_GET{'page'}<0) {
         $page = 0;
         $offset = 0;             
        }    
    else {
         $page = 0;
         $offset = 0;
         }                       

    $result = get_allquestions_admin($user_id,$offset, $rec_limit);
    while($row = mysqli_fetch_assoc($result)) 
    {
      $question_id = $row["Q_ID"];
      if ($row["ACTIVE"] == "TRUE"){
        $question_id_url = $row["Q_ID"];
        $url = 'view_question.php?q_id='.$question_id_url ;
      } else {
          $question_id_url = '#';
          $url = $question_id_url ;
      }

    echo "<div class='row'>

          <div class='col-xs-6 col-md-3'> 
                 <button type='button' class='btn btn-sm' border-color: #eeeeee;> " . $row["UP_VOTE"] . "<br>" . "Votes" . " </button> 
                 <button type='button' class='btn btn-sm' style='background-color:rgba(127, 230, 161, 0.77);border-color: #eeeeee;' >" . $row["ANSWERS_COUNT"] . "<br>" . "Answers" . " </button> 
                 <button type='button' class='btn btn-sm' border-color: #eeeeee;>" . $row["VIEWS"] . "<br>" . "Views" . " </button> 
              </div>


            <div class='col-xs-12 col-md-6'> 
                 <div> 
                     <a href='".$url."'>" . verify_output($row["Q_TITLE"]) . "</a> 
                 </div> 
                 <br>  
                 <button type='button' class='btn btn-sm' style='background-color:#d6ecff;'>" . $row["Q_TAG"] . " </button>
                 
            </div>
            <span>
            <a class='btn btn-primary' href='update_question.php?q_id=".$question_id."' >Edit</a>";
            
            if ($row["ACTIVE"] == "TRUE"){
            echo "<input type='checkbox' value = ".$question_id." name='delete-checkbox' data-on-text='Delete' data-off-text='Add' checked>"; 
            } else {
            echo "<input type='checkbox' value = ".$question_id." name='delete-checkbox' data-on-text='Delete' data-off-text='Add' >";  
            };
            if ($row["STATE"] == "TRUE"){
            echo "<input type='checkbox' value = ".$question_id." name='freeze-checkbox' data-on-text='Freeze' data-off-text='Unfreeze' checked>"; 
            } else {
            echo "<input type='checkbox' value = ".$question_id." name='freeze-checkbox' data-on-text='Freeze' data-off-text='Unfreeze' >";  
            };

      echo "</span>
            <div class='col-xs-6 col-md-3'>
                <p></p>
                <div style='background-color:#e0eaf1;width: 80%;'>";
                        $image_url = getimageurl($row["gravatar"], $row["email"], $row["user_image"]);
                                        echo "<img src='" . $image_url . "' width='55' height='55' style='float: left;padding: 0 0px 0 0;margin: 0 6% 0 0;'>";

                                      echo "<div>Posted on: <a>" . $row["Q_CREATED_ON"] . "</a ><br>Posted by: <a href = 'myprofile.php?uid=".$row["U_ID"]."'>" . $row["FIRST_NAME"] . "</a></div>
                                      <div><i class='fa fa-certificate' aria-hidden='true'> " . $row["SCORE"] . " </i></div>
                                      <p></p></div>
          </div>  

        </div> <hr/>";
    }


              $page_name = 'Admin.php';
              $query_name = 'get_allquestions_admin';     
              $p1_name = 'uid';
              $p1_value = $user_id;

              $cnt = get_row_count($query_name,$p1_name,$p1_value);
              //echo $cnt;
              echo generate_pagination_buttons($rec_limit,$cnt,$page,$page_name,$p1_name,$p1_value);

  ?>
  </div>


  </div>

</div>
<div class="col-sm-1"></div>

</div>



    <!-- Custom styles for this page -->
    <link href="css/postquestion.css" rel="stylesheet">
    <script src="js/validations.js"></script>
    <script>
$("[name='freeze-checkbox']").bootstrapSwitch();
$("[name='freeze-checkbox']").on('switchChange.bootstrapSwitch', function (event, state) {
  if (state == true){
    new_state = "TRUE"
  }
  if (state == false){
    new_state = "FALSE"
  }
  console.log(state);
  var formdata = {};
  formdata["state"] = new_state;
  formdata["q_id"] = this.value;


      $.ajax({
        url: 'admin_ajax.php',
        type: 'post',
        data: {myData:formdata,param:"freeze"},
        success: function(data) {
            
            //location.reload();
          
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call

});
$("[name='delete-checkbox']").bootstrapSwitch();
$("[name='delete-checkbox']").on('switchChange.bootstrapSwitch', function (event, state) {
  if (state == true){
    new_state = "TRUE"
  }
  if (state == false){
    new_state = "FALSE"
  }
  console.log(state);
  var formdata = {};
  formdata["active"] = new_state;
  formdata["q_id"] = this.value;


      $.ajax({
        url: 'admin_ajax.php',
        type: 'post',
        data: {myData:formdata,param:"delete"},
        success: function(data) {
            
            //location.reload();
          
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call

});
</script>


<?php
// 4. Release returned data

  	require_once("footer.php");
?>