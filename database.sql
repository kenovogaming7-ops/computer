-- Create database
CREATE DATABASE stp_computer_education;

USE stp_computer_education;

-- Create students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    enrollment_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sample data for students
INSERT INTO students (name, email) VALUES 
('Alice Johnson', 'alice.johnson@example.com'),
('Bob Smith', 'bob.smith@example.com'),
('Charlie Brown', 'charlie.brown@example.com');

-- Create courses table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sample data for courses
INSERT INTO courses (title, description) VALUES 
('Introduction to Programming', 'Learn the basics of programming using Python.'),
('Database Management Systems', 'Introduction to relational database concepts and SQL.'),
('Web Development', 'Learn how to create websites using HTML, CSS, and JavaScript.');

-- Create enrollments table
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    enrollment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Sample data for enrollments
INSERT INTO enrollments (student_id, course_id) VALUES 
(1, 1),
(1, 2),
(2, 1),
(3, 3);

-- Create contact_messages table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id)
);

-- Sample data for contact messages
INSERT INTO contact_messages (student_id, message) VALUES 
(1, 'I need help with my assignment.'),
(2, 'Can I get more information about the courses?'),
(3, 'I would like to speak with an advisor.');
