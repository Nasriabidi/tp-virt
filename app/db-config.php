<?php
// Read DB connection from environment variables with sensible defaults
$dbHost = getenv('DB_HOST') ?: 'db';
$dbName = getenv('DB_NAME') ?: 'test';
$dbUser = getenv('DB_USER') ?: 'test';
$dbPass = getenv('DB_PASS') ?: 'test';

// Build DSN dynamically and expose constants used by the app
$dsn = sprintf('mysql:host=%s;dbname=%s', $dbHost, $dbName);
define('DB_DSN', $dsn);
define('DB_USER', $dbUser);
define('DB_PASS', $dbPass);

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // encodage utf-8
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // gérer les erreurs en tant qu'exception
    PDO::ATTR_EMULATE_PREPARES => false // faire des vrais requêtes préparées et non une émulation
);

// Expose a helper to get a PDO
function get_pdo(): PDO {
    global $dsn, $options;
    return new PDO($dsn, DB_USER, DB_PASS, $options);
}