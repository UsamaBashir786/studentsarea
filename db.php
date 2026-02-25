<?php
// ============================================================
//  db.php  –  Database Configuration & Connection
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');          // ← change to your MySQL username
define('DB_PASS', '');              // ← change to your MySQL password
define('DB_NAME', 'studentsarea');  // ← your database name

// ── Create connection ────────────────────────────────────────
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// ── Check connection ─────────────────────────────────────────
if ($conn->connect_error) {
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

$conn->set_charset('utf8mb4');


// ============================================================
//  AUTO-CREATE TABLES (run once on first load)
// ============================================================

$tables = [

    // -- users ------------------------------------------------
    "CREATE TABLE IF NOT EXISTS `users` (
        `id`         INT AUTO_INCREMENT PRIMARY KEY,
        `first_name` VARCHAR(100)  NOT NULL,
        `last_name`  VARCHAR(100)  NOT NULL,
        `email`      VARCHAR(150)  NOT NULL UNIQUE,
        `password`   VARCHAR(255)  NOT NULL,
        `user_type`  ENUM('student','author','company','freelancer') DEFAULT 'student',
        `provider`   ENUM('email','google') DEFAULT 'email',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // -- author_applications ----------------------------------
    "CREATE TABLE IF NOT EXISTS `author_applications` (
        `id`         INT AUTO_INCREMENT PRIMARY KEY,
        `user_id`    INT NOT NULL,
        `full_name`  VARCHAR(200) NOT NULL,
        `expertise`  VARCHAR(100) NOT NULL,
        `bio`        TEXT         NOT NULL,
        `portfolio`  VARCHAR(500),
        `samples`    TEXT,
        `status`     ENUM('pending','approved','rejected') DEFAULT 'pending',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // -- company_applications ---------------------------------
    "CREATE TABLE IF NOT EXISTS `company_applications` (
        `id`               INT AUTO_INCREMENT PRIMARY KEY,
        `user_id`          INT NOT NULL,
        `company_name`     VARCHAR(200) NOT NULL,
        `industry`         VARCHAR(100) NOT NULL,
        `website`          VARCHAR(500) NOT NULL,
        `company_size`     VARCHAR(50)  NOT NULL,
        `description`      TEXT         NOT NULL,
        `contact_person`   VARCHAR(200) NOT NULL,
        `contact_position` VARCHAR(200) NOT NULL,
        `status`           ENUM('pending','approved','rejected') DEFAULT 'pending',
        `created_at`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // -- job_postings -----------------------------------------
    "CREATE TABLE IF NOT EXISTS `job_postings` (
        `id`                INT AUTO_INCREMENT PRIMARY KEY,
        `user_id`           INT NOT NULL,
        `job_title`         VARCHAR(200) NOT NULL,
        `job_type`          VARCHAR(50)  NOT NULL,
        `location`          VARCHAR(200) NOT NULL,
        `category`          VARCHAR(100) NOT NULL,
        `salary`            VARCHAR(100),
        `duration`          VARCHAR(100),
        `description`       TEXT         NOT NULL,
        `requirements`      TEXT         NOT NULL,
        `benefits`          TEXT,
        `application_email` VARCHAR(150) NOT NULL,
        `status`            ENUM('active','closed','pending') DEFAULT 'active',
        `created_at`        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

foreach ($tables as $sql) {
    $conn->query($sql);
}