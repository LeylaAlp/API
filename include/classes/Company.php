<?php

class Company
{

    protected $table;
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
        $this->table = 'companies';

    }

    // Gönderilen token kontrolü
    public function companyTokenControl($token){
        $company_control = $this->db->query("SELECT * FROM " . $this->table . " WHERE token = '{$token}'")->fetch(PDO::FETCH_ASSOC);
        if ($company_control) {
            return array("status_code" => 100, "message" => "Başarılı", "company_detail" => $company_control);
        } else {
            return array("status_code" => 101, "message" => "Bu token için kayıt bulunamadı!");
        }
    }


    // Gönderilen company_id için kayıt var mı?
    public function companyIDControl($company_id){
        $company_control = $this->db->query("SELECT * FROM " . $this->table . " WHERE company_id = '{$company_id}'")->fetch(PDO::FETCH_ASSOC);
        if ($company_control) {
            return array("status_code" => 100, "message" => "Başarılı");
        } else {
            return array("status_code" => 101, "message" => "Bu company_id için kayıt bulunamadı!");
        }
    }


    // Sistemde aynı bilgilere ait kullanıcı var mı?
    public function companyControl($email, $site_url)
    {
        $company_control = $this->db->query("SELECT * FROM " . $this->table . " WHERE email = '{$email}' AND site_url = '{$site_url}'")->fetch(PDO::FETCH_ASSOC);
        if ($company_control) {
            return array("status_code" => 101, "message" => "Bu bilgilere ait kullanıcı sistemde tanımlıdır!");
        } else {
            return array("status_code" => 100, "message" => "Başarılı");
        }
    }


    // Firma bilgilerini kayıt etmektedir.
    public function companyAdd($company_name, $site_url, $name, $lastname, $email, $password)
    {
        $company_control = $this->companyControl($email,$site_url);

        // Gönderilen e-posta formatı doğru mu?
        $email_format_check = email_format_check($email);
        if($email_format_check["status_code"] == 100){
            $email_address = $email;
        }

        $token = str_replace('=', '', base64_encode(rand(1000, 9999) . time()));

        if ($company_control["status_code"] == 100) {
            $query = $this->db->prepare("INSERT INTO " . $this->table . " SET company_name = ?,site_url = ?, name= ?, lastname =?, email=?, password=?, token=?, add_date=?");
            $insert = $query->execute(array($company_name, $site_url, $name, $lastname, $email_address, md5($password), $token, date('Y-m-d H:i:s')));
            $company_id = $this->db->lastInsertId();
        }

        if ($insert) {
            return array("status_code" => 100, "message" => "Başarılı", "token" => $token, "company_id" => $company_id);
        } else {
            return array("status_code" => 101, "message" => "Kayıt Başarısız!");
        }


    }

}