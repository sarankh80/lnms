<?php

class Loan_Model_DbTable_DbTransferCoClient extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_tranfser_co_client';
    public function getcoinfo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT `co_id`,`branch_id`,`co_code`,`co_khname` FROM `ln_co` WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
    public function getcoinfcoclient(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT m.member_id,m.client_id,
    			(SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id` = m.client_id LIMIT 1) AS client_name ,
				(SELECT c.`client_number` FROM `ln_client` AS c WHERE c.`client_id` = m.client_id LIMIT 1) AS client_code 
				FROM `ln_loan_member` AS m WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
    public function getAllinfoCo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT tf.id,(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.br_id = tf.`branch_id`) AS branch_id, 
(SELECT c.co_khname FROM ln_co AS c WHERE c.co_id = tf.code_co LIMIT 1) AS name_co,
(SELECT c.`co_code` FROM ln_co AS c WHERE c.co_id = tf.code_co LIMIT 1) AS code_co,
(SELECT (SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`= m.`client_id`) FROM `ln_loan_member` AS m WHERE m.`member_id` = tf.`member_code_client`) AS client_name,
(SELECT (SELECT c.`client_number` FROM `ln_client` AS c WHERE c.`client_id`= m.`client_id`) FROM `ln_loan_member` AS m WHERE m.`member_id` = tf.`member_code_client`) AS client_code,			
tf.`date`,tf.note,tf.`status` FROM `ln_tranfser_co_client` AS tf WHERE STATUS = 1';
    	return $db->fetchAll($sql);
    }
    public function getAllinfoTransfer($id){
    	$db = $this->getAdapter();
    	$sql ="SELECT * FROM `ln_tranfser_co_client` WHERE id = $id";
    	return $db->fetchRow($sql);
    }
    public function insertTransfer($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try {
	    	$_data_arr = array(
	    		'branch_id'=> $data['branch_name'],
	    		'code_co'=> $data['co_code'],
	    		'member_code_client'=> $data['name_client'],
	    		'name_co'=> $data['name_co'],
	    		'name_client'=> $data['name_co'],
	    		'status'=> $data['status'],
	    		'date'=> $data['Date'],
	    		'note'=> $data['Note'],
	    	);
	    	$this->insert($_data_arr);		    	    	
	    	$this->_name ="ln_loanmember_funddetail";
	    	$_arr_fund = array(
	    			'collect_by'=>$data['name_co'],
	    	);
	    	$where = "member_id = ".$data['name_client']." AND is_completed = 0 AND status = 1 ";
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
	    		'code_co'=> $data['co_code'],
	    		'member_code_client'=> $data['name_client'],
	    		'name_co'=> $data['name_co'],
	    		'name_client'=> $data['name_co'],
	    		'status'=> $data['status'],
	    		'date'=> $data['Date'],
	    		'note'=> $data['Note'],
	    	);
    		$wheres = "id = $id";
    		$this->update($_data_arr, $wheres);
    		$this->_name ="ln_loanmember_funddetail";
	    	$_arr_fund = array(
	    			'collect_by'=>$data['name_co'],
	    	);
	    	$where = "member_id = ".$data['name_client']." AND is_completed = 0 AND status = 1 ";
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

