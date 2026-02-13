<?php
$conn = mysqli_connect("localhost", "root", "", "zeroman");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
