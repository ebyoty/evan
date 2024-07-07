CREATE database user_db;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    user_type ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);


CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    age INT,
    year_level INT,
    course VARCHAR(100)
);