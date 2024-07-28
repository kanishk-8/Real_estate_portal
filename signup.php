<?php
require_once 'session.php';
include 'database.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Check if all necessary fields are present
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $targetFile = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
        $validFormats = ['jpg', 'jpeg', 'png', 'gif'];
        $profileImage = $_FILES['profileImage']['name'];
        $extension = strtolower(pathinfo($profileImage, PATHINFO_EXTENSION));

        if (in_array($extension, $validFormats)) {
            $hashedEmail = hash('sha256', $email);
            $targetDir = "uploads/";
            $targetFile = $targetDir . $hashedEmail . '.' . $extension;

            if (!move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFile)) {
                $targetFile = null;
                $response['message'] = 'Image upload failed!';
                echo json_encode($response);
                exit();
            }
        } else {
            $response['message'] = 'Invalid image format! Only jpg, jpeg, png, and gif are allowed.';
            echo json_encode($response);
            exit();
        }
    }

    // Check if email already exists
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $existingUser = $stmt->get_result()->fetch_assoc();

    if ($existingUser) {
        $response['message'] = 'Email already exists!';
    } else {
        // Insert new user into the database
        $stmt = $mysqli->prepare("INSERT INTO users (profileImage, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $targetFile, $username, $email, $password);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Welcome, ' . htmlspecialchars($email) . '!';
        } else {
            $response['message'] = 'Signup failed!';
        }
    }
} else {
    // Handle empty fields
    if (empty($_POST['email'])) {
        $response['message'] = "Can't signup without email!";
    } elseif (empty($_POST['username'])) {
        $response['message'] = "Can't signup without name!";
    } elseif (empty($_POST['password'])) {
        $response['message'] = "Can't signup without password!";
    }
}

echo json_encode($response);
