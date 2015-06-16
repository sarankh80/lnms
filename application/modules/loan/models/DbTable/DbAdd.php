<?php

class Loan_Model_DbTable_DbAdd extends Zend_Db_Table_Abstract
{
	public function Addzone($_data){
		$_zone=array(
				
				'zone_name'  => $_data['title_en'],
				'zone_num'  => $_data['zone_number'],
				'modify_date' => Zend_Date::now(),
				'user_id'	  => $this->getUserId()
		);
		$this->_name="ln_zone";
		return  $this->insert($_zone);
	} 
// 	public function Addloantype($_data){
// 		$_loantype=array(
				
// 				'name_en'  => $_data['zone_name'],
// 				'zone_num'  => $_data['zone_number'],
// 				'modify_date' => Zend_Date::now(),
// 				'user_id'	  => $this->getUserId()
// 		);
// 	}
}

