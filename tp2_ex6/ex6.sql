CREATE DATABASE IF NOT EXISTS bd_ex6;
USE bd_ex6;

CREATE TABLE IF NOT EXISTS utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

INSERT INTO utilisateur (username, email, password, role) VALUES 
('youssef', 'youssef@example.com', 'na3ne3', 'admin'),
('yasser', 'yasser@example.com', 'user123', 'user');

INSERT INTO section (nom, description) VALUES 
('Informatique', 'Section dédiée à l\'informatique'),
('Mathématiques', 'Section dédiée aux mathématiques');
