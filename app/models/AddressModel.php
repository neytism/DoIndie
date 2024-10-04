<?php

class AddressModel {
    private $db;

    public function __construct() {
        $this->db = new Database();  
    }
    
    public function createEmptyAddress($user_id) {

        $this->db->query("INSERT INTO addresses (owner_id) VALUES (:user_id)", [
            'user_id' => $user_id
        ]);
       
    }
    
    public function updateUserAddressByUserID($user_id, $brgy_id, $city_id, $province_id, $region_id, $detailed_info, $landmark){
        $this->db->query("UPDATE addresses SET brgy_id = :brgy_id, city_id = :city_id, province_id = :province_id, region_id = :region_id, detailed_info = :detailed_info, landmark = :landmark WHERE owner_id = :user_id", [
            'brgy_id' => $brgy_id,
            'city_id' => $city_id,
            'province_id' => $province_id,
            'region_id' => $region_id,
            'detailed_info' => $detailed_info ,
            'landmark' => $landmark,
            'user_id' => $user_id
        ]);
    }
    
    public function getAllRegion(){
        return $this->db->fetchAll('SELECT * FROM refregion');
    }
    
    public function getAllProvinceByRegionCode($region_code){
        return $this->db->fetchAll('SELECT id, provDesc, provCode FROM refprovince WHERE regCode = :region_code', ['region_code' => $region_code]);
    }

    public function getAllCityByProvinceCode($province_code){
        return $this->db->fetchAll('SELECT id, citymunDesc, citymunCode FROM refcitymun WHERE provCode = :province_code', ['province_code' => $province_code]);
    }

    public function getAllBrgyByCityCode($city_code){
        return $this->db->fetchAll('SELECT id, brgyDesc, brgyCode FROM refbrgy WHERE citymunCode = :city_code', ['city_code' => $city_code]);
    }

    public function getAddressOfUserByUserID($user_id){
        return $this->db->fetch('SELECT * FROM addresses WHERE owner_id = :user_id', ['user_id' => $user_id]);
    }
    
    public function getBrgyIDByBrgyCode($brgyCode): string {
        $brgy = $this->db->fetch('SELECT id FROM refbrgy WHERE brgyCode = :brgyCode', ['brgyCode' => $brgyCode]);
        
        return $brgy['id'] ?? '0'; // Return 0 if not found
    }

    public function getCityMunIDByCityMunCode($citymunCode): string {
        $citymun = $this->db->fetch('SELECT id FROM refcitymun WHERE citymunCode = :citymunCode', ['citymunCode' => $citymunCode]);
        
        return $citymun['id'] ?? '0'; // Return 0 if not found
    }

    public function getProvinceIDByProvCode($provCode): string {
        $province = $this->db->fetch('SELECT id FROM refprovince WHERE provCode = :provCode', ['provCode' => $provCode]);
        
        return $province['id'] ?? '0'; // Return 0 if not found
    }
    
    public function getRegionIDByRegCode($regCode): string {
        $region = $this->db->fetch('SELECT id FROM refregion WHERE regCode = :regCode', ['regCode' => $regCode]);
        
        return $region['id'] ?? '0'; // Return 0 if not found
    }

    public function getRegionCodeByRegionID($regionID): string {
        $region = $this->db->fetch('SELECT regCode FROM refregion WHERE id = :id', ['id' => $regionID]);
        
        return $region['regCode'] ?? ''; // Return empty string if not found
    }

    public function getBarangayCodeByBarangayID($barangayID): string {
        $barangay = $this->db->fetch('SELECT brgyCode FROM refbrgy WHERE id = :id', ['id' => $barangayID]);
        
        return $barangay['brgyCode'] ?? ''; // Return empty string if not found
    }

    public function getCityMunCodeByCityMunID($cityMunID): string {
        $cityMun = $this->db->fetch('SELECT citymunCode FROM refcitymun WHERE id = :id', ['id' => $cityMunID]);
        
        return $cityMun['citymunCode'] ?? ''; // Return empty string if not found
    }
    
    public function getProvinceCodeByProvinceID($provinceID): string {
        $province = $this->db->fetch('SELECT provCode FROM refprovince WHERE id = :id', ['id' => $provinceID]);
        
        return $province['provCode'] ?? ''; // Return empty string if not found
    }

    public function getFullAddressOfUserByUserID($user_id): string{
        $user_address = $this->db->fetch("SELECT * FROM addresses WHERE owner_id = '$user_id'");
        
        $brgy_arr =  $this->db->fetch("SELECT brgyDesc FROM refbrgy WHERE id = :brgy_id", ['brgy_id' => $user_address['brgy_id']]);
        $city_arr =  $this->db->fetch("SELECT citymunDesc FROM refcitymun WHERE id = :city_id", ['city_id' => $user_address['city_id']]);
        $province_arr =  $this->db->fetch("SELECT provDesc FROM refprovince WHERE id = :province_id", ['province_id' => $user_address['province_id']]);
        
        $detailed_address = $user_address['detailed_info'] ?? '';
        $landmark = $user_address['landmark'] ?? '';
        $brgy = isset($brgy_arr['brgyDesc']) ? $brgy_arr['brgyDesc'] : '';
        $city = isset($city_arr['citymunDesc']) ? $city_arr['citymunDesc'] : '';
        $province = isset($province_arr['provDesc']) ? $province_arr['provDesc'] : '';
    
        $fomratted = ucwords(strtolower($detailed_address . ', ' . $landmark . ', ' .  $brgy . ', ' . $city . ', ' . $province));
        
        $keywords = ["ncr"];
        
        $fomratted = $this->uppercaseKeywords($fomratted, $keywords);
        return $fomratted;
    
    }

    function uppercaseKeywords($inputString, $keywords) {
        foreach ($keywords as $keyword) {
            $inputString = str_ireplace($keyword, strtoupper($keyword), $inputString);
        }
        return $inputString;
    }
    
}
