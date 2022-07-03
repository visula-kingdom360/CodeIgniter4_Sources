<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Item extends Model
    {
        protected $table = 'item';
        protected $primaryKey = ['ItemID'];
        protected $allowedFields = [
            'Name',
            'Status',
        ];
        protected $foreignKeys = [
            'EquipmentID',
        ];

        public function selectItembyEquipmentID($EquipmentID, $limit = 5, $status = 'A')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $EquipmentID]);
            $query = $blueprint->where([$this->allowedFields[1] => $status]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>