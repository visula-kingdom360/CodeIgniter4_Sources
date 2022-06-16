<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Item_Detail_Types extends Model
    {
        protected $table = 'item_wise_details';

        protected $primaryKey = [
            'Item_Detail_TypesID',
            'ItemID'
        ];

        protected $allowedFields = [
            'Name',
            'Values',
            'Status',
        ];

        protected $foreignKeys = [
        ];

        public function selectItem_Detail_TypesbyItemID($ItemID, $limit = 99, $status = 'A')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[1] => $ItemID]);
            $query = $blueprint->where([$this->table.'.'.$this->allowedFields[2] => $status]);
            $query = $blueprint->join('item_detail_types',$this->table.'.'.$this->primaryKey[0].' = item_detail_types.Item_Detail_TypesID');
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>