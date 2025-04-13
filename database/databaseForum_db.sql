CREATE DATABASE forum_db;
USE forum_db;

-- Πίνακας χρηστών
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(250) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Πίνακας threads (συζητήσεις)
CREATE TABLE threads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Πίνακας posts (απαντήσεις σε συζητήσεις)
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    thread_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (thread_id) REFERENCES threads(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password, role) VALUES
('john_doe', 'john.doe@example.com', 'password123', 'user'),
('jane_smith', 'jane.smith@example.com', 'securepass456', 'user'),
('michael_brown', 'michael.brown@example.com', 'mypassword789', 'user'),
('admin_clark', 'admin.clark@example.com', 'admin88', 'admin');



ALTER TABLE threads MODIFY COLUMN content TEXT AFTER title;


