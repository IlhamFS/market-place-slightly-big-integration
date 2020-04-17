<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
header('Content-Type: application/json');

// get database connection
include_once '../../config/db.php';

// instantiate Disbursement object
include_once '../../objects/disbursement.php';

include_once '../utils/api_utils.php';

$database = new Database();
$db = $database->getConnection();

$disbursement = new Disbursement($db);

$request = json_decode(file_get_contents('php://input'));
if ($request->bank_code == null
    || $request->account_number == null
    || $request->amount == null
    || $request->remark == null) {

  // set response code - 201 created
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request: Please check your parameters.'));
    die();
}
$response = json_decode(callAPI(
    'POST',
    'https://nextar.flip.id/disburse',
    array('bank_code' => $request->bank_code, 'account_number' => $request->account_number,
                                 'amount' => $request->amount, 'remark' => $request->remark)
));
if ($response == null) {
    echo json_encode(array('message' => 'Error when pulling data from 3rd party.'));
    die();
}
$disbursement->id = $response->id;
$disbursement->amount = $response->amount;
$disbursement->status = $response->status;
$disbursement->timestamp = $response->timestamp;
$disbursement->remark = $response->remark;
$disbursement->bank_code = $response->bank_code;
$disbursement->account_number = $response->account_number;
$disbursement->beneficiary_name = $response->beneficiary_name;
$disbursement->receipt = $response->receipt;
$disbursement->time_served = $response->time_served;
$disbursement->fee = $response->fee;

// create the disbursement
if ($disbursement->create()) {

    // set response code - 201 created
    http_response_code(201);

    // tell the user
    echo json_encode(array('message' => 'Disbursement was created.', 'disbursement' => $disbursement));
}

// if unable to create the Disbursement, tell the user
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array('message' => 'Unable to create disbursement.'));
}
