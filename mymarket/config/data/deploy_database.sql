CREATE TABLE disbursement (
  id BIGINT PRIMARY KEY,
  amount FLOAT,
  status TEXT,
  timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  bank_code TEXT,
  account_number TEXT,
  beneficiary_name TEXT NOT NULL,
  remark TEXT,
  receipt TEXT,
  time_served TEXT NOT NULL,
  fee FLOAT
);