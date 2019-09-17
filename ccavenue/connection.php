<?php

//$con = @mysql_connect("localhost","root","");
$con = @mysql_connect("localhost","root","O+E7vVgBr#{}");
if ($con) {
		mysql_select_db('happysan_lamore');
    } else {
		die("Connection failed");
}
?>