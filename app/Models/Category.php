<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Category extends Model
    {
        protected $table = 'category';
        
        protected $primaryKey = [
            'CategoryID'
        ];
        
        protected $allowedFields = [
            'Name',
            'Status',
        ];

        protected $foreignKeys = [
        ];
        
    }
?>