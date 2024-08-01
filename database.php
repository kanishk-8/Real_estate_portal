<?php
// create a database first in phpmyadmin than use this code, there is no database it will not run
$mysqli = new mysqli('localhost', 'websiteprac', 'kk222004', 'websitepracdb');
if ($mysqli->connect_error) {
    echo 'Connection error: ' . $mysqli->connect_error;
    exit();
}

// Create 'roles' table
$mysqli->query("CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);");

// Create 'users' table
$mysqli->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profileImage VARCHAR(255),
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    role_id INT NOT NULL DEFAULT 2,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);");

// Create 'listings' table
$mysqli->query("CREATE TABLE IF NOT EXISTS house_listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    heading VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL
);");
