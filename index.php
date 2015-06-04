<!DOCTYPE html>
<html lang="en">
<?php include "includes/functions.php";
session_start();
$logged_in  = (isset($_SESSION['logged_in'])) ? $_SESSION['logged_in'] : false;
$user       = (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
?>
  <head>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/colpick.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
    Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Image Genarator</title>
    <meta name="description" content="">
    <meta name="author" content="Doron">
    <meta name="viewport" content="width=device-width"  initial-scale="1.0">
    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="stylesheet" href="css/colpick.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>

  <body>
  <main id="main">
    <header id="header">
    <?php if ($logged_in) : ?>
            <div id="img-gen-user-greeting" >
                <span>Hello: <?php echo $user ?>  </span>
               <a href="<?php echo BASE_URL ?>/includes/admin.php">admin</a>
            </div>
    <?php endif; ?>
        <h1 id="logo">
            <a href="#">GINNY</a>
        </h1>
      <div id="nav-wrapper">
        <nav></nav>
      </div> <!--
      -->

    </header>
    <section class="img-gen-section" id="img-gen-control-section">
        <div id="form-error-container">

        </div>
      <div id="tabs">
      <ul>
        <li><a href="#blank">blank image</a></li>
        <li><a href="#subject">by subject</a></li>
      </ul>
      <div id="blank">
      <h2 class="img-gen-title">generate blank image</h2>
          <form class="img-gen-form" id="img-gen-form-blank">
          <input type="hidden" name="generate-type" value="blank">
            <label for="img-width">width and height</label>
            <input class="img-gen-inline-input" placeholder="width" type="number" name="img_width" min="1" max="2500">
            <input class="img-gen-inline-input" placeholder="height" type="number" name="img_height" min="1" max="2500">
            <label for="img-burn-dimensions">burn dimensions on image </label>
            <input type="checkbox" name="img-burn-dimensions" value="burn">
            <label>set image color</label>
            <div id="picker"></div>
            <label for="img-burn-text">burn text on image </label>
            <input type="checkbox" name="img-burn-text" value="burn">
            <label for="img-text-on-image">text on image</label>
            <textarea name="img-text-on-image">text on image</textarea>
                        <input type="submit" value="generate">
          </form>
      </div>
      <div id="subject">
        <h2 class="img-gen-title">generate image by subject</h2>
        <form class="img-gen-form" id="img-gen-form-subject">
            <input type="hidden" name="generate-type" value="subject">
            <label for="img-subject-select">select subject</label>
            <select name="img-subject-select">
            <option value="cats">cats</option>
            <option value="landscape">landscape</option>
            <option value="business">business</option>
            <option value="abstract">abstract</option>
            </select>
            <label for="img-effects">select subject</label>
            <select name="img-effect">
              <option value="none">no effect</option>
              <option value="IMG_FILTER_GRAYSCALE">black and white</option>
              <option value="IMG_FILTER_COLORIZE">sapia</option>
              <option value="IMG_FILTER_PIXELATE">pixelate</option>
            </select>
            <input type="submit" value="generate">
          </form>
      </div><!--end #subject-->
      </div><!--end #tabs-->
    </section><!--
    --><section class="img-gen-section" id="img-gen-preview-section">
        <div id="img-gen-url-wrapper">
          <span id="img-gen-url-title">url</span>
          <span id="img-gen-url"><?php echo BASE_URL ;?>/includes/generator.php<span id="img-gen-url-generated"></span></span>
        </div>
        <div id="img-gen-preview-wrapper">
            <div id="img-gen-preview">
                
            </div>
        </div>
    </section>
    <footer id="footer">
        <?php if ($logged_in == false) : ?>
        <div id="img-gen-login-wrapper">
            <!--TODO if user is logged in ($_SESSION) show "Hello $user" + hide form + show logout(session destory())-->
            <div id="login_wrapper">
                <div id="login_container">
                    <form id="login_form">
                        <label for="username">user name</label>
                        <input id="username" type="text" name="username"/>
                        <label for="password">password</label>
                        <input id="password" type="password" name="password" />
                        <input id="submit" type="submit" name="submit" value="submit"/>
                    </form>
                    <div id="server-err-wrapper">

                    </div>
                </div>
            </div>
        </div>
         <?php endif; ?>
    </footer>
  </main>
  </body>
</html>