<?php
/**
 * Created by PhpStorm.
 * User: Doron
 * Date: 03/06/2015
 * Time: 20:06
 */

include "functions.php";

$images_details = Array();

$action = $_POST['action'];

if ($action == 'refresh') {

    $connection = establish_connection();
    $all_imgs_query = "SELECT id, name FROM img_subjects";
    $res = $connection->query($all_imgs_query);
         while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
           array_push($images_details,$row);
        }

    echo json_encode($images_details);
}
elseif ($action == 'delete')
{
    $img_id = $_POST['img_id'];
    $connection = establish_connection();
    $delete_img_query = 'DELETE FROM img_subjects WHERE id=' . $img_id;
    $connection->query($delete_img_query);
    $massage = ['status'=> 'ok','img_deleted'=> $img_id ];
    echo json_encode($massage);
}

