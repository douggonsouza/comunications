
DROP TABLE IF EXISTS `comunications`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `qualitys`;

CREATE TABLE `qualitys` (
  `quality_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(15) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`quality_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comunications` (
  `comunication_id` int(11) NOT NULL AUTO_INCREMENT,
  `quality_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `message` varchar(120) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  `read` tinyint(1) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comunication_id`),
  KEY `fk_comunications_1_idx` (`quality_id`),
  CONSTRAINT `fk_comunications_1` FOREIGN KEY (`quality_id`) REFERENCES `qualitys` (`quality_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


