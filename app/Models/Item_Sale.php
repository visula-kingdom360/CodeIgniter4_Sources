<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Item_Sale extends Model
    {
        protected $table = 'item_sale';
        
        protected $primaryKey = [
            'Item_SaleID'
        ];
        
        protected $allowedFields = [
            'Price',
            'InternalDiscount',
        ];

        protected $foreignKeys = [
            'ItemID',
        ];

        public function selectItem_SalebyItemID($ItemID)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $ItemID]);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>