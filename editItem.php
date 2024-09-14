<?php
include 'connect.php';

// Get the ID and table from URL parameters
$id = $_GET['id'];
$table = $_GET['table'];

// Determine the appropriate query based on the table
if ($table === 'adminpreorders') {
    $query = "SELECT * FROM adminpreorders WHERE id = $id";
} elseif ($table === 'preorders') {
    $query = "SELECT * FROM preorders WHERE id = $id";
} elseif ($table === 'adminreservation') {
    $query = "SELECT * FROM adminreservation WHERE id = $id";
} elseif ($table === 'reservation') {
    $query = "SELECT * FROM reservation WHERE id = $id";
} else {
    die("Invalid table specified");
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Record not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit <?php echo ucfirst(str_replace('admin', '', $table)); ?></h1>
    <form method="post" action="updateItem.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        
        <?php if (in_array($table, ['adminpreorders', 'preorders'])): ?>
            <label>Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"></label><br>
            <label>Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"></label><br>
            <label>Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"></label><br>
            <label>Food: <input type="text" name="food" value="<?php echo $row['food']; ?>"></label><br>
            <label>Quantity: <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>"></label><br>
        <?php elseif (in_array($table, ['adminreservation', 'reservation'])): ?>
            <label>Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"></label><br>
            <label>Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"></label><br>
            <label>Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"></label><br>
            <label>Date: <input type="date" name="date" value="<?php echo $row['date']; ?>"></label><br>
            <label>Time: <input type="time" name="time" value="<?php echo $row['time']; ?>"></label><br>
            <label>Guests: <input type="number" name="guests" value="<?php echo $row['guests']; ?>"></label><br>
        <?php endif; ?>

        <input type="submit" value="Update">
    </form>
</body>
</html>
