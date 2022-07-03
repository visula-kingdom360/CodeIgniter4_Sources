<?php
namespace App\Controllers\Traits\DB;

use App\Models\Offer;

trait OfferTrait {

    # Public Table Array's
    public $offer = [];
    
    ##################### O F F E R   C R U D #####################
    public function getOfferDataviaEquipmentID($equipmentID) #getOfferDataviaEquipmentID
    {
        $offerModule = new Offer();

        # Offer data from DB directly
        $offerDBData = $offerModule->selectOfferbyEquipmentID($equipmentID);

        $this->offer = $this->pushModelDBDataToArrayReturn($offerModule, $offerDBData);

        return  $this->offer;
    }

    
}
?>