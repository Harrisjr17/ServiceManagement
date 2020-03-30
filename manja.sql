SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema manja_garage
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `customer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customer` ;

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` INT(11) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(30) NOT NULL,
  `lastname` VARCHAR(30) NOT NULL,
  `username` VARCHAR(40) NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `phone` VARCHAR(12) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `dateregister` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 39
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `employee` ;

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` INT(11) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(30) NOT NULL,
  `lastname` VARCHAR(30) NOT NULL,
  `username` VARCHAR(40) NOT NULL,
  `phone` INT(12) NOT NULL,
  `password` VARCHAR(70) NOT NULL,
  `email` VARCHAR(40) NOT NULL,
  `registered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` VARCHAR(40) NOT NULL,
  `expertize` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`employee_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `manufacturer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `manufacturer` ;

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` INT NOT NULL AUTO_INCREMENT,
  `manufacturer_name` VARCHAR(45) NULL,
  PRIMARY KEY (`manufacturer_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `spare`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spare` ;

CREATE TABLE IF NOT EXISTS `spare` (
  `spare_id` INT NOT NULL AUTO_INCREMENT,
  `spare_type` VARCHAR(45) NOT NULL,
  `spare_name` VARCHAR(45) NOT NULL,
  `spare_description` VARCHAR(45) NULL,
  `image` VARCHAR(45) NULL,
  `datecreated` VARCHAR(45) NULL,
  `availability` VARCHAR(45) NULL,
  `price` INT NULL,
  `stockin` VARCHAR(45) NULL,
  `stockout` VARCHAR(45) NULL,
  `remaining` VARCHAR(45) NULL,
  PRIMARY KEY (`spare_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `manufacturer_spares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `manufacturer_spares` ;

CREATE TABLE IF NOT EXISTS `manufacturer_spares` (
  `manufacturer_id` INT NOT NULL,
  `spare_id` INT NOT NULL,
  PRIMARY KEY (`manufacturer_id`, `spare_id`),
  INDEX `fk_manufacturer_has_spare_spare1_idx` (`spare_id` ASC),
  INDEX `fk_manufacturer_has_spare_manufacturer_idx` (`manufacturer_id` ASC),
  CONSTRAINT `fk_manufacturer_has_spare_manufacturer`
    FOREIGN KEY (`manufacturer_id`)
    REFERENCES `manufacturer` (`manufacturer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_manufacturer_has_spare_spare1`
    FOREIGN KEY (`spare_id`)
    REFERENCES `spare` (`spare_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `service`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service` ;

CREATE TABLE IF NOT EXISTS `service` (
  `service_id` INT NOT NULL AUTO_INCREMENT,
  `service_name` VARCHAR(45) NULL,
  `price` INT NULL,
  PRIMARY KEY (`service_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `packages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `packages` ;

CREATE TABLE IF NOT EXISTS `packages` (
  `package_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `price` INT NULL,
  PRIMARY KEY (`package_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `customer_service`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customer_service` ;

CREATE TABLE IF NOT EXISTS `customer_service` (
  `customer_id` INT(11) NOT NULL,
  `service_id` INT NOT NULL,
  `date` TIMESTAMP NULL,
  `totalcost` INT NULL,
  `employee_id` INT(11) NOT NULL,
  PRIMARY KEY (`customer_id`, `service_id`, `employee_id`),
  INDEX `fk_customer_has_service_service1_idx` (`service_id` ASC),
  INDEX `fk_customer_has_service_customer1_idx` (`customer_id` ASC),
  INDEX `fk_customer_service_employee1_idx` (`employee_id` ASC),
  CONSTRAINT `fk_customer_has_service_customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_has_service_service1`
    FOREIGN KEY (`service_id`)
    REFERENCES `service` (`service_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_service_employee1`
    FOREIGN KEY (`employee_id`)
    REFERENCES `employee` (`employee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `billing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `billing` ;

CREATE TABLE IF NOT EXISTS `billing` (
  `billing_id` INT NOT NULL AUTO_INCREMENT,
  `particulars` TEXT NOT NULL,
  `totalcost` VARCHAR(45) NOT NULL,
  `date` TIMESTAMP NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `customer_id` INT(11) NOT NULL,
  `service_id` INT NOT NULL,
  `employee_id` INT(11) NOT NULL,
  PRIMARY KEY (`billing_id`, `customer_id`, `service_id`, `employee_id`),
  INDEX `fk_billing_customer_service1_idx` (`customer_id` ASC, `service_id` ASC, `employee_id` ASC),
  CONSTRAINT `fk_billing_customer_service1`
    FOREIGN KEY (`customer_id` , `service_id` , `employee_id`)
    REFERENCES `customer_service` (`customer_id` , `service_id` , `employee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `booking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `booking` ;

CREATE TABLE IF NOT EXISTS `booking` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `service_has_packages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `service_has_packages` ;

CREATE TABLE IF NOT EXISTS `service_has_packages` (
  `service_id` INT NOT NULL,
  `package_id` INT NOT NULL,
  PRIMARY KEY (`service_id`, `package_id`),
  INDEX `fk_service_has_packages_packages1_idx` (`package_id` ASC),
  INDEX `fk_service_has_packages_service1_idx` (`service_id` ASC),
  CONSTRAINT `fk_service_has_packages_service1`
    FOREIGN KEY (`service_id`)
    REFERENCES `service` (`service_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_service_has_packages_packages1`
    FOREIGN KEY (`package_id`)
    REFERENCES `packages` (`package_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `order` ;

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NOT NULL,
  `orderdate` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `customer_id` INT(11) NOT NULL,
  `spare_id` INT NOT NULL,
  PRIMARY KEY (`order_id`, `customer_id`, `spare_id`),
  INDEX `fk_order_customer1_idx` (`customer_id` ASC),
  INDEX `fk_order_spare1_idx` (`spare_id` ASC),
  CONSTRAINT `fk_order_customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_spare1`
    FOREIGN KEY (`spare_id`)
    REFERENCES `spare` (`spare_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `customer_spares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customer_spares` ;

CREATE TABLE IF NOT EXISTS `customer_spares` (
  `spare_id` INT NOT NULL,
  `customer_id` INT(11) NOT NULL,
  `date` VARCHAR(45) NULL,
  PRIMARY KEY (`spare_id`, `customer_id`),
  INDEX `fk_spare_has_customer_customer1_idx` (`customer_id` ASC),
  INDEX `fk_spare_has_customer_spare1_idx` (`spare_id` ASC),
  CONSTRAINT `fk_spare_has_customer_spare1`
    FOREIGN KEY (`spare_id`)
    REFERENCES `spare` (`spare_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_spare_has_customer_customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
