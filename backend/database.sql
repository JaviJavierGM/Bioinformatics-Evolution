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

CREATE TABLE projects(
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255) NOT NULL,
    title VARCHAR(100) NOT NULL,
    aminoacid MEDIUMTEXT NOT NULL,
    space_type VARCHAR(50) NOT NULL,
    dimension_type VARCHAR(50) NOT NULL,
    optimization_algorithm VARCHAR(50) NOT NULL,
    selection_op VARCHAR(50) NOT NULL,
    crossover_op VARCHAR(50) NOT NULL,
    mutation_op VARCHAR(50) NOT NULL,
    elitism INT(1) DEFAULT NULL,
    clamp_mutation INT(1) DEFAULT NULL,
    caterpillar_mutation INT(1) DEFAULT NULL,
    conformations INT(25) NOT NULL,
    times_algorithm INT(25) NOT NULL,
    experiments INT(25) NOT NULL,
    sampling INT(25) DEFAULT NULL,
    percent_tournament INT(25),
    percent_best INT(25),
    crossover_probability DOUBLE NOT NULL,
    min_mutation_probability DOUBLE,
    max_mutation_probability DOUBLE,
    proximity_pairing DOUBLE,
    final_fitness DOUBLE,
    i_know_fitness INT(1) DEFAULT NULL,
    fitness_function VARCHAR(50) NOT NULL,
    alpha_value DOUBLE,
    mutation_probability DOUBLE,
    percent_elitism INT(25),
    upperLeftPoint VARCHAR(50),
    upperRightPoint VARCHAR(50),
    lowerLeftPoint VARCHAR(50),
    lowerRightPoint VARCHAR(50),
    fileNameCorrelatedNetwork VARCHAR(50),
    image VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL,
    CONSTRAINT pk_projects PRIMARY KEY(id),
    CONSTRAINT fk_project_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE results(
    id INT(255) AUTO_INCREMENT NOT NULL,
    project_id INT(255) NOT NULL,
    results JSON NOT NULL,
    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL,
    CONSTRAINT pk_results PRIMARY KEY(id),
    CONSTRAINT fk_results_project FOREIGN KEY(project_id) REFERENCES projects(id)
)ENGINE=InnoDb;