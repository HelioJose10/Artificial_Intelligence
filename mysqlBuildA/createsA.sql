--choosing database A
USE filesA;
CREATE TABLE updatesA(
    file_id SERIAL PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk BIGINT(20)
);

CREATE TABLE hashsA(
    hash_id SERIAL PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk BIGINT(20)
);

CREATE TABLE filesContentA(
    file_id SERIAL PRIMARY KEY,
    file_content FILESTREAM NOT NULL
);

--constraints
ALTER TABLE updatesA
ADD CONSTRAINT updatesA_fk_hashsA
FOREIGN KEY (file_hash_fk) REFERENCES hashsA(hash_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE hashsA
ADD CONSTRAINT hashsA_fk_filesContentA
FOREIGN KEY (file_fk) REFERENCES filesContentA(file_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

--choosing database backupA
CREATE DATABASE backupA;
USE backupA;

CREATE TABLE bcupdatesA(
    file_id SERIAL PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk BIGINT(20)
);

CREATE TABLE bchashsA(
    hash_id SERIAL PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk BIGINT(20)
);

CREATE TABLE bcfilesContentA(
    file_id SERIAL PRIMARY KEY,
    file_content FILESTREAM NOT NULL
);

--constraints
ALTER TABLE bcupdatesA
ADD CONSTRAINT bcupdatesA_fk_bchashsA
FOREIGN KEY (file_hash_fk) REFERENCES bchashsA(hash_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE bchashsA
ADD CONSTRAINT bchashsA_fk_bcfilesContentA
FOREIGN KEY (file_fk) REFERENCES bcfilesContentA(file_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;