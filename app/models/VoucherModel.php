<?php

class VoucherModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    
    public function checkIfValidVoucher($voucher_code) {
        $voucher = $this->db->fetch("SELECT * FROM vouchers WHERE voucher_code = :voucher_code AND status = 'active'", ['voucher_code' => $voucher_code]);
    
        if ($voucher) {
            // check if usage limit reached
            if ($voucher['usage_limit'] <= $voucher['used_count']) {
                $this->updateVoucherStatus($voucher_code, 'disabled');
                return false;
            } 
            
            // check if voucher is expired
            $currentDate = new DateTime();
            $endDate = new DateTime($voucher['end_date']);
    
            if ($currentDate > $endDate) {
                $this->updateVoucherStatus($voucher_code, 'expired');
                return false;
            }
    
            // if all checks pass, the voucher is valid
            return $voucher;
        }
    
        // return false if voucher not found
        return false;
    }
    
    protected function updateVoucherStatus($voucher_code, $status) {
        $this->db->query("UPDATE vouchers SET status = :status WHERE voucher_code = :voucher_code", [
            'voucher_code' => $voucher_code,
            'status' => $status
        ]);
    }
    
    public function createVoucher($voucher_code){
        //unique code
        //value
        //type
        //start date
        //end date
        //max usage
        //current usage
        //status
    }
    
    public function useVoucherByVoucherCode($voucher_code){
        $this->db->query("UPDATE vouchers SET used_count = used_count + 1 WHERE voucher_code = :voucher_code", ['voucher_code' => $voucher_code]);
    }
    

}