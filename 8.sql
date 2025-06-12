CREATE DATABASE IF NOT EXISTS library_db;
USE library_db;
CREATE TABLE IF NOT EXISTS books (
    accession_number VARCHAR(50) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    edition VARCHAR(100),
    publication VARCHAR(255)
);
