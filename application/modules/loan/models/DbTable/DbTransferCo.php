<?php

class Loan_Model_DbTable_DbTransferCo extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_tranfser_co';
    public function getcoinfo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT `co_id`,`co_code`,`co_khname`,`user_id` FROM `ln_co` WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
    public function insertTransfer($data){
    	$_data_arr = array(
    		'branch_id'=> $data['branch_name'],
    		'code_from'=> $data['co_code'],
    		'code_to'=> $data['to_co_code'],
    		'from'=> $data['formc_co'],
    		'to'=> $data['to_co'],
    		'status'=> $data['status'],
    		'date'=> $data['Date'],
    	);
    	$this->insert($_data_arr);
    }
  
}

