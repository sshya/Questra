var error = [];
$( "#signin" ).submit(function( event ) {

  if ((!checkpresence(this[0].value,"inputEmail"))
    ||(!checkpresence(this[1].value,"inputPassword"))||(!validate_min_lengths(this[1].value,5,"inputPassword"))){

    return false;
  }
  else{
    return true;
  } 
  });

$( "#postquestion" ).submit(function( event ) {
	var formData = $("#postquestion").serializeObject();
	var temp_makrup = $('.summernote').summernote('code');
	var makrup = $('.note-editable.panel-body').text();
  makrup = $.trim(makrup);
	formData['question'] = temp_makrup;
	
  if ((!checkpresence(this[0].value,"questiontitle"))||(!validate_min_lengths(this[0].value,10,"questiontitle"))
    ||(!checkpresence(makrup,"textedit"))||(!validate_min_lengths(makrup,20,"textedit"))){

    return false;
  }
  else{
  	console.log("Form validated")
  	event.preventDefault();
    post_question(formData);
  }

  });

$( "#updatequestion" ).submit(function( event ) {
  var formData = $("#updatequestion").serializeObject();
  var temp_makrup = $('.summernote').summernote('code');
  var makrup = $('.note-editable.panel-body').text();
  makrup = $.trim(makrup);
  formData['question'] = temp_makrup;
  
  if ((!checkpresence(this[0].value,"questiontitle"))||(!validate_min_lengths(this[0].value,10,"questiontitle"))
    ||(!checkpresence(makrup,"textedit"))||(!validate_min_lengths(makrup,20,"textedit"))){

    return false;
  }
  else{
    console.log("Form validated")
    event.preventDefault();
    update_question(formData);
  }

  });
//For new user registration

$( "#newuser" ).submit(function( event ) {
  var formData = $("#newuser").serializeObject();
  //var x = checkduplicate(this[0].value,"username");
  if ((!checkpresence(this[0].value,"username"))||(!validate_min_lengths(this[0].value,5,"username"))
    ||(!checkpresence(this[1].value,"newemail"))||(!validateEmail(this[1].value,"newemail"))
    ||(!checkpresence(this[2].value,"newpassword"))||(!validate_min_lengths(this[2].value,5,"newpassword"))
    ||(!checkpresence(this[3].value,"duppassword"))||(!validate_match(this[3].value,this[2].value,"duppassword"))
    ) {

    return false;
  }
  else{
    console.log("Form validated");
    return true;
  }

  });

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

//post answer from view_question

$( "#postanswer" ).submit(function( event ) {
  var formData = $("#postanswer").serializeObject();
  var temp_makrup = $('.summernote').summernote('code');
  var makrup = $('.note-editable.panel-body').text();
  makrup = $.trim(makrup);
  formData['answer'] = temp_makrup;
  
  // if ((!checkpresence(makrup,"textedit"))||(!validate_min_lengths(makrup,20,"textedit"))){

  //   return false;
  // }
  // else{
    console.log("Form validated")
    event.preventDefault();
    post_answer(formData);
  // }

  });