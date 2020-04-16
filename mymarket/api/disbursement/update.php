<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../../config/db.php';
include_once '../../objects/disbursement.php';

// instantiate database and disbursement object
$database = new Database();
$db = $database->getConnection();

// initialize object
$disbursement = new Disbursement($db);

// Get raw posted data
$request = json_decode(file_get_contents("php://input"));

$response = new StdClass();
// Mock
$response->id = 55351525642;
$response->amount = 10000;
$response->status = "SUCCESS";
$response->timestamp = "2019-05-21 09:12:42";
$response->remark = "sample remark";
$response->bank_code = "bni";
$response->account_number = "1234567890";
$response->beneficiary_name = "PT FLIP";
$response->receipt = "MOCK RECEIPT";
$response->time_served = "2019-05-21 09:26:11";
$response->fee = 4000;

// Get ID
$disbursement->id = $request->transaction_id;

// Get post
if ($disbursement->read_single()) {
    // Set data to UPDATE
    $disbursement->status = $response->status;
    $disbursement->receipt = $response->receipt;
    $disbursement->time_served = $response->time_served;

    // Update post
    if($disbursement->update()) {
        echo json_encode(
          array('message' => 'Disbursement Updated', 'disbursement' => $disbursement)
        );
    } else {
        echo json_encode(
          array('message' => 'Disbursement not updated')
        );
    }
} else {
  echo json_encode(
          array('message' => 'Disbursement not exists')
        );
}

?>