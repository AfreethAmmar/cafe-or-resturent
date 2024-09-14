<?php
include 'connect.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café | Admin Dashboard</title>
    <style>
/* Define color variables */
:root {
    --primary-color: #442d0e;
    --secondary-color: #fff;
    --accent-color: #36a089;
    --hover-color: #08544d;
    --shadow-color: rgba(0, 0, 0, 0.2);
}

/* Reset and basic styling */
* {
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

body {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(images/cafe123.jpg);
    background-size: cover;
    background-position: center;
    color: var(--primary-color);
}

/* Header styling */
header {
    background-color: var(--primary-color);
    padding: 10px 0;
    text-align: center;
    color: var(--secondary-color);
}

header h1 {
    margin: 0;
    font-size: 2rem;
}

/* Main container */
.container {
    max-width: 1200px;
    margin: 20px auto;
    background-color: var(--secondary-color);
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 10px var(--shadow-color);
}

/* Grid layout for dashboard sections */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 3fr;
    gap: 20px;
}

/* Sidebar navigation */
.sidebar {
    background-color: var(--primary-color);
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 5px var(--shadow-color);
}

.sidebar a {
    display: block;
    color: var(--secondary-color);
    text-decoration: none;
    padding: 10px 0;
    transition: background 300ms ease;
    text-align: center;
}

.sidebar a:hover {
    background-color:#885c21;
}

/* Main content area */
.main-content {
    background-color: #442d0e;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 5px var(--shadow-color);
}

.main-content h2 {
    color: #fff;
    margin-bottom: 20px;
}

/* Statistics section */
.statistics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.stat-item {
    background-color: #885c21;
    color: var(--secondary-color);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 0 5px var(--shadow-color);
}

.stat-item h2 {
    font-size: 1.5rem;
    margin: 0 0 10px;
}

.stat-item p {
    font-size: 1.2rem;
    margin: 0;
}

/* Quick links section */
.quick-links {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
}

.quick-link {
    background-color: #885c21;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    color: var(--secondary-color);
    box-shadow: 0 0 5px var(--shadow-color);
    transition: transform 300ms ease, box-shadow 300ms ease;
    cursor: pointer;
}

.quick-link:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
}

.quick-link ion-icon {
    font-size: 3rem;
    margin-bottom: 10px;
}

.quick-link label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
}

/* Back link styling */
.back-link {
    display: block;
    width: 150px;
    margin: 20px auto;
    text-align: center;
    padding: 10px;
    background-color: var(--primary-color);
    color: var(--secondary-color);
    text-decoration: none;
    border-radius: 5px;
}

.back-link:hover {
    background-color: var(--hover-color);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .sidebar {
        text-align: center;
    }
}
    </style>
</head>
<body>
<header>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
</header>
<div class="container">
    <div class="dashboard-grid">
        <div class="sidebar">
            <a href="adminReservation.php">Bookings</a>
            <a href="staff-home.php">Staff Management</a>
            <a href="addmenu.php">Add Menu</a>
            <a href="staffdetails.php">Staff Details</a>
            <a href="unRegisterHome.php" class="back-link">Logout</a>
        </div>
        <div class="main-content">
            <h2>Admin Dashboard</h2>
            <div class="statistics">
                <div class="stat-item">
                    <h2>Total Bookings</h2>
                    <p>120</p> <!-- Replace with dynamic data -->
                </div>
                <div class="stat-item">
                    <h2>Total Menu Items</h2>
                    <p>45</p> <!-- Replace with dynamic data -->
                </div>
                <div class="stat-item">
                    <h2>Total Feedbacks</h2>
                    <p>88</p> <!-- Replace with dynamic data -->
                </div>
                <div class="stat-item">
                    <h2>Total Staff</h2>
                    <p>15</p> <!-- Replace with dynamic data -->
                </div>
            </div>
            <h2>Quick Links</h2>
            <div class="quick-links">
                <div class="quick-link" onclick="redirectToPage('adminReservation')">
                    <ion-icon name="calendar"></ion-icon>
                    <label>Bookings</label>
                </div>
                <div class="quick-link" onclick="redirectToPage('staff-home')">
                    <ion-icon name="people"></ion-icon>
                    <label>Staff Management</label>
                </div>
                <div class="quick-link" onclick="redirectToPage('addmenu')">
                    <ion-icon name="add-circle"></ion-icon>
                    <label>Add Menu</label>
                </div>
                <div class="quick-link" onclick="redirectToPage('staffdetails')">
                    <ion-icon name="people"></ion-icon>
                    <label>Add User</label>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script>
    function redirectToPage(page) {
        window.location.href = page + '.php'; // Redirect to the respective PHP page
    }
</script>
</body>
</html>
