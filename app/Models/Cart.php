<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Cart extends Model
    {
        protected $table = 'cart';

        protected $primaryKey = [
            'CartID'
        ];

        protected $allowedFields = [
            'Quantity',
            'Status',
        ];

        protected $foreignKeys = [
            'StocksID',
            'CustomerID',
        ];
    }
?>