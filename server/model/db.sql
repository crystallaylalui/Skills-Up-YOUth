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
INSERT INTO user (username, email, hashed_password, points, badges, tasks)
VALUES 
('AlexanderSmith', 'alexandersmith@email.com', '$2y$10$1YPckhzbJyeR1RE5XvvNfezdrm8saPRFg3Tc8dhpAMmTEwGx9zHme', 2100, '[1, 2, 3, 5]', '[[1, 1], [1, 1], [1, 1], [1, 1]]'),
('IsabellaLee', 'isabellalee@email.com', '$2y$10$R7LGtsshVZkyJ8zDMPkWi.Hdy514R4yrasjMdn4.hPJ4bjsUxPFfe', 51300, '[5, 6, 9, 10, 11, 12]', '[[1, 1], [1, 1], [1, 1], [1, 1]]'),
('OliviaWilson', 'oliviawilson@email.com', '$2y$10$ToKvSaYd4m5hAA9YWVQIxu3yrKujyLa57L4val10gvuazhkHgArki', 300, '[1, 2]', '[[1, 1], [1, 1], [1, 1], [1, 1]]'),
('DanielTaylor', 'danieltaylor@email.com', '$2y$10$7GzOYh9i4kZCOA2vsMmAkeCcHV11KvKkHaBXmbajvtY1onGJ6/IFC', 121500, '[1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12]', '[[1, 1], [1, 1], [1, 1], [1, 1]]'),
('BenjaminBrown', 'benjaminbrown@email.com', '$2y$10$rkKWtbt8DkMBIB45clRdUuA6r0BLuaeEDtwfdvWXVThyVab0MkXNO', 30200, '[1, 2, 5, 9, 17, 18]', '[[1, 1], [1, 1], [1, 1], [1, 1]]'),
('AvaThomas', 'avathomas@email.com', '$2y$10$sGrtWSDwz0fLkCcbNSykreMPMacV.iWSrx12fFqmPdva6gzS9aDXO', 3000, '[17, 18]', '[[1, 1], [1, 1], [1, 1], [1, 1]]'),
('AmeliaClark ', 'ameliaclark@email.com', '$2y$10$4Aoh/JcVap04oTojGJHomeh3Qu5ajvRL8CMX7SR0o4VH0fT/jvvJe', 23800, '[1, 2, 13, 14, 17, 18]', '[[1, 1], [1, 1], [1, 1], [1, 1]]');

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
('SQL 4', 'sql', 'sql4.png'),
('HTML 1', 'html', 'html1.png'),
('HTML 2', 'html', 'html2.png'),
('HTML 3', 'html', 'html3.png'),
('HTML 4', 'html', 'html4.png');


CREATE TABLE IF NOT EXISTS course (
  course_id int NOT NULL AUTO_INCREMENT,
  playlist_url varchar(50) NOT NULL,
  course_title varchar(50) NOT NULL,
  course_description varchar(500) NOT NULL,
  course_badges json NOT NULL,
  PRIMARY KEY (course_id)
);

INSERT INTO course (playlist_url, course_title, course_description, course_badges)
VALUES 
('PLWKjhJtqVAbleDe3_ZA8h3AO2rXar-q2V', 'Javascript Tutorial for Beginners', 'Embark on your coding journey with this beginner JavaScript tutorial. Complete the course and earn JS1 and JS2 badges!', '[5, 6]'),
('PL4cUxeGkcC9gksOX3Kd9KPo-O68ncT05o', 'PHP & MySQL Course - Beginner Introduction', 'Get introduced to PHP and MySQL in this beginner-friendly course. Earn PHP1 and SQL1 badges upon completion!', '[9, 13]'),
('PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB', 'HTML Course - Tutorial for Beginners', 'Embark on a beginner-friendly HTML journey with this course. Earn HTML1 and HTML2 badges upon completion!', '[17, 18]'),
('PLgCTlR71eB4-ZGpajuh01zexg8f9Qd98z', 'HTML + CSS Practice', 'Sharpen your HTML and CSS skills in this practice playlist. Complete the course to earn HTML2 and HTML3 badges!', '[18, 19]'),
('PL0Zuz27SZ-6N3bG4YZhkrCL3ZmDcLTuGd', 'Advanced Javascript Concepts', 'Dive into advanced JavaScript concepts with this comprehensive tutorial. Master the skills and earn the prestigious JS3 badge!', '[8]'),



CREATE TABLE IF NOT EXISTS enrollment (
  enrollment_id int NOT\ NULL AUTO_INCREMENT,
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
