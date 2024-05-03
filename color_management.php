<?php
include 'connection.php';

// Variables for feedback messages
$add_message = "Color was added!";
$edit_message = "Color Edited!";
$delete_message = "Color Deleted!";

// Handling form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'action' parameter is set
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Switching based on the action
        switch ($action) {
            case 'add':
                // Adding new color
                if (isset($_POST['add_name']) && isset($_POST['add_hex_value'])) {
                    $name = $_POST['add_name'];
                    $hex_value = $_POST['add_hex_value'];

                    // Sending POST request to color_selection.php
                    $data = array(
                        'action' => 'add',
                        'add_name' => $name,
                        'add_hex_value' => $hex_value
                    );

                    $options = array(
                        'http' => array(
                            'method'  => 'POST',
                            'header'  => 'Content-Type: application/x-www-form-urlencoded',
                            'content' => http_build_query($data)
                        )
                    );

                    $context  = stream_context_create($options);
                    $result = file_get_contents('color_selection.php', false, $context);

                    // Update $add_message based on the response
                    $add_message = $result ? "Color added successfully" : "Error adding color";
                } else {
                    $add_message = "Missing required parameters";
                }
                break;
            //TODO
            case 'edit':
                // Editing an existing color
                // Similar logic as 'add' case for editing goes here
                break;
            //TODO
            case 'delete':
                // Deleting an existing color
                // Similar logic as 'add' case for deleting goes here
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Management</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <h1>Color Management</h1>

    <!-- Adding a new color -->
    <form action="color_selection.php" method="POST">
        <h2>Add Color</h2>
        <label for="add_name">Name:</label>
        <input type="text" id="add_name" name="add_name" required>
        <label for="add_hex_value">Hex Value:</label>
        <input type="text" id="add_hex_value" name="add_hex_value" required>
        <button type="submit" name="action" value="add">Add Color</button>
    </form>
    <!-- Display add message -->
    <?php echo "<p>$add_message</p>"; ?>

    <!-- Editing an existing color -->
    <form action="color_selection.php" method="POST">
        <h2>Edit Color</h2>
        <label for="edit_color_id">Select Color:</label>
        <select id="edit_color_id" name="edit_color_id" required>
            <!-- This dropdown will be populated dynamically with existing colors from the database -->
        </select>
        <label for="edit_name">New Name:</label>
        <input type="text" id="edit_name" name="edit_name" required>
        <label for="edit_hex_value">New Hex Value:</label>
        <input type="text" id="edit_hex_value" name="edit_hex_value" required>
        <button type="submit" name="action" value="edit">Edit Color</button>
    </form>
    <!-- Display edit message -->
    <?php echo "<p>$edit_message</p>"; ?>

    <!-- Deleting a color -->
    <form action="color_selection.php" method="POST">
        <h2>Delete Color</h2>
        <label for="delete_color_id">Select Color:</label>
        <select id="delete_color_id" name="delete_color_id" required>
            <!-- This dropdown will be populated dynamically with existing colors from the database -->
        </select>
        <button type="submit" name="action" value="delete">Delete Color</button>
    </form>
    <!-- Display delete message -->
    <?php echo "<p>$delete_message</p>"; ?>

    <!-- Any necessary JavaScript files should be included here -->
</body>
</html>
