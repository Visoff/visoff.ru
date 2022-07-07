<?php
require("sql_connect.php");
$data = json_decode($_POST['data']);

print_r(json_encode(mysqli_fetch_assoc(mysqli_query($con, 'SELECT `login`, `nickname` FROM `xanlyLogPass` WHERE `f.token` = "'.$data.'"'))));
?>