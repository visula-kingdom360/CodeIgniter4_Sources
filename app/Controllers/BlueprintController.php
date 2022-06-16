<?php
namespace App\Controllers;

class BlueprintController extends BaseController
{
    public function pushModelDBDataToArrayReturn($module, $dbData)
    {
        $data = [];
        $temp = [];
        foreach ($dbData as $row => $feilds) {
            # DB data list merging to an array
            $temp['PK'] = $this->autoFeildBreakup($module->primaryKey, $feilds);
            $temp['SK'] = $this->autoFeildBreakup($module->allowedFields, $feilds);
            $temp['FK'] = [];

            if($module->foreignKeys != []){
                $temp['FK'] = $this->autoFeildBreakup($module->foreignKeys, $feilds);
            }

            $data[$row] = array_merge($temp['PK'],$temp['SK'],$temp['FK']);
            empty($temp);
        }
        return $data;
    }

    public function autoFeildBreakup($feildNames, $feildValues){
        foreach ($feildNames as $key => $value) {
            # Developed for Result data to auto get from object into a array (This could be used for all tables. Hense the reason we added this breakup method to Base Controller for common use).
            $dataReturn[$value] = $feildValues->{$value};
        }

        return $dataReturn;
    }

    public function statusExpand($status = 'A')
    {
        if($status == 'A'){
            return 'Actived';
        }elseif($status == 'E'){
            return 'Expired';
        }elseif($status == 'R'){
            return 'Rejected';
        }elseif($status == 'P'){
            return 'Pending';
        }elseif($status == 'T'){
            return 'Tempary';
        }else{
            return 'Unknown';
        }
    }
}

?>