DROP TABLE IF EXISTS logs;

CREATE TABLE `logs` (
  id int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  channel varchar(50) NOT NULL DEFAULT '',
  username varchar(50) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  UNIQUE KEY id (id)
);