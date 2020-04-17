<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
header('Content-Type: application/json');
// include database and object files
include_once '../../config/db.php';
include_once '../../objects/disbursement.php';
include_once '../utils/api_utils.php';

// instantiate database and disbursement object
$database = new Database();
$db = $database->getConnection();

// initialize object
$disbursement = new Disbursement($db);

// Get raw posted data
$request = json_decode(file_get_contents("php://input"));
if ($request->transaction_id == null) {
    echo json_encode(array('message' => 'Error when pulling data from 3rd party.'));
    die();
}

$response = json_decode(callAPI(
    'GET',
    'https://nextar.flip.id/disburse/'. $request->transaction_id,
    false
));
if ($response == null) {
    echo json_encode(array('message' => 'Error when pulling data from 3rd party.'));
    die();
}
// Get ID
$disbursement->id = $request->transaction_id;

// Get post
if ($disbursement->read_single()) {
    // Set data to UPDATE
    $disbursement->status = $response->status;
    $disbursement->receipt = $response->receipt;
    $disbursement->time_served = $response->time_served;

    // Update post
    if ($disbursement->update()) {
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
