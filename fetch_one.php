<?php
// Include the PDO database connection.
require_once 'dbconfig.php';

// Select one grocery item using its ID.
$sql = "SELECT * FROM grocery_items WHERE item_id = :id";
$stmt = $pdo->prepare($sql);

// Choose the ID of the item to retrieve.
$itemId = 1;
$stmt->execute(['id' => $itemId]);

// Fetch only one record from the database.
$item = $stmt->fetch(PDO::FETCH_ASSOC);

// Display the result using print_r() and <pre>.
echo "<pre>";
print_r($item);
echo "</pre>";
?>