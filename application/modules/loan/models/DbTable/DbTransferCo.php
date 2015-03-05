<?php

class Loan_Model_DbTable_DbTransferCo extends Zend_Db_Table_Abstract
{

    public function getcoinfo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT `co_id`,`co_code`,`co_khname`,`user_id` FROM `ln_co` WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
  
}

