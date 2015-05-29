<?php 
	//set app constants
	define("DB_NAME",	'img_gen');
	define("DB_URL",	'localhost');
	define("DB_USER",	'imggen_doron');
	define("DB_PASS",	'm5c5s7un');
	define("BASE_URL",	'http://localhost:8080/ginny');

	function LoadJpeg($imgname)
	{
		/* Attempt to open */
		$im = @imagecreatefromjpeg($imgname);

		/* See if it failed */
		if(!$im)
		{
			/* Create a black image */
			$im  = imagecreatetruecolor(150, 30);
			$bgc = imagecolorallocate($im, 255, 255, 255);
			$tc  = imagecolorallocate($im, 0, 0, 0);

			imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

			/* Output an error message */
			imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
		}

		return $im;
	}

	/*
	* returns the url of a random image by subject
	*/
        function get_img_by_subject($subject)
	{
		//go to DB and get full list of images by subject, use list legnth to extract list of id's
		//choose an id randomly and return thr image url

		$list_of_images = array();
		$img_to_fetcth;
		$img_id_to_fetcth;

		$mysqli = new mysqli(DB_URL, DB_USER, DB_PASS, DB_NAME);
			if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		}

		//use SQL COUNT(*) function to retreive 
		$subjects_query = "SELECT * FROM img_subjects WHERE subject = '" . $subject . "'";

		$res = $mysqli->query($subjects_query);

		while($row = $res->fetch_array(MYSQLI_ASSOC)) 
		{
			array_push($list_of_images,$row["id"]);
			//put all images ID's in an array, to be later used to get random picture
		}

		//genarates a random number between 0 and length of array
		//$img_to_fetcth the number is the position of the image ID in the  $list_of_images 
		//array, not the ID !

		$img_to_fetcth = mt_rand (1, count($list_of_images))- 1;

		$img_id_to_fetcth =	$list_of_images[$img_to_fetcth];

		$img_query = "SELECT * FROM img_subjects WHERE id ='" . $img_id_to_fetcth . "'";

		$res = $mysqli->query($img_query);

		$img_array = $res->fetch_array(MYSQLI_ASSOC);

		$img = BASE_URL . "/" . "images/" .$img_array['folder']. "/" . $img_array['name'] . ".jpeg";
		
		return $img;
	}

    function set_session ()
    {
        //TODO when user successfully logged in set a $_SESSION with user name and pass.
    }

/**
 * @param $username
 * @return bool
 */
    function user_logged_in ($username)
    {
        //TODO chack if user is loged in by useing $_SESSION
        //return true;
        return false;
    }

/**
 * @param $username
 * @param $password
 * @return bool
 */
    function attempt_login ($username, $password)
    {
        $found_user = true;

        if ($found_user)
        {
            //success!
            //mark user as logged in
            //
            return true;
        }
        else
        {
            return false;
        }
    }

 ?>