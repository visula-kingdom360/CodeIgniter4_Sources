<?php
namespace App\Controllers\Traits\DB;

use App\Models\Corparation;

trait CorparationTrait {
    
    # Public Table Array's
    public $corparation = [];

    ##################### C O R P A R A T I O N   C R U D #####################
    //Company Detail by ID and internally gather all the Brand information necessary
    // public function companyDetail($corparationID) 
    // {
    //     $corpModule = new Corparation();
        
    //     # Corparate data from DB directly
    //     $corpDBData = $corpModule->selectCompanybyID($corparationID);

    //     # Converting the DB Data to an Array
    //     $this->corparation = $this->pushModelDBDataToArrayReturn($corpModule, $corpDBData);

    //     return  $this->corparation;
    // }

    //All Company Details and internally gather all the Brand information necessary [limits assigned]
    public function companyDetails()
    {
        $corpModule = new Corparation();
        
        # Corparate data from DB directly
        $corpDBData = $corpModule->selectCompany($this->limitedCorps);
        
        # Converting the DB Data to an Array
        $this->corparation = $this->pushModelDBDataToArrayReturn($corpModule, $corpDBData);

        return  $this->corparation;
    }

    #Getting Corparation information by CorparationID
    public function getCorparationDataviaCorpID($corparationID) #getCorparationDataviaCorpID
    {
        $corpModule = new Corparation();

        # Corparate data from DB directly
        $corpDBData = $corpModule->selectCompanybyID($corparationID);

        if(isset($corpDBData[0]))
            { # Converting the DB Data to an Array
            $this->corparation = $this->pushModelDBDataToArrayReturn($corpModule, $corpDBData);

            return $this->corparation;
        }else
        {
            return '';
        }
    }

    // public function companyNameValidation($corparationID)
    // {
    //     $corpModule = new Corparation();

    //     # Corparate data from DB directly
    //     $corpDBData = $corpModule->selectCompanybyID($corparationID);

    //     if(isset($corpDBData[0]))
    //     {
    //         # Converting the DB Data to an Array
    //         $this->corparation = $this->pushModelDBDataToArrayReturn($corpModule, $corpDBData);

    //         return $this->corparation;
    //     }else
    //     {
    //         return '';
    //     }
    // }
}
?>