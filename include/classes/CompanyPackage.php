<?php

class CompanyPackage
{

    protected $table;
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
        $this->table = 'company_packages';

    }


    public function companyPackageControl($company_id, $package_id = null)
    {

        if($package_id == null){
            $company_package_control = $this->db->query("SELECT * FROM " . $this->table . " WHERE company_id = '{$company_id}'
          AND status = '1'")->fetch(PDO::FETCH_ASSOC);
        }else{
            $company_package_control = $this->db->query("SELECT * FROM " . $this->table . " WHERE company_id = '{$company_id}'
         AND package_id = '{$package_id}' AND status = '1'")->fetch(PDO::FETCH_ASSOC);
        }


        if ($company_package_control) {
            return array("status_code" => 101, "message" => "Sistemde bu bilgilerle kayıt mevcuttur!", "company_package_detail" => $company_package_control);
        } else {
            return array("status_code" => 100, "message" => "Başarılı");
        }
    }


    // Firma bilgilerini kayıt etmektedir.
    public function companyPackageAdd($company_id,$package_id)
    {

        //kullanıcı kontrolü
        $companyID = new Company();
        $companyIDControl = $companyID->companyIDControl($company_id);
        if($companyIDControl["status_code"] == 101){
            return array("status_code" =>101, "message" => $companyIDControl["message"]);
        }

        // paket kontrolü
        $packageID = new Package();
        $packageIDControl = $packageID->packageIDControl($package_id);
        if($packageIDControl["status_code"] == 101){
            return array("status_code" =>101, "message" => $packageIDControl["message"]);
        }

        // company_packages tablosunda bu bilgiler için kayıt daha önce atılmış mı?
        $companyPackageControl = $this->companyPackageControl($company_id,$package_id);
        if($companyPackageControl["status_code"] == 101){
            return array("status_code" =>101, "message" => $companyPackageControl["message"]);
        }

        $start_date = date('Y-m-d H:i:s');
        $end_date = date('Y-m-d H:i:s', strtotime('+1 month'));

        if($companyIDControl["status_code"] == 100 && $packageIDControl["status_code"] == 100){
            if($companyPackageControl["status_code"] == 100){
                $query = $this->db->prepare("INSERT INTO " . $this->table . " SET company_id = ?,package_id = ?,period = ?, start_date =?, end_date=?, status=?");
                $insert = $query->execute(array($company_id, $package_id, "monthly", $start_date, $end_date, 1));
            }
        }

        if ($insert) {
            return array("status_code" => 100, "message" => "Başarılı", "start_date" => $start_date, "end_date" => $end_date, "package_detail" => $packageIDControl["package_detail"]);
        }


    }


}