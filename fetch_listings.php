<?php
include 'database.php'; // Ensure this file contains your DB connection logic

$sql = "SELECT * FROM house_listings";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='houselistings'>";
    echo "<div class='houseinfo'>";
    echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
    if ($row['image']) {
        $image = htmlspecialchars($row['image']);
        echo "<img class ='houseimg' src='$image' alt='Property Image'>";
    }
    echo "<div class='details-map'> ";
    echo "<div class='info'> ";
    echo "<p class='priceinfo'>Rs. " . htmlspecialchars($row['price']) . "</p>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";

    echo "</div>";
    if ($row['location']) {
        $locationSrc = htmlspecialchars($row['location']);
        echo "<iframe class='rounded-map' src='$locationSrc' width='300' height='200' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
    }


    echo "</div>";

    echo "</div>";
    echo "</div>";
}

$mysqli->close();
