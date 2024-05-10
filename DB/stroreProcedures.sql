CREATE PROCEDURE Select_user (user_id INT)
BEGIN
	SELECT * FROM client_users WHERE c_no = user_id;
END
