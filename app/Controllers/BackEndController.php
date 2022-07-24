<?php
namespace App\Controllers;

class BackEndController extends AccessController
{
    use Traits\DB\BrandTrait;
    use Traits\DB\EquipmentTrait;
    use Traits\DB\OtherTrait;

    # Company wise accessing brand Name method
    public function companyAccessBrandNames($corparationID)
    {
        $brand_access_names = [];
        $brand_access = $this->getBrand_AccessDatafromCorparationID($corparationID);

        foreach ($brand_access as $row_1_key => $row_1_value) {
            # code...
            $brand_access_names[$row_1_key] = $this->brandName($row_1_value['BrandID']);
        }

        return $brand_access_names;
    }

    # Exluding brand details from existing given Brands
    public function exclusionBrands($excluded_brands)
    {
        $all_brands = $this->getBrandData();

        foreach ($all_brands as $row_1_key => $row_1_value) {
            # loop all brand details
            $searched_val = in_array($row_1_value['Name'],$excluded_brands);

            if($searched_val){
                unset($all_brands[$row_1_key]);
            }
        }

        return $all_brands;
    }

    # Companies Brands Detail's and Equipment Available for the Brand
    public function companyBrandDetails($corparationID) # Gather Details
    {
        $company_brands = [];
        $brand_info = [];

        $brand_access_info = $this->getBrand_AccessDatafromCorparationID($corparationID);

        foreach ($brand_access_info as $row_1_key => $row_1_value) {
            # access wise brand information
            $brand_info = $this->getBrandDataviaID($row_1_value['BrandID']);
            
            # equipments count for the brand's accessed
            $equipCount = $this->brandEquipmentCount($row_1_value['Brand_AccessID']);

            # data list passing for the front-end
            $company_brands[$row_1_key]['BrandID']        = $brand_info[0]['BrandID'];
            $company_brands[$row_1_key]['Brand']          = $brand_info[0]['Name'];
            $company_brands[$row_1_key]['Summary']        = $brand_info[0]['Summary'];
            $company_brands[$row_1_key]['Description']    = $brand_info[0]['Description'];
            $company_brands[$row_1_key]['EquipmentCount'] = $equipCount;
            $company_brands[$row_1_key]['Brand_AccessID'] = $row_1_value['Brand_AccessID'];
            $company_brands[$row_1_key]['Relationship']   = $row_1_value['Relationship'];

            $brand_info = [];
        }

        return $company_brands;
    }

    # All Owned Brand Detail's with Relationship with Supplier Access's
    public function ownedBrandDetails($corparationID) # Gather Details
    {
        $owned_brands = [];
        $relationships = [];

        $brand_info = $this->getBrandDatafromOwnerID($corparationID);

        foreach ($brand_info as $row_1_key => $row_1_value) {
            # brand wise access count information
            $relationships = $this->relationshipwiseBrandAccessDetails($row_1_value['BrandID'],'Count-Only');

            # data list passing for the front-end
            $owned_brands[$row_1_key]['BrandID']        = $row_1_value['BrandID'];
            $owned_brands[$row_1_key]['Brand']          = $row_1_value['Name'];
            $owned_brands[$row_1_key]['Summary']        = $row_1_value['Summary'];
            $owned_brands[$row_1_key]['Request_Count']  = $relationships['requested'];
            $owned_brands[$row_1_key]['Rejected_Count'] = $relationships['rejected'];
            $owned_brands[$row_1_key]['Accepted_Count'] = $relationships['validated'];
        }

        return $owned_brands;
    }

    # Brand Access Changing status
    public function companyBrandAccessStsChg($brand_accessID, $status = 'E')
    {
        # getting the wordings of the Status
        $statusWording = $this->statusExpand($status);
        
        # If Status is Unknown returning Error
        if( $statusWording == 'Unknown')
        {
            $data['error'] = $status.' is not a common brand, please contact the adminstation.';

            return redirect()->to(base_url('error-screen'))->with('error',$data['error']);
        }

        $data['brand_access'] = $this->setBrand_AccessStatusviaBrandID($brand_accessID, $status);

        # Brand Access via ID was not found
        if(!isset($data['brand_access'][0]['BrandID']))
        {
            $data['status'] = 'Status changing failed becuase Brand Access ID was not found.';
            return redirect()->to(base_url('supplier-plateform/brands/access/brand-details'))->with('status',$data['status']);
        }
        
        # Brand Access templated for returning common status
        $commonSts = 'Status changing to '.$statusWording.' of Brand ID: '.$data['brand_access'][0]['BrandID'];

        if($data['brand_access'][0]['Status'] == $status)
        {
            # Brand Access status not require change
            $data['status'] = $commonSts.' failed beause status is already '.$statusWording.' .';
            return redirect()->to(base_url('supplier-plateform/brands/access/brand-details'))->with('status',$data['status']);
        }

        # Brand Access status cahnge was successful
        $data['status'] = $commonSts.' was done successful.';
            
        # redirecting to Brand Management Screen
        return redirect()->to(base_url('supplier-plateform/brands/access/brand-details'))->with('success',$data['status']);
    }

    # Count all Equipments in Brnad
    public function brandEquipmentCount($brand_accessID)
    {
        $equipment = $this->getEquipmentDataviaBrandID($brand_accessID);

        return count($equipment);
    }

