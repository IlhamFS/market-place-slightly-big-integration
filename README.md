# A Market Place and Slightly Big Flip Integration
## Problem Statement
1. Your service will send the disbursement data to the 3rd party API
2. Your service will then, save the detailed data about the disbursement from the 3rd party, in your local database
3. Your service will also have the capability to check the disbursement status, and update the information on your database according to the response you get
### Rules
* You should use PHP to work on this assignment
* You are not allowed to use any framework or any external libraries
* You must save the information you get from the API response, to your local database
* You must update the information you get from the disbursement status endpoint, to the related transaction in your local database
* The information that must be updated when you check the disbursement status are the following:
  * status
  * receipt
  * time_served
* You must use git when working on the project
## NOTES
Please contact me at `ilhamfathys@gmail.com` if you have difficulties running this demo.
## Folder Structure
```
/api/disbursement/*
```

Code related to disburse API implementation. There are 3 APIs: read, disburse, and update.
```
/api/utils/*
```
Code related to API utilities. For now, just a wrapper to call 3rd party api.
```
/config/*
```

Code related to database setup.
```
/objects/*
```

Code related to object abstraction for the api. For now, it's for `disbursement` object only.

## How To Run
### Prerequisites:
1. PHP >= 7.3.9 Installed (I use PHP 7.3.9 and cannot ensure other version compatibility)
2. MySql Installed (Mine is Ver 8.0.19).
3. Make sure to clone this repo and you are in the repo folder (market-place-slightly-big-integration)

### Database Set Up in Config File:
Setting db user:
1. `cd config`
2. open `app.ini` with text editor or `nano`.
3. change value in the config file according to your mysql host and a user that has enough privileges. The default database is `mymarket`, so make sure you don't have similar database in your local.
4. Run `php migration.php`, it will create database and table.
5. Back to top folder `cd ..`.

### Run:
Make sure you are in the top repo folder (market-place-slightly-big-integration/)
```
php -S 0.0.0.0:8080
```
### How To and Examples
#### Problem 1: Send Disbursement Data and Saved it to Database
Run this in your terminal (different terminal from the one you run `php -S 0.0.0.0:8080`) / use Postman:
```
curl --header "Content-Type: application/json" -d "{\"bank_code\":\"bni\", \"account_number\":\"123\", \"amount\": 1000, \"remark\":\"TEST\"}" http://0.0.0.0:8080/api/disbursement/disburse.php
```
Response:
```
{"message":"Disbursement was created.","disbursement":{"id":"8586634721","amount":"1000","status":"PENDING","timestamp":"2020-04-17 11:48:07","remark":"TEST","bank_code":"bni","account_number":"123","beneficiary_name":"PT FLIP","receipt":"","time_served":"0000-00-00 00:00:00","fee":"4000"}}
```
#### Problem 2: Check Inserted Data
Run this in your terminal (different terminal from the one you run `php -S 0.0.0.0:8080`) / use Postman:
```
curl http://0.0.0.0:8080/api/disbursement/read.php
```
Response:
```
{"disbursements":[{"id":"8586634721","amount":"1000","status":"PENDING","timestamp":"2020-04-17 11:48:07","remark":"TEST","bank_code":"bni","account_number":"123","beneficiary_name":"PT FLIP","receipt":"","time_served":"0000-00-00 00:00:00","fee":"4000"}]}
```
#### Problem 3: Check Status and Update Data
Run this in your terminal (different terminal from the one you run `php -S 0.0.0.0:8080`) / use Postman to check status and update data:
```
curl --header "Content-Type: application/json" -d "{\"transaction_id\":[transaction_id]}" http://0.0.0.0:8080/api/disbursement/update.php
```
Please fill `[transaction_id]` (without `[` and `]`) with one of the `id` from transaction data which you can see using API from problem 2.
For example:
```
curl --header "Content-Type: application/json" -d "{\"transaction_id\":6236433201}" http://0.0.0.0:8080/api/disbursement/update.php
```
Response:
```
{"message":"Disbursement Updated","disbursement":{"id":"8586634721","amount":"1000","status":"PENDING","timestamp":"2020-04-17 11:48:07","remark":"TEST","bank_code":"bni","account_number":"123","beneficiary_name":"PT FLIP","receipt":"https:\/\/flip-receipt.oss-ap-southeast-5.aliyuncs.com\/debit_receipt\/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg","time_served":"2020-04-17 11:49:48","fee":"4000"}}
```
When you run `curl http://0.0.0.0:8080/api/disbursement/read.php`, you can see that the data for `id: 8586634721` has been updated:
```
{"disbursements":[{"id":"8586634721","amount":"1000","status":"PENDING","timestamp":"2020-04-17 11:48:07","remark":"TEST","bank_code":"bni","account_number":"123","beneficiary_name":"PT FLIP","receipt":"https:\/\/flip-receipt.oss-ap-southeast-5.aliyuncs.com\/debit_receipt\/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg","time_served":"2020-04-17 11:49:48","fee":"4000"}]}
```
### Revert Database
1. `cd config`
2. open `app.ini` with text editor or `nano`.
3. change value in the config file according to your mysql host and a user that has enough privileges.
4. Run `php revert.php`
5. Back to top folder `cd ..`
