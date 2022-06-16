<?php
namespace App\Controllers\Traits\DB;

use App\Models\Equipment;
use App\Models\Item;
use App\Models\Stocks;
use App\Models\Item_Sale;
use App\Models\Item_Rental;
use App\Models\Item_Detail_Types;
use App\Models\Item_Wise_Detail;
use App\Models\Image;

trait EquipmentTrait {

    # Public Table Array's
    public $equipment = [];
    public $item      = [];
    public $stocks    = [];
    public $item_sale   = [];
    public $item_rental = [];
    public $item_detail_types = [];
    public $item_wise_details = [];

    ##################### E Q U I P M E N T   C R U D #####################
     # getEquipmentDataviaEquipmentID
    public function getEquipmentDataviaEquipmentID($equipmentID)
    {
        $equipmentModule = new Equipment();

        # Equipment data from DB directly
        $equipmentDBData = $equipmentModule->selectEquipments($equipmentID);

        if(isset($brand_accessDBData[0])){
            # Converting the DB Data to an Array
            $this->equipment = $this->pushModelDBDataToArrayReturn($equipmentModule, $equipmentDBData);

            return $this->equipment;
        }else{
            return '';
        }
    }

    public function getEquipmentDataviaBrandID($brand_accessID,$limitedEquips = 99) #getEquipmentDataviaBrandID
    {
        $equipmentModule = new Equipment();
        
        # Equipment data from DB directly
        $equipmentDBData = $equipmentModule->selectEquipmentsbyBrnadID($brand_accessID, $limitedEquips);

        # Converting the DB Data to an Array
        $this->equipment = $this->pushModelDBDataToArrayReturn($equipmentModule, $equipmentDBData);

        return $this->equipment;
    }

    // public function equipmentWiseItems($equipmentID, $rental_sales) #getEquipmentDataviaEquipmentID
    // {
    //     $item = [];
    //     $RemainingStocks = 0;

    //     $itemModule = new Item();
    //     $itemDBData = $itemModule->selectItembyEquipmentID($equipmentID);

    //     foreach ($itemDBData as $row => $feilds) {
    //         # Item data from DB directly
    //         $item[$row]['PK'] = $this->autoFeildBreakup($itemModule->primaryKey, $feilds);
    //         $item[$row]['SK'] = $this->autoFeildBreakup($itemModule->allowedFields, $feilds);
    //         $item[$row]['SK']['Category_Item'] = $this->getItem_Detail_TypesDataviaItemID($feilds->{'ItemID'});

    //         if($rental_sales == 'Both' OR $rental_sales == 'Rental')
    //         {
    //             $item[$row]['SK']['Rental'] = $this->getItem_RentalDataviaItemID($feilds->{'ItemID'});
    //         }
            
    //         if($rental_sales == 'Both' OR $rental_sales == 'Sale')
    //         {
    //             $item[$row]['SK']['Sale'] = $this->getItem_SaleDataviaItemID($feilds->{'ItemID'});
    //         }
            
    //         $imageList = $this->getImageDataviaItemID($feilds->{'ItemID'});
    //         $stockList = $this->getStockDataviaItemID($feilds->{'ItemID'});
    //         foreach ($stockList as $key => $value) {
    //             # Stock Remaining Value
    //             $RemainingStocks += ($value['SK']['TotalStocks'] - $value['SK']['SoldStocks']);
    //         }

    //         $item[$row]['SK']['RemainingStocks'] = $RemainingStocks;
    //         $item[$row]['SK']['Images'] = $imageList;
    //     }
            
    //     return  $item;
    // }

    public function getOfferDataviaEquipmentID($equipmentID) #getOfferDataviaEquipmentID
    {
        $offer = [];
        $RemainingStocks = 0;

        $offerModule = new Offer();
        $offerDBData = $offerModule->selectOfferbyEquipmentID($equipmentID);

        foreach ($offerDBData as $row => $feilds) {
            $offer[$row]['PK'] = $this->autoFeildBreakup($offerModule->primaryKey, $feilds);
            $offer[$row]['SK'] = $this->autoFeildBreakup($offerModule->allowedFields, $feilds);
        }
        return  $offer;
    }

