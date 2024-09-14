<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'gallery_cafe';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_selected = mysqli_select_db($conn, $dbname);

if (!$db_selected) {
    die("Could not select the database: " . mysqli_error($conn));
} else {
    
}
?>
