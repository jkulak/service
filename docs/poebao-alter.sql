SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `my_7727`.`posts` DROP COLUMN `flag_nsfw` , ADD COLUMN `flag_nsfw` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0  AFTER `category` , ADD COLUMN `attachment_id` INT(11) NULL DEFAULT NULL  AFTER `agreement` ;

CREATE  TABLE IF NOT EXISTS `my_7727`.`attachments` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `filename` VARCHAR(255) NOT NULL ,
  `added` VARCHAR(45) NULL DEFAULT NULL ,
  `original_mime` VARCHAR(45) NULL DEFAULT NULL ,
  `original_size_x` VARCHAR(45) NULL DEFAULT NULL ,
  `original_size_y` VARCHAR(45) NULL DEFAULT NULL ,
  `original_filesize` VARCHAR(45) NULL DEFAULT NULL ,
  `source` VARCHAR(1000) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
