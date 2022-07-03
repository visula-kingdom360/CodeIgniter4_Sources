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

        public function selectGenrebyID($GenreID)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->primaryKey[0] => $GenreID]);
            $data = $query->get()->getResult();

            return $data;
        }
        
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