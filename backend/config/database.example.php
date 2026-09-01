<?php
/*
 * Copy this file to database.php before running the project locally.
 * For the default XAMPP setup, the values below normally work unchanged.
 */

$host = "localhost";
$username = "root";
$password = "";
$database = "employee_payroll_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
