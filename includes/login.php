<?php
/**
 * Created by PhpStorm.
 * User: Doron
 * Date: 29/05/2015
 * Time: 11:41
 * pass 1q@w3A user doron | pass AaBb123%
 */

include "functions.php";
session_start();
$_SESSION['logged_in'] = false;

if ( !isset($_POST['username'])  || !isset($_POST['password']))
{
    echo '<h1>Error - $_POST data was noe set</h1>';
    exit;
}

$username   = $_POST['username'];
$password   = $_POST['password'];

//TODO if login successful set $_SESSION with user name and pass
//TODO if user us already logged in show massage "Logged in as". User details User-name, pass, email + images
//get $_POST data from login
//Handle logging by calling functions - chacke_if_loggedin(),set_session (),log_in();

    //TODO get current user name from $_SESSION
    if (user_logged_in($username))
    {
        //TODO redirect to admin.php
    }
    else
    {
    //TODO login user. Use $_POST to login user. only after user is logged in - show images and set seesion
        $login = attempt_login ($username, $password);
        echo json_encode($login);
    }

