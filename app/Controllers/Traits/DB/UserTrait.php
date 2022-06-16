<?php
namespace App\Controllers\Traits\DB;

use App\Models\User;
use App\Models\Supplier;

trait UserTrait {
    
    ##################### U S E R   C R U D #####################
    #Getting User information by Username
    public function userbyUsername($username) #getUserDataviaUsername
    {
        $userModule = new User();
        
        # User data from DB directly
        $userDBData = $userModule->selectUserbyUsername($username);

        # Converting the DB Data to an Array
        $this->user = $this->pushModelDBDataToArrayReturn($userModule, $userDBData);
        
        return $this->user;
    }

    #Getting User information by Email
    public function userbyEmail($email) #getUserDataviaEmail
    {
        $userModule = new User();
        
        # User data from DB directly
        $userDBData = $userModule->selectUserbyEmail($email);

        # Converting the DB Data to an Array
        $this->user = $this->pushModelDBDataToArrayReturn($userModule, $userDBData);
        
        return $this->user;
    }
    
    ##################### C U S T O M E R   C R U D #####################
    
    ##################### S U P P L I E R   C R U D #####################
    #Getting Supplier information by UserID
    public function getSupplierDataviaUserID($userID)
    {
        $supplierModule = new Supplier();

        # Supplier data from DB directly
        $supplierDBData = $supplierModule->selectgetSupplierDataviaUserID($userID);

        # Converting the DB Data to an Array
        $this->supplier = $this->pushModelDBDataToArrayReturn($supplierModule, $supplierDBData);
        
        return $this->supplier;
    }

    ##################### U S E R   L O G I N   I N F O   C R U D #####################
    #User Login History Information
    public function userLoginHistory($userID) #addUser_Login_HistoryviaUserID
    {
        $user_login_history = [
            'userID' => $userID,
            'ipAddress' => $this->getIPAddress(),
            'machineName' => $this->getHostname()
        ];

        $user_login_historyModule = new User_Login_History();
        
        # User Login History data from DB directly: returning ID
        $this->user_login_history['User_Login_InfoID'] = $user_login_historyModule->insertDatatoUser_Login_Info($user_login_history);

        if(isset($this->user_login_history['User_Login_InfoID'])){
            return $this->user_login_history['User_Login_InfoID'];
        }else{
            return '';
        }
    }
}
?>