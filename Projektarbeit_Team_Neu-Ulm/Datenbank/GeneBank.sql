SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `GenBank` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `GenBank` ;

-- -----------------------------------------------------
-- Table `GenBank`.`MutP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenBank`.`MutP` (
  `idMutP` INT NOT NULL AUTO_INCREMENT,
  `Gene` VARCHAR(255) NULL,
  `Name` VARCHAR(45) NULL,
  `Location` VARCHAR(45) NULL,
  `Pos.` VARCHAR(45) NULL,
  `Type` VARCHAR(45) NULL,
  `Nuc Change` VARCHAR(45) NULL,
  `Coverage` VARCHAR(45) NULL,
  `AA Change` VARCHAR(45) NULL,
  `Condition` VARCHAR(45) NULL,
  `Hint` VARCHAR(45) NULL,
  `web Ref` VARCHAR(45) NULL,
  `HGVS nomenclatur` VARCHAR(45) NULL,
  `mut Entry` VARCHAR(45) NULL,
  `mut Effect` VARCHAR(45) NULL,
  `TValidtation` VARCHAR(45) NULL,
  `MValidation` VARCHAR(45) NULL,
  `Index` INT NULL,
  PRIMARY KEY (`idMutP`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GenBank`.`Patient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GenBank`.`Patient` (
  `idPatient` INT NOT NULL AUTO_INCREMENT,
  `MutP_idMutP` INT NOT NULL,
  PRIMARY KEY (`idPatient`),
  INDEX `fk_Patient_MutP_idx` (`MutP_idMutP` ASC),
  CONSTRAINT `fk_Patient_MutP`
    FOREIGN KEY (`MutP_idMutP`)
    REFERENCES `GenBank`.`MutP` (`idMutP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
