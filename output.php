<?php
 //Capture and input values from form page
 $shoebrand = $_GET['shoebrand'];
 $shoetype = $_GET['shoetype'];
 $shoename = $_GET['shoename'];
?>

<html>
    <head>
        <title>Output Values</title>
    <head>
    <body>
        <h2>Shoe Brands</h2>
        <p>Shoe Brand: <?php echo $shoebrand; ?></p>
        <p>Shoe Type: <?php echo $shoetype; ?></p>
        <p>Shoe Name: <?php echo $shoename; ?></p>
    </body>