    # Relationship wise Brand Access Details
    public function relationshipwiseBrandAccessDetails($brandID, $returnType = 'Both') #Reusable
    {
        # Brand Access with Brand ID and Relationships
        $brand_access['details']['rejected']  = $this->getBrand_AccessviaBrandIDandRelationship($brandID,'Rejected by User');
        $brand_access['details']['requested'] = $this->getBrand_AccessviaBrandIDandRelationship($brandID,'Requested to User');
        $brand_access['details']['validated'] = $this->getBrand_AccessviaBrandIDandRelationship($brandID,'Validated by User');

        # count all the details from Brand Access 
        $brand_access['count']['rejected'] = count($brand_access['details']['rejected']);
        $brand_access['count']['requested'] = count($brand_access['details']['requested']);
        $brand_access['count']['validated'] = count($brand_access['details']['validated']);

        if($returnType == 'Count-Only'){
            return $brand_access['count'];

        }elseif($returnType == 'Detail-Only'){
            return $brand_access['details'];
        }elseif($returnType == 'Both'){
            return $brand_access;
        }else{
            return '';
        }
    }

    # Relationship data breakdown and automatically
    public function relationshipDetails($relationship)
    {
        foreach($relationship as $row_2_key => $row_2_value) {
            # Brand Access details
            $brand_access[$row_2_key]['Brand_AccessID'] = $row_2_value['Brand_AccessID'];
            
            # Company Name for the brand access
            $brand_access[$row_2_key]['CompanyName'] = $this->companyName($row_2_value['CorparationID']);
            
            # Equipments count for the Brand's Accessed
            $brand_access[$row_2_key]['EquipmentCount'] = $this->brandEquipmentCount($row_2_value['Brand_AccessID']);
        }

        return $brand_access;
    }

    # Tooltip Brand Access
    public function tooltipsforBrandAccess() #Reusable
    {
        $tooltips['Request_Tooltip']  = 'No of Requests for the Brand Access';
        $tooltips['Rejected_Tooltip'] = 'Total Rejected Brand Access still used';
        $tooltips['Accepted_Tooltip'] = 'Accepted Brand Access';
            
        return $tooltips;
    }

    # Return Company Name my sending Company ID
    public function companyName($corparateID)
    {
        $companyDetails = $this->getCorparationDataviaCorpID($corparateID);

        return $companyDetails[0]['Name'];
    }

    # Return Brand Name my sending Brand ID
    public function brandName($brandID)
    {
        $brand = $this->getBrandDataviaID($brandID);

        return $brand[0]['Name'];
    }

    # Compare Brand Details with the Datapassed
    public function validateChangesBrand($brandData)
    {
        $changes = [];
        $brand = $this->getBrandDataviaID($brandData['BrandID']);

        if($brandData['Name'] != $brand[0]['Name']){
            array_push($changes,'Name');
        }
        
        if($brandData['Summary'] != $brand[0]['Summary']){
            array_push($changes,'Summary');
        }
        
        if($brandData['Description'] != $brand[0]['Description']){
            array_push($changes,'Description');
        }

        return $changes;
    }

    # Brand Access Statistics
    public function brandSellsStatic($brandID, $corpID)
    {
        $brand_access = $this->getBrand_AccessDataviaBrandIDCorpID($brandID, $corpID);

        if(isset($brand_access[0]['Brand_AccessID'])){
            $equipcount = $this->brandEquipmentCount($brand_access[0]['Brand_AccessID']);

            if($equipcount != 0){
                return 'Active-Equip';
            }else{
                return 'No-Equip';
            }
        }else{
            return 'No-Brand-Access';
        }
    }

    # Changing brand details Dynimally
    public function changingBrandDetails($changes, $brandData)
    {
        $brand = $this->setBrandviaData($changes, count($changes), $brandData);

        return isset($brand);
    }

    # Active or Create the Brand Access
    public function activate_createBrandAccess($brand_access)
    {
        # Validate if inactive Brand Accessors are available
        $brand_access_avail = $this->getBrand_AccessDataviaBrandIDCorpID($brand_access['BrandID'], $brand_access['CorparationID'],'A');

        if(isset($brand_access_avail[0])){
            $this->setBrand_AccessStatusviaBrandID($brand_access_avail[0]['Brand_AccessID'], 'A');
            return 'Actived';
        }else{
            $this->addBrand_AccessData($brand_access);
            return 'Created';
        }
    }

    # 
    public function access_brandName($brand_accessID)
    {
        $brand_access = [];

        $brand_access = $this->getBrand_AccessviaBrand_AccessIDandStatus($brand_accessID);

        return $this->brandName($brand_access[0]['BrandID']);
    }

    # 
    public function gerneName($genreID)
    {
        $genre = [];
        $genre = $this->getGenreDataviaID($genreID);

        return $genre[0]['GenreName'];

    }

    # 
    // public function all_equipmentsOfCompany($corparateID)
    // {
    //     $equipment = [];

    //     $equipmentDetails = $this->getEquipmentDataviaCorparationID($corparateID);

    //     foreach ($equipmentDetails as $row_1_key => $row_1_value) {
    //         # loop all equipment details
    //         $equipment['count'][$row_1_key] = $this->totalItemsofEquipment($row_1_value['EquipmentID']);
    //     }

    //     var_dump($equipment);
    //     die;
    // }

    # Count of all Items in Equipment
    public function equipmentItemCount($equipmentID)
    {
        $item = [];

        $item =  $this->getItemDataviaEquipmentID($equipmentID);

        return count($item);

    }
}
?>
