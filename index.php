<?php
  include("./includes/session.php");
  include("./includes/db_connection.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
  include("./includes/nav.php");  
?>

<link href="css/pagination.css" rel="stylesheet">

<div class="container-fluid">
  <p></p>
  <div class="row">

  	<div class="col-sm-1"> </div>

    <div class="col-sm-10" style="background-color:#fff">    

    		<div class="col-sm-12"> 
    		
                        <?php  
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
                        $result = get_landing_questions($offset, $rec_limit);
                        ?>

				<p>
				</p>
  				<ul class="nav nav-tabs">
  				
    				<li class="active"><a href="#"><h4><b>Top Portal Questions</b></h4></a></li>
    				<!--<li><a href="#">Un-Answered</a></li>-->
  				</ul>
  				<p></p>
  				<br>

  				<div class="col-sm-12" >
					<div>

						<p></p>

						<div>
		 		 		<?php
		  				while($row = mysqli_fetch_assoc($result))	
		  				{
		  					$question_id = $row["Q_ID"];

						echo "<div class='row'>

	  							  <div class='col-xs-6 col-md-3'> 
							           <button type='button' class='btn btn-sm'  > " . $row["V_COUNT"] . "<br>" . "Votes" . " </button> 
							           <button type='button' class='btn btn-sm' style='background-color:rgba(127, 230, 161, 0.77);border-color: #eeeeee;' >" . $row["ANSWERS_COUNT"] . "<br>" . "Answers" . " </button> 
							           <button type='button' class='btn btn-sm' style='border-color: #eeeeee;'>" . $row["VIEWS"] . "<br>" . "Views" . " </button> 
						          </div>


	  						      <div class='col-xs-12 col-md-6'> 
	  						           <div> 
	  						               <a href='view_question.php?q_id=".$question_id."'>" . $row["Q_TITLE"] . "</a> 
	  						           </div> 
	  						           <br>";  
	  						           //<button type='button' class='btn btn-sm' style='background-color:#d6ecff;'>" . $row["Q_TAG"] . " </button> ";

	  					               $Tag_String = $row['Q_TAG'];
                                    
                                       $Tag_Array = explode(' ', $Tag_String);
                                       $i=0;

                                             for($i=0;$i<=(count($Tag_Array)-1);$i++)
                                              {
                                                echo "<button type='button' class='btn btn-sm' >
                                                       <a href='questionsbytag.php?q_tag=".$Tag_Array[$i]."'>".$Tag_Array[$i]."</a></button>";

                                              }  	           


	  					echo      "</div>
							      <div class='col-xs-6 col-md-3'>
								        <p></p>
								        <div style='background-color:#e0eaf1;width: 80%;'>";
								        $image_url = getimageurl($row["gravatar"], $row["email"], $row["user_image"]);
                                        echo "<img src='" . $image_url . "' width='55' height='55' style='float: left;padding: 0 0px 0 0;margin: 0 6% 0 0;'>                
	                                    <div>Posted on: <a>" . $row["Q_CREATED_ON"] . "</a><br>Posted by: <a>" . $row["FIRST_NAME"] . "</a></div>
	                                    <div><i class='fa fa-certificate' aria-hidden='true'> " . $row["SCORE"] . " </i></div>
	                                    <p></p>	   
								  </div>	
								  </div>

							  </div>";
			  			}
		  				?>

		  				<?php
		  				    $page_name = 'index.php';
		  				    $p1_name = 1;
		  				    $p1_value = 1;
		  				    $query_name = 'landing_page_questions';
							$cnt = get_row_count($query_name,$p1_name,$p1_value);
							echo generate_pagination_buttons($rec_limit,$cnt,$page,$page_name,$p1_name,$p1_value);
						?>

		  				</div>



		  			</div>
				</div>
    		</div>
    	</div>
    </div>


    <div class="col-sm-1" > 

    </div>
</div>

    <!-- Custom styles for this page -->
    <link href="css/signin.css" rel="stylesheet">


<?php
  require_once("footer.php");
?>