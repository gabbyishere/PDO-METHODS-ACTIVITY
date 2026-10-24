
<?php
// Connect to the Swiss grocery database.
require_once 'dbconfig.php';

// Retrieve all grocery items, ordered by their IDs.
$sql = "SELECT * FROM grocery_items ORDER BY item_id ASC";
$stmt = $pdo->query($sql);

// Store all query results in an associative array.
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swiss Grocery Items</title>

    <style>
        /* Format the table and its cells. */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        /* Give the column headings a background color. */
        th {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <h2>Swiss Grocery Items</h2>

    <!-- Display the database query results in an HTML table. -->
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Product Name</th>
                <th>Brand Name</th>
                <th>Category</th>
                <th>Package Size</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Country of Origin</th>
            </tr>
        </thead>

        <tbody>
            <!-- Loop through each record and create a table row. -->
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $item['item_id']) ?></td>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= htmlspecialchars($item['brand_name']) ?></td>
                    <td><?= htmlspecialchars($item['category']) ?></td>
                    <td><?= htmlspecialchars($item['package_size']) ?></td>
                    <td><?= number_format((float) $item['price'], 2) ?></td>
                    <td><?= htmlspecialchars((string) $item['stock_quantity']) ?></td>
                    <td><?= htmlspecialchars($item['country_of_origin']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Display the total number of retrieved records. -->
    <p>Total records: <?= count($items) ?></p>
</body>
</html>
