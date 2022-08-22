<?php

class Package
{

    protected $table;
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
        $this->table = 'packages';
    }

    // Gönderilen package_id için kayıt var mı?
    public function packageIDControl($package_id){
        $package_control = $this->db->query("SELECT * FROM " . $this->table . " WHERE package_id = '{$package_id}' AND package_status = '1'")->fetch(PDO::FETCH_ASSOC);
        if ($package_control) {
            return array("status_code" => 100, "message" => "Başarılı" ,"package_detail" => $package_control);
        } else {
            return array("status_code" => 101, "message" => "Bu package_id için kayıt bulunamadı!");
        }
    }




}