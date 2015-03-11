<?php

class Loan_Model_DbTable_DbTransferCo extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_tranfser_co';
    public function getcoinfo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT `co_id`,`branch_id`,`co_code`,`co_khname` FROM `ln_co` WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
    public function getAllinfoCo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT tf.id,(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.br_id = tf.`branch_id`) AS branch_id, 
				(SELECT c.co_khname FROM ln_co AS c WHERE c.co_id = tf.from LIMIT 1) AS `from`,
				(SELECT c.co_khname FROM ln_co AS c WHERE c.co_id = tf.to LIMIT 1) AS `to`,
    			(SELECT c.`co_code` FROM ln_co AS c WHERE c.co_id = tf.code_from LIMIT 1) AS code_from,
				(SELECT c.`co_code` FROM ln_co AS c WHERE c.co_id = tf.code_to LIMIT 1) AS code_to,				
				tf.`date`,tf.note,tf.`status` FROM `ln_tranfser_co` AS tf WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
    public function getAllinfoTransfer($id){
    	$db = $this->getAdapter();
    	$sql ="SELECT * FROM `ln_tranfser_co` WHERE id = $id";
    	return $db->fetchRow($sql);
    }
    public function insertTransfer($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try {
	    	$_data_arr = array(
	    		'branch_id'=> $data['branch_name'],
	    		'code_from'=> $data['co_code'],
	    		'code_to'=> $data['to_co_code'],
	    		'from'=> $data['formc_co'],
	    		'to'=> $data['to_co'],
	    		'status'=> $data['status'],
	    		'date'=> $data['Date'],
	    		'note'=> $data['Note'],
	    	);
	    	$this->insert($_data_arr);		    	    	
	    	$this->_name ="ln_loanmember_funddetail";
	    	$_arr_fund = array(
	    			'collect_by'=>$data['to_co'],
	    	);
	    	$where = "collect_by = ".$data['formc_co']." AND is_completed = 0 AND status = 1 ";
	    	$this->update($_arr_fund, $where);
	    	$db->commit();
    	}catch (Exception $e){
    		Application_Form_FrmMessage::message("INSERT_FAIL");
    		$err =$e->getMessage();
    		Application_Model_DbTable_DbUserLog::writeMessageError($err);
    		$db->rollBack();
    	}
    }
    public function updatTransfer($data,$id){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try {
    		$_data_arr = array(
    				'branch_id'=> $data['branch_name'],
    				'code_from'=> $data['co_code'],
    				'code_to'=> $data['to_co_code'],
    				'from'=> $data['formc_co'],
    				'to'=> $data['to_co'],
    				'status'=> $data['status'],
    				'date'=> $data['Date'],
    				'note'=> $data['Note'],
    		);
    		$wheres = "id = $id";
    		$this->update($_data_arr, $wheres);
    		$this->_name ="ln_loanmember_funddetail";
    		$_arr_fund = array(
    				'collect_by'=>$data['to_co'],
    		);
    		$where = "collect_by = ".$data['formc_co']." AND is_completed = 0 AND status = 1 ";
    		$this->update($_arr_fund, $where);
    		$db->commit();
    	}catch (Exception $e){
    		Application_Form_FrmMessage::message("INSERT_FAIL");
    		$err =$e->getMessage();
    		Application_Model_DbTable_DbUserLog::writeMessageError($err);
    		$db->rollBack();
    	}
    }
  
}

