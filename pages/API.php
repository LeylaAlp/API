<?php

include "../include/config.php";
$Company = new Company();
$CompanyPackage = new CompanyPackage();
$Package = new Package();



$action= $_GET["action"];


// Kullanıcı Kayıt İşlemi
if($action == "CompanyRegister"){
    $company_name = "Kobisi";
    $site_url = "www.kobisi.com";
    $name = "isim";
    $lastname = "soyisim";
    $email = "kobisim@kobisi.com";
    $password = "Kobisi.123";


    $company_add = $Company->companyAdd($company_name,$site_url,$name,$lastname,$email,$password);

    if($company_add){
        echo json_encode($company_add);
        exit();
    }

 // Kullanıcı Paket Tanımlama İşlemi
} else if($action == "CompanyPackage"){

    $company_id = 1;
    $package_id = 1;

    $companyPackageAdd = $CompanyPackage->companyPackageAdd($company_id,$package_id);
    if($companyPackageAdd){
        echo json_encode($companyPackageAdd);
        exit();
    }

    // Company ve Package Bilgileri Listelenmesi
}else if($action == "CheckCompanyPackage"){

    $token = "MzAyMDE2NjEwNjY0NDg";
    $endpoint = "http://dev.kobisi.com/pages/API/?action=CheckCompanyPackage&token=". $token;

    $CheckCompanyPackage = array();
    $company_list = $Company->companyTokenControl($token);
    $company_package_list = $CompanyPackage->companyPackageControl($company_list["company_detail"]["company_id"]);
    $package_list = $Package->packageIDControl($company_package_list["company_package_detail"]["package_id"]);


    $CompanyDetail = array(
        "CompanyID" => $company_list["company_detail"]["company_id"],
        "CompanyName" => $company_list["company_detail"]["company_name"],
        "SiteUrl" => $company_list["company_detail"]["site_url"],
        "Name" => $company_list["company_detail"]["name"],
        "Lastname" => $company_list["company_detail"]["lastname"],
        "Email" => $company_list["company_detail"]["email"],
        "Password" => $company_list["company_detail"]["password"],
        "AddDate" =>$company_list["company_detail"]["add_date"],
    );


    $PackageDetail= array(
        "PackageID" => $package_list["package_detail"]["package_id"],
        "PackageName" => $package_list["package_detail"]["package_name"],
        "PackageStatus" => $package_list["package_detail"]["package_status"]
    );


    $CheckCompanyPackage = array(
        "CompanyDetail" => $CompanyDetail,
        "PackageDetail" => $PackageDetail
    );

   if($CheckCompanyPackage){
       echo json_encode($CheckCompanyPackage);
       exit();
   }



}


