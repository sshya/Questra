<?php
  include("./includes/db_connection.php");
  include("./includes/session.php");
  include("./includes/functions.php");
  include("./htmlheader.php");
  include("./includes/nav.php");
?>
 

<style type="text/css">
    .bs-example{
      margin: 10px;
    }

    .panel-default > .panel-heading {
    color: #1b96fe;
    background-color: #eee;
    border-color: #eeeeee;
}

</style>
    <div class="container">

    <h1>Frequently Asked Questions</h1>
    <br>

<div class="bs-example">  
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. What topics can I ask about here?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>Questra is for quora enthusiasts, people who have generally questions.</p>
                    <p> # Any Science, Health, Mathematics, Software and Social topics.</p>                              
                    <a href="newuser_register.php" target="_blank">Register Here.</a></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2. I lost my password; how do I reset it?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>If you have lost your password, please email our account recovery team id below: </p><a>helpdesk@questra.com</a><p> 
                    <p>Enter the email address that you signed up with and We will email you a list of your account credentials and a link to reset your password.
                    </p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. Why and how are some answers deleted?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Answers that do not fundamentally answer the question may be removed.</p> 
                    <p>This includes answers that are:</p>
                    <p># Commentary on the question or other answers</p>
                    <p># Asking another, different question</p>
                    <p># “thanks!” or “me too!” responses</p>
                    <p># Exact duplicates of other answers </p>
                </div>
            </div>
        </div>       
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">4. What does it mean if a question is "Freezed"?</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Questions that need additional work or that are not a good fit for this site may be put on hold by experienced community members. While questions are on hold, they cannot be answered until the Admins to make them eligible for reopening.</p>
                </div>
            </div>
        </div>   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">5. Why is voting important?</a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Voting is central to our model of providing quality questions and answers</p>
                    <p>   # Good content rises to the top</p>
                    <p>   # Incorrect content falls to the bottom</p>
                    <p>   # Users who consistently provide useful content accrue reputation on the site</p>
                </div>
            </div>
        </div>               
    </div>
  <p><strong>Note:</strong> Click on the linked heading text to expand or collapse panels.</p>
</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php
  require_once("footer.php");
?>

