<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME') ?: 'defaultdb';
$port = (int) (getenv('DB_PORT') ?: 25963);

if (!$host || !$user || !$password) {
    die('Database environment variables are not configured.');
}

$con = mysqli_init();

mysqli_ssl_set(
    $con,
    null,
    null,
    null,
    null,
    null
);

if (!mysqli_real_connect(
    $con,
    $host,
    $user,
    $password,
    $database,
    $port
)) {
    die("Database connection failed: " . mysqli_connect_error());
}

$createTable = "CREATE TABLE IF NOT EXISTS student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(20) NOT NULL,
    phone VARCHAR(30) NOT NULL
)";

if (!mysqli_query($con, $createTable)) {
    die("Table initialization failed: " . mysqli_error($con));
}

?>
