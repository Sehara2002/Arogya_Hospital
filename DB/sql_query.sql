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

