<!-- This file contains the code for the Color Coordinate Tables Page -->

<!-- the following html just keeps the header and nav bar consistent -->
<title>Byte By Bite</title>
<div class="header">
        <img src="BBBLogo.png" alt="Byte By Bite logo" width="200px">
</div>
    <div class="navbar">
        <?php 
        include 'navbar.php'; 
        ?>
</div>

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

    $selectedColors = array();

    $table = '<table border="1" style="width: 80%;">';

    for ($i = 1; $i <= $numColors; $i++) {
        $table .= '<tr>';
       
        $table .= '<td style="width: 20%;">';
        $table .= '<select id="color_select_' . $i . '" name="color_select_' . $i . '" onchange="updateDropdown(' . $i . ', this.value)">';
        foreach ($colors as $color) {
            if (!in_array($color, $selectedColors)) {
                $table .= '<option value="' . $color . '">' . ucfirst($color) . '</option>';
            }
        }
        $table .= '</select>';
        $table .= '</td>';
        $table .= '<td style="width: 80%;"></td>';
        $table .= '</tr>';
        $selectedColors[] = $color;
    }

    $table .= '</table>';

    return $table;
}


function generateTable2($numColsRows) {
    $table = '<table border="1">';
    
    for ($i = 0; $i <= $numColsRows; $i++) {
        $table .= '<tr>';
        for ($j = 0; $j <= $numColsRows; $j++) {
            // Add column and row headers
            if ($i == 0 && $j == 0) {
                $table .= '<td></td>';
            } elseif ($i == 0) {
                $table .= '<td>' . chr(64 + $j) . '</td>'; // Display column headers as alphabets (A, B, C...)
            } elseif ($j == 0) {
                $table .= '<td>' . $i . '</td>'; // Display row headers
            } else {
                $table .= '<td></td>'; // Empty cells
            }
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

<!-- print button -->
<form name="printForm" action="print_view.php" method="GET" >
    <input type="submit" value="Print">
</form>

<script>
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