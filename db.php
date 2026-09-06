<?php
/**
 * Database connection — Azura Reef Dive
 * Every page that needs the database does: require 'db.php';
 * then uses the $conn variable.
 */

$db_host = 'localhost';
$db_user = 'root';   // XAMPP default username
$db_pass = '';       // XAMPP default password is blank
$db_name = 'azura_reefdive';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Make sure special characters (accents, emojis, etc.) save correctly
$conn->set_charset('utf8mb4');