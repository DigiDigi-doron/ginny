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

					$('#img-gen-preview').append("<img class='generated-img' src='../image-genarator/includes/generator.php?"+ form_data +"' alt='img'/>");
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

});

/*--------------------------------------------------------------------*/

// function send_data (form_data) 
// 	{
// 		console.log(form_data);
// 		$.ajax
// 		({
// 	      url: 'includes/main.php',
// 	      type: 'post',
// 	      data: {
// 	      		'image-name': 'test-image',
// 	      		'width':				200,
// 	      		'height':				200,
// 	      		'burn-dimensions':		true
// 	      		},

// 	      success: function(data, status) {
// 	        if(data == "ok") {
// 	          $('#img-gen-preview').html('<p><em>Got image!</em></p>');
// 	        }
// 	      },
// 	      error: function(xhr, desc, err) {
// 	        console.log(xhr);
// 	        console.log("Details: " + desc + "\nError:" + err);
// 	      }
// 	    }); // end ajax call

// 	}
// $.ajax
// 					({
// 				      type: 'post',
// 				      url: 'includes/main.php',
// 				      data: form_data ,

// 				      success: function(data, status) {
// 				      	console.log(status + " / " + data);
// 				      	$('#img-gen-preview-section').load('includes/main.php');
// 				        // if(data == "ok") 
// 				        // {
// 				        //   //$('#img-gen-preview-section').html('<p><em>Got image!</em></p>');
// 				        // }
// 				      },
// 				      error: function(xhr, desc, err) {
// 				        console.log(xhr);
// 				        console.log("Details: " + desc + "\nError:" + err);
// 				      }
// 				    }); // end ajax call

	
 
