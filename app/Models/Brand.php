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
            'Status',
        ];

        protected $foreignKeys = [
            'OwnerID',
        ];

        public function selectBrandbyStatus($status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->allowedFields[3].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrandbyID($brandID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandID]);
            $query = $blueprint->where([$this->allowedFields[3].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrandbyOwnerID($ownerID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $ownerID]);
            $query = $blueprint->where([$this->allowedFields[3].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrandbyName($name, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->allowedFields[0] => $name]);
            $query = $blueprint->where([$this->allowedFields[3].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function updateDataofBrandbyData($changes, $count, $brandData)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandData['BrandID']]);
            for ($i=0; $i < $count; $i++) { 
                # looping query list
                $query = $blueprint->set([$changes[$i] => $brandData[$changes[$i]]]);
            }
            $query = $blueprint->update();
            
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandData['BrandID']]);
            $data = $query->get()->getResult();

            
            return $data;
        }

        public function updateStatusofBrandbyID($brandID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandID]);
            $query = $blueprint->set([$this->allowedFields[3] => $status]);
            $query = $blueprint->update();

            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brandID]);
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