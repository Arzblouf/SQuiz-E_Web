<?php
// public/debug.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Testing Components</h1>";

// Test 1: Check file paths
echo "<h2>1. Checking Files</h2>";

$files = [
    'index.php' => __DIR__ . '/index.php',
    'AuthController' => __DIR__ . '/../app/controllers/AuthController.php',
    'SurveyController' => __DIR__ . '/../app/controllers/SurveyController.php',
    'Database' => __DIR__ . '/../app/models/Database.php',
    'UserModel' => __DIR__ . '/../app/models/UserModel.php',
    'SurveyModel' => __DIR__ . '/../app/models/SurveyModel.php',
    'QuestionModel' => __DIR__ . '/../app/models/QuestionModel.php',
    'database config' => __DIR__ . '/../config/database.php',
    'layout view' => __DIR__ . '/../app/views/layout.php',
    'login view' => __DIR__ . '/../app/views/auth/login.php',
];

foreach ($files as $name => $path) {
    $exists = file_exists($path) ? 'YES' : 'NO';
    $color = file_exists($path) ? 'green' : 'red';
    echo "<p style='color:$color'>$name: $exists</p>";
}

// Test 2: Database connection
echo "<h2>2. Testing Database</h2>";
try {
    require_once __DIR__ . '/../config/database.php';
    echo "<p>Config loaded. DB_HOST = " . DB_HOST . "</p>";
    
    require_once __DIR__ . '/../app/models/Database.php';
    $db = Database::getConnection();
    echo "<p style='color:green'>Database connected!</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>Database error: " . $e->getMessage() . "</p>";
}

// Test 3: Load AuthController
echo "<h2>3. Testing AuthController</h2>";
try {
    require_once __DIR__ . '/../app/controllers/AuthController.php';
    $controller = new AuthController();
    echo "<p style='color:green'>AuthController loaded!</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>AuthController error: " . $e->getMessage() . "</p>";
}

echo "<h2>All tests complete!</h2>";