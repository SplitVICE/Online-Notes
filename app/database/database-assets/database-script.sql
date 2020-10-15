CREATE DATABASE online_notes;

USE online_notes;

-- Table which holds notes.
CREATE TABLE NOTE (
    ID int NOT NULL AUTO_INCREMENT,
	owner_id LONGTEXT,
    title varchar(500),
    description varchar(65535),
	archived boolean,
	in_trash_can boolean,
	PRIMARY KEY (ID)
);

-- Users info table.
CREATE TABLE USER (
	ID int NOT NULL AUTO_INCREMENT,
	username varchar(250),
	password varchar(250),
	salt varchar(250),
	PRIMARY KEY (ID)
);

-- Session tokens to persist user's sessions.
CREATE TABLE SESSION(
	ID int NOT NULL AUTO_INCREMENT,
	user_id varchar(250),
	user_username varchar(250),
	token varchar(250),
	PRIMARY KEY (ID)
);

-- API connection token to use an user credentials
-- with API. Just to store and to read notes.
CREATE TABLE API_CONNECTION_TOKEN(
	ID int NOT NULL AUTO_INCREMENT,
	user_id varchar(250),
	token varchar(250),
	ReadPermission TINYINT,
	PublishPermission TINYINT,
	DeletePermission TINYINT,
	PRIMARY KEY (ID)
);