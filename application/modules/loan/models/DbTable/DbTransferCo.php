<?php

class Loan_Model_DbTable_DbTransferCo extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_tranfser_co';
    public function getcoinfo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT m.`member_id`,`group_id`,(SELECT (SELECT c.`co_code` FROM `ln_co` AS c WHERE c.co_id = g.co_id AND STATUS = 1 LIMIT 1) 
				FROM `ln_loan_group` AS g WHERE g.g_id = m.`group_id` AND STATUS = 1 LIMIT 1) AS co_code ,
				(SELECT (SELECT c.`co_khname` FROM `ln_co` AS c WHERE c.co_id = g.co_id AND STATUS = 1 LIMIT 1) 
				FROM `ln_loan_group` AS g WHERE g.g_id = m.`group_id` AND STATUS = 1 LIMIT 1) AS co_khname
				FROM `ln_loan_member` AS m ';
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

