CREATE TABLE IF NOT EXISTS `user` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role VARCHAR(255) NOT NULL
    )  ENGINE=INNODB;

INSERT INTO `user` (`username`, `password`,`created_at`, `role`) VALUES ('cindy', 'sindi123', current_timestamp(), 'admin');
INSERT INTO `user` (`username`, `password`,`created_at`, `role`) VALUES ('klaus', 'klaus123', current_timestamp(), 'admin');
INSERT INTO `user` (`username`, `password`,`created_at`, `role`) VALUES ('ciku', 'ciku123', current_timestamp(), 'user');

