<?php
/**
 * Created by PhpStorm.
 * User: Doron
 * Date: 29/05/2015
 * Time: 15:03
 */
include "functions.php";
session_start();
$logged_in  = (isset($_SESSION['logged_in'])) ? $_SESSION['logged_in'] : false;
$user       = (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	    <script type="text/javascript" src="../js/dropzone.js"> </script>
        <script type="text/javascript" src="../js/colpick.js"></script>
		<meta charset="utf-8">
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Admin</title>
		<meta name="description" content="">
		<meta name="author" content="Doron">
		<meta name="viewport" content="width=device-width"  initial-scale="1.0">
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <script type="text/javascript" src="../js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/dropzone.css">
        <link rel="stylesheet" type="text/css" href="../css/normalize.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">

	</head>

	<body>
    <main id="main">
        <?php if($logged_in == true ): ?>
        <header id="header">

                <div id="img-gen-user-greeting" >
                    <span>Hello: </span><?php echo $_SESSION['user']; ?>
                </div>

            <h1 id="logo">
               <a href="<?php echo BASE_URL ?>">GINNY</a>
            </h1>
            <div id="nav-wrapper">
                <nav>
                    
                </nav>
            </div> <!--
      --> <span id="img-gen-refresh-preview">
                refresh
            </span>
        </header>
        <section class="img-gen-section" id="img-gen-admin-upload">
        <form action="upload.php" class="dropzone">
            <select name="img-subject-select">
                <option value="cats">cats</option>
                <option value="landscape">landscape</option>
                <option value="business">business</option>
                <option value="abstract">abstract</option>
            </select>
        </form>
        </section><!--
        --><section class="img-gen-section" id="img-gen-admin-preview">

        </section>
            <footer id="footer">
            </footer>
        <?php endif ?>
        <?php if($logged_in == false) : ?>
            <h1>
                You are not logged in!
            </h1>
            <h2> Go <a href="<?php echo BASE_URL ?>">home</a> you are drunk...</h2>
        <?php endif ?>
    </main>
	</body>
</html>
