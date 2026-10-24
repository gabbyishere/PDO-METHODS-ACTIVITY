<?php
require 'dbconfig.php';

// fetchAll() retrieves every row returned by the query.
$stmt = $pdo->query("SELECT * FROM grocery_items ORDER BY item_id LIMIT 10");
$items = $stmt->fetchAll();

echo "<h2>First 10 Grocery Items (fetchAll)</h2>";
echo "<pre>";
print_r($items); // Display the result array for the activity screenshot.
echo "</pre>";
?>
