<?php

class Loan_Model_DbTable_DbLoanILPayment extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_client_receipt_money';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    public function getAllIndividuleLoan($search){
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
				FROM `ln_client_receipt_money` AS lcrm WHERE lcrm.is_group=0";
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
	function getIlPaymentByID($id){
		$db = $this->getAdapter();
		$sql="SELECT * FROM `ln_client_receipt_money` WHERE id = $id";
		return $db->fetchRow($sql);
	}
	public function getIlDetail($id){
		$db = $this->getAdapter();
		$sql="SELECT 
				  
				  (SELECT `currency_id` FROM `ln_client_receipt_money_detail` WHERE crm_id = $id LIMIT 1) AS `currency_type`,
				  (SELECT c.`client_number` FROM `ln_client` AS c WHERE crmd.`client_id`=c.`client_id`) AS client_number,
				  (SELECT c.`name_kh` FROM `ln_client` AS c WHERE crmd.`client_id`=c.`client_id`) AS name_kh,
				  crmd.* 
				FROM
				  `ln_client_receipt_money_detail` AS crmd 
				WHERE crmd.`crm_id` = $id ";
		return $db->fetchAll($sql);
	}
    function getTranLoanByIdWithBranch($id){
//     	$sql = "SELECT lg.g_id,lg.level,lg.co_id,lg.zone_id,lg.pay_term,lm.payment_method,
//     		lm.interest_rate,lm.amount_collect_principal,
//     		lm.client_id,lm.admin_fee,
// 	    	(SELECT name_kh FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_kh,
// 	  		(SELECT name_en FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_en,
// 	  		lm.total_capital,lm.interest_rate,lm.payment_method,
// 	    	lg.time_collect,
// 	    	lg.zone_id,
// 	    	(SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_enname,
// 	    	lg.status AS str ,lg.status FROM `ln_loan_group` AS lg,`ln_loan_member` AS lm
// 			WHERE lg.g_id = lm.group_id AND lg.g_id = $id LIMIT 1 ";
//     	return $this->getAdapter()->fetchRow($sql);
    }
    public function getIlPaymentNumber(){
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
public function addILPayment($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	
    	$reciept_no = $data['reciept_no'];
    	
    	$sql="SELECT id  FROM ln_client_receipt_money WHERE receipt_no='$reciept_no' ORDER BY id DESC LIMIT 1 ";
    	$acc_no = $db->fetchOne($sql);
    	
    	if($acc_no){
    		$reciept_no=$this->getIlPaymentNumber();
    	}else{
    		$reciept_no = $data['reciept_no'];
    	}
    	
    	$loan_number = $data['loan_number'];
    	
    	try{
    		$arr_client_pay = array(
    			'co_id'							=>		$data['co_id'],
    			'group_id'						=>		$data["client_id"],
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
    			'is_group'						=>		0,
    		);
			$this->_name = "ln_client_receipt_money";
    		$client_pay = $this->insert($arr_client_pay);
    		
    		$date_collect = $data["collect_date"];
    		$identify = explode(',',$data['identity']);
    		foreach($identify as $i){
				$date_pay = $data["date_payment_".$i];
				$date = strtotime($date_collect)-strtotime($date_pay);
				
				if($date>0){
					$status = 3;
				}else if($date==0){
					$status=1;
				}else {
					$status=2;
				}
				$amount_receive = $data["amount_receive"];
				$interest = $data["total_interest"];
				$os_amount = $data["os_amount"];
				$total_payment = $data["total_payment"];
				if($amount_receive<=$interest){
					$new_amount = $interest-$amount_receive;
					$new_interest = $new_amount;
				}else{
					$new_amount = $amount_receive-$interest;
					$new_interest = 0;
				}
    			if($data["mfdid_".$i]){
    				if($amount_receive>=$total_payment){
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
    							'is_closingentry'		=>		0,
    							'status'				=>		$data["option_pay"]
    					);
    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    						
    					$arr_update_fun_detail = array(
    							'is_completed'		=> 	1,
    							'payment_option'	=>	$data["option_pay"]
    					);
    					$this->_name="ln_loanmember_funddetail";
    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
    					$this->update($arr_update_fun_detail, $where);
    					
    				}else{
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
	    							'is_completed'			=>		0,
	    							'is_verify'				=>		0,
	    							'verify_by'				=>		0,
	    							'is_closingentry'		=>		0,
	    							'status'				=>		$data["option_pay"]
	    					);
	    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
	    						
	    					$arr_update_fun_detail = array(
	    							'is_completed'		=> 	0,
	    							'total_interest'	=>  $new_interest,
	    							'total_payment'		=>	$os_amount-$new_amount,
	    							'payment_option'	=>	$data["option_pay"]
	    					);
	    					$this->_name="ln_loanmember_funddetail";
	    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
	    					$this->update($arr_update_fun_detail, $where);
    				}
    				
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
    		echo $e->getMessage();exit();
    	}
    }
    function updateIlPayment($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$query = new Application_Model_DbTable_DbGlobal();
    	$id= $data["id"];
    	$identify_detail = $data["identity"];
    	try{
    		
    		$arr_client_pay = array(
    			'co_id'							=>		$data['co_id'],
    			'group_id'						=>		$data["client_id"],
    			'receiver_id'					=>		$data['reciever'],
    			//'receipt_no'					=>		$reciept_no,
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
    			'is_group'						=>		0,
    			
    		);
    		$this->_name = "ln_client_receipt_money";
    		$where = $db->quoteInto("id=?", $data["id"]);
    		
    			$client_pay = $this->update($arr_client_pay, $where);
    		
    			$loan_fun = $this->getIlDetail($id);
    			foreach ($loan_fun as $row){
	    			$array = array(
	    				'is_completed'  =>0,
	    			);
	    			$this->_name= "ln_loanmember_funddetail";
	    			$where = $db->quoteInto("id=?", $row["lfd_id"]);
	    			$this->update($array, $where);
    			}
    		$sql_delete = "DELETE FROM ln_client_receipt_money_detail WHERE crm_id =$id";
    		
    			$db->query($sql_delete);
    	
    		$identify = explode(',',$data['identity']);
    		foreach($identify as $i){
    			$amount_receive = $data["amount_receive"];
				$interest = $data["total_interest"];
				$os_amount = $data["os_amount"];
				$total_payment = $data["total_payment"];
				if($amount_receive<=$interest){
					$new_amount = $interest-$amount_receive;
					$new_interest = $new_amount;
				}else{
					$new_amount = $amount_receive-$interest;
					$new_interest = 0;
				}
    			if(!empty($identify)){
    				if($amount_receive>=$total_payment){
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
    							'is_closingentry'		=>		0,
    							'status'				=>		$data["option_pay"]
    					);
    						
    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    					
    					$arr_update_fun_detail = array(
    							'is_completed'		=> 	1,
    							'payment_option'	=>	$data["option_pay"]
    					);
    					$this->_name="ln_loanmember_funddetail";
    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
    					$this->update($arr_update_fun_detail, $where);
    					
    				}else{
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
	    							'is_completed'			=>		0,
	    							'is_verify'				=>		0,
	    							'verify_by'				=>		0,
	    							'is_closingentry'		=>		0,
	    							'status'				=>		$data["option_pay"]
	    					);
	    						
	    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
	    						
	    					$a = $os_amount-$new_amount;
	    					$arr_update_fun_detail = array(
	    							'is_completed'		=> 	0,
	    							'total_interest'	=>  $new_interest,
	    							'total_payment'		=>	$os_amount-$new_amount,
	    							'payment_option'	=>	$data["option_pay"]
	    					);
	    					$this->_name="ln_loanmember_funddetail";
	    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
	    					$this->update($arr_update_fun_detail, $where);
	    					
    				}
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
    		
    		$group_id = $data["client_id"];
    		if(empty($rs_payment)){
    		$sql ="UPDATE
		    			`ln_loan_group` AS l
		    		SET l.`status` = 2
		    		WHERE l.`g_id`= (SELECT m.`group_id` FROM `ln_loan_member` AS m WHERE m.`loan_number`='$loan_number' LIMIT 1)
		    			AND l.`group_id`= $group_id AND l.`loan_type`=1";
    			$db->query($sql);
    					 
    					$sql_loan_member ="UPDATE `ln_loan_member` AS m SET m.`is_completed`=1 WHERE m.`loan_number`= '$loan_number'";
    					$db->query($sql_loan_member);
    		}
    		//exit();
    		$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();exit();
    	}
    }
   function getAllPaymentListBySender($client_id){
   		$db = $this->getAdapter();
   		$sql = " CALL `stgetAllPaymentById`($client_id)";
   		return $db->fetchAll($sql);
   }

   function getLoanPaymentByLoanNumber($data){
    	$db = $this->getAdapter();
    	$loan_number= $data['loan_number'];
    	if($data['type']!=1){
    		$where =($data['type']==2 AND $data["type"]==3)?'lc.client_id = '.$loan_number:'lc.client_id='.$loan_number;
    		$sql ="SELECT 
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
					WHERE lg.`g_id`=lm.`group_id`
					  AND lf.`member_id`=lm.`member_id`
					  AND lm.`client_id`=lc.`client_id`
					  AND lg.`loan_type`=1
    				  AND lf.`is_completed`=0
    				  AND $where
    				";
    	}elseif($data['type']==1){
    		$where = 'lm.`loan_number`='.$loan_number;
    		$sql ="SELECT 
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
					WHERE lg.`g_id`=lm.`group_id`
					  AND lf.`member_id`=lm.`member_id`
					  AND lm.`client_id`=lc.`client_id`
					  AND lg.`loan_type`=1
					  AND $where
    				AND lf.`is_completed`=0";
    				
 	}
    	return $db->fetchAll($sql);
   }
//     function getLoanPaymentByLoanNumber($data){
//     	$db = $this->getAdapter();
//     	$loan_number= $data['loan_number'];
//     	if($data['type']!=2){
//     		$where =($data['type']==1)?'loan_number = '.$loan_number:'client_id='.$loan_number;
//     	    $sql=" SELECT *,
// 					(SELECT currency_type FROM `ln_loan_member` WHERE $where LIMIT 1  ) AS curr_type
//     	     FROM `ln_loanmember_funddetail` WHERE member_id =
// 		    		(SELECT  member_id FROM `ln_loan_member` WHERE $where AND status=1 LIMIT 1)
// 		    		AND status = 1 ";
//     	}elseif($data['type']==2){
//     		$sql="SELECT * FROM `ln_loanmember_funddetail` WHERE status = 1 AND member_id = 
//     		       ( SELECT member_id FROM `ln_loan_member` WHERE client_id =
//     		       (SELECT client_id FROM `ln_client` WHERE client_number = ".$loan_number." LIMIT 1) LIMIT 1) ";
//     	}
//     	return $db->fetchAll($sql);
//     }
  
   function getAllClient(){
   	$db = $this->getAdapter();
   	$sql = "SELECT c.`client_id` AS id ,c.`name_en` AS name ,c.`branch_id` FROM `ln_client` AS c WHERE c.`name_en`!='' " ;
   	return $db->fetchAll($sql);
   }
   
   function getAllClientCode(){
   	$db = $this->getAdapter();
   	$sql = "SELECT c.`client_id` AS id ,c.`client_number` AS name ,c.`branch_id` FROM `ln_client` AS c WHERE c.`name_en`!='' " ;
   	return $db->fetchAll($sql);
   }
}

