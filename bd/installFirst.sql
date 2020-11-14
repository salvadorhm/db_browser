CREATE DATABASE pafg;
USE pafg;
CREATE TABLE IF NOT EXISTS `bases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(400) NOT NULL,
  `db` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO bases (host,db,user,pass) VALUES ("localhost","demo","root","toor");