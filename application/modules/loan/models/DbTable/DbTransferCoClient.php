<?php

class Loan_Model_DbTable_DbTransferCoClient extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_tranfser_co';
	public function getUserId(){
		$session_user=new Zend_Session_Namespace('auth');
		return $session_user->user_id;
	}
    public function getcoinfo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT m.member_id,m.client_id,m.loan_number,m.group_id,
		(SELECT (SELECT co.`co_id` FROM `ln_co` AS co WHERE co.`co_id`= g.`g_id` LIMIT 1) FROM `ln_loan_group` AS g  
		WHERE g. `g_id` = m.`group_id` LIMIT 1) AS co_id ,
		(SELECT (SELECT co.`co_code` FROM `ln_co` AS co WHERE co.`co_id`= g.`g_id` LIMIT 1) FROM `ln_loan_group` AS g  
		WHERE g. `g_id` = m.`group_id` LIMIT 1) AS co_code ,
		(SELECT (SELECT co.`co_khname` FROM `ln_co` AS co WHERE co.`co_id`= g.`g_id` LIMIT 1) FROM `ln_loan_group` AS g  
		WHERE g. `g_id` = m.`group_id` LIMIT 1) AS co_name ,
		(SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id` = m.client_id LIMIT 1) AS client_name ,
		(SELECT c.`client_number` FROM `ln_client` AS c WHERE c.`client_id` = m.client_id LIMIT 1) AS client_code 
		FROM `ln_loan_member` AS m WHERE status = 1';
    	return $db->fetchAll($sql);
    }
    public function getAllinfoCo(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT tf.id ,(SELECT `branch_namekh` FROM `ln_branch` WHERE `br_id` = tf.branch_id) AS branch_name,
				(SELECT `name_kh` FROM `ln_client` WHERE `client_id` = (SELECT `client_id` FROM `ln_loan_member` WHERE `member_id`= tf.client_id)) AS client_name,
				(SELECT co.co_khname FROM ln_co AS co WHERE co.`co_id` = tf.to LIMIT 1) AS co_name,
				(SELECT `client_number` FROM `ln_client` WHERE `client_id` = (SELECT `client_id` FROM `ln_loan_member` WHERE `member_id`= tf.client_id)) AS client_code,
				(SELECT co.`co_code` FROM ln_co AS co WHERE co.`co_id` = tf.to LIMIT 1) AS co_code,
				tf.date,tf.note,tf.status FROM ln_tranfser_co AS tf WHERE STATUS = 1 AND tf.type = 2';
    	return $db->fetchAll($sql);
    }
    public function getAllinfoCoLoan(){
    	$db = $this->getAdapter();
    	$sql = 'SELECT tf.id ,(SELECT `branch_namekh` FROM `ln_branch` WHERE `br_id` = tf.branch_id) AS branch_name,
(SELECT loan_number FROM ln_loan_member WHERE  member_id = tf.loan_id LIMIT 1) AS loan_number,
(SELECT co.co_khname FROM ln_co AS co WHERE co.`co_id` = tf.to LIMIT 1) AS co_name,
(SELECT co.`co_code` FROM ln_co AS co WHERE co.`co_id` = tf.to LIMIT 1) AS co_code,
tf.date,tf.note,tf.status FROM ln_tranfser_co AS tf WHERE STATUS = 1 AND tf.type = 3';
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
	    		'code_to'=> $data['co_code'],
	    		'client_id'=> $data['name_client'],
	    		'to'=> $data['name_co'],
	    		'status'=> $data['status'],
	    		'date'=> $data['Date'],
	    		'note'=> $data['Note'],
	    		'type'=> 2,
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
    public function insertTransferloan($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try {
    		$dbg = new Application_Model_DbTable_DbGlobal();
    		$row = $dbg->getClientIdBYMemberId($data['loan_client']);
    		$_data_arr = array(
    				'client_id'=>$row['client_id'],
    				'branch_id'=> $data['branch_name'],
    				'loan_id'=> $data['loan_number'],
    				'code_to'=> $data['name_co'],
    				'from'=>$row['co_id'],
    				'to'=> $data['name_co'],
    				'status'=> $data['status'],
    				'date'=> $data['Date'],
    				'note'=> $data['Note'],
    				'type'=> 3,
    				'user_id'=>$this->getUserId()
    		);
    		$this->insert($_data_arr);
    		$this->_name ="ln_loanmember_funddetail";
    		$_arr_fund = array(
    				'collect_by'=>$data['name_co'],
    		);
    		$where = " member_id = ".$data['loan_number']." AND is_completed = 0 AND status = 1 ";
    		$this->update($_arr_fund, $where);
    		$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    	}
    }
    public function updatTransferloan($data,$id){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try {
    		$_data_arr = array(
    				'branch_id'=> $data['branch_name'],
    				'loan_id'=> $data['loan_number'],
    				'code_to'=> $data['name_co'],
    				'to'=> $data['name_co'],
    				'status'=> $data['status'],
    				'date'=> $data['Date'],
    				'note'=> $data['Note'],
    				'type'=> 3,
    		);
    		$wheres = "id = $id";
    		$this->update($_data_arr, $wheres);
    		$this->_name ="ln_loanmember_funddetail";
    		$_arr_fund = array(
    				'collect_by'=>$data['name_co'],
    		);
    		$where = "member_id = ".$data['loan_number']." AND is_completed = 0 AND status = 1 ";
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
	    		'code_to'=> $data['co_code'],
	    		'client_id'=> $data['name_client'],
	    		'to'=> $data['name_co'],
	    		'status'=> $data['status'],
	    		'date'=> $data['Date'],
	    		'note'=> $data['Note'],
	    		'type'=> 2,
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

