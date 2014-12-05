-- MySQL Script generated by MySQL Workbench
-- Fri Dec  5 10:20:16 2014
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema wintertourtennis
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `wintertourtennis_tipologie_soci`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_tipologie_soci` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_tipologie_soci` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(35) NOT NULL,
  `descrizione` VARCHAR(125) NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_soci`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_soci` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_soci` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(35) NOT NULL,
  `cognome` VARCHAR(35) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `tipologia` INT NULL,
  `saldo` DOUBLE NULL DEFAULT 0,
  `indirizzo` VARCHAR(64) NOT NULL,
  `citta` VARCHAR(64) NOT NULL,
  `cap` CHAR(5) NOT NULL,
  `provincia` CHAR(2) NOT NULL,
  `telefono` VARCHAR(16) NULL,
  `cellulare` VARCHAR(16) NOT NULL,
  `statoattivo` TINYINT(1) NULL DEFAULT 0,
  `datanascita` DATE NOT NULL,
  `cittanascita` VARCHAR(64) NULL,
  `dataiscrizione` DATE NULL,
  `codicefiscale` CHAR(16) NOT NULL,
  `dataimmissione` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `certificatomedico` TINYINT(1) NULL DEFAULT 0,
  `domandaassociazione` DATE NULL,
  `token` CHAR(32) NULL,
  `sesso` CHAR(1) NULL,
  `tessera` TINYINT(1) NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertour_soci_wintertour_tipologie_soci_idx` (`tipologia` ASC),
  UNIQUE INDEX `codicefiscale_UNIQUE` (`codicefiscale` ASC),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_wintertour_soci_wintertour_tipologie_soci`
    FOREIGN KEY (`tipologia`)
    REFERENCES `wintertourtennis_tipologie_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_circoli`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_circoli` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_circoli` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(70) NOT NULL,
  `indirizzo` VARCHAR(64) NOT NULL,
  `citta` VARCHAR(64) NOT NULL,
  `cap` CHAR(5) NOT NULL,
  `provincia` CHAR(2) NOT NULL,
  `nomereferente` VARCHAR(35) NULL,
  `cognomereferente` VARCHAR(35) NULL,
  `telefono` VARCHAR(16) NULL,
  `cellulare` VARCHAR(16) NULL,
  `email` VARCHAR(254) NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_tornei`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_tornei` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_tornei` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `datainizio` DATE NOT NULL,
  `datafine` DATE NOT NULL,
  `circolo` INT NOT NULL,
  `nometorneo` VARCHAR(75) NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertour_tornei_wintertour_circoli1_idx` (`circolo` ASC),
  CONSTRAINT `fk_wintertour_tornei_wintertour_circoli1`
    FOREIGN KEY (`circolo`)
    REFERENCES `wintertourtennis_circoli` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_iscritti_newsletter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_iscritti_newsletter` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_iscritti_newsletter` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(254) NULL,
  `nome` VARCHAR(35) NULL,
  `cognome` VARCHAR(35) NULL,
  `socio` INT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertourtennis_iscritti_newsletter_wintertourtennis_so_idx` (`socio` ASC),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  CONSTRAINT `fk_wintertourtennis_iscritti_newsletter_wintertourtennis_soci1`
    FOREIGN KEY (`socio`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_incontri`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_incontri` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_incontri` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `torneo` INT NOT NULL,
  `giocatore1` INT NOT NULL,
  `giocatore2` INT NOT NULL,
  `giocatore3` INT NULL,
  `giocatore4` INT NULL,
  `arbitro` INT NULL,
  `dataeorainizio` DATETIME NOT NULL,
  `scontrodoppio` TINYINT(1) NULL,
  `almegliodicinque` TINYINT(1) NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertour_incontri_wintertour_tornei1_idx` (`torneo` ASC),
  INDEX `fk_wintertour_incontri_wintertour_soci1_idx` (`giocatore1` ASC),
  INDEX `fk_wintertour_incontri_wintertour_soci2_idx` (`giocatore2` ASC),
  INDEX `fk_wintertour_incontri_wintertour_soci3_idx` (`arbitro` ASC),
  INDEX `fk_wintertour_incontri_wintertour_soci4_idx` (`giocatore3` ASC),
  INDEX `fk_wintertour_incontri_wintertour_soci5_idx` (`giocatore4` ASC),
  CONSTRAINT `fk_wintertour_incontri_wintertour_tornei1`
    FOREIGN KEY (`torneo`)
    REFERENCES `wintertourtennis_tornei` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertour_incontri_wintertour_soci1`
    FOREIGN KEY (`giocatore1`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertour_incontri_wintertour_soci2`
    FOREIGN KEY (`giocatore2`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertour_incontri_wintertour_soci3`
    FOREIGN KEY (`arbitro`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertour_incontri_wintertour_soci4`
    FOREIGN KEY (`giocatore3`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertour_incontri_wintertour_soci5`
    FOREIGN KEY (`giocatore4`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wintertourtennis_turni`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_turni` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_turni` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `circolo` INT NOT NULL,
  `categoria` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertour_turni_wintertourtennis_circoli1_idx` (`circolo` ASC),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  UNIQUE INDEX `data_UNIQUE` (`data` ASC),
  CONSTRAINT `fk_wintertour_turni_wintertourtennis_circoli1`
    FOREIGN KEY (`circolo`)
    REFERENCES `wintertourtennis_circoli` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_set`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_set` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_set` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `partitesquadra1` TINYINT(1) NOT NULL,
  `partitesquadra2` TINYINT(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wintertourtennis_risultati`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_risultati` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_risultati` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `giocatore1` INT NOT NULL,
  `giocatore2` INT NOT NULL,
  `giocatore3` INT NULL DEFAULT NULL,
  `giocatore4` INT NULL DEFAULT NULL,
  `turno` INT NOT NULL,
  `set1` INT NOT NULL,
  `set2` INT NOT NULL,
  `set3` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_turni1_idx` (`turno` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_soci1_idx` (`giocatore1` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_soci2_idx` (`giocatore2` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_soci3_idx` (`giocatore3` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_soci4_idx` (`giocatore4` ASC),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_set1_idx` (`set1` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_set2_idx` (`set2` ASC),
  INDEX `fk_wintertourtennis_risultati_wintertourtennis_set3_idx` (`set3` ASC),
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_turni1`
    FOREIGN KEY (`turno`)
    REFERENCES `wintertourtennis_turni` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_soci1`
    FOREIGN KEY (`giocatore1`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_soci2`
    FOREIGN KEY (`giocatore2`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_soci3`
    FOREIGN KEY (`giocatore3`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_soci4`
    FOREIGN KEY (`giocatore4`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_set1`
    FOREIGN KEY (`set1`)
    REFERENCES `wintertourtennis_set` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_set2`
    FOREIGN KEY (`set2`)
    REFERENCES `wintertourtennis_set` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_risultati_wintertourtennis_set3`
    FOREIGN KEY (`set3`)
    REFERENCES `wintertourtennis_set` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wintertourtennis_socio_partecipa_torneo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_socio_partecipa_torneo` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_socio_partecipa_torneo` (
  `socio` INT NOT NULL,
  `torneo` INT NOT NULL,
  PRIMARY KEY (`socio`, `torneo`),
  INDEX `fk_wintertourtennis_soci_has_wintertourtennis_tornei_winter_idx` (`torneo` ASC),
  INDEX `fk_wintertourtennis_soci_has_wintertourtennis_tornei_winter_idx1` (`socio` ASC),
  CONSTRAINT `fk_wintertourtennis_soci_has_wintertourtennis_tornei_winterto1`
    FOREIGN KEY (`socio`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_soci_has_wintertourtennis_tornei_winterto2`
    FOREIGN KEY (`torneo`)
    REFERENCES `wintertourtennis_tornei` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_tessere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_tessere` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_tessere` (
  `numerotessera` VARCHAR(75) NOT NULL,
  `socio` INT NOT NULL,
  INDEX `fk_wintertourtennis_tessere_wintertourtennis_soci1_idx` (`socio` ASC),
  PRIMARY KEY (`numerotessera`),
  CONSTRAINT `fk_wintertourtennis_tessere_wintertourtennis_soci1`
    FOREIGN KEY (`socio`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `wintertourtennis_punteggi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wintertourtennis_punteggi` ;

CREATE TABLE IF NOT EXISTS `wintertourtennis_punteggi` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `punteggio` INT NULL DEFAULT 0,
  `socio` INT NOT NULL,
  `turno` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_wintertourtennis_punteggi_wintertourtennis_soci1_idx` (`socio` ASC),
  INDEX `fk_wintertourtennis_punteggi_wintertourtennis_turni1_idx` (`turno` ASC),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  CONSTRAINT `fk_wintertourtennis_punteggi_wintertourtennis_soci1`
    FOREIGN KEY (`socio`)
    REFERENCES `wintertourtennis_soci` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wintertourtennis_punteggi_wintertourtennis_turni1`
    FOREIGN KEY (`turno`)
    REFERENCES `wintertourtennis_turni` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Placeholder table for view `wintertourtennis_classifica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wintertourtennis_classifica` (`ID` INT, `nome` INT, `cognome` INT, `punteggio` INT);

-- -----------------------------------------------------
-- Placeholder table for view `wintertourtennis_parziali`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wintertourtennis_parziali` (`ID` INT, `punteggio` INT);

-- -----------------------------------------------------
-- View `wintertourtennis_classifica`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `wintertourtennis_classifica` ;
DROP TABLE IF EXISTS `wintertourtennis_classifica`;
CREATE  OR REPLACE VIEW `wintertourtennis_classifica` AS
SELECT `wintertourtennis_soci`.`ID`, `nome`, `cognome`, `wintertourtennis_parziali`.`punteggio` FROM `wintertourtennis_soci` LEFT JOIN `wintertourtennis_parziali` ON `wintertourtennis_soci`.`ID`=`wintertourtennis_parziali`.`ID` WHERE `wintertourtennis_soci`.`ID` IN (SELECT `socio` FROM `wintertourtennis_punteggi`) ORDER BY `punteggio` DESC;

-- -----------------------------------------------------
-- View `wintertourtennis_parziali`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `wintertourtennis_parziali` ;
DROP TABLE IF EXISTS `wintertourtennis_parziali`;
CREATE  OR REPLACE VIEW `wintertourtennis_parziali` AS
SELECT `socio` AS `ID`, SUM(`punteggio`) AS `punteggio` FROM `wintertourtennis_punteggi` GROUP BY `socio`;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
