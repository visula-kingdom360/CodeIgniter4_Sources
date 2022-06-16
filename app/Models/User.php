<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class User extends Model
    {
        protected $table = 'user';

        protected $primaryKey = ['UserID'];

        protected $allowedFields = [
            'UserName',
            'Password',
            'Email',
            'TelephoneNo',
            'Address',
            'Status',
        ];

        protected $foreignKeys = [
        ];

        public function selectUserbyEmail($email)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->allowedFields[2] => $email]);
            $data = $query->get()->getResult();

            return $data;
        }

        public function selectUserbyUsername($username)
        {
            $blueprint = $this->db->table($this->table);
            $query = $blueprint->where([$this->allowedFields[0] => $username]);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>