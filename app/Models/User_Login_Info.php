<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class User_Login_Info extends Model
    {
        protected $table = 'user_login_info';

        protected $primaryKey = [
            'User_Login_InfoID'
        ];

        protected $allowedFields = [
            'IPAddress',
            'MachineName',
            'LoggedInTime',
            'LogoutTime',
        ];

        protected $foreignKeys = [
            'UserID',
        ];

        public function insertDatatoUser_Login_Info($data)
        {
            $blueprint = $this->db->table($this->table);
            // $query = $blueprint->where([$this->allowedFields[0] => $UserID]);
            // $query = $blueprint->where([$this->table.'.'.$this->allowedFields[2] => $status]);
            // $query = $blueprint->join('item_detail_types',$this->table.'.'.$this->primaryKey[0].' = item_detail_types.Item_Detail_TypesID');
            // $query = $blueprint->limit($limit);
            $data = $query->get()->getResult();

            return $data;
        }
    }
?>