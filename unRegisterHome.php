<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Gallery Café</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url(images/cafe123.jpg);
        }

        /* Header and Navigation */
        header {
            background-color: #c4956b38;
            color: #fff;
            padding: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1.1em;
            position: relative;
        }

        nav ul li a::after {
            content: '';
            display: block;
            height: 3px;
            background: #d4a373;
            width: 0;
            position: absolute;
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            max-width: 80%;
            animation: fadeIn 2s ease-in-out;
        }

        .hero-content h1 {
            font-size: 3em;
            margin-bottom: 20px;
            animation: slideIn 1.5s ease-in-out;
        }

        .hero-content p {
            font-size: 1.2em;
            margin-bottom: 30px;
            animation: slideIn 2s ease-in-out;
        }

        .hero-content .btn {
            background: #d4a373;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.2em;
            transition: background 0.3s;
        }

        .hero-content .btn:hover {
            background: #c4956b;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

<header>
    <div class="nav-container">
        <a href="#" class="logo"><img src="images/logo.png" alt="The Gallery Café Logo" /></a>
        <nav>
            <ul>
                <li><a href="unRegisterHome.php">Home</a></li>
                <li><a href="unRegisterMenu.php">Menu</a></li>
                <li><a href="unRegisterLocation.php">Location</a></li>
                <li><a href="unRegisterContact.php">Contact</a></li>
                <li><a href="unRegisterAboutus.php">About Us</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>Welcome to The Gallery Café</h1>
        <p>Experience the finest cuisine and ambiance in town.</p>
        <a href="login.php" class="btn">Login</a>
    </div>
</section>

<footer>
    <p>&copy; 2024 The Gallery Café. All rights reserved.</p>
</footer>

</body>
</html>
