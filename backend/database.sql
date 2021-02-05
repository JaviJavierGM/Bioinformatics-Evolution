CREATE DATABASE IF NOT EXISTS bioinformatics_evolution;
USE bioinformatics_evolution;

CREATE TABLE users(
id  INT(255) AUTO_INCREMENT NOT NULL,
name    VARCHAR(50) NOT NULL,
surname VARCHAR(100),
role    VARCHAR(20),
email   VARCHAR(255) NOT NULL,
password    VARCHAR(255) NOT NULL,
description TEXT,
image   VARCHAR(255),
created_at DATETIME DEFAULT NULL,
updated_at  DATETIME DEFAULT NULL,
remember_token  VARCHAR(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

ALTER TABLE `users` ADD `confirmed` BOOLEAN NULL DEFAULT NULL AFTER `remember_token`, ADD `confirmation_code` VARCHAR(255) NULL DEFAULT NULL AFTER `confirmed`; 