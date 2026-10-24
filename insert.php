
<?php
// Include the PDO database connection.
require_once 'dbconfig.php';

// Create a message to display after submitting the form.
$message = "";

// Check if the form has been submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the values entered in the form.
    $productName = trim($_POST['product_name']);
    $brandName = trim($_POST['brand_name']);
    $category = trim($_POST['category']);
    $packageSize = trim($_POST['package_size']);
    $price = (float) $_POST['price'];
    $stockQuantity = (int) $_POST['stock_quantity'];

    // Prepare the SQL query to insert a new grocery item.
    $sql = "INSERT INTO grocery_items
        (product_name, brand_name, category, package_size,
         price, stock_quantity, country_of_origin)
        VALUES
        (:product, :brand, :category, :size, :price, :stock, :country)";

    $stmt = $pdo->prepare($sql);

    // Insert the values into the database.
    $stmt->execute([
        'product' => $productName,
        'brand' => $brandName,
        'category' => $category,
        'size' => $packageSize,
        'price' => $price,
        'stock' => $stockQuantity,
        'country' => 'Switzerland'
    ]);

    // Display a success message.
    $message = "Grocery item inserted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Grocery Item</title>
</head>
<body>
    <h2>Insert a Swiss Grocery Item</h2>

    <p><?= htmlspecialchars($message) ?></p>

    <!-- Form for entering a new grocery item. -->
    <form method="POST">
        <label>Product Name:</label>
        <input type="text" name="product_name" required>
        <br><br>

        <label>Brand Name:</label>
        <input type="text" name="brand_name" required>
        <br><br>

        <label>Category:</label>
        <input type="text" name="category" required>
        <br><br>

        <label>Package Size:</label>
        <input type="text" name="package_size" required>
        <br><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" min="0" required>
        <br><br>

        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" min="0" required>
        <br><br>

        <button type="submit">Insert Item</button>
    </form>
</body>
</html>
