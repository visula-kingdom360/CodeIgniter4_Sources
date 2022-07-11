<?php
namespace App\Controllers;

class BackEndAssessor extends BackEndController
{
    #KDM Information
    public function kingdom360() 
    {
        echo view('SupplierPlateform/kdm360');
    }

    #Login Request
    public function loginRequest()
    {
        #posted data for validation
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        #Return User information
        $data = $this->validateUser($username, $password);

        if($data['error'] != '')
        {
            #Redirect Error
            return redirect()->to(base_url('login'))->with('status',$data['error']);
        }

        # Remember User Information
        $remember = $this->request->getPost('remember');
        if (isset($remember)) 
        {
            # Remember Accesses
            $this->accessRemember($username, $password); // need to think how to do this
        }

        // # User Login History
        // $this->userLoginHistory($data['user'][0]['PK']['UserID']);

        # Session Creation
        $this->sessionSupplier($data['User'][0]['UserID'],$data['User'][0]['Corparation'][0]['CorparationID']);
        
        # calling Supplier
        return redirect()->to(base_url('supplier-plateform'));
    }
    
    public function loginView()
    {
        $sessionActive = $this->sessionValidate();
        if ($sessionActive) {
            # returning to Supplier
            return redirect()->to(base_url('supplier-plateform'));
        }
        return view('SupplierPlateform/loginScreen');
    }

