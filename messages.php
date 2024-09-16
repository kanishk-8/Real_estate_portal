<?php
// require_once 'session.php';
// include 'database.php';

// // Get property ID from the URL
// $property_id = intval($_GET['property_id']);
// $user_id = $_SESSION['id']; // The ID of the logged-in user

// // Check if the form was submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $message = $mysqli->real_escape_string($_POST['message']);

//     // Get recipient ID (seller) from the property listing
//     $result = $mysqli->query("SELECT user_id FROM house_listings WHERE id = $property_id");
//     if ($result && $row = $result->fetch_assoc()) {
//         $recipient_id = $row['user_id'];

//         // Insert the message into the database
//         $query = "INSERT INTO messages (sender_id, recipient_id, property_id, message) VALUES ('$user_id', '$recipient_id', '$property_id', '$message')";

//         if ($mysqli->query($query)) {
//             echo "Message sent successfully!";
//         } else {
//             echo "Error: " . $mysqli->error;
//         }
//     } else {
//         echo "Property not found.";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Seller</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            padding-top: 20px;
            /* display: flex; */
            /* width: 100%; */
            /* justify-content: center;
            align-items: center; */
        }

        .blogpage {
            display: flex;
            justify-content: start;
            padding: 10px;
            width: 100%;
            border-radius: 30px;
            align-items: center;
            background-color: black;
            height: auto;
            flex-direction: column;
            color: white;
        }
    </style>
    <style>
        .contact-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: white;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .contact-button:hover {
            background-color: #0056b3;
        }

        .form-section {
            margin-bottom: 15px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: white;
            color: #000;
            border: none;
            width: 100%;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="blogpage">
            <h1>Contact Seller</h1>
            <form action="contact_seller.php?property_id=<?php echo $property_id; ?>" method="post">
                <div class="form-section">
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <input type="submit" value="Send Message">
            </form>
        </div>
    </div>
</body>

</html>