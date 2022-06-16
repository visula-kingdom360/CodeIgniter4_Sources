<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Card extends Model
    {
        protected $table = 'card';
        
        protected $primaryKey = [
            'CardID'
        ];

        protected $allowedFields = [
            'CardType',
            'CardName',
        ];

        protected $foreignKeys = [
        ];
        
    }
?>