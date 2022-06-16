<?php
namespace App\Controllers;

// use App\Models\User;
// use App\Models\Supplier;
// use App\Models\Corparation;

class AccessController extends BlueprintController
{
    use Traits\DB\UserTrait;
    use Traits\DB\HistoryTrait;
    use Traits\DB\CorparationTrait;

    #Session Validation
    public function sessionValidate()
    {
        if(isset($_SESSION['UserID']) && isset($_SESSION['CorpID']))
        {
            # Access Granted
            return true;
        }
        #Access Rejected
        return false;
    }

    #Session Creation
    public function sessionSupplier($userID, $corpID)
    {
        $_SESSION["UserID"] = $userID;
        $_SESSION["CorpID"] = $corpID;

        # Access Granted
        return true;
    }

    #Valid User Access
    public function validateUser($username, $password)
    {
        $user = [];
        $success = '';
        $error = '';
        $commonErr = 'If this error still stands please contact an admin of "Online Order Mart Wide World" team for tech support.';

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $user = $this->userbyEmail($username);
            $access = 'Email';
        }else{
            $user = $this->userbyUsername($username);
            $access = 'Username';
        }

        #Information validate and get statuses amd errors
        if(isset($user[0]))
        {
            $user[0]['Supplier'] = $this->getSupplierDataviaUserID($user[0]['UserID']);
            $user[0]['Corparation'] = $this->getCorparationDataviaCorpID($user[0]['Supplier'][0]['CorparationID']);

            if($user[0]['Password'] != $password){
                $error = 'Password is incorrect.Please check your password and try again.'.$commonErr;
            }elseif(!isset($user[0]['Supplier'])){
                $error = 'Supplier is not mapped.Please check your user and try again.'.$commonErr;
            }elseif(!isset($user[0]['Corparation'])){
                $error = 'Company is not mapped.Please check your user and try again.'.$commonErr;
            }else{
                $success = 'Connection is successful.';
            }
        }else{
            $error = $access.' was incorrect. Please check your username and try again. '.$commonErr;
        }

        return [
            'success' => $success,
            'error' => $error,
            'User' => $user
        ];
    }

    #Access Remember Process
    public function accessRemember($username, $password)
    {

    }

    #IP Address
    public function getIPAddress()
    {  
        //whether ip is from the share internet  
            if(!emptyempty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!emptyempty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            }  
        //whether ip is from the remote address  
        else{  
                    $ip = $_SERVER['REMOTE_ADDR'];  
            }  
            return $ip;  
    }    
}

?>