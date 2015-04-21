<?php

class Loan_Model_DbTable_DbGroupPayment extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_loan_group';
    public function getAllGroupLoan($search){
    	$from_date =(empty($search['from_date']))? '1': "lg.date_release >= '".$search['from_date']." 00:00:00'";
    	$to_date = (empty($search['to_date']))? '1': "lg.date_release <= '".$search['to_date']." 23:59:59'";
    	$where = " AND ".$from_date." AND ".$to_date;
    	 
    	$db = $this->getAdapter();
    	$sql=" SELECT lm.member_id,lm.loan_number,
    	(SELECT name_kh FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_kh,
    	(SELECT name_en FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_en,
    	lm.total_capital,lm.interest_rate,
    	(SELECT payment_nameen FROM `ln_payment_method` WHERE id = lm.payment_method LIMIT 1) AS payment_method,
    	(SELECT zone_name FROM `ln_zone` WHERE zone_id=lg.zone_id LIMIT 1) AS zone_name,
    	(SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_name,
    	(SELECT branch_namekh FROM `ln_branch` WHERE br_id =lg.branch_id LIMIT 1) AS branch,
    	lg.status  FROM `ln_loan_group` AS lg,`ln_loan_member` AS lm
    	WHERE lg.g_id = lm.group_id AND lg.loan_type =2 ";
    	if($search['status']>1){
    		$where.= "lm.status = ".$search['status'];
    
    	}
    	$order = " ORDER BY ";
    	$db = $this->getAdapter();
    	return $db->fetchAll($sql.$where);
    }
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    public function getGroupClient(){
    	$db = $this->getAdapter();
    	//$this->_name = "ln_client";
    	$sql ="SELECT lc.`client_id`,lc.`name_kh`,lc.`name_en` FROM `ln_client` AS lc WHERE lc.`is_group`=1";
    	return $db->fetchAll($sql);
    }
    public function getGroupLoadDetail($type){
    	$db = $this->getAdapter();
    	$loan_number= $data['loan_number'];
    	$sql="SELECT 
				  lmf.`id`,
				  lmf.`member_id`,
				  lmf.`total_principal`,
				  lmf.`principal_permonth`,
				  lmf.`total_interest`,
				  lmf.`total_payment`,
				  lmf.`date_payment`,
				  lmf.`branch_id`,
				  lc.`name_kh`
				FROM
				  `ln_loanmember_funddetail` AS lmf ,
				  ln_loan_member AS lm, 
				  `ln_client` AS lc
				WHERE lmf.`is_completed` = 0 
				  AND lmf.`status` = 1 
				  AND lmf.`member_id` = lm.`member_id`
				  AND lm.`group_id`=1
				  AND lm.`client_id`=lc.`client_id`";
    }

    function round_up($value, $places)
    {
    	$mult = pow(10, abs($places));
    	return $places < 0 ?
    	ceil($value / $mult) * $mult :
    	ceil($value * $mult) / $mult;
    }
    function round_up_currency($curr_id, $value,$places=-2){
    	return (($curr_id==1)? $this->round_up($value, $places):$value);
    }
    
    public function getAllMemberLoanById($member_id){
    	$db = $this->getAdapter();
    	$sql = "SELECT member_id ,client_id,group_id ,loan_number,
    			total_capital,admin_fee,loan_purpose FROM `ln_loan_member` 
    			WHERE status =1 AND group_id = $member_id ";
    	return $db->fetchAll($sql);
    }
    public function getNextDateById($pay_term){
    	if($pay_term==3){
    		$str_next = 'next month';
    	}elseif($pay_term==2){
    		$str_next = 'next week';
    	}else{
    		$str_next = 'next day';
    	}
    	return $str_next;
    }
    public function getSubDaysByPaymentTerm($pay_term){
    	if($pay_term==3){
    		$amount_days =30;
    	}elseif($pay_term==2){
    		$amount_days =7;
    	}else{
    		$amount_days =1;
    	}
    	return $amount_days;
    	
    }
    public function CountDayByDate($start,$end){
    	$db = new Application_Model_DbTable_DbGlobal();
    	return ($db->countDaysByDate($start,$end));
    }
    public function CalculateByMethod($method_type){
    	
    }
function getLoanPaymentByLoanNumber($data){
    	$db = $this->getAdapter();
    	$loan_number= $data['loan_number'];
    	if($data['type']!=1){
    		$where =($data['type']==2)?'client_id = '.$loan_number:'client_id='.$loan_number;
    		$sql ="SELECT 
    				  (SELECT lc.`client_id` FROM `ln_client` AS lc WHERE lc.`parent_id`=lc.`client_id`) AS group_id,
    				  (SELECT lc.`client_number` FROM `ln_client` AS lc WHERE lc.`parent_id`=lc.`client_id`) AS group_number,
					  lc.`client_id`,
					  lc.`client_number`,
					  lc.`name_kh`,
					  lm.`loan_number`,
					  lm.`currency_type`,
					  lm.`pay_before`,
					  lm.`pay_after`,
					  lm.`branch_id`,
					  lg.`co_id`,
					  lg.`payment_method`,   
					  lf.*
					FROM
					  `ln_client` AS lc,
					  `ln_loan_member` AS lm ,
					  `ln_loan_group` AS lg,
					  `ln_loanmember_funddetail` AS lf
					WHERE lc.`is_group` = 1 
					AND lc.`parent_id`=(SELECT client_id FROM `ln_client` WHERE $where LIMIT 1)
					  AND lg.`g_id`=lm.`group_id`
					  AND lf.`member_id`=lm.`member_id`
					  AND lm.`client_id`=lc.`client_id`
					  AND lg.`group_id`=lc.`parent_id`
					  AND lg.`loan_type`=2
    					AND lf.`is_completed`=0
  						GROUP BY lc.`client_id`
    				";
    	}elseif($data['type']==1){
    		$where = 'lm.`loan_number`='.$loan_number;
    		$sql ="SELECT 
					  (SELECT lc.`client_id` FROM `ln_client` AS lc WHERE lc.`parent_id`=lc.`client_id`) AS group_id,
					  (SELECT lc.`client_number` FROM `ln_client` AS lc WHERE lc.`parent_id`=lc.`client_id`) AS group_number,
					  lc.`client_id`,
					  lc.`client_number`,
					  lc.`name_kh`,
					  lm.`loan_number`,
					  lm.`currency_type`,
					  lm.`pay_before`,
					  lm.`pay_after`,
					  lm.`branch_id`,
					  lg.`co_id`,
					  lg.`payment_method`,   
					  lf.*
					FROM
					  `ln_client` AS lc,
					  `ln_loan_member` AS lm ,
					  `ln_loan_group` AS lg,
					  `ln_loanmember_funddetail` AS lf
					WHERE lc.`is_group` = 1 
					AND lc.`parent_id`=(SELECT client_id FROM `ln_client` LIMIT 1)
					  AND lg.`g_id`=lm.`group_id`
					  AND lf.`member_id`=lm.`member_id`
					  AND lm.`client_id`=lc.`client_id`
					  AND lg.`group_id`=lc.`parent_id`
					  AND lg.`loan_type`=2
					  AND $where
    				AND lf.`is_completed`=0
  					GROUP BY lc.`client_id`";
    				
 	}
    	return $db->fetchAll($sql);
   }
    public function addGroupPayment($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$reciept_no = $data['reciept_no'];
    	$sql="SELECT id  FROM ln_client_receipt_money WHERE receipt_no='$reciept_no' ORDER BY id DESC LIMIT 1 ";
    	$acc_no = $db->fetchOne($sql);
    	if($acc_no){
    		$reciept_no=$this->getGroupPaymentNumber();
    	}else{
    		$reciept_no = $data['reciept_no'];
    	}
    	try{
    		$arr_client_pay = array(
    			'co_id'							=>		$data['co_id'],
    			'group_id'						=>		$data["group_id"],
    			'receiver_id'					=>		$data['reciever'],
    			'receipt_no'					=>		$reciept_no,
    			'branch_id'						=>		$data['branch_id'],
    			'loan_number'					=>		$data['loan_number'],
    			'date_pay'						=>		$data['collect_date'],
    			'date_input'					=>		$data["date_input"],
    			'principal_amount'				=>		$data["priciple_amount"],
    			'total_principal_permonth'		=>		$data['os_amount'],
    			'total_payment'					=>		$data['total_payment'],
    			'total_interest'				=>		$data['total_interest'],
    			'recieve_amount'				=>		$data['amount_receive'],
    			'penalize_amount'				=>		$data['penalize_amount'],
    			'return_amount'					=>		$data['amount_return'],
    			'service_charge'				=>		$data['service_charge'],
    			'total_discount'				=>		$data["discount"],
    			'note'							=>		$data['note'],
    			'user_id'						=>		$user_id,
    			'is_group'						=>		1
    		);
//     		$db->getProfiler()->setEnabled(true);
			$this->_name = "ln_client_receipt_money";
    		//$client_pay = $db->insert("ln_client_receipt_money", $arr_client_pay);
    		$client_pay = $this->insert($arr_client_pay);
    		
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     		$db->getProfiler()->setEnabled(false);
    		
    		$identify = explode(',',$data['identity']);
    		foreach($identify as $i){
//     			print_r($data["mfdid_".$i]);
    			if(@$data["mfdid_".$i]){
    				$arr_money_detail = array(
    					'crm_id'				=>		$client_pay,
    					'lfd_id'				=>		$data["mfdid_".$i],
    					'client_id'				=>		$data["client_id_".$i],
    					'date_payment'			=>		$data["date_payment_".$i],
    					'capital'				=>		$data["total_priciple_".$i],
    					'remain_capital'		=>		$data["total_priciple_".$i] - $data["principal_permonth_".$i],
    					'principal_permonth'	=>		$data["principal_permonth_".$i],
    					'total_interest'		=>		$data["interest_".$i],
    					'total_payment'			=>		$data["payment_".$i],
    					'currency_id'			=>		$data["curr"],
    					'pay_before'			=>		$data['pay_before_'.$i],
    					'pay_after'				=>		$data['pay_after_'.$i],
    					'is_completed'			=>		1,
    					'is_verify'				=>		0,
    					'verify_by'				=>		0,
    					'is_closingentry'		=>		0
    				);
//     				$db->getProfiler()->setEnabled(true);
    				 
    				$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    				 
//     				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     				$db->getProfiler()->setEnabled(false);
    				
//     				$db->getProfiler()->setEnabled(true);
    				$arr_update_fun_detail = array(
    					'is_completed'		=> 	1,
    				);
    				$this->_name="ln_loanmember_funddetail";
    				$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
    				$this->update($arr_update_fun_detail, $where);
    				
//     				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     				$db->getProfiler()->setEnabled(false);
    			}
    		}
    		$loan_number = $data['loan_number'];
    		$sql_payment ="SELECT
					    		l.*
					    	FROM
					    		`ln_loanmember_funddetail` AS l,
					    		`ln_loan_member` AS m
					    	WHERE l.`member_id` = m.`member_id`
					    		AND m.`loan_number` = '$loan_number'
					    		AND l.`is_completed` = 0 ";
    		$rs_payment = $db->fetchRow($sql_payment);
    		//echo $sql_payment;
    		
    		$group_id = $data["group_id"];
    		if(empty($rs_payment)){
    			$sql ="UPDATE
				    		`ln_loan_group` AS l
				    	SET l.`status` = 2
				    	WHERE l.`g_id`= (SELECT m.`group_id` FROM `ln_loan_member` AS m WHERE m.`loan_number`='$loan_number' LIMIT 1)
				    		AND l.`group_id`= $group_id AND l.`loan_type`=1";
    		$db->query($sql);
    		 
    		$sql_loan_memeber ="UPDATE `ln_loan_member` AS m SET m.`is_completed`=1 WHERE m.`loan_number`= '$loan_number'";
    		$db->query($sql_loan_memeber);
    		}
     		//exit();
    		$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();exit();
    	}
    }
    function updateGroupPayment($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$query = new Application_Model_DbTable_DbGlobal();
    	$id= $data["id"];
    	try{
    		$arr_client_pay = array(
    				'co_id'							=>		$data['co_id'],
    				'group_id'						=>		$data["group_id"],
    				'receiver_id'					=>		$data['reciever'],
    				//'receipt_no'					=>		$data["reciept_no"],
    				'branch_id'						=>		$data['branch_id'],
    				'loan_number'					=>		$data['loan_number'],
    				'date_pay'						=>		$data['collect_date'],
    				'date_input'					=>		$data["date_input"],
    				'principal_amount'				=>		$data["priciple_amount"],
    				'total_principal_permonth'		=>		$data['os_amount'],
    				'total_payment'					=>		$data['total_payment'],
    				'total_interest'				=>		$data['total_interest'],
    				'recieve_amount'				=>		$data['amount_receive'],
    				'penalize_amount'				=>		$data['penalize_amount'],
    				'return_amount'					=>		$data['amount_return'],
    				'service_charge'				=>		$data['service_charge'],
    				'total_discount'				=>		$data["discount"],
    				'note'							=>		$data['note'],
    				'user_id'						=>		$user_id,
    				'is_group'						=>		1,
    		);
    		$this->_name = "ln_client_receipt_money";
    		$where = $db->quoteInto("id=?", $data["id"]);
    		
    		$db->getProfiler()->setEnabled(true);
    			$client_pay = $this->update($arr_client_pay, $where);
    		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
    		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
    		$db->getProfiler()->setEnabled(false);
    		
    			$loan_fun = $this->getGroupPaymentDetail($id);
    			foreach ($loan_fun as $row){
	    			$array = array(
	    				'is_completed'  =>0,
	    			);
	    			$this->_name= "ln_loanmember_funddetail";
	    			$where = $db->quoteInto("id=?", $row["lfd_id"]);
	    			$db->getProfiler()->setEnabled(true);
	    			$this->update($array, $where);
	    			
	    			Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
	    			Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
	    			$db->getProfiler()->setEnabled(false);
    			}
    		$sql_delete = "DELETE FROM ln_client_receipt_money_detail WHERE crm_id =$id";
    		
    		$db->getProfiler()->setEnabled(true);
    			$db->query($sql_delete);
    		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
    		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
    		$db->getProfiler()->setEnabled(false);
    	
    		$identify = explode(',',$data['identity']);
    		print_r($identify);
    		foreach($identify as $i){
    			if(!empty($identify)){
    				$arr_money_detail = array(
    						'crm_id'				=>		$id,
    						'lfd_id'				=>		$data["mfdid_".$i],
    						'client_id'				=>		$data["client_id_".$i],
    						'date_payment'			=>		$data["date_payment_".$i],
    						'capital'				=>		$data["total_priciple_".$i],
    						'remain_capital'		=>		$data["total_priciple_".$i] - $data["principal_permonth_".$i],
    						'principal_permonth'	=>		$data["principal_permonth_".$i],
    						'total_interest'		=>		$data["interest_".$i],
    						'total_payment'			=>		$data["payment_".$i],
    						'currency_id'			=>		$data["curr"],
    						'pay_before'			=>		$data['pay_before_'.$i],
    						'pay_after'				=>		$data['pay_after_'.$i],
    						'is_completed'			=>		1,
    						'is_verify'				=>		0,
    						'verify_by'				=>		0,
    						'is_closingentry'		=>		0
    				);
    				
    				$db->getProfiler()->setEnabled(true);
    				$this->_name="ln_client_receipt_money_detail";
    				$this->insert($arr_money_detail);
    					//$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
    				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
    				$db->getProfiler()->setEnabled(false);
    					
    				$arr_update_fun_detail = array(
    						'is_completed'		=> 	1,
    				);
    				$this->_name="ln_loanmember_funddetail";
    				$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
    				
    				$db->getProfiler()->setEnabled(true);
    					$this->update($arr_update_fun_detail, $where);
    				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
    				Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
    				$db->getProfiler()->setEnabled(false);
    	
    			}
    		}
    		
    		$sql_payment ="SELECT
					    		l.*
					    	FROM
					    		`ln_loanmember_funddetail` AS l,
					    		`ln_loan_member` AS m
					    	WHERE l.`member_id` = m.`member_id`
					    		AND m.`loan_number` = '$loan_number'
					    		AND l.`is_completed` = 0 ";
    		$rs_payment = $db->fetchRow($sql_payment);
    		//echo $sql_payment;
    		
    		$group_id = $data["client_id"];
    		if(empty($rs_payment)){
    		$sql ="UPDATE
			    		`ln_loan_group` AS l
			    	SET l.`status` = 2
			    	WHERE l.`g_id`= (SELECT m.`group_id` FROM `ln_loan_member` AS m WHERE m.`loan_number`='$loan_number' LIMIT 1)
			    		AND l.`group_id`= $group_id AND l.`loan_type`=1";
    		$db->query($sql);
    		 
    		$sql_loan_memeber ="UPDATE `ln_loan_member` AS m SET m.`is_completed`=1 WHERE m.`loan_number`= '$loan_number'";
    		$db->query($sql_loan_memeber);
    		}
    		//exit();
    		$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();//exit();
    	}
    }
    function getAllMemberByGroup($group_member){
    	$db = $this->getAdapter();
    	$sql = "SELECT client_id,name_en FROM `ln_client` WHERE 
    	(parent_id = $group_member OR client_id = $group_member) AND status=1 ";
    	return $db->fetchAll($sql);
    }
    public function getGroupPaymentNumber(){
    	$this->_name='ln_client_receipt_money';
    	$db = $this->getAdapter();
    	$sql=" SELECT id  FROM $this->_name ORDER BY id DESC LIMIT 1 ";
    	$acc_no = $db->fetchOne($sql);
    	$new_acc_no= (int)$acc_no+1;
    	$acc_no= strlen((int)$acc_no+1);
    	$pre = "";
    	$pre_fix="PM-";
    	for($i = $acc_no;$i<5;$i++){
    		$pre.='0';
    	}
    	return $pre_fix.$pre.$new_acc_no;
    }
    public function getAllGroupPPayment($search){
    	
    	$date_pay = $search['date_pay'];
    	$date_input = $search['due_date'];
    	
    	$db = $this->getAdapter();
    	$sql = "SELECT lcrm.`id`,
					lcrm.`receipt_no`,
					lcrm.`loan_number`,
					(SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=lcrm.`group_id`) AS team_group ,
					lcrm.`total_principal_permonth`,
					lcrm.`total_payment`,
					lcrm.`recieve_amount`,
					lcrm.`total_interest`,
					lcrm.`penalize_amount`,
					lcrm.`date_pay`,
					lcrm.`date_input`,
				    (SELECT co.`co_khname` FROM `ln_co` AS co WHERE co.`co_id`=lcrm.`co_id`) AS co_name,
    				(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=lcrm.`branch_id`) AS branch
				FROM `ln_client_receipt_money` AS lcrm WHERE lcrm.is_group=1";
    	$where ='';
    	if(!empty($search['advance_search'])){
    		//print_r($search);
    		$s_where = array();
    		$s_search = $search['advance_search'];
    		$s_where[] = "lcrm.`loan_number` LIKE '%{$s_search}%'";
    		$s_where[] = " lcrm.`receipt_no` LIKE '%{$s_search}%'";
    		
    		$where .=' AND ('.implode(' OR ',$s_where).')';
    	}
    	if($search['status']!=""){
    		$where.= " AND status = ".$search['status'];
    	}
    	
    	if(!empty($search['date_pay'])){
    		$where.=" AND lcrm.`date_pay`= '$date_pay'";
    	}
    	if(!empty($search['due_date'])){
    		$where.=" AND lcrm.`date_input`= '$date_input'";
    	}
    	if($search['client_name']>0){
    		$where.=" AND lcrm.`group_id`= ".$search['client_name'];
    	}
    	
    	//$where='';
    	$order = " ORDER BY receipt_no DESC";
    	//echo $sql.$where.$order;
    	return $db->fetchAll($sql.$where.$order);
    	
    }
    public function getGroupPaymentById($id){
    	$db = $this->getAdapter();
    	$sql="SELECT 
				  (SELECT c.`client_number` FROM `ln_client` AS c WHERE c.`client_id`=lcrm.`group_id`) AS client_code,
				  lcrm.* 
				FROM
				  `ln_client_receipt_money` AS lcrm 
				WHERE lcrm.`id` = $id";
    	return $db->fetchRow($sql);
    }
    public function getGroupPaymentDetail($id){
    	$db = $this->getAdapter();
    	$sql = "SELECT 
				  (SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=lcrmd.`client_id`) AS client_name,
				  (SELECT c.`client_number` FROM `ln_client` AS c WHERE c.`client_id`=lcrmd.`client_id`) AS client_number,
				  lcrmd.* 
				FROM
				  `ln_client_receipt_money_detail` AS lcrmd 
				WHERE lcrmd.`crm_id` = (SELECT id FROM `ln_client_receipt_money` WHERE id=$id)";
    	return $db->fetchAll($sql);
    }
    public function getClientByBranch($id){
    	$db = $this->getAdapter();
    	$sql="SELECT c.`branch_id`,c.`client_id`,c.`client_number`,c.`name_en` FROM `ln_client` AS c WHERE c.`is_group`=1 AND c.`branch_id`=$id";
    	return $db->fetchAll($sql);
    	
    	
    }
    function getAllClient(){
    	$db = $this->getAdapter();
    	$sql = "SELECT c.`client_id` AS id ,c.`name_en` AS name ,c.`branch_id` FROM `ln_client` AS c WHERE c.`is_group`=1  AND c.`name_en`!='' " ;
    	return $db->fetchAll($sql);
    }
    
    function getAllClientCode(){
    	$db = $this->getAdapter();
    	$sql = "SELECT c.`client_id` AS id ,c.`client_number` AS name ,c.`branch_id` FROM `ln_client` AS c WHERE c.`is_group`=1  AND c.`name_en`!='' " ;
    	return $db->fetchAll($sql);
    }
    
}

