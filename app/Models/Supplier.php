<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Supplier extends Model
    {
        protected $table = 'supplier';

        protected $primaryKey = [
            'SupplierID'
        ];

        protected $allowedFields = [
            'FullName',
            'About',
            'SupplierType',
            'Status',
            // 'Name',
            // 'Summary',
            // 'Description',
            // 'BIR',
            // 'Logo',
            // 'Rate',
            // 'Status',
        ];

        protected $foreignKeys = [
            'UserID',
            'CorparationID'
        ];

        public function selectgetSupplierDataviaUserID($UserID, $Status = 'A')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $UserID]);
            $query = $blueprint->where([$this->allowedFields[3] => $Status]);
            // $query = $blueprint->join('brand',$this->table.'.'.$this->allowedFields[0].' = brand.BrandID');
            $data = $query->get()->getResult();

            return $data;
        }

    }
?>