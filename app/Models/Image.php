<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Image extends Model
    {
        protected $table = 'image';

        protected $primaryKey = [
            'ImageID'
        ];

        protected $allowedFields = [
            'ImagePath',
            'Status',
        ];

        protected $foreignKeys = [
            'ItemID',
        ];

        public function selectImagesbyItemID($itemID, $limit = 99, $status = 'A')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $itemID]);
            $query = $blueprint->where([$this->allowedFields[1] => $status]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>