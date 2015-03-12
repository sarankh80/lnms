<?php
class Report_Model_DbTable_DbParamater extends Zend_Db_Table_Abstract
{
      public function getAllHoliday($search=null){
    	 $db = $this->getAdapter();
          $sql="SELECT id,holiday_name,amount_day,start_date,end_date,status,modify_date,note FROM ln_holiday Where 1";
          $Other =" ORDER BY id DESC ";
          $where = '';
          if(!empty($search['txtsearch'])){
          	$s_where = array();
          	$s_search = $search['txtsearch'];
          	$s_where[] = " holiday_name LIKE '%{$s_search}%'";
          	$s_where[]=" start_date LIKE '%{$s_search}%'";
          	$where .=' AND '.implode(' OR ',$s_where).'';
          }      
          return $db->fetchAll($sql.$where.$Other);
    }
    public function getALLzone($search = null){
    	$db = $this->getAdapter();
    	$sql="SELECT zone_id,zone_name,zone_num,modify_date,status FROM ln_zone WHERE 1";
    	$Other =" ORDER BY zone_id DESC ";
    	$where = '';
    	if(!empty($search['txtsearch'])){
    		$s_where = array();
    		$s_search = $search['txtsearch'];
    		$s_where[] = " zone_name LIKE '%{$s_search}%'";
    		$s_where[]=" zone_num LIKE '%{$s_search}%'";
    		$where .=' AND '.implode(' OR ',$s_where).'';
    	}
    	return $db->fetchAll($sql.$where.$Other);
    }
    public function getALLstaff($search = null){
    	$db = $this->getAdapter();
    	$sql="SELECT co_code,co_khname,co_firstname,(SELECT name_kh FROM ln_view WHERE TYPE = 11 AND key_code=sex ) AS sex
    	,email,basic_salary,start_date,end_date,contract_no,shift,workingtime,(SELECT position_kh FROM ln_position WHERE id=position_id) As position,
    	tel,basic_salary,national_id,address,degree,
    	(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1) AS branch_name,note FROM ln_co WHERE 1";
    	$Other =" ORDER BY co_id DESC ";
    	$where = '';
    	//echo $search['txtsearch'];
    	if(!empty($search['txtsearch'])){
    		$s_where = array();
    		$s_search = $search['txtsearch'];
    		$s_where[] = " co_code LIKE '%{$s_search}%'";
    		$s_where[]=" co_khname LIKE '%{$s_search}%'";
    		$where .=' AND '.implode(' OR ',$s_where).'';
    	}
    	return $db->fetchAll($sql,$where.$Other);
    }
    public function getAllVillage(){
    	$db=$this->getAdapter();
    	$sql = "SELECT 
				  lv.`vill_id`,
				  lv.`village_name`,
				  lv.`village_namekh`,
				  lc.`com_id`,
				  lc.`commune_name`,
				  lc.`commune_namekh`,
				  lc.`district_id`,
				  ld.`district_name`,
				  ld.`district_namekh`,
				  lp.`province_id`,
				  lp.`province_en_name` ,
				  lp.`province_kh_name`,
				  lv.`modify_date`,
				  lv.`status`,
				  us.`user_name`
				FROM
				  `ln_province` AS lp,
				  `ln_district` AS ld,
				  `ln_commune` AS lc,
				  `ln_village` AS lv ,
				  `rms_users` AS us
				WHERE ld.`pro_id` = lp.`province_id` 
				  AND ld.`dis_id` = lc.`district_id` 
				  AND lv.`commune_id` = lc.`com_id`
				  AND lv.`user_id`=us.`id` ";
    	return $db->fetchAll($sql);
    }
    	function getAllBranch(){
    		$db=$this->getAdapter();
    		$sql=" select br_id,branch_namekh,branch_nameen
    		,br_address,branch_code,branch_tel,status,fax,other,displayby from ln_branch where status=1";
    		
    		return $db->fetchAll($sql);
    	}
}

