<?php
require_once 'session.php';
include 'database.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'redirect' => ''];

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT users.*, roles.role_name FROM users JOIN roles ON users.role_id = roles.id WHERE users.email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $userdetails = $stmt->get_result()->fetch_assoc();

    if (!$userdetails) {
        $response['message'] = 'Invalid email!';
    } else {
        $passwords = $userdetails['password'];
        if (!password_verify($password, $passwords)) {
            $response['message'] = 'Invalid password!';
        } else {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $userdetails['email'];
            $_SESSION['profileImage'] = $userdetails['profileImage'];
            $_SESSION['username'] = $userdetails['username'];
            $_SESSION['role'] = $userdetails['role_name'];
            $_SESSION['id'] = $userdetails['id'];
            $_SESSION['loginstring'] = hash('sha512', $email . rand());

            if ($_SESSION['role'] == 'admin') {
                $response['redirect'] = 'mainpage.php';
            } else {
                $response['redirect'] = 'mainpage.php';
            }
            $response['success'] = true;
            $response['message'] = 'Login successful!';
        }
    }
} else {
    // Handle missing fields
    if (empty($_POST['email'])) {
        $response['message'] = "Can't login without email!";
    } elseif (empty($_POST['password'])) {
        $response['message'] = "Can't login without password!";
    }
}

echo json_encode($response);
