<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Genre extends Model
    {
        protected $table = 'genre';
        
        protected $primaryKey = [
            'GenreID'
        ];

        protected $allowedFields = [
            'GenreName',
        ];

        protected $foreignKeys = [
            'ParentID',
        ];

        public function selectGenrebyParentID($ParentID, $limit)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $ParentID]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }
        
    }
?>