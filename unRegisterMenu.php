<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - The Gallery Café</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #343a40;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(images/cafe123.jpg);
            background-size: cover;
            background-position: center;
        }

        .banner {
            width: 100%;
            height: 100vh;
            
        }

        .navbar {
            width: 100%;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .logo {
            margin-left: 10px;
            display: flex;
            align-items: center;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin-right: 20px;
            position: relative;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff0cb;
            text-transform: capitalize;
            font-weight: 900;
            margin:10px;
        }

        .navbar ul li::after {
            content: "";
            height: 2px;
            width: 0;
            background:#fff0cb;;
            position: absolute;
            left: 0;
            bottom: -8px;
            transition: 0.5s;
        }

        .navbar ul li:hover::after {
            width: 100%;
        }

        main {
            max-width: 1200px;
            margin: 100px auto 20px; /* Added margin-top to account for fixed navbar */
            padding: 20px;
            background-color: #ffffff1f;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .category {
            margin-bottom: 30px;
        }

        .category h2 {
            background-color: #fff0cb;
            color: #343a40;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .item-details {
            padding: 15px;
            text-align: center;
        }

        .item-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 10px 0;
        }

        .item-price {
            color: #000000;
            font-weight: 600;
        }

        .order-button {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #343a40;
            color: #ffc107;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .order-button:hover {
            background-color: #ffc107;
            color: #343a40;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="#">
                <img class="logo" src="images/logo.png" loading="lazy" alt="Logo" width="60px">
            </a>
            <ul>
            <li><a href="unRegisterHome.php">Home</a></li>
                    <li><a href="unRegisterMenu.php">Menu</a></li>
                    <li><a href="unRegisterLocation.php">location</a></li>
                    <li><a href="unRegisterContact.php">contact</a></li>
                    <li><a href="unRegisterAboutus.php">about us</a></li>
                    
            </ul>
        </div>
    </header>
    <main>
        <h1 style="text-align:center; color: #fff;">Our Menu</h1>
        <?php
        $sql = "SELECT * FROM menu_items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $categories = array(
                "Cool Beverage" => array(),
                "Hot Beverage" => array(),
                "Rice/Pasta" => array()
            );

            while ($row = $result->fetch_assoc()) {
                $categories[$row["category"]][] = $row;
            }

            foreach ($categories as $category => $items) {
                if (!empty($items)) {
                    echo '<div class="category">';
                    echo '<h2>' . $category . '</h2>';
                    echo '<div class="grid">';
                    foreach ($items as $item) {
                        echo '<div class="item">';
                        if (!empty($item["image"])) {
                            echo '<img src="images/' . $item["image"] . '" alt="' . $item["name"] . '">';
                        }
                        echo '<div class="item-details">';
                        echo '<p class="item-name">' . $item["name"] . '</p>';
                        echo '<p class="item-price">Rs ' . $item["price"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo "<p>No menu items found.</p>";
        }

        $conn->close();
        ?>
        
    </main>
    <footer>
        &copy; <?php echo date("Y"); ?> 2024 Gallery Cafe. All rights reserved.
    </footer>
</body>
</html>
