<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Brand_Access extends Model
    {
        protected $table = 'brand_access';
        
        protected $primaryKey = [
            'Brand_AccessID',
        ];

        protected $allowedFields = [
            'Relationship',
            'Status',
        ];

        protected $foreignKeys = [
            'BrandID',
            'CorparationID',
        ];

        public function selectBrand_AccessesbyCorpID($corparationID, $limit = 99, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[1] => $corparationID]);
            $query = $blueprint->where([$this->allowedFields[1].'<>' => $status]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrand_AccessbyID($brand_accessID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brand_accessID]);
            $query = $blueprint->where([$this->allowedFields[1].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrand_AccessesbyBrandIDandRelationship($brandID, $relationship, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $brandID]);
            $query = $blueprint->where([$this->allowedFields[0] => $relationship]);
            $query = $blueprint->where([$this->allowedFields[1].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectBrand_AccessesbyBrandIDandCorpID($brandID, $corpID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $brandID]);
            $query = $blueprint->where([$this->foreignKeys[1] => $corpID]);
            $query = $blueprint->where([$this->allowedFields[1].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function updateStatusofBrand_AccessbyID($brand_accessID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $brand_accessID]);

            $data = $query->get()->getResult();
            $query = $blueprint->where([$this->primaryKey[0] => $brand_accessID]);
            $query = $blueprint->update([$this->allowedFields[1] => $status]);

            return $data;
        }

        public function insertDatatoBrand_Access($brand_access)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->insert($brand_access);
            $dataID = $this->db->insertID();

            return $dataID;
        }
    }
?> 