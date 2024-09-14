<?php
include 'connect.php';

// Add a new user to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "";
    } else {
        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, userType) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);

        if ($stmt->execute()) {
            echo "User added successfully.";
        } else {
            echo "Error adding user: " . $stmt->error;
        }
    }

    $stmt->close();
}

// Edit a user in the database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Update user in the database
    $query = "UPDATE users SET username = ?, email = ?, userType = ?";
    if ($password) {
        $query .= ", password = ?";
    }
    $query .= " WHERE id = ?";

    $stmt = $conn->prepare($query);
    if ($password) {
        $stmt->bind_param("ssssi", $name, $email, $role, $password, $id);
    } else {
        $stmt->bind_param("sssi", $name, $email, $role, $id);
    }

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
}

// Delete a user from the database
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all users from the database
$users = [];
$result = $conn->query("SELECT * FROM users");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - The Gallery Café</title>
    <style>
        /* Reset and basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

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
            background-color: #442d0e78;
            color: #dfe6e9;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding-bottom: 30px;
        }

        header h1 {
            font-size: 2rem;
        }

        nav ul {
            list-style: none;
            margin-top: 10px;
        }

        nav ul li {
            display: inline;
            margin: 0 10px;
        }

        nav ul li a {
            color: #dfe6e9;
            text-decoration: none;
            font-size: 1rem;
        }

        section {
            background: #ffffff;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
           
        }

        h2 {
            color: #2d3436;
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 1rem;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table thead tr {
            background-color: #442d0e;
            color: white;
        }

        table tbody tr:hover {
            background-color: #f1f2f6;
        }

        button {
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
        }

        .add-user-button {
            background-color: #442d0e;
            color: white;
            margin-top: 20px;
            display: block;
            width: fit-content;
            margin-left: auto;
        }

        .edit-button {
            background-color: #b37f39;
            color: white;
            margin-right: 5px;
        }

        .delete-button {
            background-color: #d63031;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            position: relative;
        }

        .modal-content h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #2d3436;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2d3436;
        }

        form input,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #636e72;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #636e72;
        }
    </style>
</head>

<body>
    <header>
        <h1>The Gallery Café / Admin Manage Users</h1>
        <nav>
            <ul>
                <li><a href="adminHome.php">Admin Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>User Management</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamically Generated Rows -->
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['userType'] ?></td>
                        <td>
                            <button class="edit-button" data-id="<?= $user['id'] ?>" data-username="<?= $user['username'] ?>" data-email="<?= $user['email'] ?>" data-role="<?= $user['userType'] ?>">Edit</button>
                            <a href="staffdetails.php?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                                <button class="delete-button">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="add-user-button">Add User</button>
    </section>

    <!-- Modal for Adding/Editing Users -->
    <div class="modal" id="user-modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2 id="modal-title">Add User</h2>
            <form method="post" id="user-form">
                <input type="hidden" name="action" id="action" value="add">
                <input type="hidden" name="id" id="user-id">

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="customer">Customer</option>
                </select>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Save User</button>
            </form>
        </div>
    </div>

    <footer>&copy; 2024 The Gallery Café. All rights reserved.</footer>

    <script>
        const modal = document.getElementById('user-modal');
        const closeBtn = document.querySelector('.close-btn');
        const addUserButton = document.querySelector('.add-user-button');
        const editButtons = document.querySelectorAll('.edit-button');
        const form = document.getElementById('user-form');
        const modalTitle = document.getElementById('modal-title');
        const actionField = document.getElementById('action');
        const userIdField = document.getElementById('user-id');
        const nameField = document.getElementById('name');
        const emailField = document.getElementById('email');
        const roleField = document.getElementById('role');
        const passwordField = document.getElementById('password');

        // Open the modal to add a user
        addUserButton.addEventListener('click', () => {
            modal.style.display = 'flex';
            modalTitle.textContent = 'Add User';
            actionField.value = 'add';
            userIdField.value = '';
            nameField.value = '';
            emailField.value = '';
            roleField.value = 'admin';
            passwordField.required = true;
        });

        // Open the modal to edit a user
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.style.display = 'flex';
                modalTitle.textContent = 'Edit User';
                actionField.value = 'edit';
                userIdField.value = button.getAttribute('data-id');
                nameField.value = button.getAttribute('data-username');
                emailField.value = button.getAttribute('data-email');
                roleField.value = button.getAttribute('data-role');
                passwordField.required = false; // Don't require password for editing
            });
        });

        // Close the modal
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close the modal when clicking outside the content
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>

</html>