    # Accesses Supplier
    public function supplierView()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        return view('SupplierPlateform/supplierMenu');
    }

    ################## BRAND MANAGER ##################
    # Accesses Brand Manager Screen
    public function brandManager()
    {
        $data = [];

        $sessionActive = $this->sessionValidate();
        
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $data['company_brands'] = $this->companyBrandDetails($_SESSION["CorpID"]);
        $data['active_equipment_true'] = 'Cannot Expire while active Equipment are available.';

        // var_dump($data);
        // die;

        return view('SupplierPlateform/Brand-Management/brandManager',$data);
    }

    # Company Owned Brands
    public function companyBrand()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $data['owned_brands'] = $this->ownedBrandDetails($_SESSION["CorpID"]);
        $data['tool_tips'] = $this->tooltipsforBrandAccess();

        return view('SupplierPlateform/Brand-Management/companyBrands',$data);
    }

    # Brand Details
    public function moreBrandDetails($brandID)
    {
        $data = [];

        $sessionActive = $this->sessionValidate();
        
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $brand_detail = [];
        $brand_access = [];

        $brand_info = $this->getBrandDataviaID($brandID);
        $expire = true;

        if (isset($brand_info[0])) {
            
            # brand wise access count information
            $relationships = $this->relationshipwiseBrandAccessDetails($brand_info[0]['BrandID'],'Detail-Only');

            if(isset($relationships['requested'][0])){
                $brand_access['requested'] = $this->relationshipDetails($relationships['requested']);
                $expire = false;
            }else{
                $brand_access['requested'] = [];
            }

            if(isset($relationships['rejected'][0])){
                $brand_access['rejected'] = $this->relationshipDetails($relationships['rejected']);
            }else{
                $brand_access['rejected'] = [];
            }

            if(isset($relationships['validated'][0])){
                $brand_access['validated'] = $this->relationshipDetails($relationships['validated']);
                $expire = false;
            }else{
                $brand_access['validated'] = [];
            }

            # data list passing for the front-end
            $brand_detail['BrandID']     = $brand_info[0]['BrandID'];
            $brand_detail['Brand']       = $brand_info[0]['Name'];
            $brand_detail['Summary']     = $brand_info[0]['Summary'];
            $brand_detail['Description'] = $brand_info[0]['Description'];
            $brand_detail['Request-Details']  = $brand_access['requested'];
            $brand_detail['Rejected-Details'] = $brand_access['rejected'];
            $brand_detail['Accepted-Details'] = $brand_access['validated'];
            $brand_detail['expire'] = $expire;

            $brand_access = [];
        }
        $data['brand_detail'] = $brand_detail;

        return view('SupplierPlateform/Brand-Management/brandInformation',$data);
        
    }

    # Map a New Brand
    public function linkBrand()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        
    }

    # New Brand Screen
    public function newBrand()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $data = [
            'brandid' => '',
            'brand' => '',
            'summary' => '',
            'description' => '',
            'sellertoo' => '',
            'button' => 'Create',
            'url' => 'supplier-plateform/brands/owned/brand-creation',
            'status' => '',
        ];

        return view('SupplierPlateform/Brand-Management/addNewBrand',$data);
    }

    # Creating a new Brand
    public function createBrand()
    {
        #inital Posted data gathering
        $sellerToo = $this->request->getPost('sellertoo');

        if(isset($sellerToo)){
            $sellerToo = 'checked';
        }
        
        $brand = [
            'Name' => $this->request->getPost('brand'),
            'Summary' => $this->request->getPost('summary'),
            'Description' => $this->request->getPost('description'),
            'OwnerID' => $_SESSION['CorpID'],
        ];

        #Validating the existance of Brand Name
        $brandRepeated = $this->getBrandDatafromBrandName($brand['Name']);

        #If Brand Name already existing
        if($brandRepeated != '')
        {
            $status = '';

            #checking the Brand Name to Ownship
            if($brandRepeated[0]['OwnerID'] == $brand['OwnerID']){
                $status = 'The following Brand Name '.$brand['Name'].' is already created from your Company.';
            }else{
                $owner = $this->companyName($brandRepeated['OwnerID']);
                $status = 'The following Brand Name '.$brand['Name'].' is already added with the Owner Name '.$owner;
            }

            $data = [
                'brandid' => '',
                'brand' => $brand['Name'],
                'summary' => $brand['Summary'],
                'description' => $brand['Description'],
                'sellertoo' => $sellerToo,
                'button' => 'Create',
                'url' => 'supplier-plateform/brands/owned/brand-creation',
                'status' => $status,
            ];
    
            #If Brand Name already existing return Error
            return view('SupplierPlateform/Brand-Management/addNewBrand',$data);
        }

        #calling to create a Brand
        $brand['BrandID'] = $this->addBrandData($brand);

        if($sellerToo)
        {
            $brand_access = [
                'BrandID' => $brand['BrandID'],
                'CorparationID' => $brand['OwnerID'],
                'Relationship' => 'Validated by User',
            ];
    
            #calling to create Brand's Access
            $this->addBrand_AccessData($brand_access);
        }
        
        $status = 'The Brand '.$brand['Name'].' Creation was successful';
        return redirect()->to(base_url('supplier-plateform/brands/owned/brand-details'))->with('success',$status);
    }

    # Brand Modification Screen
    public function modifyBrand($brandID)
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $sellertoo = '';
        $brand = $this->getBrandDataviaID($brandID);

        $stats = $this->brandSellsStatic($brandID, $_SESSION['CorpID']);

        if($stats == 'No-Brand-Access'){
            $sellertoo = '';
        }else{
            $sellertoo = 'checked';
        }

        $data = [
            'brandid' => $brandID,
            'brand' => $brand[0]['Name'],
            'summary' => $brand[0]['Summary'],
            'description' => $brand[0]['Description'],
            'button' => 'Modify',
            'url' => 'supplier-plateform/brands/owned/brand-editing',
            'status' => '',
            'sellertoo' => $sellertoo,
        ];

        return view('SupplierPlateform/Brand-Management/addNewBrand',$data);
    }

    # Edition of the Brand
    public function editBrand()
    {
        $changed = false;
        $sellerTooPost = $this->request->getPost('sellertoo');

        $brandData = [
            'BrandID' => $this->request->getPost('brandid'),
            'Name' => $this->request->getPost('brand'),
            'Summary' => $this->request->getPost('summary'),
            'Description' => $this->request->getPost('description'),
            'OwnerID' => $_SESSION['CorpID'],
        ];

        $changes = $this->validateChangesBrand($brandData);

        $stats = $this->brandSellsStatic($brandData['BrandID'],$brandData['OwnerID']);

        if(isset($sellerTooPost)){
            if($stats == 'No-Brand-Access'){
                $brand_access = [
                    'BrandID' => $brandData['BrandID'],
                    'CorparationID' => $brandData['OwnerID'],
                    'Relationship' => 'Validated by User',
                ];

                #calling to create/active Brand's Access
                $this->activate_createBrandAccess($brand_access);
                $changed = true;
            }

            $sellertoo = 'checked';
        }else{
            if($stats == 'Active-Equip'){
                # Active equipments are available for the Brand
                $status = 'Active equipments are available and so cannot remove the seller.';
            }elseif($stats == 'No-Equip'){
                # No equipments are available for the Brand
                $this->setBrand_AccessStatusviaBrandIDandOwnerID($brandData['BrandID'],$brandData['OwnerID'], 'E');
                $changed = true;
            }

            $sellertoo = '';
        }

        if(!isset($changes[0])){
            if(!($changed)){
                if($status == ''){
                    # No Access changed or Brand Inform remains to be changed
                    $status = 'No brand detail change have being done. ';
                }

                $data = [
                    'brandid' => $brandData['BrandID'],
                    'brand' => $brandData['Name'],
                    'summary' => $brandData['Summary'],
                    'description' => $brandData['Description'],
                    'button' => 'Modify',
                    'url' => 'supplier-plateform/brands/owned/brand-editing', 
                    'sellertoo' => $sellertoo,
                    'status' => $status,
                ];

                return view('SupplierPlateform/Brand-Management/addNewBrand',$data);
            }
        }else{
            # Brand changing controller
            $changed = $this->changingBrandDetails($changes, $brandData);
        }

        return redirect()->to(base_url('supplier-plateform/brands/owned/brand-details'));
    }

    # Expire Brand
    public function expireBrand($brandID)
    {
        $expire = true;
        $relationships = $this->relationshipwiseBrandAccessDetails($brandID,'Count-Only');

        if(($relationships['requested'] + $relationships['validated']) > 0){
            $expire = false;
        }

        $this->setBrandStatusviaID($brandID, 'E');

        return redirect()->to(base_url('supplier-plateform/brands/owned/brand-details'));
    }

    # Brand Mapping Screen
    public function mapBrandAccess()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $current_brand_access = $this->companyAccessBrandNames($_SESSION['CorpID']);
        $non_access_brands = $this->exclusionBrands($current_brand_access);

        $data['brand_list'] = $non_access_brands;

        return view('SupplierPlateform/Brand-Management/mapBrandAccess',$data);
    }

    # Mapping the New Brand
    public function mapNewAccess()
    {
        $brand_access = [
            'BrandID' => $this->request->getPost('brandid'),
            'CorparationID' => $_SESSION['CorpID'],
        ];

        $this->addBrand_AccessData($brand_access);

        return redirect()->to(base_url('supplier-plateform/brands/access/brand-details'));

    }

    # JS request Brand Detail
    public function jsBrandDetail()
    {
        $BrandID = $this->request->getPost('brandid');

        // $brand['brandID'] = $BrandID;
        $brand_info = $this->getBrandDataviaID($BrandID);

        echo json_encode($brand_info[0]);
        exit;

    }
    
    # Expire Brand Access
    public function expireBrandAccess($brand_accessID)
    {
        return $this->companyBrandAccessStsChg($brand_accessID,'E');
        // return redirect()->to(base_url('supplier-plateform/brands/access/brand-details'));
    }

    ################## BRAND MANAGER ##################
    # Equipment Detail Screen
    public function productStorage()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $corparateID = $_SESSION['CorpID'];

        $equipment = [];

        $equipmentDetails = $this->getEquipmentDataviaCorparationID($corparateID);

        foreach ($equipmentDetails as $row_1_key => $row_1_value) {
            # loop all equipment details
            $equipment[$row_1_key]['EquipmentID']   = $row_1_value['EquipmentID'];
            $equipment[$row_1_key]['Name']          = $row_1_value['Name'];
            $equipment[$row_1_key]['Highlight']     = $row_1_value['Highlight'];
            $equipment[$row_1_key]['Rate']          = $row_1_value['Rate'];
            $equipment[$row_1_key]['Brand']         = $this->access_brandName($row_1_value['Brand_AccessID']);
            $equipment[$row_1_key]['Count']         = $this->equipmentItemCount($row_1_value['EquipmentID']);
            $equipment[$row_1_key]['Genre']         = $this->gerneName($row_1_value['GenreID']);
            $equipment[$row_1_key]['Rental_Sales']  = $row_1_value['Rental_Sales'];

        }

        $data['Equipment'] = $equipment;
        $data['active_item_true'] = 'Cannot Expire while active Items are available.';

        return view('SupplierPlateform/Product-Store/equipmentDetail',$data);
        // var_dump($equipment);
        // die;
        
    }
}

?>