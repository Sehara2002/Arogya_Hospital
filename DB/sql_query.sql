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
CREATE TABLE patient(
	p_id INT PRIMARY KEY AUTO_INCREMENT,
    p_fname VARCHAR(100),
    p_lname VARCHAR(100),
    p_nic VARCHAR(15),
    p_address VARCHAR(150),
    p_gender ENUM('Male','Female','Other'),
    p_email VARCHAR(60)
);
create TABLE ward(
	w_id INT PRIMARY KEY AUTO_INCREMENT,
    w_no VARCHAR(20),
    w_capacity INT
);

CREATE TABLE doctor_ward_assignment(
	assignment_id INT auto_increment PRIMARY KEY,
    d_no INT,
    w_id INT,
    
    foreign key(d_no) references doctor(d_no),
    foreign key(w_id) references ward(w_id)
);

CREATE TABLE patient_ward_admission(
	admission_id INT PRIMARY KEY AUTO_INCREMENT, 
    admitted_patient_id INT,
    admitted_ward_id INT,
    admitted_date DATE,
    admitted_time TIME,
    admission_state ENUM('Admitted','Discharged','Transfered'),
    
    FOREIGN KEY (admitted_ward_id) REFERENCES ward(w_id),
    FOREIGN KEY (admitted_patient_id) REFERENCES patient(p_id)
);


CREATE TABLE doctor_appointments(
	appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    d_no INT,
    a_no INT,
    
    FOREIGN KEY(d_no) REFERENCES doctor(d_no),
    FOREIGN KEY(a_no) REFERENCES appointment(a_no)
);

USE arogya_hospital;


DELIMITER $$
CREATE PROCEDURE addDoctor(dfname VARCHAR(50),dlname VARCHAR(50),dspec VARCHAR(100))
BEGIN
	INSERT INTO doctor(df_name,dl_name,d_specialization)VALUES(dfname,dlname,dspec);
END$$

DELIMITER ;

USE arogya_hospital;


DELIMITER $$
CREATE PROCEDURE addClient(cf_name VARCHAR(60),cl_name VARCHAR(60),c_age INT,c_gender VARCHAR(10),c_email VARCHAR(100),c_contact VARCHAR(10),ce_contact VARCHAR(10),c_un VARCHAR(100),c_pw VARCHAR(20))
BEGIN
	INSERT INTO client_users(cf_name,cl_name,c_age,c_gender,c_email,c_contact,ce_contact,c_un,c_pw) VALUES(cf_name,cl_name,c_age,c_gender,c_email,c_contact,ce_contact,c_un,c_pw);
	INSERT INTO login_user(SELECT c_no FROM client_users ORDER BY c_no DESC,c_un,c_pw,"client");
END$$
DELIMITER ;

DROP PROCEDURE addClient;


DELIMITER $$
CREATE PROCEDURE editClient(c_no INT, cf_name VARCHAR(60),cl_name VARCHAR(60),c_age INT,c_gender VARCHAR(10),c_email VARCHAR(100),c_contact VARCHAR(10),ce_contact VARCHAR(10),c_un VARCHAR(100),c_pw VARCHAR(20))
BEGIN
	UPDATE client_users SET cf_name = cf_name, cl_name=cl_name,c_age=c_age,c_gender=c_gender,c_email=c_email,c_contact = c_contact,ce_contact=ce_contact,c_un=c_un WHERE c_no=c_no;
END$$

DELIMITER ;

DELETE FROM client_users;

DELETE FROM appointments;


USE arogya_hospital;


SELECT * FROM client_users;

ALTER TABLE doctor ADD patient_capacity INT;
ALTER TABLE doctor ADD fee decimal(18,2);


SELECT * FROM doctor;

UPDATE doctor SET patient_capacity = 20 WHERE d_no IN (1,2);
UPDATE doctor SET fee = 2000.00 WHERE d_no IN (1,2);






SELECT * FROM appointments;
 


CALL placeAppointment(7,'Thanuka Perera',1,'Ravindra','2024-05-31','16:00','Nothing Special',2000.00,'Pending');

use arogya_hospital;

SELECT * FROM client_users c,appointments a WHERE c.c_no = a.c_no;


SELECT * FROM (client_users c INNER JOIN appointments a ON c.c_no = a.c_no) INNER JOIN doctor d ON d.d_no = a.d_no;










DELIMITER $$
CREATE PROCEDURE placeAppointment(c_no INT,cf_name VARCHAR(100),d_no INT,df_name VARCHAR(100),a_date DATE,a_time TIME,a_desc VARCHAR(400),a_fee DOUBLE(18,2),a_state VARCHAR(10))
BEGIN
	INSERT INTO appointments(c_no,cf_name,d_no,df_name,a_date,a_time,a_description,a_fee,a_state)VALUES(c_no,cf_name,d_no,df_name,a_date,a_time,a_desc,a_fee,a_state);
    SELECT a_no FROM appointments ORDER BY a_no DESC LIMIT 0,1;
END $$
DELIMITER ;

DROP PROCEDURE placeAppointment;


CREATE TABLE user_login(
	user_id INT,
    username VARCHAR(100),
    password varchar(16),
    role ENUM('client','admin'),
    CONSTRAINT client_FK FOREIGN KEY (user_id) REFERENCES client_users(c_no)
);

