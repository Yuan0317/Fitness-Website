<!--
* Group 15: Yuan Tang,Lishu Yuan
* Date: 2023-03-27
* Section: CST 8285 section 302
* Description: the database page,manage all the database connection
-->

<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fitness";
$con1 = "";

try {
    $con1 = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch (mysqli_sql_exception) {
    echo "not connect";
}

if ($con1) {
    echo "you are connected";
}
