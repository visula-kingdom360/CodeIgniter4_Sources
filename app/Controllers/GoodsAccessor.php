<?php
namespace App\Controllers;

defined('BASEPATH');

// use App\Models\Corparation;
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

class GoodsAccessor extends GoodsController
{
    protected $limitedCorps  = 5;  # Mainmenu data with limited Corpate values
    protected $limitedBrands = 5;  # Mainmenu data with limited Brand values
    protected $limitedEquips = 20; # Mainmenu data with limited Equipment values
    protected $limitedGenres = 15; # Mainmenu data with limited Genre values
    protected $limitedCategs = 15; # Mainmenu data with limited Category values

    //Developed partially - UI side remain
    public function mainView() #Routing file for Main View of Goods
    {
        $data['corparation'] = $this->companyDetails();
        $data['genre'] = $this->genreDetails();
        
        // var_dump($data);
        // echo view('CustomerPlateform/Goods/ItemMenuScreen',$data);
        
    }

    //Developed partially - linking with mainView
    public function companyView($corparationID) #Routing file for Main View of Goods
    {
        $data['corparation'] = $this->companyDetail($corparationID);
        $data['genre'] = $this->genreDetails();

        echo view('CustomerPlateform/Goods/ItemMenuScreen',$data);
        
    }

    //still not developed
    public function equipmentView($equipmentID) #Routing file for Main View of Goods
    {
        $data['Equipment'] = $this->getEquipmentDataviaEquipmentID($equipmentID);
        // echo 'Equipment VIew:'.$equipmentID;
        // $data['corparation'] = $this->companyDetails();
        $data['genre'] = $this->genreDetails();
        
        // var_dump($data);
        // echo view('CustomerPlateform/Goods/ItemMenuScreen',$data);
        
    }

}
?>