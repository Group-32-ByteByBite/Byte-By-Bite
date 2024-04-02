<!--
Hello everyone!

Just so everyone is on the same page, the file structure should be as follows:
local_html
    group32
        Byte-By-Bite
            index.php
            other files yadda yadda 

the url for this project is: https://cs.colostate.edu:4444/~EID/group32/Byte-By-Bite/index.php

THIS FILE WILL CONTAIN CODE FOR THE INDEX/WELCOME PAGE
-->
<!DOCTYPE html>
<html>
    <title>Byte By Bite</title>
    <head>
    <meta name="Authors" content="Riley Bowling, Rose Berger, Paige Johnson-Hensley, Elizabeth Kilby"> 
    <meta name="Description" content="CS312 group project homepage">
    <meta name="Keywords" content="HTML, CSS, Homepage">
</head>
    <div class="header">
        <img src="/BBBLogo.png" alt="Byte By Bite logo">
</div>
    <div class="navbar">
        <?php 
        include 'navbar.php'; 
        ?>
 </div>
    <div class="body">
</div>
</html>