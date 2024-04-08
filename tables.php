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
function validateInput($numRows, $numColumns, $numColors) {
    $errors = [];
    // Validate number of rows
    if (!is_numeric($numRows) || $numRows < 1 || $numRows > 26) {
        $errors[] = "Number of rows must be a value between 1 and 26";
    }
    // Validate number of columns
    if (!is_numeric($numColumns) || $numColumns < 1 || $numColumns > 26) {
        $errors[] = "Number of columns must be a value between 1 and 26";
    }
    // Validate number of colors
    if (!is_numeric($numColors) || $numColors < 1 || $numColors > 10) {
        $errors[] = "Number of colors must be a value between 1 and 10";
    }
    return $errors;
}

// Function to generate the table
function generateTable2($numRows, $numColumns) {
    $table = '<table border="1">';
    
    for ($i = 0; $i <= $numRows; $i++) {
        $table .= '<tr>';
        for ($j = 0; $j <= $numColumns; $j++) {
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
    $numRows = isset($_GET['rows']) ? $_GET['rows'] : '';
    $numColumns = isset($_GET['columns']) ? $_GET['columns'] : '';
    $numColors = isset($_GET['colors']) ? $_GET['colors'] : '';

    $errors = validateInput($numRows, $numColumns, $numColors);

    if (empty($errors)) {
        // Generate table if no errors
        echo generateTable2($numRows, $numColumns);
    } else {
        // Display errors if validation fails
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    }
}
?>

<!-- print button -->
<form name="printForm" action="print_view.php" method="post" >
            <input type="submit" name="submit" value="Print">
        </form>
