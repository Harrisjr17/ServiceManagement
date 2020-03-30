

Table service

CREATE TABLE IF NOT EXISTS service (
  service_id INT(11) NOT NULL AUTO_INCREMENT,
  service_name VARCHAR(45) NULL DEFAULT NULL,
  price INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (service_id));

Table customer

CREATE TABLE IF NOT EXISTS customer (
  customer_id INT(11) NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  username VARCHAR(40) NOT NULL,
  email VARCHAR(70) NOT NULL,
  gender VARCHAR(45) NOT NULL,
  phone VARCHAR(12) NOT NULL,
  password VARCHAR(100) NOT NULL,
  dateregister TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (customer_id));

Table manufacturer

CREATE TABLE IF NOT EXISTS manufacturer (
  manufacturer_id INT(11) NOT NULL AUTO_INCREMENT,
  manufacturer_name VARCHAR(45) NULL DEFAULT NULL,
  type VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (manufacturer_id));

Table vehicle

CREATE TABLE IF NOT EXISTS vehicle (
  vehicle_id INT(11) NOT NULL AUTO_INCREMENT,
  model VARCHAR(45) NULL DEFAULT NULL,
  year YEAR NULL DEFAULT NULL,
  image VARCHAR(45) NULL DEFAULT NULL,
  other_info VARCHAR(45) NULL DEFAULT NULL,
  licence_number VARCHAR(45) NULL DEFAULT NULL,
  customer_id INT(11) NOT NULL,
  manufacturer_id INT(11) NOT NULL,
  PRIMARY KEY (vehicle_id),
  FOREIGN KEY (customer_id)REFERENCES customer (customer_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (manufacturer_id)REFERENCES manufacturer (manufacturer_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table employee

CREATE TABLE IF NOT EXISTS employee (
  employee_id INT(11) NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  username VARCHAR(40) NOT NULL,
  phone INT(12) NOT NULL,
  password VARCHAR(70) NOT NULL,
  email VARCHAR(40) NOT NULL,
  registered TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  type VARCHAR(40) NOT NULL,
  expertize VARCHAR(45) NOT NULL,
  PRIMARY KEY (employee_id));

Table vehicle_service

CREATE TABLE IF NOT EXISTS vehicle_service (
  vehicle_id INT(11) NOT NULL,
  service_id INT(11) NOT NULL,
  date TIMESTAMP NULL DEFAULT NULL,
  employee_id INT(11) NOT NULL,
  PRIMARY KEY (vehicle_id, service_id),
    FOREIGN KEY (service_id)REFERENCES service(service_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (vehicle_id)REFERENCES vehicle (vehicle_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (employee_id)REFERENCES employee (employee_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table billing

CREATE TABLE IF NOT EXISTS billing (
  billing_id INT(11) NOT NULL AUTO_INCREMENT,
  particulars TEXT NOT NULL,
  totalcost VARCHAR(45) NOT NULL,
  date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status VARCHAR(45) NOT NULL,
  vehicle_id INT(11) NOT NULL,
  service_id INT(11) NOT NULL,
  PRIMARY KEY (billing_id),
  FOREIGN KEY (vehicle_id , service_id)REFERENCES vehicle_service (vehicle_id , service_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table `topic`

CREATE TABLE IF NOT EXISTS topic (
  topic_id INT(11) NOT NULL AUTO_INCREMENT,
  subject VARCHAR(45) NOT NULL,
  date TIMESTAMP NULL DEFAULT NULL,
  customer_id INT(11) NOT NULL,
  PRIMARY KEY (topic_id),
    FOREIGN KEY (customer_id)
    REFERENCES customer (customer_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table comment

CREATE TABLE IF NOT EXISTS comment(
  comment_id INT(11) NOT NULL AUTO_INCREMENT,
  comment VARCHAR(45) NULL DEFAULT NULL,
  date TIMESTAMP NULL DEFAULT NULL,
  topic_id INT(11) NOT NULL,
  PRIMARY KEY (comment_id),
    FOREIGN KEY (topic_id)
    REFERENCES topic (topic_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table spare

CREATE TABLE IF NOT EXISTS spare (
  spare_id INT(11) NOT NULL AUTO_INCREMENT,
  spare_type VARCHAR(45) NOT NULL,
  spare_name VARCHAR(45) NOT NULL,
  spare_description VARCHAR(45) NULL DEFAULT NULL,
  image VARCHAR(45) NULL DEFAULT NULL,
  datecreated VARCHAR(45) NULL DEFAULT NULL,
  availability VARCHAR(45) NULL DEFAULT NULL,
  price INT(11) NULL DEFAULT NULL,
  stockin VARCHAR(45) NULL DEFAULT NULL,
  stockout VARCHAR(45) NULL DEFAULT NULL,
  remaining VARCHAR(45) NULL DEFAULT NULL,
  manufacturer_id INT(11) NOT NULL,
  PRIMARY KEY (spare_id),
  FOREIGN KEY (manufacturer_id)REFERENCES manufacturer (manufacturer_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table order

CREATE TABLE IF NOT EXISTS order(
  order_id INT(11) NOT NULL AUTO_INCREMENT,
  quantity INT(11) NOT NULL,
  orderdate VARCHAR(45) NULL DEFAULT NULL,
  status VARCHAR(45) NULL DEFAULT NULL,
  customer_id INT(11) NOT NULL,
  spare_id INT(11) NOT NULL,
  PRIMARY KEY (order_id),
  FOREIGN KEY (customer_id)REFERENCES customer (customer_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (spare_id)REFERENCES spare (spare_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

Table service_track

CREATE TABLE IF NOT EXISTS service_track (
  id INT(11) NOT NULL,
  status VARCHAR(45) NULL DEFAULT NULL,
  comments VARCHAR(45) NULL DEFAULT NULL,
  postdate TIMESTAMP NULL DEFAULT NULL,
  vehicle_id INT(11) NOT NULL,
  service_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (vehicle_id, service_id)REFERENCES vehicle_service (vehicle_id , service_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
