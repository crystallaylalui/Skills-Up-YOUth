drop database if exists wad2_project;
create database wad2_project;
use wad2_project;

CREATE TABLE IF NOT EXISTS user (
  username varchar(50) NOT NULL,
  hashed_password varchar(256) NOT NULL,
  PRIMARY KEY (username)
);