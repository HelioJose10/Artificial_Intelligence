
CREATE TABLE filesContentA(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_content LONGBLOB NOT NULL
);

CREATE TABLE hashsA(
    hash_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk INT NOT NULL,
    FOREIGN KEY (file_fk) REFERENCES filesContentA(file_id) ON DELETE NO ACTION
);

CREATE TABLE updatesA(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    submission_date CHAR(30) NOT NULL,
    file_hash_fk INT NOT NULL,
    FOREIGN KEY (file_hash_fk) REFERENCES hashsA(hash_id) ON DELETE NO ACTION
);


CREATE DATABASE backupA;
USE backupA;

CREATE TABLE bcfilesContentA(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_content LONGBLOB NOT NULL
);

CREATE TABLE bchashsA(
    hash_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk INT NOT NULL,
    FOREIGN KEY (file_fk) REFERENCES bcfilesContentA(file_id) ON DELETE NO ACTION
);

CREATE TABLE bcupdatesA(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date CHAR(30) NOT NULL,
    file_hash_fk INT NOT NULL,
    FOREIGN KEY (file_hash_fk) REFERENCES bchashsA(hash_id) ON DELETE NO ACTION
);

CREATE USER 'replication_user'@'%' IDENTIFIED BY 'password';
GRANT REPLICATION SLAVE ON *.* TO 'replication_user'@'%';
FLUSH TABLES WITH READ LOCK;
SHOW MASTER STATUS;
UNLOCK TABLES;
SET GLOBAL server_id = 3;
                        

