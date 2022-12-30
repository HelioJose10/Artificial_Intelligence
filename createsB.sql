USE filesB;
CREATE TABLE updatesB(
    file_id SERIAL PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk BIGINT(20)
);

CREATE TABLE hashsB(
    hash_id SERIAL PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk BIGINT(20)
);

CREATE TABLE filesContentB(
    file_id SERIAL PRIMARY KEY,
    file_content FILESTREAM NOT NULL
);

--constraints
ALTER TABLE updatesB
ADD CONSTRAINT updatesB_fk_hashsB
FOREIGN KEY (file_hash_fk) REFERENCES hashsB(hash_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE hashsB
ADD CONSTRAINT hashsB_fk_filesContentB
FOREIGN KEY (file_fk) REFERENCES filesContentB(file_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

--choosing database backupB
CREATE DATABASE backupB;
USE backupB;

CREATE TABLE bcupdatesB(
    file_id SERIAL PRIMARY KEY,
    file_title CHAR(100) NOT NULL,
    file_author CHAR(40) NOT NULL,
    file_type CHAR(20) NOT NULL,
    file_updated INTEGER NOT NULL,
    submission_date DATE NOT NULL,
    file_hash_fk BIGINT(20)
);

CREATE TABLE bchashsB(
    hash_id SERIAL PRIMARY KEY,
    hash_1 CHAR(56) NOT NULL,
    hash_2 CHAR(200) NOT NULL,
    file_fk BIGINT(20)
);

CREATE TABLE bcfilesContentB(
    file_id SERIAL PRIMARY KEY,
    file_content FILESTREAM NOT NULL
);

--constraints
ALTER TABLE bcupdatesB
ADD CONSTRAINT bcupdatesB_fk_bchashsB
FOREIGN KEY (file_hash_fk) REFERENCES bchashsB(hash_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE bchashsB
ADD CONSTRAINT bchashsB_fk_bcfilesContentB
FOREIGN KEY (file_fk) REFERENCES bcfilesContentB(file_id)
ON DELETE NO ACTION ON UPDATE NO ACTION;