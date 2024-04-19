CREATE DATABASE arogya_hospital;

USE arogya_hospital;

CREATE TABLE client_users(
	c_no INTEGER PRIMARY KEY AUTO_INCREMENT ,
    cf_name VARCHAR(100),
    cl_name VARCHAR(100),
    c_age INTEGER,
    c_gender VARCHAR(10),
    c_email VARCHAR(100),
    c_contact VARCHAR(10),
    ce_contact VARCHAR(10),
    c_un VARCHAR(30),
    c_pw VARCHAR(30)
);

DELETE FROM client_users WHERE c_no = 4;

SELECT * FROM client_users;
SELECT * FROM appointments;
SELECT * FROM doctor;

DROP TABLE appointments;

CREATE TABLE doctor(
	d_no INTEGER AUTO_INCREMENT PRIMARY KEY,
    df_name VARCHAR(100),
    dl_name VARCHAR(100),
    d_specialization VARCHAR(60)
);

INSERT INTO doctor(df_name,dl_name,d_specialization)VALUES("Ravindra","Perera","VP"),("Kasun","Piyathilaka","VP");

CREATE TABLE appointments(
	a_no INTEGER PRIMARY KEY AUTO_INCREMENT,
    c_no INTEGER,
    cf_name VARCHAR(100),
    d_no INTEGER,
    df_name VARCHAR(100),
    a_date DATE,
    a_time TIME,
    a_description VARCHAR(400),
    a_fee DECIMAL(18,2),
    a_state ENUM('Pending','Completed','Cancel'),
    
    FOREIGN KEY(c_no) REFERENCES client_users(c_no),
    FOREIGN KEY(d_no) REFERENCES doctor(d_no)
);



