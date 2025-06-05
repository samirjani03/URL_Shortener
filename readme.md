Create Database:
- create database url_shortener;
- use url_shortener;

Create table :
- CREATE TABLE urls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    long_url VARCHAR(2048) NOT NULL,
    short_url VARCHAR(10) NOT NULL
 );
