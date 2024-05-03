<?php
include 'connection.php';

// GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the colors from the database
    $sql = "SELECT * FROM colors";
    $result = $conn->query($sql);

    // Check if there are colors retrieved
    if ($result->num_rows > 0) {
        $colors = [];
        // Store each color in an array
        while ($row = $result->fetch_assoc()) {
            $colors[] = $row;
        }
        // Return colors as JSON
        echo json_encode($colors);
    } else {
        // If no colors, return empty
        echo json_encode([]);
    }
}

// POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'action' parameter is set
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'add':
                // Adding a color
                if (isset($_POST['add_name']) && isset($_POST['add_hex_value'])) {
                    $name = $_POST['add_name'];
                    $hex_value = $_POST['add_hex_value'];

                    //TODO
                    // Validating input (You can add validation logic here)

                    // Inserting the color into the database
                    $sql = "INSERT INTO colors (name, hex_value) VALUES ('$name', '$hex_value')";
                    // Checking if successful
                    if ($conn->query($sql) === TRUE) {
                        echo "Color added successfully";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "Missing required parameters";
                }
                break;
            //TODO
            case 'edit':
                // Editing an existing color
                // Logic for updating color name and hex value goes here
                break;
            //TODO
            case 'delete':
                // Deleting an existing color
                // Logic for deleting a color goes here
                break;

            default:
                echo "Invalid action";
        }
    } else {
        echo "No action specified";
    }
}
?>
