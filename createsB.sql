CHANGE MASTER TO MASTER_HOST='databaseA', 
MASTER_USER='replication_user', 
MASTER_PASSWORD='password', 
MASTER_LOG_FILE='log_file', MASTER_LOG_POS=log_pos; --log_file and log_pos to change manually 

START SLAVE;
