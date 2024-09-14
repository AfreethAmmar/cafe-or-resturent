<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $table = $_POST['table'];  // 'adminreservation' or 'reservation'
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];

    $sql = "UPDATE adminreservation SET name='$name', email='$email', phone='$phone', date='$date', time='$time', guests='$guests' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: staff-dashboad.php");
    exit();
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $table = $_GET['table'];
        $result = $conn->query("SELECT * FROM $table WHERE id = $id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f8;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(images/cafe123.jpg);
    background-size:cover;
}

/* Form Container */
form {
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

/* Form Title */
h1 {
    text-align: center;
    color: #ffffff;
    margin-bottom: 20px;
}

/* Label Styles */
label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #34495e;
}

/* Input Styles */
input[type="text"],
input[type="email"],
input[type="date"],
input[type="time"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Focus State for Inputs */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus,
input[type="time"]:focus,
input[type="number"]:focus {
    border-color: #2980b9;
    outline: none;
}

/* Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #2980b9;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover State for Submit Button */
input[type="submit"]:hover {
    background-color: #21618c;
}

/* Responsive Design */
@media (max-width: 500px) {
    form {
        padding: 15px 20px;
    }

    h1 {
        font-size: 24px;
    }

    input[type="submit"] {
        font-size: 16px;
    }
}

    </style>
</head>
<body>
    <h1>admin reservation</h1>
    <form method="post" action="editReservation.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <label>Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"></label><br>
        <label>Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"></label><br>
        <label>Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"></label><br>
        <label>Date: <input type="date" name="date" value="<?php echo $row['date']; ?>"></label><br>
        <label>Time: <input type="time" name="time" value="<?php echo $row['time']; ?>"></label><br>
        <label>Guests: <input type="number" name="guests" value="<?php echo $row['guests']; ?>"></label><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
