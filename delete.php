
<?php
// Connect to the Swiss grocery database.
require_once 'dbconfig.php';

// Initialize the message displayed to the user.
$message = "";

// Check if the deletion form was submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the ID of the grocery item to delete.
    $itemId = (int) $_POST['item_id'];

    // Prepare an SQL statement to delete the selected record.
    $sql = "DELETE FROM grocery_items WHERE item_id = :id";
    $stmt = $pdo->prepare($sql);

    // Execute the deletion using the provided item ID.
    $stmt->execute(['id' => $itemId]);

    // Check whether a record was deleted.
    if ($stmt->rowCount() > 0) {
        $message = "Grocery item deleted successfully!";
    } else {
        $message = "No item was deleted. Check the item ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Grocery Item</title>
</head>
<body>
    <h2>Delete a Grocery Item</h2>

    <!-- Display the result of the deletion. -->
    <p><?= htmlspecialchars($message) ?></p>

    <!-- Form for entering the ID of the item to delete. -->
    <form method="POST">
        <label>Item ID:</label>
        <input type="number" name="item_id" min="1" required>
        <button type="submit">Delete Item</button>
    </form>
</body>
</html>
