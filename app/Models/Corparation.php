<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Corparation extends Model
    {
        protected $table = 'corparation';
        
        protected $primaryKey = [
            'CorparationID'
        ];
        
        protected $allowedFields = [
            'Name',
            'Summary',
            'Description',
            'BIR',
            'Logo',
            'Rate',
            'Status',
        ];

        protected $foreignKeys = [
        ];

        public function selectCompany($limit = 99, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->allowedFields[6].'<>' => $status]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectCompanybyID($corparationID, $status = 'E')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $corparationID]);
            $query = $blueprint->where([$this->allowedFields[6].'<>' => $status]);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>