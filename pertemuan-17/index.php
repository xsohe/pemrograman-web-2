<?php
    // example 1
    // include"header.php";
    // session_start();

    // example 2
    // echo"<p>Hallo Apa kabar?</p>";
    // header("Location:test.php");

    // example 3
    $a1=10;
    if($a1<0) {
        echo "Nilai A negatif";
    } else {
        header("Location:test.php");
    } 
?>