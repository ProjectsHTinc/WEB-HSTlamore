<?php
$mysqli = new mysqli("localhost", "root", "O+E7vVgBr#{}", "happysan_lamore");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>