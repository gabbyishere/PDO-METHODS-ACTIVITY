
<?php
// Connect to the Swiss grocery database.
require_once 'dbconfig.php';

// Initialize the message displayed to the user.
$message = "";

// Check whether the update form was submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the ID and new values entered in the form.
    $itemId = (int) $_POST['item_id'];
    $newPrice = (float) $_POST['price'];
    $newStock = (int) $_POST['stock_quantity'];

    // Prepare an SQL statement to update the selected record.
    $sql = "UPDATE grocery_items
            SET price = :price,
                stock_quantity = :stock
            WHERE item_id = :id";

    $stmt = $pdo->prepare($sql);

    // Execute the update using the supplied values.
    $stmt->execute([
        'price' => $newPrice,
        'stock' => $newStock,
        'id' => $itemId
    ]);

    // Check whether the item exists and report the result.
    if ($stmt->rowCount() > 0) {
        $message = "Grocery item updated successfully!";
    } else {
        $check = $pdo->prepare(
            "SELECT item_id FROM grocery_items WHERE item_id = :id"
        );
        $check->execute(['id' => $itemId]);

        if ($check->fetch()) {
            $message = "Item found, but the values may be unchanged.";
        } else {
            $message = "No grocery item found with that ID.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Grocery Item</title>
</head>
<body>
    <h2>Update a Grocery Item</h2>

    <!-- Display the update result. -->
    <p><?= htmlspecialchars($message) ?></p>

    <!-- Form for entering the item's ID and new values. -->
    <form method="POST">
        <label>Item ID:</label>
        <input type="number" name="item_id" min="1" required>
        <br><br>

        <label>New Price:</label>
        <input type="number" name="price" step="0.01" min="0" required>
        <br><br>

        <label>New Stock Quantity:</label>
        <input type="number" name="stock_quantity" min="0" required>
        <br><br>

        <button type="submit">Update Item</button>
    </form>
</body>
</html>
