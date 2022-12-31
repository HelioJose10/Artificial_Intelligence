DROP TABLE IF EXISTS filesContentA,
                     hashsA,
                     updatesA,
                     bcfilesContentA,
                     bchashsA,
                     bcupdatesA;
CREATE TABLE filesContentB(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_content LONGBLOB NOT NULL
);

CREATE TABLE hashsB(
    hash_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk INT NOT NULL,
    FOREIGN KEY (file_fk) REFERENCES filesContentB(file_id) ON DELETE NO ACTION
);

CREATE TABLE updatesB(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk INT NOT NULL,
    FOREIGN KEY (file_hash_fk) REFERENCES hashsB(hash_id) ON DELETE NO ACTION
);


CREATE DATABASE backupB;
USE backupB;
DROP TABLE IF EXISTS filesContentA,
                     hashsA,
                     updatesA,
                     bcfilesContentA,
                     bchashsA,
                     bcupdatesA;

CREATE TABLE bcfilesContentB(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_content LONGBLOB NOT NULL
);

CREATE TABLE bchashsB(
    hash_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk INT NOT NULL,
    FOREIGN KEY (file_fk) REFERENCES bcfilesContentB(file_id) ON DELETE NO ACTION
);

CREATE TABLE bcupdatesB(
    file_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk INT NOT NULL,
    FOREIGN KEY (file_hash_fk) REFERENCES bchashsB(hash_id) ON DELETE NO ACTION
);

DROP DATABASE IF EXISTS filesA;
DROP DATABASE IF EXISTS backupA;