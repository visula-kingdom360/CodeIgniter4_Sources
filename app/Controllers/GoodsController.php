<?php
namespace App\Controllers;

defined('BASEPATH');

// use App\Models\Brand_Access;
// use App\Models\Equipment;
// use App\Models\Item;
// use App\Models\Stocks;
// use App\Models\Item_Detail_Types;
// use App\Models\Item_Rental;
// use App\Models\Item_Sale;
// use App\Models\Genre;
// use App\Models\Image;
// use App\Models\Offer;

class GoodsController extends AccessController
{

    // public function companyWiseBrands($corparationID)
    // {
    //     $brand_access = [];

    //     $brand_accessModule = new Brand_Access();
    //     $brand_accessDBData = $brand_accessModule->selectBrand_AccessbyCorpID($corparationID, $this->limitedBrands);

    //     foreach ($brand_accessDBData as $row => $feilds) {
    //         # Brand Access data from DB directly
    //         $brand_access[$row]['PK'] = $this->autoFeildBreakup($brand_accessModule->primaryKey, $feilds);
    //         $brand_access[$row]['SK'] = $this->autoFeildBreakup($brand_accessModule->allowedFields, $feilds);
    //         $brand_access[$row]['SK']['Equipments'] = $this->getEquipmentDataviaBrandID($feilds->{'Brand_AccessID'}, $this->limitedEquips);
    //     }
            
    //     return  $brand_access;
    // }

    // public function getEquipmentDataviaEquipmentID($equipmentID)
    // {
    //     $equipment = [];

    //     $equipmentModule = new Equipment();
    //     $equipmentDBData = $equipmentModule->selectEquipments($equipmentID);

    //     foreach ($equipmentDBData as $row => $feilds) {
    //         # Equipment data from DB directly
    //         $equipment[$row]['PK'] = $this->autoFeildBreakup($equipmentModule->primaryKey, $feilds);
    //         $equipment[$row]['SK'] = $this->autoFeildBreakup($equipmentModule->allowedFields, $feilds);
    //         $equipment[$row]['SK']['Items'] = $this->equipmentWiseItems($feilds->{'EquipmentID'}, $feilds->{'Rental_Sales'});
    //         $equipment[$row]['SK']['Offer'] = $this->getOfferDataviaEquipmentID($feilds->{'EquipmentID'});
    //     }
            
    //     return  $equipment;
    // }

    // public function getEquipmentDataviaBrandID($brandID)
    // {
    //     $equipment = [];

    //     $equipmentModule = new Equipment();
    //     $equipmentDBData = $equipmentModule->selectEquipmentsbyBrnadID($brandID, $this->limitedEquips);

    //     foreach ($equipmentDBData as $row => $feilds) {
    //         # Equipment data from DB directly
    //         $equipment[$row]['PK'] = $this->autoFeildBreakup($equipmentModule->primaryKey, $feilds);
    //         $equipment[$row]['SK'] = $this->autoFeildBreakup($equipmentModule->allowedFields, $feilds);
    //         $equipment[$row]['SK']['Offer'] = $this->getOfferDataviaEquipmentID($feilds->{'EquipmentID'});
    //         $equipment[$row]['SK']['Items'] = $this->equipmentWiseItems($feilds->{'EquipmentID'}, $feilds->{'Rental_Sales'});
    //     }
            
    //     return  $equipment;
    // }

    // public function equipmentWiseItems($equipmentID, $rental_sales)
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

    // public function getOfferDataviaEquipmentID($equipmentID)
    // {
    //     $offer = [];
    //     $RemainingStocks = 0;

    //     $offerModule = new Offer();
    //     $offerDBData = $offerModule->selectOfferbyEquipmentID($equipmentID);

    //     foreach ($offerDBData as $row => $feilds) {
    //         $offer[$row]['PK'] = $this->autoFeildBreakup($offerModule->primaryKey, $feilds);
    //         $offer[$row]['SK'] = $this->autoFeildBreakup($offerModule->allowedFields, $feilds);
    //     }
    //     return  $offer;
    // }

    // public function getImageDataviaItemID($ItemID)
    // {
    //     $image = [];

    //     $imageModule = new Image();
    //     $imageDBData = $imageModule->selectImagesbyItemID($ItemID);

    //     foreach ($imageDBData as $row => $feilds) {
    //         # Image data from DB directly
    //         $image[$row]['PK'] = $this->autoFeildBreakup($imageModule->primaryKey, $feilds);
    //         $image[$row]['SK'] = $this->autoFeildBreakup($imageModule->allowedFields, $feilds);
    //     }
            
    //     return  $image;

    // }

    // public function getStockDataviaItemID($ItemID)
    // {
    //     $stocks = [];

    //     $stocksModule = new Stocks();
    //     $stocksDBData = $stocksModule->selectStocksbyItemID($ItemID);

