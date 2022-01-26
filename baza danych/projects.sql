CREATE TABLE projects (
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	project_name VARCHAR(255) NOT NULL,
	start_date DATETIME,
	end_date DATETIME,
	client_id int(11),
	finished int(11),
	PRIMARY KEY (id))