<?php
require("sql_connect.php");
$data = json_decode($_POST['data']);
$res = mysqli_query($con, 'INSERT INTO `xanlyMessages`(`author`, `content`, `toUser`) VALUES ("'.$data -> author.'", "'.$data -> content.'", "'.$data -> toUser.'")');
?>