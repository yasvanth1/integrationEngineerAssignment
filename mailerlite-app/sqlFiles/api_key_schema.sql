-- Create the user
CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED BY 'rootroot';

-- Grant all privileges to the user on all databases
GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;

-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS mailerliteapp;

-- Use the database
USE mailerliteapp;

-- Create the table
CREATE TABLE IF NOT EXISTS api_keys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    api_key VARCHAR(5000) NOT NULL
);