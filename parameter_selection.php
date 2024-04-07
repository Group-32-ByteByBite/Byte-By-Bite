<!-- this file will contain code for the parameter selection page -->

<?php

?>

<html>
    <body>
        <form name="colorForm" action="tables.php" method="GET" >
            Number of rows and columns: <input type="text" name="numColsRows" />
            Number of colors: <input type="text" name="numColors" />
            <input type="submit" value="Generate Tables" />

            <?php
            if(isset($_POST['submit'])){
                $submit = $_POST['submit'];
                switch ($submit) {
                    case 'Generate Tables':
                        include 'tables.php';
                        break;
                }
            }
            ?>
            
</body>
</html>