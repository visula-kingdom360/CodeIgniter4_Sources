<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Offer extends Model
    {
        protected $table = 'equipment_offer';

        protected $primaryKey = [
            'OfferID',
            'EquipmentID'
        ];

        protected $allowedFields = [
            'Name',
            'Description',
            'StartDate',
            'EndDate',
            'PaymentMethod',
            'Quanitity',
            'OfferRate',
            'OfferAmt',
        ];
        
        protected $foreignKeys = [
            'CardID',
        ];

        public function selectOfferbyEquipmentID($equipmentID)
        {
            $today = date('Y-m-d');

            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[1] => $equipmentID]);
            $query = $blueprint->where([$this->allowedFields[2].'=' => $today]);
            $query = $blueprint->where([$this->allowedFields[3].'>=' => $today]);
            $query = $blueprint->join('offer',$this->table.'.'.$this->primaryKey[0].' = offer.OfferID');
            $data = $query->get()->getResult();

            return $data;
        }
        
    }
?>