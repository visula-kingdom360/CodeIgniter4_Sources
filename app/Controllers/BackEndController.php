<?php
namespace App\Controllers;

class BackEndController extends AccessController
{
    use Traits\DB\BrandTrait;
    use Traits\DB\EquipmentTrait;

    #Companies Brands Using and owned information base
    public function companyBrandDetails($corparationID) # Gather Details
    {
        $company_brands = [];
        $brand_info = [];

        $brand_access_info = $this->getBrand_AccessDatafromCorpationID($corparationID);

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

    public function brandDetails($brandID) # Gather Details
    {
        $brands_details = [];
        $brand_access = [];

        $brand_info = $this->getBrandDataviaID($brandID);

        if (isset($brand_info[0])) {
            
            # brand wise access count information
            $relationships = $this->relationshipwiseBrandAccessDetails($brand_info[0]['BrandID'],'Detail-Only');

            if(isset($relationships['requested'][0])){
                foreach($relationships['requested'] as $row_2_key => $row_2_value) {
                    # Brand Access ID value
                    $brand_access['requested'][$row_2_key]['Brand_AccessID'] = $row_2_value['Brand_AccessID'];
                    
                    # Company Name for the brand access
                    $brand_access['requested'][$row_2_key]['CompanyName'] = $this->companyName($row_2_value['CorparationID']);
                    
                    # Equipments count for the Brand's Accessed
                    $brand_access['requested'][$row_2_key]['EquipmentCount'] = $this->brandEquipmentCount($row_2_value['Brand_AccessID']);
                }
            }else{
                $brand_access['requested'] = [];
            }

            if(isset($relationships['rejected'][0])){
                foreach($relationships['rejected'] as $row_2_key => $row_2_value) {
                    # Brand Access details
                    $brand_access['rejected'][$row_2_key]['Brand_AccessID'] = $row_2_value['Brand_AccessID'];
                    
                    # Company Name for the brand access
                    $brand_access['rejected'][$row_2_key]['CompanyName'] = $this->companyName($row_2_value['CorparationID']);
                    
                    # Equipments count for the Brand's Accessed
                    $brand_access['rejected'][$row_2_key]['EquipmentCount'] = $this->brandEquipmentCount($row_2_value['Brand_AccessID']);
                }
            }else{
                $brand_access['rejected'] = [];
            }

            if(isset($relationships['validated'][0])){
                foreach($relationships['validated'] as $row_2_key => $row_2_value) {
                    # Brand Access details
                    $brand_access['validated'][$row_2_key]['Brand_AccessID'] = $row_2_value['Brand_AccessID'];
                    
                    # Company Name for the brand access
                    $brand_access['validated'][$row_2_key]['CompanyName'] = $this->companyName($row_2_value['CorparationID']);
                    
                    # Equipments count for the Brand's Accessed
                    $brand_access['validated'][$row_2_key]['EquipmentCount'] = $this->brandEquipmentCount($row_2_value['Brand_AccessID']);
                }
            }else{
                $brand_access['validated'] = [];
            }

            # data list passing for the front-end
            $brands_detail['BrandID']     = $brand_info[0]['BrandID'];
            $brands_detail['Brand']       = $brand_info[0]['Name'];
            $brands_detail['Summary']     = $brand_info[0]['Summary'];
            $brands_detail['Description'] = $brand_info[0]['Description'];
            $brands_detail['Request-Details']  = $brand_access['requested'];
            $brands_detail['Rejected-Details'] = $brand_access['rejected'];
            $brands_detail['Accepted-Details'] = $brand_access['validated'];

            $brand_access = [];
        }

        return $brands_detail;
    }

    # Company Brand Status Changing 
    public function companyBrandStsChg($brand_accessID, $status = 'E')
    {
        #getting the wordings of the Status
        $statusWording = $this->statusExpand($status);
        
        #If Status is Unknown returning Error
        if( $statusWording == 'Unknown')
        {
            $data['error'] = $status.' is not a common brand, please contact the adminstation.';

            return redirect()->to(base_url('error-screen'))->with('error',$data['error']);
        }

        $data['brand_access'] = $this->setBrand_AccessStatusviaBrandID($brand_accessID, $status);

        #Brand Access via ID was not found
        if(!isset($data['brand_access'][0]['BrandID']))
        {
            $data['status'] = 'Status changing failed becuase Brand Access ID was not found.';
            return redirect()->to(base_url('brand-manager'))->with('status',$data['status']);
        }
        
        #Brand Access templated for returning common status
        $commonSts = 'Status changing to '.$statusWording.' of Brand ID: '.$data['brand_access'][0]['BrandID'];

        if($data['brand_access'][0]['Status'] == $status)
        {
            #Brand Access status not require change
            $data['status'] = $commonSts.' failed beause status is already '.$statusWording.' .';
            return redirect()->to(base_url('brand-manager'))->with('status',$data['status']);
        }

        #Brand Access status cahnge was successful
        $data['status'] = $commonSts.' was done successful.';
            
        #redirecting to Brand Management Screen
        return redirect()->to(base_url('brand-manager'))->with('success',$data['status']);
    }


    # Brand Equipment Counting
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
            $this->brandAccessCreation($brand_access);
            return 'Created';
        }
    }

}
?>
