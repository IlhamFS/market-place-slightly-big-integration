#A Market Place and Slightly Big Flip Integration
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

## Folder Structure
```
/api/disbursement/*
```
Code related to disburse API implementation. There are 3 APIs: read, disburse, and update.
```
/api/utlis/*
```
Code related to API utilities. For now, just a wrapper to call 3rd party api.

```
/config/*
```
Code related to database setup.
```
/objects/*
```
Code related to object abstraction for the api. For no, it's for `disbursement` object only.

## How To Run
### Prerequisites:
1. PHP >= 7.3.9 Installed (I use PHP 7.3.9 and cannot ensure other version compatibility)
2. Make sure to clone this repo and you are in the repo folder (market-place-slightly-big-integration)

### Set Up:
Database setup.
```
cd config
php migration.php
cd ..
```
### Run:
```
php -S 0.0.0.0:8080
```
