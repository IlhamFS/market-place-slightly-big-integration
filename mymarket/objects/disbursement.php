<?php
class Disbursement{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "disbursement";

    // table columns
    public $id;
    public $amount;
    public $status;
    public $timestamp;
    public $remark;
    public $receipt;
    public $time_served;
    public $fee;
    public $bank_transfer_information_id;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id=:id, amount=:amount, status=:status, timestamp=:timestamp, remark=:remark, receipt=:receipt, time_served=:time_served, fee=:fee, bank_transfer_information_id=:bank_transfer_information_id;";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timestamp = htmlspecialchars(strip_tags($this->timestamp));
        $this->bank_code = htmlspecialchars(strip_tags($this->bank_code));
        $this->account_number = htmlspecialchars(strip_tags($this->account_number));
        $this->beneficiary_name = htmlspecialchars(strip_tags($this->beneficiary_name));
        $this->remark = htmlspecialchars(strip_tags($this->remark));
        $this->receipt = htmlspecialchars(strip_tags($this->receipt));
        $this->time_served = htmlspecialchars(strip_tags($this->time_served));
        $this->fee = htmlspecialchars(strip_tags($this->fee));

        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":timestamp", $this->timestamp);
        $stmt->bindParam(":bank_code", $this->bank_code);
        $stmt->bindParam(":account_number", $this->account_number);
        $stmt->bindParam(":beneficiary_name", $this->beneficiary_name);
        $stmt->bindParam(":remark", $this->remark);
        $stmt->bindParam(":receipt", $this->receipt);
        $stmt->bindParam(":time_served", $this->time_served);
        $stmt->bindParam(":fee", $this->fee);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    //R
    public function read(){
     // select all query
        $query = "SELECT d.id, d.amount, d.status, d.timestamp, d.bank_code, d.account_number, d.beneficiary_name, d.remark, d.receipt, d.time_served, d.fee, d.bank_transfer_information_id
                  FROM disbursement d;";

        // prepare query statement
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }
    //U
    public function update(){}
    //D
    public function delete(){}
}