<?php
require "handler/dbBroker.php";
require "model/user.php";

$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);



$sqlDropDatabase = "DROP DATABASE IF EXISTS kurser";
if ($conn->query($sqlDropDatabase) === TRUE) {
    echo "Database 'kurser' dropped (if it existed).\n";
} else {
    echo "Error dropping database: " . $conn->error . "\n";
}


$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS kurser";
if ($conn->query($sqlCreateDatabase) === TRUE) {
    echo "Database 'kurser' created successfully.\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}
$conn = Database::connectDatabase();
// Select the "kurser" database
$conn->select_db("kurser");

//CREATE USERS

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    birthday DATE,
    phone VARCHAR(20),
    is_admin BOOLEAN DEFAULT FALSE
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'users' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

function createUser($username, $password, $name, $surname, $email, $birthday, $phone, $isAdmin = false)
{
    $conn = Database::connectDatabase();
    // Prepare the SQL statement
    $sql = "INSERT INTO users (username, password, name, surname, email, birthday, phone, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $username, $password, $name, $surname, $email, $birthday, $phone, $isAdmin);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User created successfully.\n";
    } else {
        echo "Error creating user: " . $stmt->error . "\n";
    }
}

// Default Admins
createUser("jana", "andjela1234", "jana", "prezime", "jana@example.com", "1990-01-01", "1234567890", true);
createUser("admin", "admin1234", "John", "Doe", "admin@example.com", "1995-05-05", "9876543210", true);

include 'CourseSeeder.php';













$conn->close();
?>