    //     foreach ($stocksDBData as $row => $feilds) {
    //         # Stock data from DB directly
    //         $stocks[$row]['PK'] = $this->autoFeildBreakup($stocksModule->primaryKey, $feilds);
    //         $stocks[$row]['SK'] = $this->autoFeildBreakup($stocksModule->allowedFields, $feilds);
    //     }
            
    //     return  $stocks;
    // }

    // public function getItem_Detail_TypesDataviaItemID($ItemID)
    // {
    //     $item_detail_types = [];

    //     $item_detail_typesModule = new Item_Detail_Types();
    //     $item_detail_typesDBData = $item_detail_typesModule->selectItem_Detail_TypesbyItemID($ItemID, $this->limitedCategs);

    //     foreach ($item_detail_typesDBData as $row => $feilds) {
    //         # Category data from DB directly
    //         $item_detail_types[$row]['PK'] = $this->autoFeildBreakup($item_detail_typesModule->primaryKey, $feilds);
    //         $item_detail_types[$row]['SK'] = $this->autoFeildBreakup($item_detail_typesModule->allowedFields, $feilds);
    //     }
            
    //     return  $item_detail_types;
    // }

    // public function getItem_RentalDataviaItemID($ItemID)
    // {
    //     $rental = [];

    //     $rentalModule = new Item_Rental();
    //     $rentalDBData = $rentalModule->selectItem_RentalbyItemID($ItemID);

    //     foreach ($rentalDBData as $row => $feilds) {
    //         # Item Rental data from DB directly
    //         $rental[$row]['PK'] = $this->autoFeildBreakup($rentalModule->primaryKey, $feilds);
    //         $rental[$row]['SK'] = $this->autoFeildBreakup($rentalModule->allowedFields, $feilds);
    //         $rental[$row]['SK']['Preiod'] = $this->periodType($feilds->{'PreiodType'});
    //     }
            
    //     return  $rental;
    // }

    public function periodType($PreiodType)
    {
        if($PreiodType == 'hr'){
            return 'Hour';
        }elseif($PreiodType == 'D'){
            return 'Day';
        }elseif($PreiodType == 'W'){
            return 'Week';
        }elseif($PreiodType == 'M'){
            return 'Month';
        }elseif($PreiodType == 'Q'){
            return 'Quarter Year';
        }elseif($PreiodType == 'HY'){
            return 'Half Year';
        }elseif($PreiodType == 'Y'){
            return 'Year';
        }else{
            return '';
        }
    }

    // public function getItem_SaleDataviaItemID($ItemID)
    // {
    //     $sale = [];

    //     $saleModule = new Item_Sale();
    //     $saleDBData = $saleModule->selectItem_SalebyItemID($ItemID);

    //     foreach ($saleDBData as $row => $feilds) {
    //         # Item Sale data from DB directly
    //         $sale[$row]['PK'] = $this->autoFeildBreakup($saleModule->primaryKey, $feilds);
    //         $sale[$row]['SK'] = $this->autoFeildBreakup($saleModule->allowedFields, $feilds);
    //         // number_format($number, 2, '.', '')
    //         $sale[$row]['SK']['SalesPrice'] = number_format(($feilds->{'Price'} - $feilds->{'InternalDiscount'}),2, '.', '');
    //         // $sale[$row]['SK']['SalesPrice'] += ($sale[$row]['SK']['Price'] - $sale[$row]['SK']['InternalDiscount']);
    //     }

    //     return  $sale;
    // }

    public function genreDetails() #genre lists limited values
    {
        $parentGenre = [];

        $parentGenreModule = new Genre();
        $parentGenreDBData = $parentGenreModule->selectGenrebyParentID(1,$this->limitedGenres);

        foreach ($parentGenreDBData as $row => $feilds) {
            # Parent Genres data from DB directly
            $parentGenre[$row]['PK'] = $this->autoFeildBreakup($parentGenreModule->primaryKey, $feilds);
            $parentGenre[$row]['SK'] = $this->autoFeildBreakup($parentGenreModule->allowedFields, $feilds);
            $parentGenre[$row]['SK']['Sub_Genre'] = $this->subGenres($feilds->{'GenreID'});
        }

        return  $parentGenre;
    }

    function subGenres($GenreID, $MultiDimensionalGenres = [])
    {
        $subGenre = [];
        $tempGenre = [];

        $subGenreModule = new Genre();
        $subGenreDBData = $subGenreModule->selectGenrebyParentID($GenreID, $this->limitedGenres);

        if(empty($subGenreDBData)){
            return '';
        }

        foreach ($subGenreDBData as $row => $feilds) {
            # Sub Genres data from DB directly
            $subGenre['GenreID'] = $feilds->{'GenreID'};
            $subGenre['GenreName'] = $feilds->{'GenreName'};
            $subGenre['ParentID'] = $feilds->{'ParentID'};

            $subGenre[] = $this->subGenres($feilds->{'GenreID'},$MultiDimensionalGenres);
            array_push($MultiDimensionalGenres,$subGenre);
        }

        return $MultiDimensionalGenres;
    }
}

?>