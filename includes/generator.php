<?php 

	include "functions.php";
	
 	generate_img($_GET);

	function generate_img (Array $form_data) 
	{

	$generate_type 	= $form_data['generate-type'];

	 	if ($generate_type == 'blank') 
	 	{
	 		
	 		//genarate image
                    $img_width 			 =	$_GET['img_width'];
                    $img_height 		 = 	$_GET['img_height'];
                    $img_burn_dimensions = 	(isset($_GET['img-burn-dimensions']) ? true : false   );
                    $img_burn_text 		 = 	(isset($_GET['img-burn-text']) ? true : false   );
                    $img_text			 =	$_GET['img-text-on-image'];
                    $img_color			 =	explode(',' , $_GET['color']);


			//creates image with width and height
			$im = @imagecreate($img_width, $img_height)
				or die("Cannot Initialize new GD image stream");
			//sets background color
			$background_color = imagecolorallocate($im, $img_color[0], $img_color[1], $img_color[2]);

			//if user checked the "burn text on image" cheackbox
			if ($img_burn_text) 
			{
				// -!- need to put here some funcionality to calculate the x and y position
				$text_color = imagecolorallocate($im, 000, 000, 000);
				imagestring($im,5, 1, 1, $img_text, $text_color);
			}

			if ($img_burn_dimensions) 
			{
				// -!- need to put here some funcionality to calculate the x and y position
				$text_color = imagecolorallocate($im, 000, 000, 000);
				imagestring($im,5, 1, 20, $img_width . " x " . $img_height  , $text_color);
			}

			header('Content-type: image/jpeg');
			imagepng($im);
			imagedestroy($im);
	 	}

	 	elseif ($generate_type == 'subject') 
	 	{
	 		header('Content-Type: image/jpeg');
	 		//go to db and get images by parameter

            $img_effects	=  ($_GET['img-effect']=='none') ? false : true;
			$img_subject	=	$_GET['img-subject-select'];


			$retrived_img = get_img_by_subject($img_subject);
            $img = LoadJpeg($retrived_img);
            if ($img_effects)
            {
                $effect = $_GET['img-effect'];
                switch  ($effect)
                {
                    case 'IMG_FILTER_GRAYSCALE':
                        imagefilter($img, IMG_FILTER_GRAYSCALE);
                        imagejpeg($img);
                        imagedestroy($img);
                        break;
                    case 'IMG_FILTER_COLORIZE':
                        imagefilter($img, IMG_FILTER_COLORIZE,  255, 128, 16, 60);
                        imagejpeg($img);
                        imagedestroy($img);
                        break;
                    case 'IMG_FILTER_PIXELATE':
                        imagefilter($img, IMG_FILTER_PIXELATE, 15, true);
                        imagejpeg($img);
                        imagedestroy($img);
                        break;
                    default:
                    imagejpeg($img);
                    imagedestroy($img);
                }
            }
            else
            {
                imagejpeg($img);
                imagedestroy($img);
            }

	 	}

	 	elseif (!isset($generate_type)) 
	 	{
	 		echo "<h1>no type was set</h1>";
	 	}

	}



 ?>