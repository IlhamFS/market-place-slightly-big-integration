<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header('Content-Type: application/json');
// include database and object files
include_once '../../config/db.php';
include_once '../../objects/disbursement.php';

// instantiate database and disbursement object
$database = new Database();
$db = $database->getConnection();

// initialize object
$disbursement = new Disbursement($db);

// query disbursements
$stmt = $disbursement->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // disbursements array
    $disbursements_arr=array();
    $disbursements_arr["disbursements"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $disbursement_item=array(
            "id" => $id,
            "amount" => $amount,
            "status" => html_entity_decode($status),
            "timestamp" => $timestamp,
            "remark" => $remark,
            "bank_code" => $bank_code,
            "account_number" => $account_number,
            "beneficiary_name" => $beneficiary_name,
            "receipt" => $receipt,
            "time_served" => $time_served,
            "fee" => $fee,
        );

        array_push($disbursements_arr["disbursements"], $disbursement_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show disbursements data in json format
    echo json_encode($disbursements_arr);
} else {

     // set response code - 404 Not found
    http_response_code(404);

    // tell the user no disbursements found
    echo json_encode(
        array("message" => "No disbursements found.")
    );
}
