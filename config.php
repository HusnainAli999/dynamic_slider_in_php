<?php
$conn = new mysqli("localhost", "root", "", "dynamic_slider_database");

if ($conn->connect_error) {
    echo "Mojor Connection Failed : " . mysqli_connect_error();
    exit;
}
