<?php
require_once 'session.php';
include 'database.php';

// Function to extract the src from the iframe or plain URL
function extractSrcFromIframe($input)
{
    // Remove backslashes from the input
    $input = stripslashes($input);

    // Debug: Output the cleaned input
    echo "Cleaned input: " . htmlentities($input) . "<br>";

    // Check if the input contains an iframe
    if (strpos($input, '<iframe') !== false) {
        // Debug: Detected an iframe in the input
        echo "Detected an iframe in the cleaned input.<br>";

        // Extract the src attribute from the iframe tag using a robust regular expression
        if (preg_match('/<iframe[^>]+src="([^"]+)"/', $input, $matches)) {
            // Debug: Output the extracted src value
            echo "Extracted src: " . htmlentities($matches[1]) . "<br>";
            return $matches[1]; // Return the src attribute value
        }
    } elseif (filter_var($input, FILTER_VALIDATE_URL)) {
        // If it's a valid URL, return it as-is
        echo "Detected a valid URL.<br>";
        return $input;
    }

    // If no iframe or valid URL, return empty string
    echo "No valid iframe or URL found.<br>";
    return '';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_id = $_SESSION['id']; // Assuming the user ID is stored in session
    $title = $mysqli->real_escape_string($_POST['title']);
    $locationInput = $mysqli->real_escape_string($_POST['location']);
    $price = $mysqli->real_escape_string($_POST['price']);
    $description = $mysqli->real_escape_string($_POST['description']);

    // Extract the Google Maps src from the input (iframe or URL)
    $locationSrc = extractSrcFromIframe($locationInput);

    // Debugging: Check if src was correctly extracted
    if (empty($locationSrc)) {
        echo "Error: Could not extract a valid Google Maps URL from the provided input.";
        exit;
    }

    // Handle image upload
    $imagePaths = [];
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = 'houseimg/'; // Ensure this directory is writable
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $filePath)) {
                $imagePaths[] = $filePath;
            }
        }
    }

    // Insert property details into the database
    if (!empty($imagePaths)) {
        $imagePath = implode(',', $imagePaths); // Store as a comma-separated string
        $query = "INSERT INTO house_listings (user_id, title, location, price, description, image) VALUES ('$user_id', '$title', '$locationSrc', '$price', '$description', '$imagePath')";

        if ($mysqli->query($query)) {
            echo "Property added successfully!";
            echo '<script>alert("Property added successfully!");</script>';
        } else {
            echo "Error: " . $mysqli->error;
        }
    } else {
        echo "Error: Please upload at least one image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <style>
        .houselistings {
            padding-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .houseinfo {
            display: flex;
            justify-content: start;
            padding: 20px;
            width: 80%;
            border-radius: 30px;
            align-items: center;
            background-color: black;
            height: auto;
            flex-direction: column;
            color: white;
        }

        h1 {
            color: white;
            text-align: center;
        }

        .form-section {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: wheat;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: white;
            color: #000;
            border: none;
            padding: 10px 15px;
            border-radius: 15px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: wheat;

        }

        .form-container {
            width: 80%;
        }
    </style>
</head>

<body>

    <div class="houselistings">
        <div class="houseinfo">
            <h1>Add New Property</h1>

            <form class="form-container" method="post" enctype="multipart/form-data">
                <div class="form-section">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-section">
                    <label for="location">Google Maps Link (Full URL):</label>
                    <input type="text" id="location" name="location" placeholder="Paste Google Maps embedded link here" required>
                </div>

                <div class="form-section">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" required>
                </div>

                <div class="form-section">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="form-section">
                    <label for="images">Images (multiple allowed):</label>
                    <input type="file" id="images" name="images[]" multiple required>
                </div>

                <input type="submit" value="Add Property">
            </form>
        </div>
    </div>

</body>

</html>