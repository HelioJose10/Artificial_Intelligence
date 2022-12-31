DROP TABLE IF EXISTS filesContentB,
                     hashsB,
                     updatesB,
                     bcfilesContentB,
                     bchashsB,
                     bcupdatesB;
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
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk INT NOT NULL,
    FOREIGN KEY (file_hash_fk) REFERENCES hashsA(hash_id) ON DELETE NO ACTION
);


CREATE DATABASE backupA;
USE backupA;
DROP TABLE IF EXISTS filesContentB,
                     hashsB,
                     updatesB,
                     bcfilesContentB,
                     bchashsB,
                     bcupdatesB;

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
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk INT NOT NULL,
    FOREIGN KEY (file_hash_fk) REFERENCES bchashsA(hash_id) ON DELETE NO ACTION
);

DROP DATABASE IF EXISTS filesB, 
DROP DATABASE IF EXISTS backupB;
                        

