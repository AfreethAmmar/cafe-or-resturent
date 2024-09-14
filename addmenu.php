<?php
include 'connect.php';

// Initialize message variable
$message = '';

// Handle form submission for adding a new menu item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle the image upload
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO menu_items (name, price, category, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $category, $image);

    // Execute the statement
    if ($stmt->execute()) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $message = 'Menu item added successfully!';
        } else {
            $message = 'Failed to upload image.';
        }
    } else {
        $message = 'Failed to add menu item. Error: ' . $stmt->error;
    }

    $stmt->close();
}

// Handle deletion of a menu item
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = 'Menu item deleted successfully!';
    } else {
        $message = 'Failed to delete menu item. Error: ' . $stmt->error;
    }

    $stmt->close();
}

// Handle editing of a menu item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    if ($_FILES['image']['name']) {
        // Handle the image upload
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $imageQuery = ", image = ?";
            $imageParam = $image;
        } else {
            $message = 'Failed to upload image.';
            $imageQuery = '';
            $imageParam = '';
        }
    } else {
        $imageQuery = '';
        $imageParam = '';
    }

    // Prepare and bind parameters
    $sql = "UPDATE menu_items SET name = ?, price = ?, category = ? $imageQuery WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($imageQuery) {
        $stmt->bind_param("sdssi", $name, $price, $category, $imageParam, $id);
    } else {
        $stmt->bind_param("sdsi", $name, $price, $category, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        $message = 'Menu item updated successfully!';
    } else {
        $message = 'Failed to update menu item. Error: ' . $stmt->error;
    }

    $stmt->close();
}

// Fetch menu items from the database
$query = "SELECT * FROM menu_items";
$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

$menuItems = $result->fetch_all(MYSQLI_ASSOC);
$result->free();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu Management - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #343a40;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(images/cafe123.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        header {
            background-color: #442d0e;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        header nav ul li {
            margin: 0 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        header nav ul li a:hover {
            background-color: #495057;
        }

        main {
            flex: 1;
            padding: 30px;
            max-width: 1200px;
            margin: 30px auto;
            background: #ffffff42;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
            font-size: 2.2em;
        }

        /* Form Styles */
        .admin-form {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .admin-form h2 {
            margin-bottom: 20px;
            color: #343a40;
            font-size: 1.6em;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
        }

        .admin-form label {
            display: block;
            margin-bottom: 10px;
            color: #495057;
        }

        .admin-form input, .admin-form select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            box-sizing: border-box;
            font-size: 1em;
        }

        .admin-form button {
            background-color: #442d0e;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.1em;
        }

        .admin-form button:hover {
            background-color: #218838;
        }

        /* Menu Card Styles */
        .menu-card {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .menu-card-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-card-item img {
            max-width: 100%;
            border-radius: 10px;
        }

        .menu-card-item h3 {
            margin: 15px 0;
            font-size: 1.5em;
        }

        .menu-card-item p {
            font-size: 1.1em;
        }

        .menu-card-item button, .menu-card-item a {
            display: block;
            margin-top: 10px;
            background-color:#442d0e;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .menu-card-item button:hover, .menu-card-item a:hover {
            background-color: #9b6a29;
        }

        /* Popup Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
        }

        .modal-header h2 {
            margin: 0;
            color: #343a40;
        }

        .close {
            font-size: 1.5em;
            font-weight: bold;
            color: #495057;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #000;
        }

        .modal-body {
            margin-top: 20px;
        }

        .modal-body input, .modal-body select {
            width: calc(100% - 22px);
            margin-bottom: 20px;
        }

        .modal-footer {
            margin-top: 20px;
            text-align: right;
        }

        .modal-footer button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.1em;
        }

        .modal-footer button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="adminHome.php">AdminDashboard</a></li>
            
        </ul>
    </nav>
</header>

<main>
    <h1>Manage Menu Items</h1>
    <div class="admin-form">
        <h2>Add New Menu Item</h2>
        <form action="addmenu.php" method="post" enctype="multipart/form-data">
            <label for="name">Menu Item Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select Category</option>
                <option value="Cool Beverage">Cool Beverage</option>
                <option value="Hot Beverage">Hot Beverage</option>
                <option value="Rice/Pasta">Rice/Pasta</option>
            </select>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image">

            <button type="submit" name="add">Add Menu Item</button>
        </form>
    </div>

    <div class="menu-card">
        <?php foreach ($menuItems as $item): ?>
            <div class="menu-card-item">
                <img src="images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                <p>Price: $<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></p>
                <p>Category: <?php echo htmlspecialchars($item['category']); ?></p>
                <button onclick="openModal(<?php echo $item['id']; ?>)">Edit</button>
                <a href="addmenu.php?delete=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal for Editing Menu Item -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Menu Item</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editId">
                    <label for="editName">Menu Item Name:</label>
                    <input type="text" id="editName" name="name" required>

                    <label for="editPrice">Price:</label>
                    <input type="number" id="editPrice" name="price" step="0.01" required>

                    <label for="editCategory">Category:</label>
                    <select id="editCategory" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Cool Beverage">Cool Beverage</option>
                    <option value="Hot Beverage">Hot Beverage</option>
                    <option value="Rice/Pasta">Rice / Pasta</option>
                    </select>

                    <label for="editImage">Image:</label>
                    <input type="file" id="editImage" name="image">

                    <div class="modal-footer">
                        <button type="submit" name="update">Update Menu Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // JavaScript to handle modal functionality
    function openModal(id) {
        var modal = document.getElementById("editModal");
        var form = document.getElementById("editForm");
        
        // Fetch menu item data
        fetch('get_menu_item.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                document.getElementById("editId").value = data.id;
                document.getElementById("editName").value = data.name;
                document.getElementById("editPrice").value = data.price;
                document.getElementById("editCategory").value = data.category;
            });

        modal.style.display = "flex";
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("editModal")) {
            closeModal();
        }
    }
</script>

</body>
</html>
