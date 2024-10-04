<?php

class AddressModel {
    private $db;

    public function __construct() {
        $this->db = new Database();  
    }

    public function createAddress() {
       
       
    }
    
    public function getAllRegion(){
        return $this->db->fetchAll('SELECT * FROM refregion');
    }
    
    public function getAllProvinceByRegionCode($region_code){
        return $this->db->fetchAll('SELECT id, provDesc, provCode FROM refprovince WHERE regCode = :region_code', ['region_code' => $region_code]);
    }
}
