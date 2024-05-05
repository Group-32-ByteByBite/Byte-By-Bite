<!-- This file contains the code for the Color Coordinate Tables Page -->

<!-- the following html just keeps the header and nav bar consistent -->
<link rel="stylesheet" type="text/css" href="./style.css">

<div class="header">
            <img src="Donut-ByteByBite.png" alt="Byte By Bite logo" width="200px">
            <h1>Byte-By-Bite</h1>
        </div>
        <div class="frosting"></div>
        <div class="navbar">
            <?php 
            include 'navbar.php'; 
            ?>
        </div>

<div class="tables">
<?php
// Function to validate input parameters
function validateInput($numColsRows, $numColors) {
    $errors = [];
    // Validate number of rows and columns
    if (!is_numeric($numColsRows) || $numColsRows < 1 || $numColsRows > 26) {
        $errors[] = "Number of rows must be a value between 1 and 26";
    }
    // Validate number of colors
    if (!is_numeric($numColors) || $numColors < 1 || $numColors > 10) {
        $errors[] = "Number of colors must be a value between 1 and 10";
    }
    return $errors;
}

// Function to generate the table
function generateTable1($numColsRows, $numColors) {
    $colors = array("Choose Color", "red", "orange", "yellow", "green", "blue", "purple", "grey", "brown", "black", "teal");
    $table = '<table id="table1" border="1" style="width: 80%;">';

    // Start loop to generate rows for each color
    for ($i = 1; $i <= $numColors; $i++) {
        $table .= '<tr>';
        // Add radio button for current color selection
        $table .= '<td><input type="radio" name="current_color" value="" onchange="updateRadio(this)"';
        // Set the first color as default checked
        if ($i === 1) {
            $table .= ' checked';
        }
        $table .= '></td>';

        // Add dropdown for color selection
        $table .= '<td style="width: 20%;">';
        $table .= '<select id="color_select_' . $i . '" name="color_select_' . $i . '" onchange="updateRadio(this)">';
        foreach ($colors as $color) {
            $table .= '<option value="' . $color . '">' . ucfirst($color) . '</option>';
        }
        $table .= '</select>';
        $table .= '</td>';
        $table .= '<td style="width: 80%;"></td>';
        $table .= '</tr>';
    }

    $table .= '</table>';
    return $table;
}



function generateTable2($numColsRows) {
    $table = '<table id="table2" border="1">';
    $table .= '<tr><td></td>'; 
    for ($j = 1; $j <= $numColsRows; $j++) {
        $table .= '<td>' . chr(64 + $j) . '</td>';
    }
    $table .= '</tr>';
    
    // Add rows and cells with unique identifiers
    for ($i = 1; $i <= $numColsRows; $i++) {
        $table .= '<tr>';
        // Add row headers (numbers 1, 2, 3...)
        $table .= '<td>' . $i . '</td>';
        for ($j = 1; $j <= $numColsRows; $j++) {
            // Cell ID format: cell_A1, cell_B1, cell_C1, ...
            $cellId = 'cell_' . chr(64 + $j) . $i;
            // Add onclick event to call colorCell function
            $table .= '<td id="' . $cellId . '" onclick="colorCell(\'' . $cellId . '\')"></td>';
        }
        $table .= '</tr>';
    }
    
    $table .= '</table>';
    return $table;
}



// Main function to handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $numColsRows = isset($_GET['numColsRows']) ? $_GET['numColsRows'] : '';
    $numColors = isset($_GET['colors']) ? $_GET['colors'] : '';

    $errors = validateInput($numColsRows, $numColors);

    if (empty($errors)) {
        // Generate tables if no errors
        echo generateTable1($numColsRows, $numColors);
        echo generateTable2($numColsRows);
    } else {
        // Display errors if validation fails
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    }
}
?>
</div>

<!-- print button -->
<div class="print">
    <form name="printForm" action="print_view.php" method="POST"  onsubmit="updateSelectedColors()">
        <input type="hidden" name="numColsRows" value="<?php echo $numColsRows; ?>">
        <input type="hidden" name="numColors" value="<?php echo $numColors; ?>">
        <input type="hidden" id="selectedColors" name="selectedColors">
        <input type="submit" value="Print"> 
    </form>
<div>
<script>
    //storing the selected colors for print view
    function updateSelectedColors(){
        var selectedColors = [];
        var dropdowns = document.querySelectorAll('select[name^="color_select_"]');
        dropdowns.forEach(function(dropdown){
            selectedColors.push(dropdown.value);
        });
        document.getElementById('selectedColors').value = JSON.stringify(selectedColors);
    }
    
</script>

<script>
function colorCell(cellId) {
    console.log("Cell clicked:", cellId);
    // Get the selected color from the radio button
    const selectedColor = document.querySelector('input[name="current_color"]:checked').value;
    console.log("Selected color:", selectedColor); 
    // Set the background color of the clicked cell
    document.getElementById(cellId).style.backgroundColor = selectedColor;
}

function updateRadio(select) {
    // Get the selected color from the dropdown
    const selectedColor = select.value;
    // Get the corresponding radio button
    const radio = select.parentElement.previousElementSibling.querySelector('input[type="radio"]');
    // Set the value of the radio button to match the selected color
    radio.value = selectedColor;
}


document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('[id^="color_select_"]');
    let selectedColors = Array.from(selects).map(select => select.value);

    selects.forEach((select, index) => {
        select.addEventListener('change', function(event) {
            const selectedValue = event.target.value;
            if (selectedColors.includes(selectedValue)) {
                const previousIndex = selectedColors.indexOf(selectedValue);
                event.target.value = selectedColors[index];
                console.log("Color already selected. Reverting to the previous value.");
            } else {
                selectedColors[index] = selectedValue;
            }
        });
    });
});
</script>
