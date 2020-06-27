CREATE DATABASE online_notes;

USE online_notes;

CREATE TABLE NOTE (
    ID int NOT NULL AUTO_INCREMENT,
	owner_id LONGTEXT,
    title varchar(500),
    description varchar(65535),
	archived boolean,
	in_trash_can boolean,
	PRIMARY KEY (ID)
);

CREATE TABLE USER (
	ID int NOT NULL AUTO_INCREMENT,
	username varchar(250),
	password varchar(250),
	salt varchar(250),
	PRIMARY KEY (ID)
);

CREATE TABLE ADMIN(
	ID int NOT NULL AUTO_INCREMENT,
	username varchar(250),
	password varchar(250),
	salt varchar(250),
	PRIMARY KEY (ID)
);