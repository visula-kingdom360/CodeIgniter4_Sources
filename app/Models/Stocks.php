<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Stocks extends Model
    {
        protected $table = 'stocks';
        
        protected $primaryKey = [
            'StocksID'
        ];
        
        protected $allowedFields = [
            'TotalStocks',
            'SoldStocks',
            'Status',
        ];

        protected $foreignKeys = [
            'ItemID',
        ];

        public function selectStocksbyItemID($ItemID, $limit = 99, $status = 'A')
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->foreignKeys[0] => $ItemID]);
            $query = $blueprint->where([$this->allowedFields[2] => $status]);
            $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>