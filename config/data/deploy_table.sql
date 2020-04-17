CREATE TABLE disbursement (
  id BIGINT PRIMARY KEY,
  amount FLOAT,
  status TEXT,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  bank_code TEXT,
  account_number TEXT,
  beneficiary_name TEXT,
  remark TEXT,
  receipt TEXT,
  time_served TEXT,
  fee FLOAT
);
