<?php
$path = tempnam("/home/httpd/vhosts/visoff.ru/httpdocs/xakaton/media/", '').".mp4";
if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
    require("../api/sql_connect.php");
    $data = json_decode($_POST['data']);
    mysqli_query($con, 'INSERT INTO `xanlyMessages`(`type`, `author`, `content`, `toUser`) VALUES ("circle", "'.$data -> author.'", "'.str_replace("/home/httpd/vhosts/visoff.ru/httpdocs/", "", $path).'", "'.$data -> toUser.'")');
}
?>