<!-- this file will contain code for the parameter selection page -->
<link rel="stylesheet" type="text/css" href="./style.css">
<?php

?>

<html>
    <body>
        <div class="selection"></div>
            <h2> Color Coordinates Generator</h2>
            <form name="colorForm" action='tables.php' method="GET" >
                <div class= "rowColumn"> Number of rows and columns: <input type="text" name="numColsRows" /><div>
                <div class= "rowColumn">Number of colors: <input type="text" name="colors" /></div>
                <div class="submitButton"><input type="submit" value="Generate Tables" /></div>    
        </div>
</body>
</html>