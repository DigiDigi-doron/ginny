<?php 
	//set app constants
	define("DB_NAME",	'img_gen');
	define("DB_URL",	'localhost');
	define("DB_USER",	'imggen_doron');
	define("DB_PASS",	'm5c5s7un');
	define("BASE_URL",	'http://localhost:8080/ginny');

/**
 * @return mysqli
 */
function establish_connection ()
    {
        $mysqli = new mysqli(DB_URL, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            return false;
        }
        else
        {
           return $mysqli;
        }

    }

	function LoadJpeg($imgname)
	{
		/* Attempt to open */
		$im = imagecreatefromjpeg($imgname);

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

/**
 * @param $filter filter type
 * @param  $img
 */
    function applay_filter ($filter, $img)
    {

    }

	/*
	* returns the url of a random image by subject
	*/
        function get_img_by_subject($subject)
	{
		//go to DB and get full list of images by subject, use list legnth to extract list of id's
		//choose an id randomly and return thr image url

		$list_of_images = array();

        $connection = establish_connection();

        //selects all the images with the selected subject
		$subjects_query = "SELECT * FROM img_subjects WHERE subject = '" . $subject . "'";

		$res = $connection->query($subjects_query);

		while($row = $res->fetch_array(MYSQLI_ASSOC)) 
		{
            //put all images ID's in an array, to be later used to get random picture
			array_push($list_of_images,$row["id"]);
		}

        /*
        *genarates a random number between 0 and length of array
        *$img_to_fetcth the number is the position of the image ID in the  $list_of_images
        *array, not the ID !
        */

		$img_to_fetcth = mt_rand (1, count($list_of_images))- 1;

		$img_id_to_fetcth   = $list_of_images[$img_to_fetcth];

		$img_query = "SELECT name FROM img_subjects WHERE id ='" . $img_id_to_fetcth . "'";

		$res = $connection->query($img_query);

		$img_array = $res->fetch_array(MYSQLI_ASSOC);

		$img = $_SERVER['DOCUMENT_ROOT'] . '/ginny/images/' . $img_array['name'];

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
 * @return Array
 */
    function attempt_login ($username, $password)
    {
        $massage            = Array('connected' => false, 'error' => 'general error - something went wrong');
        $found_user_name    = false;
        $found_user_pass    = false;
        $mysqli             = new mysqli(DB_URL, DB_USER, DB_PASS, DB_NAME);

        if ($mysqli->connect_errno) {
            $massage = ['connected' => false , 'error' => 'Failed to connect to MySQL: ' . $mysqli->connect_error];
            return $massage;
        }

        $users_query    = "SELECT * FROM admins WHERE username = '" . $username . "'";
        $user_res       = $mysqli->query($users_query);

        if($user_res->num_rows == 0) {
            $found_user_name = false;
            $massage = ['connected' => false, 'error' => 'user name dose not exists'];
            //mysql_close();
            return $massage;
        }
        elseif ($user_res->num_rows == 1)
        {
            $found_user_name = true;
            $pass_query     = "SELECT password FROM admins WHERE username = '" . $username . "'";
            $pass_res       = $mysqli->query($users_query);
            $fetched_pass   = $pass_res->fetch_array(MYSQLI_ASSOC)['password'];

            if ($fetched_pass != $password) {
                $massage = ['connected' => false, 'error' => 'password is wrong'];
                return $massage;
            } else
            {
                $found_user_pass = true;
            }

        }

        if ($found_user_name && $found_user_pass)
        {
            //success!
            //mark user as logged in
            $_SESSION['user']= $_POST['username'];
            $_SESSION['logged_in'] = true;
            $massage = ['connected' => true, 'username' => $username];
            return $massage;
        }
        else
        {
            return $massage;
        }
    }

/**
 *@param   $subject
 * @param $name
 *@return Bool
 */
function register_file_in_DB ($subject,$name)
    {
        if (establish_connection() === false)
        {
            return false;
        }
        else
        {
            $connection     =   establish_connection();
            $upload_query   =  "INSERT INTO img_subjects(subject, name) VALUES ('$subject','$name')";
            $connection->query($upload_query);
        }
    }

    /**
    *
    */
    function count_images ()
    {
        if (establish_connection() === false)
        {
            return false;
        }
        else
        {
            $connection     =   establish_connection();
            $count_query    =   "SELECT COUNT(id) FROM img_subjects";
            $images_count   =   $connection->query($count_query);
            $res            =   $images_count->fetch_array(MYSQLI_ASSOC);
            $count          =   $res['COUNT(id)'];
            return $count;
        }
    }
 ?>