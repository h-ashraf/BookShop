CREATE DATABASE WEBSITE1;

CREATE TABLE credit_cards (
  id INT(11) NOT NULL AUTO_INCREMENT,
  card_number VARCHAR(16) NOT NULL,
  expiry_month INT(2) NOT NULL,
  expiry_year INT(4) NOT NULL,
  security_code VARCHAR(4) NOT NULL,
  PRIMARY KEY (id)
);