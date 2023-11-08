drop database if exists wad2_project;
create database wad2_project;
use wad2_project;

-- change user and pass in connectionmanager

-- user table
CREATE TABLE IF NOT EXISTS user (
  user_id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  hashed_password varchar(256) NOT NULL,
  points int NOT NULL,
  badges json NOT NULL,
  tasks json NOT NULL,
  PRIMARY KEY (user_id)
);


-- badge table
CREATE TABLE IF NOT EXISTS badge (
  badge_id int NOT NULL AUTO_INCREMENT,
  badge_name varchar(50) NOT NULL,
  badge_type varchar(50) NOT NULL,
  badge_img varchar(50) NOT NULL,
  PRIMARY KEY (badge_id)
);
INSERT INTO badge (badge_name, badge_type, badge_img)
VALUES 
('Python 1', 'python', 'py1.png'),
('Python 2', 'python', 'py2.png'),
('Python 3', 'python', 'py3.png'),
('Python 4', 'python', 'py4.png'),
('JS 1', 'javascript', 'js1.png'),
('JS 2', 'javascript', 'js2.png'),
('JS 3', 'javascript', 'js3.png'),
('JS 4', 'javascript', 'js4.png'),
('PHP 1', 'php', 'php1.png'),
('PHP 2', 'php', 'php2.png'),
('PHP 3', 'php', 'php3.png'),
('PHP 4', 'php', 'php4.png'),
('SQL 1', 'sql', 'sql1.png'),
('SQL 2', 'sql', 'sql2.png'),
('SQL 3', 'sql', 'sql3.png'),
('SQL 4', 'sql', 'sql4.png');


CREATE TABLE IF NOT EXISTS course (
  course_id int NOT NULL AUTO_INCREMENT,
  playlist_url varchar(50) NOT NULL,
  course_title varchar(50) NOT NULL,
  course_description varchar(500) NOT NULL,
  course_badges json NOT NULL,
  PRIMARY KEY (course_id)
);


CREATE TABLE IF NOT EXISTS enrollment (
  enrollment_id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  course_id int NOT NULL,
  content json NOT NULL,
  start_date datetime NOT NULL,
  completed boolean NOT NULL,
  PRIMARY KEY (enrollment_id),
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (course_id) REFERENCES Course(course_id)
);

CREATE TABLE IF NOT EXISTS tasks (
  task_id int NOT NULL AUTO_INCREMENT,
  task_name varchar(50) NOT NULL,
  task_points int NOT NULL,
  PRIMARY KEY (task_id)
);
INSERT INTO tasks (task_name, task_points)
VALUES 
('Enroll into a course!', 500),
('Attempt a quiz!', 1500),
('Complete a course!', 2000),
('Obtain a badge!', 3000)
