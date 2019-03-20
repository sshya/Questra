 
  // It has the name attribute "signin"
function validateEmail(email,id) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!re.test(email)){
  	$( '#'+id ).siblings('.help-block').html("Invalid Email");
  	return false;
  }
  else 
  	return true;
  //returns false for invalid email
}

function validate_min_lengths(field,minlength,id) {
  if(field.length >= minlength){
    return true;
  }
  else {
  	$( '#'+id ).siblings('.help-block').html("Less than "+minlength+" characters");
    return false;
  }
}
function validate_match(field,checkfield,id) {
  if(field == checkfield){
    return true;
  }
  else {
    $( '#'+id ).siblings('.help-block').html("Did not match");
    return false;
  }
}
function checkpresence(a,id) {
	if (a.length == 0||a == null) {
		$( '#'+id ).siblings('.help-block').html("This field should not be left blank");
		return false
	}
	else {
    $( '#'+id ).siblings('.help-block').html("");
		return true;
  }
}



  function post_question(formdata){

    $.ajax({
        url: 'post_question_ajax.php',
        type: 'post',
        data: {myData:formdata},
        success: function(data) {
            
            location.reload();
          
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
    ga('send', {
        hitType: 'event',
        eventCategory: 'Questions',
        eventAction: 'Post',
        eventLabel: 'New Question'
      });
  }
  function update_question(formdata){

    $.ajax({
        url: 'update_question_ajax.php',
        type: 'post',
        data: {myData:formdata},
        success: function(data) {
            
            window.location.href = "Admin.php";
          
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
  }

    function post_answer(formdata){

    $.ajax({
        url: 'post_answer_ajax.php',
        type: 'post',
        data: {myData:formdata},
        success: function(data) {
            
            location.reload();
          
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
  }
    function verify_user(username){
    return $.ajax({
        url: 'verify_ajax.php',
        type: 'post',
        async: false,
        data: {myData:username},

        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
  }

  function checkduplicate(value,id){
  var validate = verify_user(value);
  return validate.success(function(data){
            if ($.trim(data) == "notok"){
            $( '#'+id ).siblings('.help-block').html("User already exists");
            
            return false;
          }
          else {
            return true;
          }
        });

  }

  
  

      function best_answer(formdata){
        var element = $( formdata ).siblings();
        var data_answer = {};
        var element1 = element[1].value;
        data_answer['a_id'] = element[1].value;
        data_answer['ba_id'] = element[2].value;
        data_answer['q_id'] = element[3].value;
        console.log(data_answer);
        if (element[4].value != 'FALSE'){
        
        $.ajax({
        url: 'post_bestanswer_ajax.php',
        type: 'post',
        data: {myData:data_answer},
        success: function(data) {
            if($.trim(data) == 'ok'){
              $( ".fa.fa-check-square-o.fa-3x" ).attr('class', 'fa fa-square-o fa-3x');
            $( formdata ).attr('class', 'fa fa-check-square-o fa-3x');
            element[2].value = data_answer['a_id'];
            }
            if($.trim(data) == 'notok'){
              $( formdata ).attr('class', 'fa fa-square-o fa-3x');
              element[2].value = '0';
            }
          
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
      }
  } 



      $(".increment").click(function( event )
        { 
          var element = $(this).siblings();

          var data_ques = {};
          data_ques['id'] = element[0].value;
          data_ques['v_type'] = element[1].value;

          console.log(data_ques);


          var count = parseInt($("~ .count", this).text());
          if($(this).hasClass("up")) 
            { 
              data_ques['vote'] = 1;

              $.ajax(
              {
              url: 'post_vote_ajax.php',
              type:'post',
              data: {myData:data_ques},

              success: function(data) 
                                    {
    
                                      q_votes =  $.trim(data);
                                      if (q_votes == null || q_votes == ''){alert('Please login to vote.')}
                                      // if ($(element[3]).html() == q_votes) {
                                      //   alert('Already upvoted')
                                      // }
                                      else{
                                        $(element[3]).html(q_votes);
                                      }
                                      
                                    },

              error: function(xhr, desc, err) {
              console.log(xhr);
              console.log("Details: " + desc + "\nError:" + err);},

            });                                      
            } 
          else 
            {
              data_ques['vote'] = -1;

              $.ajax(
              {
              url: 'post_vote_ajax.php',
              type:'post',
              data: {myData:data_ques},
              
              success: function(data) 
                                    {
                                      q_votes =  $.trim(data);
                                      if (q_votes == null || q_votes == ''){alert('Please login to vote.')}
                                      // if ($(element[3]).html() == q_votes) {
                                      //   alert('Already downvoted')
                                      // }
                                      else{
                                        $(element[3]).html(q_votes);
                                      }                                        
                                    },
              error: function(xhr, desc, err) {
                                              console.log(xhr);
                                              console.log("Details: " + desc + "\nError:" + err);
                                              },

            });                  
            }    
          $(this).parent().addClass("bump");
          setTimeout(function()
         {
           $(this).parent().removeClass("bump");    
         }, 400);
       });