<?php
/**
 * Created by PhpStorm.
 * User: Doron
 * Date: 01/06/2015
 * Time: 23:31
 */

include "functions.php";
$subject = $_POST['img-subject-select'];
$date_identifier = date('DMH');
$images_count = count_images () + 1;
$file_name = $images_count . "_" . $date_identifier . "_" . $_FILES['file']['name'];
$ds = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'images';   //2

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = 'C:\xampp\htdocs\ginny\images' . $ds; //4

    $targetFile =  $targetPath . $file_name;  //5

    move_uploaded_file($tempFile,$targetFile); //6

    register_file_in_DB ($subject,$file_name);
}
?>
