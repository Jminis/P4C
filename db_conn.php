<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

function db_connect(){
        $conn = mysqli_connect("localhost","root","","my_web") or die ("Can't access DB");
        return $conn;
}

?>
