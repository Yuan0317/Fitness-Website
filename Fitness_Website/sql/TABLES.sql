CREATE TABLE users (
     email VARCHAR(255) PRIMARY KEY,
     name VARCHAR(255),
     password varchar(255),
     phone (255),
     gender(25)
);
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(255) NOT NULL,
    class_time VARCHAR(20) NOT NULL,
    user_email VARCHAR(255),
    FOREIGN KEY (user_email) REFERENCES users(email)
);

