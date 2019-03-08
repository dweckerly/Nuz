<?php
$host = 'localhost';
$dbn = 'u575021534_db';
$user = 'u575021534_user';
$pass = 'R@n$0m!?!';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbn;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$db = new PDO($dsn, $user, $pass, $options);