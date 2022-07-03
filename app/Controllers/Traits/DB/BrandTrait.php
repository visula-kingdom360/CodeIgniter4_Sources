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
    
    public function getBrandData()
    {
        $brandModule = new Brand();

        # Brand data from DB directly
        $brandDBData = $brandModule->selectBrandbyStatus();

        # Converting the DB Data to an Array
        $this->brand = $this->pushModelDBDataToArrayReturn($brandModule, $brandDBData);

        return $this->brand;
    }

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

        return $this->brand;
    }

    public function setBrandStatusviaID($brandID, $status = 'E')
    {
        $brand_accessModule = new Brand();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->updateStatusofBrandbyID($brandID, $status);
        
        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return $this->brand;
    }

    ##################### B R A N D   A C C E S S   C R U D #####################
    # 
    public function getBrand_AccessData() # Not used currently
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyCorpID($corparationID, $this->limitedBrands);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return  $this->brand_access;
    }

    # gathering the Brand Access details via Corparate ID method from DB
    public function getBrand_AccessDatafromCorparationID($corparationID)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyCorpID($corparationID);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return  $this->brand_access;
    }

    # adding Brand Access data via Brand array
    public function addBrand_AccessData($brand_access)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $this->brand_access['BrandID'] = $brand_accessModule->insertDatatoBrand_Access($brand_access);

        if(isset($this->brand_access['BrandID'])){
            return $this->brand_access['BrandID'];
        }else{
            return '';
        }
    }

    # gathering the Brand Access detail via Brand ID, Corparate ID and Status method from DB
    public function getBrand_AccessDataviaBrandIDCorpID($brandID, $corparationID, $status = 'E')
    {
        $brand_accessModule = new Brand_Access();
        
        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyBrandIDandCorpID($brandID, $corparationID, $status);

        if(isset($brand_accessDBData[0])){
            # Converting the DB Data to an Array
            $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

            return $this->brand_access;
        }else{
            return '';
        }
    }

    # gathering the Brand Access detail via Brand ID and Relationship method from DB
    public function getBrand_AccessviaBrandIDandRelationship($brandID, $relationship)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyBrandIDandRelationship($brandID,$relationship);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return $this->brand_access;
    }

    # gathering the Brand Access detail via Brand Access ID and Status method from DB
    public function getBrand_AccessviaBrand_AccessIDandStatus($brand_accessID, $status = 'E')
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyIDandStatus($brand_accessID, $status);

        # Converting the DB Data to an Array
        $this->brand_access = $this->pushModelDBDataToArrayReturn($brand_accessModule, $brand_accessDBData);

        return $this->brand_access;
    }

    # modification of the Brand Access detail via Brand Access ID and Status method from DB
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

    public function setBrand_AccessStatusviaBrandIDandOwnerID($brandID, $corparationID, $status)
    {
        $brand_accessModule = new Brand_Access();

        # Brand Access data from DB directly
        $brand_accessDBData = $brand_accessModule->updateStatusofBrand_AccessbyBrandIDandCorparateID($brandID, $corparationID, $status);

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