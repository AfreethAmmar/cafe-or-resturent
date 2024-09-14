<?php
include 'connect.php';

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    

    
    $stmt = $conn->prepare("INSERT INTO adminreservation (name, email, phone, date, time, guests) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssi", $name, $email, $phone, $date, $time, $guests);
        
        if ($stmt->execute()) {
            echo "Reservation made successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement.";
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
       
:root {
    --primary-color: #442d0e;
    --secondary-color: #e0f2f1;
    --accent-color:#6e4918;
    --hover-color: #08544d;
    --shadow-color: rgba(0, 0, 0, 0.2);
}


* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

body {
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/cafe123.jpg');
    background-size: cover;
    background-position: center;
    color: var(--primary-color);
}

header {
    background-color: var(--primary-color);
    padding: 15px 0;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 80%;
    margin: auto;
}

.navbar ul {
    list-style: none;
    display: flex;
}

.navbar ul li {
    margin-left: 20px;
}

.navbar ul li a {
    text-decoration: none;
    color: var(--secondary-color);
    font-weight: bold;
}

.navbar ul li a:hover {
    color: var(--accent-color);
}

main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 130px); 
    padding-top: 61px;
}

.reservation-section {
    background: var(--secondary-color);
    border-radius: 8px;
    display: flex;
    overflow: hidden;
    box-shadow: 0 0 20px var(--shadow-color);
    max-width: 900px;
    margin: 20px;
    padding-bottom: 50px;
}

.image-container {
    flex: 1;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.form-container {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

form h2 {
    color: var(--primary-color);
    margin-bottom: 20px;
    text-align: center;
}

form label {
    margin-top: 10px;
    color: var(--primary-color);
}

form input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid var(--primary-color);
    border-radius: 4px;
}

form button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: var(--primary-color);
    color: var(--secondary-color);
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: var(--hover-color);
}

footer {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    text-align: center;
    padding: 10px 0;
    position: absolute;
    bottom: 0;
    width: 100%;
}

    </style>    
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="#"><img class="logo" src="images/logo.png" alt="Logo" width="60" height="60"></a>
            <ul>
            <li><a href="adminHome.php">Menu</a></li>
                <li><a href="adminPreorder.php">Pre-order</a></li>
                <li><a href="adminReservation.php">Reservation</a></li>
            </ul>
        </nav>
    </header>
    <main data-aos="fade-up">
        <section class="reservation-section">
            
            </div>
            <div class="form-container">
                <form id="reservation-form" method="POST">
                    <h2>Table Reservations</h2>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                    
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" required>
                    
                    <label for="guests">Number of Guests:</label>
                    <input type="number" id="guests" name="guests" required>
                    
                    <button type="submit" id="submit-btn">Reserve Table</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({
        delay: 200,
        duration: 600,
      });

      document.getElementById('reservation-form').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var date = document.getElementById('date').value;
        var time = document.getElementById('time').value;
        var guests = document.getElementById('guests').value;

       
        if (name && email && phone && date && time && guests) {
         
            alert('Reservation made successfully!');

            this.submit(); 
        } else {
            
            alert('Please fill out all fields before submitting the form.');
        }
      });
    </script>
</body>
</html>
