<?php

$connect = mysqli_connect(
    'localhost',
    'root',
    '',
    'techinventory'
);

// Query to fetch data
$query = 'SELECT gadgets.name, gadgets.category, gadgets.release_date, gadgets.price, gadgets.image_url, brands.name AS brand_name, brands.brand_logo 
        FROM gadgets
        INNER JOIN brands ON gadgets.brand_id = brands.brand_id';

$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Gadgets Inventory</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Tech Gadgets Inventory</h1>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "<div class='card'>";
                
                echo "<h2>" . $row["name"] . "</h2>";
                
                echo "<img src='images/" . $row["image_url"] . "' alt='Gadget Image' class='gadget-image'>";
               
                echo "<p>Category: " . $row["category"] . "</p>";
                echo "<p class='brand-container'>Brand:
                        <img src='images/" . ($row["brand_logo"]) . "' alt='Brand Logo' class='brand-logo'>
                      </p>";
                echo "<p>Release Date: " . $row["release_date"] . "</p>";

                if ($row["price"] > 1000) {
                    echo "<p class='expensive'>Price: $" . $row["price"] . " (Expensive)</p>";
                } else {
                    echo "<p class='price'>Price: $" . $row["price"] . "</p>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No data found.</p>";
        }
        ?>
    </div>
</body>
</html>
