
<?php
include 'connect.php';

// Check if form data is set
if (isset($_POST['preorder-name']) && isset($_POST['preorder-email']) && isset($_POST['preorder-phone']) && isset($_POST['preorder-food']) && isset($_POST['preorder-quantity'])) {
    $name = $_POST['preorder-name'];
    $email = $_POST['preorder-email'];
    $phone = $_POST['preorder-phone'];
    $food = $_POST['preorder-food'];
    $quantity = $_POST['preorder-quantity'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO preorders (name, email, phone, food, quantity) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssi", $name, $email, $phone, $food, $quantity);
        
        if ($stmt->execute()) {
            echo "Pre-order placed successfully!";
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
    <title>Pre-order</title>
   
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
/* Root variables */
:root {
    --primary-color: #442d0e;
    --secondary-color: #e0f2f1;
    --accent-color: #6e4918;
    --hover-color: #08544d;
    --shadow-color: rgba(0, 0, 0, 0.2);
}

/* Reset and basic styling */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

body {
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/photo-1521017432531-fbd92d768814.avif');
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
    height: calc(100vh - 130px); /* Adjust based on header and footer height */
    padding-top: 61px;
}

.preorder-section {
    background: var(--secondary-color);
    border-radius: 8px;
    display: flex;
    overflow: hidden;
    box-shadow: 0 0 20px var(--shadow-color);
    max-width: 900px;
    margin: 20px;
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

form input, form select {
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

.image-container {
    flex: 1;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
                <li><a href="menu.php">Menu</a></li>
                <li><a href="pre-order.php">Pre-order</a></li>
                <li><a href="reservation.php">Reservation</a></li>
            </ul>
        </nav>
    </header>
    <main data-aos="fade-up">
        <section class="preorder-section">
            <div class="form-container">
                <form id="preorder-form" method="POST">
                    <h2>Pre-order Your Meal</h2>
                    <label for="preorder-name">Name:</label>
                    <input type="text" id="preorder-name" name="preorder-name" required>
                    
                    <label for="preorder-email">Email:</label>
                    <input type="email" id="preorder-email" name="preorder-email" required>
                    
                    <label for="preorder-phone">Phone:</label>
                    <input type="tel" id="preorder-phone" name="preorder-phone" required>
                    
                    <label for="preorder-food">Select Food:</label>
                    <select id="preorder-food" name="preorder-food" required>
                    <option value="rice-curry">Bluberry-smoothie</option>
                        <option value="spring-rolls">Americano</option>
                        <option value="pasta-carbonara">Capuccino</option>
                        <option value="rice-curry">Carmel-Frappe</option>
                        <option value="spring-rolls">Hot-Chocolate</option>
                        <option value="pasta-carbonara">Nutella</option>
                    </select>
                    
                    <label for="preorder-quantity">Quantity:</label>
                    <input type="number" id="preorder-quantity" name="preorder-quantity" required>
                    
                    <button type="submit">Pre-order</button>
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
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('preorder-form');
    const successMessage = document.createElement('div');
    const errorMessage = document.createElement('div');
    
    successMessage.style.display = 'none';
    successMessage.style.backgroundColor = 'var(--accent-color)';
    successMessage.style.color = 'white';
    successMessage.style.padding = '10px';
    successMessage.style.marginTop = '10px';
    successMessage.style.borderRadius = '4px';
    form.appendChild(successMessage);
    
    errorMessage.style.display = 'none';
    errorMessage.style.backgroundColor = 'red';
    errorMessage.style.color = 'white';
    errorMessage.style.padding = '10px';
    errorMessage.style.marginTop = '10px';
    errorMessage.style.borderRadius = '4px';
    form.appendChild(errorMessage);

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const name = form.querySelector('#preorder-name').value.trim();
        const email = form.querySelector('#preorder-email').value.trim();
        const phone = form.querySelector('#preorder-phone').value.trim();
        const food = form.querySelector('#preorder-food').value;
        const quantity = form.querySelector('#preorder-quantity').value.trim();

        if (name === '' || email === '' || phone === '' || food === '' || quantity === '') {
            errorMessage.textContent = 'Please fill in all fields.';
            errorMessage.style.display = 'block';
            return;
        }

        if (!validateEmail(email)) {
            errorMessage.textContent = 'Please enter a valid email address.';
            errorMessage.style.display = 'block';
            return;
        }

        if (!validatePhone(phone)) {
            errorMessage.textContent = 'Please enter a valid phone number.';
            errorMessage.style.display = 'block';
            return;
        }

        // Form is valid, submit the form data using AJAX
        const formData = new FormData(form);

        fetch('pre-order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('Pre-order placed successfully!')) {
                successMessage.textContent = 'Pre-order placed successfully!';
                successMessage.style.display = 'block';
                errorMessage.style.display = 'none';
                form.reset();
            } else {
                errorMessage.textContent = data;
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
            }
        })
        .catch(error => {
            errorMessage.textContent = 'An error occurred: ' + error.message;
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
        });
    });

    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePhone(phone) {
        const re = /^[0-9]{10,15}$/;
        return re.test(String(phone));
    }
});
</script>
</body>
</html>
