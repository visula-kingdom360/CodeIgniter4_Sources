<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Brand_Recommandation extends Model
    {
        protected $table = 'brand_access';
        
        protected $primaryKey = [
            'Brand_RecommandationID',
        ];

        protected $allowedFields = [
            'Note',
            'RequestedDateTime',
            'Status',
        ];

        protected $foreignKeys = [
            'RecommendedID',
            'RequestID',
        ];

       public function selectBrand_RecommandationbyID($requestID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[1] => $requestID]);
            $query = $blueprint->where([$this->allowedFields[2].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function insertDatatoBrand_Recommandation($brand_recommandation)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->insert($brand_recommandation);
            $dataID = $this->db->insertID();

            return $dataID;
        }
    }
?> 