    ##################### I T E M   C R U D #####################
    ##################### S T O C K S   C R U D #####################
    public function getStockDataviaItemID($ItemID) #getStockDataviaItemID
    {
        $stocks = [];

        $stocksModule = new Stocks();
        $stocksDBData = $stocksModule->selectStocksbyItemID($ItemID);

        foreach ($stocksDBData as $row => $feilds) {
            # Stock data from DB directly
            $stocks[$row]['PK'] = $this->autoFeildBreakup($stocksModule->primaryKey, $feilds);
            $stocks[$row]['SK'] = $this->autoFeildBreakup($stocksModule->allowedFields, $feilds);
        }
            
        return  $stocks;
    }

    ##################### I T E M   S A L E   C R U D #####################
    public function getItem_SaleDataviaItemID($ItemID) #getItem_SaleDataviaItemID
    {
        $sale = [];

        $saleModule = new Item_Sale();
        $saleDBData = $saleModule->selectItem_SalebyItemID($ItemID);

        foreach ($saleDBData as $row => $feilds) {
            # Item Sale data from DB directly
            $sale[$row]['PK'] = $this->autoFeildBreakup($saleModule->primaryKey, $feilds);
            $sale[$row]['SK'] = $this->autoFeildBreakup($saleModule->allowedFields, $feilds);
            // number_format($number, 2, '.', '')
            $sale[$row]['SK']['SalesPrice'] = number_format(($feilds->{'Price'} - $feilds->{'InternalDiscount'}),2, '.', '');
            // $sale[$row]['SK']['SalesPrice'] += ($sale[$row]['SK']['Price'] - $sale[$row]['SK']['InternalDiscount']);
        }

        return  $sale;
    }

    ##################### I T E M   R E N T A L   C R U D #####################
    public function getItem_RentalDataviaItemID($ItemID) #getItem_RentalDataviaItemID
    {
        $rental = [];

        $rentalModule = new Item_Rental();
        $rentalDBData = $rentalModule->selectItem_RentalbyItemID($ItemID);

        foreach ($rentalDBData as $row => $feilds) {
            # Item Rental data from DB directly
            $rental[$row]['PK'] = $this->autoFeildBreakup($rentalModule->primaryKey, $feilds);
            $rental[$row]['SK'] = $this->autoFeildBreakup($rentalModule->allowedFields, $feilds);
            $rental[$row]['SK']['Preiod'] = $this->periodType($feilds->{'PreiodType'});
        }
            
        return  $rental;
    }

    ##################### I T E M   D E T A I L   T Y P E S   C R U D #####################
    public function getItem_Detail_TypesDataviaItemID($ItemID) #getItem_Detail_TypesDataviaItemID
    {
        $item_detail_types = [];

        $item_detail_typesModule = new Item_Detail_Types();
        $item_detail_typesDBData = $item_detail_typesModule->selectItem_Detail_TypesbyItemID($ItemID, $this->limitedCategs);

        foreach ($item_detail_typesDBData as $row => $feilds) {
            # Category data from DB directly
            $item_detail_types[$row]['PK'] = $this->autoFeildBreakup($item_detail_typesModule->primaryKey, $feilds);
            $item_detail_types[$row]['SK'] = $this->autoFeildBreakup($item_detail_typesModule->allowedFields, $feilds);
        }
            
        return  $item_detail_types;
    }

    ##################### I T E M   W I S E   D E T A I L S   C R U D #####################
    ##################### I M A G E   C R U D #####################
    public function getImageDataviaItemID($ItemID) #getImageDataviaItemID
    {
        $image = [];

        $imageModule = new Image();
        $imageDBData = $imageModule->selectImagesbyItemID($ItemID);

        foreach ($imageDBData as $row => $feilds) {
            # Image data from DB directly
            $image[$row]['PK'] = $this->autoFeildBreakup($imageModule->primaryKey, $feilds);
            $image[$row]['SK'] = $this->autoFeildBreakup($imageModule->allowedFields, $feilds);
        }
            
        return  $image;

    }
}
?>