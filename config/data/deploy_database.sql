CREATE DATABASE mymarket;

use mymarket;

CREATE TABLE bank_transfer_information (
  id INT AUTO_INCREMENT PRIMARY KEY,
  bank_code TEXT,
  account_number TEXT,
  beneficiary_name datetime NOT NULL
  );


CREATE TABLE disbursement (
  id INT AUTO_INCREMENT PRIMARY KEY,
  amount FLOAT,
  status TEXT,
  timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  remark TEXT,
  receipt TEXT,
  time_served TEXT NOT NULL,
  fee FLOAT,
  bank_transfer_information_id INT,
  CONSTRAINT fk_bank_transfer_information
  FOREIGN KEY (bank_transfer_information_id)
          REFERENCES bank_transfer_information(id)
          ON DELETE CASCADE
);