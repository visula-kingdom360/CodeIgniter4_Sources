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

        #Remember User Information
        $remember = $this->request->getPost('remember');
        if (isset($remember)) 
        {
            # Remember Accesses
            $this->accessRemember($username, $password); // need to think how to do this
        }

        // # User Login History
        // $this->userLoginHistory($data['user'][0]['PK']['UserID']);

        // var_dump($data);
        // die;
        # Session Creation
        $this->sessionSupplier($data['User'][0]['UserID'],$data['User'][0]['Corparation'][0]['CorparationID']);
        
        # calling Supplier
        return redirect()->to(base_url('supplier'));
    }
    
    public function loginView()
    {
        $sessionActive = $this->sessionValidate();
        if ($sessionActive) {
            # returning to Supplier
            return redirect()->to(base_url('supplier'));
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

    # Accesses Brand Manager
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

    // # Brand Details
    public function moreBrandDetails($brandID)
    {
        $data = [];

        $sessionActive = $this->sessionValidate();
        
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $data['brand_details'] = $this->brandDetails($brandID);
        // var_dump($data);
        // die;
        // echo $brandID;
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

    # Adding New Brand's
    public function newBrand()
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $data = [
            'brandacessid' => '',
            'brand' => '',
            'summary' => '',
            'description' => '',
            'sellertoo' => '',
            'button' => 'Create',
            'url' => 'brand-creation',
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
                'brandacessid' => '',
                'brand' => $brand['Name'],
                'summary' => $brand['Summary'],
                'description' => $brand['Description'],
                'sellertoo' => $sellerToo,
                'button' => 'Create',
                'url' => 'brand-creation',
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
            $this->brandAccessCreation($brand_access);
        }
        
        $status = 'The Brand '.$brand['Name'].' Creation was successful';
        return redirect()->to(base_url('company-brands'))->with('success',$status);
        // return $this->brandDataCreate($brandData, $sellerToo);
    }

    public function modifyBrand($brandID) #Screen Access Task
    {
        $sessionActive = $this->sessionValidate();
        if (!$sessionActive) {
            # returning to Login
            return redirect()->to(base_url('login'));
        }

        $sellertoo = '';
        $brand = $this->getBrandDataviaID($brandID);

        $stats = $this->brandSellsStatic($brandID, $_SESSION['CorpID']);

        if($stats != 'No-Brand-Access'){
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
            'url' => 'brand-editing',
            'status' => '',
            'sellertoo' => $sellertoo,
        ];

        return view('SupplierPlateform/Brand-Management/addNewBrand',$data);
    }

    public function editBrand()
    {
        $sellerTooPost = $this->request->getPost('sellertoo');
        $sellertoo = '';

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
                $data['status'] = 'Active equipments are available and so cannot remove the seller condition of this Brand. ';
            }elseif($stats == 'No-Equip'){
                # No equipments are available for the Brand
                $this->setBrand_AccessStatusviaBrandID($brand_accessID, 'E');
                $changed = true;
            }

            $sellertoo = '';
        }

        if(!isset($changes[0]) && !($changed)){
            # No Access changed or Brand Inform remains to be changed
            $data['status'] = 'No Brand detail changes have being done. ';
        }else{
            $changed = $this->changingBrandDetails($changes, $brandData);
        }

        if(!($changed)){
            # returning Data if modification was not approved
            $data = [
                'brandid' => $brandData['BrandID'],
                'brand' => $brandData['Name'],
                'summary' => $brandData['Summary'],
                'description' => $brandData['Description'],
                'button' => 'Modify',
                'url' => 'brand-editing', 
                'sellertoo' => $sellertoo,
            ];
    
            return view('SupplierPlateform/Brand-Management/addNewBrand',$data);
        }
            
        return redirect()->to(base_url('company-brands'));
            
        // return view('SupplierPlateform/Brand-Management/addNewBrand',$data);

        #returning Data if modification was not approved
        // $data = [
        //     'brandid' => $brandData['BrandID'],
        //     'brand' => $brandData['Name'],
        //     'summary' => $brandData['Summary'],
        //     'description' => $brandData['Description'],
        //     'button' => 'Modify',
        //     'url' => 'brand-editing', 
        // ];

        // return view('SupplierPlateform/Brand-Management/addNewBrand',$data);

        // $brand_access = $this->brand_accessDetail($brandData['brandacessid']);

        // if($brandData['Name'] != $brand_access[0]['SK']['Name']){
        //     // $data['status'] = 'Data';
        // }elseif($brandData['Summary'] != $brand_access[0]['SK']['Summary']){

        // }elseif($brandData['Description'] != $brand_access[0]['SK']['Description']){
        // // }elseif($sellerToo != $brand_access[0]['SK']['Description']){

        // }else{
            
        // }
    }
    
    public function changeBrand($brand_accessID)
    {

    }
    
    public function expireBrand($brand_accessID)
    {

        return $this->companyBrandStsChg($brand_accessID);
        // return redirect()->to(base_url('brand-manager'));
    }
}

?>