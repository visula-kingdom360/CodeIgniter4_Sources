<?php
namespace App\Controllers\Traits\DB;

use App\Models\Brand;
use App\Models\Brand_Access;
use App\Models\Brand_Recommandation;

trait BrandTrait {

    # Public Table Array's
    public $brand = [];
    public $brand_access = [];
    public $brand_recommandation = [];

    protected $limitedBrands = 99;

    ##################### B R A N D   C R U D #####################
    public function getBrandDatafromOwnerID($ownerID)
    {
        $brandModule = new Brand();

        # Brand data from DB directly
        $brandDBData = $brandModule->selectBrandbyOwnerID($ownerID);

        # Converting the DB Data to an Array
        $this->brand = $this->pushModelDBDataToArrayReturn($brandModule, $brandDBData);

        return $this->brand;
    }

    public function getBrandDatafromBrandName($brandName)
    {
        $brandModule = new Brand();

        # Brand data from DB directly
        $brandDBData = $brandModule->selectBrandbyName($brandName);

        if(isset($brandDBData[0])){
            # Converting the DB Data to an Array
            $this->brand = $this->pushModelDBDataToArrayReturn($brandModule, $brandDBData);

            return $this->brand;
        }else
        {
            return '';
        }
    }

    public function getBrandDataviaID($brandID)
    {
        $brandModule = new Brand();
            
        # Brand data from DB directly
        $brandDBData = $brandModule->selectBrandbyID($brandID);

        if(isset($brandDBData[0])){
            # Converting the DB Data to an Array
            $this->brand = $this->pushModelDBDataToArrayReturn($brandModule, $brandDBData);

            return $this->brand;
        }else
        {
            return '';
        }
    }

    public function addBrandData($brand)
    {
        $brandModule = new Brand();

        # Brand Access data from DB directly: returning ID
        $this->brand['BrandID'] =  $brandModule->inserDatatoBrand($brand);

        if(isset($this->brand['BrandID'])){
            return $this->brand['BrandID'];
        }else{
            return '';
        }
    }

    public function setBrandviaData($changes, $count, $brandData)
    {
        $brand_accessModule = new Brand();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->updateDataofBrandbyData($changes, $count, $brandData);
        
        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return  $this->brand_access;
    }

    ##################### B R A N D   A C C E S S   C R U D #####################
    public function getBrand_AccessDatafromCorpationID($corparationID)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessesbyCorpID($corparationID, $this->limitedBrands);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return  $this->brand_access;
    }

    public function changeBrand_AccessStatusviaID()
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->updateStatusofBrand_AccessbyID($brand_accessID, $status);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return  $this->brand_access;
    }
    
    public function brandAccessCreation($brand_access)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $this->brand_access['BrandID'] = $brand_accessModule->insertDatatoBrand_Access($brand_access);

        if(isset($this->brand_access['BrandID'])){
            return $this->brand['BrandID'];
        }else{
            return '';
        }
    }

    public function brand_accessDetail($brand_accessID)
    {
        $brand_accessModule = new Brand_Access();
        
        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyID($brand_accessID);

        if(isset($brand_accessDBData[0])){
            # Converting the DB Data to an Array
            $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

            return $this->brand_access;
        }else{
            return '';
        }
    }

    public function getBrand_AccessDataviaBrandIDCorpID($brandID, $corparationID, $status = 'E')
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessesbyBrandIDandCorpID($brandID, $corparationID, $status);

        if(isset($brandDBData[0])){
            # Converting the DB Data to an Array
            $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

            return $this->brand_access;
        }else{
            return '';
        }
    }

    public function getBrand_AccessviaBrandIDandRelationship($brandID, $relationship)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessesbyBrandIDandRelationship($brandID,$relationship);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return $this->brand_access;
    }

    public function setBrand_AccessStatusviaBrandID($brand_accessID, $status)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->updateStatusofBrand_AccessbyID($brand_accessID, $status);

        if(isset($brand_accessDBData[0])){
            # Converting the DB Data to an Array
            $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

            return $this->brand_access;
        }else{
            return '';
        }
    }

    ##################### B R A N D   R E C O M M A N D A T I O N   C R U D #####################
    public function getBrand_RecommandationDatafromRequestID($requestID)
    {
        $brand_recommandationModule = new Brand_Recommandation();

        # Brand Recommandation data from DB directly
        $brand_recommandationDBData = $brand_recommandationModule->selectBrand_RecommandationbyRequestID($requestID);

        # Converting the DB Data to an Array
        $this->brand_recommandation = $this->pushModelDBDataToArrayReturn($brand_recommandationModule, $brand_recommandationDBData);

        return  $this->brand_recommandation;
    }
}
?>