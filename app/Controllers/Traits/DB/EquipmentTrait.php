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
    public $image_files = [];

    ##################### E Q U I P M E N T   C R U D #####################
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

    public function getEquipmentDataviaBrandID($brand_accessID,$limitedEquips = 99)
    {
        $equipmentModule = new Equipment();
        
        # Equipment data from DB directly
        $equipmentDBData = $equipmentModule->selectEquipmentsbyBrnadID($brand_accessID, $limitedEquips);

        # Converting the DB Data to an Array
        $this->equipment = $this->pushModelDBDataToArrayReturn($equipmentModule, $equipmentDBData);

        return $this->equipment;
    }

    public function getEquipmentDataviaCorparationID($corparationID, $limitedEquips = 99)
    {
        $equipmentModule = new Equipment();

        # Equipment data from DB directly
        $equipmentDBData = $equipmentModule->selectEquipmentsbyCorparationID($corparationID, $limitedEquips);

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

    ##################### I T E M   C R U D #####################
    public function getItemDataviaEquipmentID($equipmentID, $limitedItems = 5)
    {
        $itemModule = new Item();

        # Item data from DB directly
        $itemDBData = $itemModule->selectItembyEquipmentID($equipmentID, $limitedItems);

        # Converting the DB Data to an Array
        $this->item = $this->pushModelDBDataToArrayReturn($itemModule, $itemDBData);

        return $this->item;
    }

    ##################### S T O C K S   C R U D #####################
    public function getStockDataviaItemID($ItemID) #getStockDataviaItemID
    {
        $stocksModule = new Stocks();

        # Stocks data from DB directly
        $stocksDBData = $stocksModule->selectStocksbyItemID($ItemID);

        # Converting the DB Data to an Array
        $this->stocks = $this->pushModelDBDataToArrayReturn($stocksModule, $stocksDBData);
            
        return  $this->stocks;
    }

    ##################### I T E M   S A L E   C R U D #####################
    public function getItem_SaleDataviaItemID($ItemID) #getItem_SaleDataviaItemID
    {
        $saleModule = new Item_Sale();

        # Item's Sale data from DB directly
        $saleDBData = $saleModule->selectItem_SalebyItemID($ItemID);

        // foreach ($saleDBData as $row => $feilds) {
        //     # Item Sale data from DB directly
        //     $sale[$row]['PK'] = $this->autoFeildBreakup($saleModule->primaryKey, $feilds);
        //     $sale[$row]['SK'] = $this->autoFeildBreakup($saleModule->allowedFields, $feilds);
        //     // number_format($number, 2, '.', '')
        //     $sale[$row]['SK']['SalesPrice'] = number_format(($feilds->{'Price'} - $feilds->{'InternalDiscount'}),2, '.', '');
        //     // $sale[$row]['SK']['SalesPrice'] += ($sale[$row]['SK']['Price'] - $sale[$row]['SK']['InternalDiscount']);
        // }

        # Converting the DB Data to an Array
        $this->item_sale = $this->pushModelDBDataToArrayReturn($saleModule, $saleDBData);
        
        return  $this->item_sale;
    }

    ##################### I T E M   R E N T A L   C R U D #####################
    public function getItem_RentalDataviaItemID($ItemID) #getItem_RentalDataviaItemID
    {
        $rental = [];

        $rentalModule = new Item_Rental();
        
        # Item's Rental data from DB directly
        $rentalDBData = $rentalModule->selectItem_RentalbyItemID($ItemID);

        // foreach ($rentalDBData as $row => $feilds) {
        //     # Item Rental data from DB directly
        //     $rental[$row]['PK'] = $this->autoFeildBreakup($rentalModule->primaryKey, $feilds);
        //     $rental[$row]['SK'] = $this->autoFeildBreakup($rentalModule->allowedFields, $feilds);
        //     $rental[$row]['SK']['Preiod'] = $this->periodType($feilds->{'PreiodType'});
        // }
            
        # Converting the DB Data to an Array
        $this->item_rental = $this->pushModelDBDataToArrayReturn($rentalModule, $rentalDBData);
        
        return  $this->item_rental;
    }

    ##################### I T E M   D E T A I L   T Y P E S   C R U D #####################
    public function getItem_Detail_TypesDataviaItemID($ItemID) #getItem_Detail_TypesDataviaItemID
    {
        $item_detail_typesModule = new Item_Detail_Types();

        # Item Detail Types data from DB directly
        $item_detail_typesDBData = $item_detail_typesModule->selectItem_Detail_TypesbyItemID($ItemID, $this->limitedCategs);

        // foreach ($item_detail_typesDBData as $row => $feilds) {
        //     # Category data from DB directly
        //     $item_detail_types[$row]['PK'] = $this->autoFeildBreakup($item_detail_typesModule->primaryKey, $feilds);
        //     $item_detail_types[$row]['SK'] = $this->autoFeildBreakup($item_detail_typesModule->allowedFields, $feilds);
        // }
            
        # Converting the DB Data to an Array
        $this->item_detail_types = $this->pushModelDBDataToArrayReturn($item_detail_typesModule, $item_detail_typesDBData);
        
        return  $this->item_detail_types;
    }

    ##################### I T E M   W I S E   D E T A I L S   C R U D #####################
    ##################### I M A G E   C R U D #####################
    public function getImageDataviaItemID($ItemID) #getImageDataviaItemID
    {
        $image = [];

        $imageModule = new Image();

        # Images data from DB directly
        $imageDBData = $imageModule->selectImagesbyItemID($ItemID);

        // foreach ($imageDBData as $row => $feilds) {
        //     # Image data from DB directly
        //     $image[$row]['PK'] = $this->autoFeildBreakup($imageModule->primaryKey, $feilds);
        //     $image[$row]['SK'] = $this->autoFeildBreakup($imageModule->allowedFields, $feilds);
        // }
            
        # Converting the DB Data to an Array
        $this->image_files = $this->pushModelDBDataToArrayReturn($imageModule, $imageDBData);
        
        return  $this->image_files;
    }
}
?>