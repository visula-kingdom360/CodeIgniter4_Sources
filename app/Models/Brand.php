<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Brand extends Model
    {
        protected $table = 'brand';
        
        protected $primaryKey = [
            'BrandID',
        ];

        protected $allowedFields = [
            'Name',
            'Summary',
            'Description',
        ];

        protected $foreignKeys = [
            'OwnerID',
        ];

        public function selectBrandbyID($brandID)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandID]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrandbyOwnerID($ownerID)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $ownerID]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrandbyName($name)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->allowedFields[0] => $name]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function updateDataofBrandbyData($changes, $count, $brandData)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandData['BrandID']]);
            for ($i=0; $i < $count; $i++) { 
                # looping query list
                $query = $blueprint->update([$changes[$i] => $brandData[$changes[$i]]]);
            }
            
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandData['BrandID']]);
            $data = $query->get()->getResult();

            
            return $data;
        }

        public function inserDatatoBrand($brand)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->insert($brand);
            $dataID = $this->db->insertID();

            return $dataID;
        }                
    }
?>