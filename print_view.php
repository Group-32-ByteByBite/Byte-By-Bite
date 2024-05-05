
<link rel="stylesheet" type="text/css" href="./printStyle.css">

<div class="header">
            <img src="Donut-ByteByBite.png" alt="Byte By Bite logo" width="200px">
            <h1>Byte-By-Bite</h1>
        </div>

<?php

//getting the data from the tables page
$numColsRows = isset($_POST['numColsRows']) ? $_POST['numColsRows'] : '';
$numColors = isset($_POST['numColors']) ? $_POST['numColors'] : '';
$selectedColors = isset($_POST['selectedColors']) ? json_decode($_POST['selectedColors']) : [];

echo PrintTable1($numColsRows, $numColors, $selectedColors);
echo PrintTable2($numColsRows);

// Function to generate table1
function PrintTable1($numColsRows, $numColors, $selectedColors) {
    
    //adding hex codes 
    $colors = array(
        "Choose Color" => "#FFFFFF", // Default color?
        "red" => "#FF0000",
        "orange" => "#FFA500",
        "yellow" => "#FFFF00",
        "green" => "#008000",
        "blue" => "#0000FF",
        "purple" => "#800080",
        "grey" => "#808080",
        "brown" => "#A52A2A",
        "black" => "#000000",
        "teal" => "#008080"
    );
    $table = '<table id="table1" border="1" style="width: 80%;">';

    // Start loop to generate rows for each color
    foreach ($selectedColors as $index => $colorIndex) {
        $colorName = isset($colors[$colorIndex]) ? ucfirst($colorIndex) : "Choose Color";
        $hexCode = isset($colors[$colorIndex]) ? $colors[$colorIndex] : "#FFFFFF";

        $table .= '<tr>';
        $table .= '<td>' . ucfirst($colorIndex). " ". $hexCode .'</td>';
        $table .= '<td style="width: 80%;"></td>';
        $table .= '</tr>';
    }

    $table .= '</table>';
    return $table;
}


//Function to generate table2
function PrintTable2($numColsRows) {
    $table = '<table id="table2" border="1">';
    $table .= '<tr><td></td>'; 
    for ($j = 1; $j <= $numColsRows; $j++) {
        $table .= '<td>' . chr(64 + $j) . '</td>';
    }
    $table .= '</tr>';

    for ($i = 1; $i <= $numColsRows; $i++) {
        $table .= '<tr>';
        // Add row headers (numbers 1, 2, 3...)
        $table .= '<td>' . $i . '</td>';
        for ($j = 1; $j <= $numColsRows; $j++) {
            $table .= '<td></td>';
        }
        $table .= '</tr>';
    }
    
    $table .= '</table>';
    return $table;
}

?>
<!-- print button 
<script>
    window.print();
    </script>-->
