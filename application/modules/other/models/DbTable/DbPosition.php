<?php

class Other_Model_DbTable_DbPosition extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_position';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
	public function addCreditOfficer($_data){
// 		$_arr=array(
// 				'co_code'	  => $_data['co_id'],
// 				'co_khname'	  => $_data['name_kh'],
// 				'co_firstname'=> $_data['first_name'],
// 				'co_lastname' => '',//$_data['last_name'],
// 				'displayby'	  => $_data['display'],
// 				'sex'		  => $_data['co_sex'],
// 				'national_id'	  => $_data['national_id'],
// 				'address'	  => $_data['address'],
// 				'pob'	      => $_data['pob'],
// 				'degree'	      => $_data['degree'],
// 				'tel'	  	  => $_data['tel'],
// 				'email'	      => $_data['email'],
// 				'create_date' => Zend_Date::now(),
// 				'status'      => $_data['status'],
// 				'user_id'	  => $this->getUserId()
// 		);
// 		if(!empty($_data['id'])){
// 			$where = 'co_id = '.$_data['id'];
// 			return  $this->update($_arr, $where);
// 		}else{
// 			return  $this->insert($_arr);
// 		}
		
	}
	public function getPostionById($id){
		$db = $this->getAdapter();
		$sql = "SELECT * FROM $this->_name WHERE co_id = ".$db->quote($id);
		$sql.=" LIMIT 1 ";
		$row=$db->fetchRow($sql);
		return $row;
	}
	function getAllStaffPosition($search=null){
		$db = $this->getAdapter();
		$sql=" SELECT id,position_en,position_kh,
		(SELECT displayby_en FROM `ln_displayby` AS ld WHERE ld.id = id LIMIT 1) AS displayby,
		status
		FROM `ln_position` WHERE status =1 ";
		
		$where = "";
		
// 		if($search['status']>-1){
// 			$where.= " AND status = ".$search['status'];
// 		}
		
// 		echo $sql.$where;
		return $db->fetchAll($sql.$where);	
	}	
}

