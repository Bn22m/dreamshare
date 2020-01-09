##########################
# 
# Brian M
# dreamshare.sql
#########################


CREATE DATABASE DREAMSHARE;

USE DREAMSHARE;

GRANT ALL ON DREAMSHARE.* to cool@localhost identified by 'myp3pw';

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  email VARCHAR(99) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  activities TEXT,
  image TEXT,
  created DATETIME,
  modified DATETIME
);

CREATE TABLE logins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  email VARCHAR(99) NOT NULL,
  userid INT NOT NULL,
  password VARCHAR(255) NOT NULL,
  comments VARCHAR(255) UNIQUE,
  logdate DATETIME
);

CREATE TABLE blogs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  email VARCHAR(99) NOT NULL,
  title VARCHAR(255) NOT NULL UNIQUE,
  body TEXT,
  imagelink VARCHAR(255),
  comments INT,
  created DATETIME,
  modified DATETIME
);


#######################################
# mysql> show tables;
# +----------------------+
# | Tables_in_dreamshare |
# +----------------------+
# | blogs                |
# | logins               |
# | users                |
# +----------------------+
# 3 rows in set (0.00 sec)
##############################################
