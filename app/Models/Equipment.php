<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Equipment extends Model
    {
        protected $table = 'equipment';

        protected $primaryKey = [
            'EquipmentID'
        ];

        protected $allowedFields = [
            'Name',
            'Highlight',
            'Description',
            'Status',
            'Rental_Sales',
            'Rate',
        ];

        protected $foreignKeys = [
            'CorparationID',
            'Brand_AccessID',
            'GenreID',
        ];

        public function selectEquipmentsbyBrnadID($Brand_AccessID, $limit = 99, $status = 'A')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[1] => $Brand_AccessID]);
            $query = $blueprint->where([$this->allowedFields[3] => $status]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectEquipments($equipmentID, $status = 'A') #selectEquipments
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $equipmentID]);
            $query = $blueprint->where([$this->allowedFields[3] => $status]);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>