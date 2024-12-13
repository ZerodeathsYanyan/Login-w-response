CREATE TABLE titser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password TEXT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);
CREATE TABLE students (
	student_id INT AUTO_INCREMENT PRIMARY KEY,
    namefirst VARCHAR(255),
    namelast VARCHAR(255),
    schoolyear INT,
	address VARCHAR(255),
	department VARCHAR(255),
	contact_number VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	added_by VARCHAR(255),
	last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	last_updated_by VARCHAR(255)
);

CREATE TABLE activity_logs (
    activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
    operation VARCHAR(255),
    student_id VARCHAR(255),
    namefirst VARCHAR(255),
    namelast VARCHAR(255),
    schoolyear INT,
    address VARCHAR(255),
	department VARCHAR(255),
	contact_number VARCHAR(255),
    username VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);



