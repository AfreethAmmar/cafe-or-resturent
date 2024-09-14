<?php
include 'connect.php'; // Include your database connection file

// SQL to create table
$sql = "CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL
);

)";
$sql="CREATE TABLE reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    guests INT NOT NULL
);"

if ($conn->query($sql) === TRUE) {
    echo "Table menu_items created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
