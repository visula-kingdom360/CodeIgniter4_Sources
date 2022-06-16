<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Item_Rental extends Model
    {
        protected $table = 'item_rental';
        
        protected $primaryKey = ['Item_RentalID'];
        
        protected $allowedFields = [
            'Preiod',
            'Amount',
            'PreiodType',
        ];
        
        protected $foreignKeys = [
            'ItemID',
        ];

        public function selectItem_RentalbyItemID($ItemID)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $ItemID]);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>