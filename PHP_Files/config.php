<?php
$conn = mysqli_connect('localhost','root','','intellitask');
    if(!$conn)
        {
            die("error in connection") ;
        }

        else
        {
            echo ("Database connected successfully.");
            // echo ("");
        }
?>