<?php

class Loan_Model_DbTable_DbLoanILPayment extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_client_receipt_money';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    public function getAllIndividuleLoan(){
//     	$from_date =(empty($search['from_date']))? '1': "lg.date_release >= '".$search['from_date']." 00:00:00'";
//     	$to_date = (empty($search['to_date']))? '1': "lg.date_release <= '".$search['to_date']." 23:59:59'";
//     	$where = " AND ".$from_date." AND ".$to_date;
    	
    	$db = $this->getAdapter();
    	$sql="SELECT 
				  crm.`id`,
				  (SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=crm.`group_id`) AS client_name,
				  (SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`= crm.`branch_id`) AS branch,
    			  crm.`receipt_no`,
				  crm.`loan_number`,
				  
    			  crm.`principal_amount`,
				  crm.`total_principal_permonth`,
				  crm.`total_payment`,
				  crm.`date_input`,
    			 (SELECT c.`co_khname` FROM `ln_co` AS c WHERE c.`co_id`=crm.`co_id`) AS co,
				  crm.`status`
				FROM
				  `ln_client_receipt_money` AS crm WHERE crm.`is_group`=0 ";
//     	if($search['status']>1){
//     		$where.= "lm.status = ".$search['status'];
//     	}
    	
    	return $db->fetchAll($sql);
    }
//     (SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_name,
	function getIlPaymentByID($id){
		$db = $this->getAdapter();
		$sql="SELECT * FROM `ln_client_receipt_money` WHERE id = $id";
		return $db->fetchRow($sql);
	}
	public function getIlDetail($id){
		$db = $this->getAdapter();
		$sql="SELECT 
				  
				  (SELECT `currency_id` FROM `ln_client_receipt_money_detail` WHERE crm_id = $id) AS `currency_type`,
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
//     		$db->getProfiler()->setEnabled(true);
			$this->_name = "ln_client_receipt_money";
    		//$client_pay = $db->insert("ln_client_receipt_money", $arr_client_pay);
    		$client_pay = $this->insert($arr_client_pay);
    		
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     		$db->getProfiler()->setEnabled(false);
    		
    		$date_collect = $data["collect_date"];
    		$identify = explode(',',$data['identity']);
    		foreach($identify as $i){
//     			print_r($data["mfdid_".$i]);
				$date_pay = $data["date_payment_".$i];
				
				$date = strtotime($date_collect)-strtotime($date_pay);
// 				print_r($date_pay."-".$date_collect."=".$date);
				
				if($date>0){
					$status = 3;
					print_r($status);
				}else if($date==0){
					$status=1;
					print_r($status);
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
//     					$db->getProfiler()->setEnabled(true);
    						
    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    						
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     					$db->getProfiler()->setEnabled(false);
    					
    					$arr_update_fun_detail = array(
    							'is_completed'		=> 	1,
    							'payment_option'	=>	$data["option_pay"]
    					);
    					$this->_name="ln_loanmember_funddetail";
    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
//     					$db->getProfiler()->setEnabled(true);
    					$this->update($arr_update_fun_detail, $where);
    					
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     					$db->getProfiler()->setEnabled(false);
    				}else{
//     					if($amount_receive){
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
// 	    					$db->getProfiler()->setEnabled(true);
	    						
	    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
	    						
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
// 	    					$db->getProfiler()->setEnabled(false);
	    					
	    					
	    					$a = $os_amount-$new_amount;
	    					print_r($os_amount."-".$new_amount."=". $a);
	    					$arr_update_fun_detail = array(
	    							'is_completed'		=> 	0,
	    							'total_interest'	=>  $new_interest,
	    							'total_payment'		=>	$os_amount-$new_amount,
	    							'payment_option'	=>	$data["option_pay"]
	    					);
	    					$this->_name="ln_loanmember_funddetail";
	    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
// 	    					$db->getProfiler()->setEnabled(true);
	    					$this->update($arr_update_fun_detail, $where);
	    					
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
// 	    					$db->getProfiler()->setEnabled(false);
//     					}
    				}
    				
    			}
    		}
     		exit();
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
    		
//     		$db->getProfiler()->setEnabled(true);
    			$client_pay = $this->update($arr_client_pay, $where);
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     		$db->getProfiler()->setEnabled(false);
    		
    			$loan_fun = $this->getIlDetail($id);
    			foreach ($loan_fun as $row){
	    			$array = array(
	    				'is_completed'  =>0,
	    			);
	    			$this->_name= "ln_loanmember_funddetail";
	    			$where = $db->quoteInto("id=?", $row["lfd_id"]);
// 	    			$db->getProfiler()->setEnabled(true);
	    			$this->update($array, $where);
	    			
// 	    			Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
// 	    			Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
// 	    			$db->getProfiler()->setEnabled(false);
    			}
    		$sql_delete = "DELETE FROM ln_client_receipt_money_detail WHERE crm_id =$id";
    		
//     		$db->getProfiler()->setEnabled(true);
    			$db->query($sql_delete);
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     		Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     		$db->getProfiler()->setEnabled(false);
    	
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
//     					$db->getProfiler()->setEnabled(true);
    						
    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    						
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     					$db->getProfiler()->setEnabled(false);
    					
    					$arr_update_fun_detail = array(
    							'is_completed'		=> 	1,
    							'payment_option'	=>	$data["option_pay"]
    					);
    					$this->_name="ln_loanmember_funddetail";
    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
//     					$db->getProfiler()->setEnabled(true);
    					$this->update($arr_update_fun_detail, $where);
    					
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
//     					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
//     					$db->getProfiler()->setEnabled(false);
    				}else{
//     					if($amount_receive){
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
// 	    					$db->getProfiler()->setEnabled(true);
	    						
	    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
	    						
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
// 	    					$db->getProfiler()->setEnabled(false);
	    					
	    					
	    					$a = $os_amount-$new_amount;
	    					print_r($os_amount."-".$new_amount."=". $a);
	    					$arr_update_fun_detail = array(
	    							'is_completed'		=> 	0,
	    							'total_interest'	=>  $new_interest,
	    							'total_payment'		=>	$os_amount-$new_amount,
	    							'payment_option'	=>	$data["option_pay"]
	    					);
	    					$this->_name="ln_loanmember_funddetail";
	    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
// 	    					$db->getProfiler()->setEnabled(true);
	    					$this->update($arr_update_fun_detail, $where);
	    					
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQuery());
// 	    					Zend_Debug::dump($db->getProfiler()->getLastQueryProfile()->getQueryParams());
// 	    					$db->getProfiler()->setEnabled(false);
//     					}
    				}
    	
    			}
    		}
//     		exit();
    		$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();//exit();
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

