<?php
class Report_Model_DbTable_DbParamater extends Zend_Db_Table_Abstract
{
      
     

    public function getAllHoliday(){
    	 $db = $this->getAdapter();
          $sql="SELECT id,holiday_name,amount_day,start_date,end_date,STATUS,modify_date,note FROM ln_holiday ORDER BY id";
          return $db->fetchAll($sql);
    }
    public function getALLzone(){
    	$db = $this->getAdapter();
    	$sql="SELECT zone_id,zone_name,zone_num,modify_date,STATUS FROM ln_zone ORDER BY zone_id";
    	return $db->fetchAll($sql);
    }
    public function getALLstaff(){
    	$db = $this->getAdapter();
    	$sql="SELECT co_id,co_khname,co_firstname,sex,(SELECT position_kh FROM ln_position WHERE id=position_id) As position,tel,basic_salary,national_id,address,
    	(SELECT branch_namekh FROM ln_branch WHERE br_id =branch_id limit 1) AS branch_name,note FROM ln_co ORDER BY co_id";
    	return $db->fetchAll($sql);
    }
}

