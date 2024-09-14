<?php
include 'connect.php';


$adminPreordersQuery = "SELECT * FROM adminpreorders";
$adminPreordersResult = $conn->query($adminPreordersQuery);

$preordersQuery = "SELECT * FROM preorders";
$preordersResult = $conn->query($preordersQuery);


$adminReservationQuery = "SELECT * FROM adminreservation";
$adminReservationResult = $conn->query($adminReservationQuery);


$reservationQuery = "SELECT * FROM reservation";
$reservationResult = $conn->query($reservationQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    color: #333;
    display: flex;
    height: 100vh;
}

.wrapper {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background: #442d0e;
    color: white;
    height: 100vh;
    padding: 20px;
    position: fixed;
}

.sidebar-header {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.sidebar-header h3 {
    margin-bottom: 10px;
}

.sidebar .logo {
    width: 60px;
    height: 60px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
    text-align: center;
    
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
    width: 100%;
    padding: 10px;
    transition: background 0.3s;
    background-color:#815416;
}

.sidebar ul li a:hover,
.sidebar ul li a.active {
    background: #815416; /* Darker shade */
}

.content {
    margin-left: 250px;
    width: calc(100% - 250px);
    padding: 20px;
}

header {
    background: #442d0e;
    padding: 20px;
    color: white;
    text-align: center;
}

.main-content {
    padding: 20px;
}

h2 {
    margin-bottom: 20px;
    color: #442d0e;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background: white;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #442d0e;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

.button {
    padding: 5px 10px;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.button.edit {
    background-color: #442d0e; /* Complementary shade */
}

.button.edit:hover {
    background-color: #2e8c76; /* Darker complementary shade */
}

.button.delete {
    background-color: #e64a45; /* Accent color */
}

.button.delete:hover {
    background-color: #d43d39; /* Darker accent color */
}

footer {
    background-color:#442d0e;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
}
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Your Company</h3>
                <img class="logo" src="images/logo.png "loading="lazy" width="60px" alt="Logo">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="adminHome.php" class="active">Home</a>
                </li>
                <li>
                    <a href="#adminPreorders" class="active">Admin Pre-orders</a>
                </li>
                <li>
                    <a href="#adminReservations">Admin Reservations</a>
                </li>
                <li>
                    <a href="#userPreorders">User Pre-orders</a>
                </li>
                <li>
                    <a href="#userReservations">User Reservations</a>
                </li>
                <li>
                <a href="unRegisterHome.php">logout</a>
                </li>
            </ul>
        </nav>

        <div class="content">
            <header>
                <h1>Welcome to the Staff Dashboard</h1>
            </header>
            <div class="main-content">
                <!-- Admin Pre-orders Section -->
                <section id="adminPreorders">
                    <h2>Admin Pre-orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Food</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($adminPreordersResult->num_rows > 0) {
                                while ($row = $adminPreordersResult->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['food']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>
                                                <button class='button edit' onclick='editItem(\"adminpreorders\", {$row['id']})'>Edit</button>
                                                <button class='button delete' onclick='deleteItem(\"adminpreorders\", {$row['id']})'>Delete</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No admin pre-orders found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </section>

                <!-- Admin Reservations Section -->
                <section id="adminReservations">
                    <h2>Admin Reservations</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Number of People</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($adminReservationResult->num_rows > 0) {
                                while ($row = $adminReservationResult->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['date']}</td>
                                            <td>{$row['time']}</td>
                                            <td>{$row['guests']}</td>
                                            <td>
                                                <button class='button edit' onclick='editItem(\"adminreservation\", {$row['id']})'>Edit</button>
                                                <button class='button delete' onclick='deleteItem(\"adminreservation\", {$row['id']})'>Delete</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No admin reservations found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </section>

                <!-- User Pre-orders Section -->
                <section id="userPreorders">
                    <h2>User Pre-orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Food</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($preordersResult->num_rows > 0) {
                                while ($row = $preordersResult->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['food']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>
                                                <button class='button edit' onclick='editItem(\"preorders\", {$row['id']})'>Edit</button>
                                                <button class='button delete' onclick='deleteItem(\"preorders\", {$row['id']})'>Delete</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No user pre-orders found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </section>

                <!-- User Reservations Section -->
                <section id="userReservations">
                    <h2>User Reservations</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Number of People</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($reservationResult->num_rows > 0) {
                                while ($row = $reservationResult->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['date']}</td>
                                            <td>{$row['time']}</td>
                                            <td>{$row['guests']}</td>
                                            <td>
                                                <button class='button edit' onclick='editItem(\"reservation\", {$row['id']})'>Edit</button>
                                                <button class='button delete' onclick='deleteItem(\"reservation\", {$row['id']})'>Delete</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No user reservations found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Gallery Cafe. All rights reserved..</p>
    </footer>

    <script>
        function editItem(table, id) {
            window.location.href = 'editPreorders.php?id=' + id + '&table=' + table;
        }
        function editItem(table, id) {
            window.location.href = 'editReservation.php?id=' + id + '&table=' + table;
        }
        function editItem(table, id) {
            window.location.href = 'edit-adminPreorders.php?id=' + id + '&table=' + table;
        }
        function editItem(table, id) {
            window.location.href = 'edit-adminReservation.php?id=' + id + '&table=' + table;
        }

        function deleteItem(table, id) {
            if (confirm("Are you sure you want to delete this item?")) {
                
                window.location.href = 'deletePreorders.php?id=' + id + '&table=' + table;
            }
        }
        function deleteItem(table, id) {
            if (confirm("Are you sure you want to delete this item?")) {
                
                window.location.href = 'deleteReservation.php?id=' + id + '&table=' + table;
            }
        }
        function deleteItem(table, id) {
            if (confirm("Are you sure you want to delete this item?")) {
                
                window.location.href = 'delete-adminPreorders.php?id=' + id + '&table=' + table;
            }
        }
        function deleteItem(table, id) {
            if (confirm("Are you sure you want to delete this item?")) {
                
                window.location.href = 'delete-adminReservation.php?id=' + id + '&table=' + table;
            }
        }
    </script>
</body>
</html>
