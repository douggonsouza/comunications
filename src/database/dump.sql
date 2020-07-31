
CREATE TABLE IF NOT EXISTS `heartwood`.`qualitys` (
  `quality_id` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(15) NOT NULL,
  `description` VARCHAR(255) NULL,
  `active` TINYINT(1) NULL DEFAULT 1,
  `created` DATETIME NULL,
  PRIMARY KEY (`quality_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8

CREATE TABLE IF NOT EXISTS `heartwood`.`comunications` (
  `comunication_id` INT NOT NULL AUTO_INCREMENT,
  `quality_id` INT(11) NOT NULL,
  `receiver` INT(11) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `message` VARCHAR(120) NULL,
  `href` VARCHAR(255) NULL,
  `user_id` INT(11) NOT NULL,
  `active` INT(11) NULL DEFAULT '1',
  `created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comunication_id`),
  INDEX `fk_comunications_1_idx` (`quality_id` ASC),
  CONSTRAINT `fk_comunications_1`
    FOREIGN KEY (`quality_id`)
    REFERENCES `heartwood`.`qualitys` (`quality_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8