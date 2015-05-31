$(document).ready(function() 
{
	var img_color = [000,000,000];
	//jquery ui - tabs
	$( "#tabs" ).tabs();

	//set up color picker 
	//http://colpick.com/plugin
	$('#picker').colpick
	({
		flat:true,
		layout:'hex',
		colorScheme:'dark',
		submit:0,
		onChange:function(hsb,hex,rgb,el,bySetColor) 
		{ 
			//get sepatare rgb values from rgb object
			img_color = [rgb.r, rgb.g ,rgb.b];	
		}
	});

	//jquery validate
	$('#img-gen-form-blank').submit(function(event) 
	{
		event.preventDefault();
		//using jquery validate to validate the form
		$('#img-gen-form-blank').validate
			({
				submitHandler:function()
				{
					var form_data = $('#img-gen-form-blank').serialize();
					form_data += '&color=' + img_color;
					console.log("Form Data: " + form_data);
					
					if ($('#img-gen-preview').has('.generated-img'))
					{
						$('.generated-img').remove();
					}

					$('#img-gen-preview').append("<img class='generated-img' src='../ginny/includes/generator.php?"+ form_data +"' alt='img'/>");
				}
			});
	});

	$('#img-gen-form-subject').submit(function(event) 
	{
		event.preventDefault();
		//using jquery validate to validate the form
		$('#img-gen-form-subject').validate
			({
				submitHandler:function()
				{
					var form_data = $('#img-gen-form-subject').serialize();
					console.log("Form Data: " + form_data);
					//$('#img-gen-preview').append('<img src="#" />');
				}
			});
	});

    $('#login_form').submit(function(event)
    {
        event.preventDefault();
        //using jquery validate to validate the form
        $('#login_form').validate
        ({
            rules :{
                username : {
                    required: true
                },
                password : {
                    required: true
                }
            },
            messages: {
                username: "You must specify your user name",
                password: {
                    required: "You must specify your password"
                }
            },
            submitHandler:function()
            {

                var login_form_data = $('#login_form').serializeArray();
                //console.log(login_form_data);
                $.ajax({

                    // The URL for the request
                    url: "includes/login.php",

                    // The data to send (will be converted to a query string)
                    data: {
                        username: login_form_data[0].value,
                        password: login_form_data[1].value
                    },

                    // Whether this is a POST or GET request
                    type: "POST",

                    // The type of data we expect back
                    dataType : "json",

                    // Code to run if the request succeeds;
                    // the response is passed to the function
                    success: function( json ) {
                        console.log("echoed back- " + json);
                        if (json.connected == true){
                            console.log("connection OK redirecting");
                            window.location =  "http://localhost:8080/ginny/includes/admin.php?username=" + json.username;
                        }
                        else {
                            console.log(json.error);
                        }
                    },

                    // Code to run if the request fails; the raw request and
                    // status codes are passed to the function
                    error: function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    },

                    // Code to run regardless of success or failure
                    complete: function( xhr, status ) {
                        console.log( "The request is complete!" );
                    }
                });


            }
        });
    });

});



	
 
