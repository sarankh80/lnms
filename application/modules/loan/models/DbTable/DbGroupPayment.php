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
    	$team_group_code = $data["client_code"];
    		$sql ="SELECT 
    				  (SELECT crm.`date_input` FROM `ln_client_receipt_money` AS crm , `ln_client_receipt_money_detail` AS crmd WHERE crm.`id`=crmd.`crm_id` AND crmd.`lfd_id`=lf.`id` AND crmd.`loan_number`=lm.`loan_number` ORDER BY `crm`.`date_input` DESC LIMIT 1) AS last_pay_date,
					  lm.`loan_number`,
					  lm.`currency_type`,
					  lm.`client_id`,
					  lm.`interest_rate`,
					  lm.`pay_after`,
					  (SELECT c.client_number FROM `ln_client` AS c WHERE c.client_id=lm.`client_id`) AS client_code,
					  (SELECT c.name_kh FROM `ln_client` AS c WHERE c.client_id=lm.`client_id`) AS client_name,
					  lg.`level`,
					  DATE_FORMAT(lg.`date_release`, '%d-%m-%Y') AS `date_release`,
					  lg.`co_id`,
					  lg.`total_duration`,
					  lg.`collect_typeterm`,
					  lg.`payment_method`,
					  (SELECT SUM(lm.`total_capital`) FROM `ln_loan_member` AS lm,`ln_loan_group` AS lg,`ln_client` AS lc WHERE lg.`g_id`=lm.`group_id` AND lg.`group_id`=lc.`client_id` AND lc.`client_id`=$team_group_code) AS total_capital,
					  DATE_FORMAT(lf.`date_payment`, '%d-%m-%Y') AS `payment_date`,
					  lf.* 
					FROM
					  `ln_loanmember_funddetail` AS lf,
					  `ln_loan_member` AS lm,
					  `ln_loan_group` AS lg,
					  `ln_client` AS lc 
					WHERE lf.`member_id` = lm.`member_id` 
					  AND lm.`group_id` = lg.`g_id` 
					  AND lg.`group_id` = lc.`client_id` 
					  AND lg.`group_id` = $team_group_code
					  AND lf.`is_completed` = 0 
					  AND lg.`loan_type`=2
					  AND lg.`is_reschedule`=0
					GROUP BY lm.`client_id`
    				";
//     	return $sql;
    	return $db->fetchAll($sql);
   }
   
   public function getLoanByLoanNimber($data){
   		$db = $this->getAdapter();
   		$loan_number = $data["loan_number"];
   		$option_pay = $data["option_pay"];
   		if($option_pay==1){
	   		$sql="SELECT 
	    				  (SELECT crm.`date_input` FROM `ln_client_receipt_money` AS crm , `ln_client_receipt_money_detail` AS crmd WHERE crm.`id`=crmd.`crm_id` AND crmd.`lfd_id`=lf.`id` AND crmd.`loan_number`=lm.`loan_number` ORDER BY `crm`.`date_input` DESC LIMIT 1) AS last_pay_date,
						  lm.`loan_number`,
						  lm.`currency_type`,
						  lm.`client_id`,
						  lm.`interest_rate`,
						  lm.`pay_after`,
						  (SELECT SUM(lm.`total_capital`) FROM `ln_loan_member` AS lm WHERE lm.`group_id` = lg.`g_id` GROUP BY lm.`loan_number`) AS total_capital,
						  (SELECT c.client_number FROM `ln_client` AS c WHERE c.client_id=lm.`client_id`) AS client_code,
						  (SELECT c.name_kh FROM `ln_client` AS c WHERE c.client_id=lm.`client_id`) AS client_name,
						  lg.`level`,
						  DATE_FORMAT(lg.`date_release`, '%d-%m-%Y') AS `date_release`,
						  lg.`co_id`,
						  lg.`total_duration`,
						  lg.`collect_typeterm`,
						  lg.`payment_method`,
						  
						  DATE_FORMAT(lf.`date_payment`, '%d-%m-%Y') AS `payment_date`,
						  lf.* 
						FROM
						  `ln_loanmember_funddetail` AS lf,
						  `ln_loan_member` AS lm,
						  `ln_loan_group` AS lg,
						  `ln_client` AS lc 
						WHERE lf.`member_id` = lm.`member_id` 
						  AND lm.`group_id` = lg.`g_id` 
						  AND lg.`group_id` = lc.`client_id` 
						  AND lf.`is_completed` = 0 
						  AND lg.`loan_type`=2
						  AND lg.`is_reschedule`!=1
						  AND lm.`loan_number`='$loan_number'
						  GROUP BY lm.`client_id`
						";
   		}else{
   			$sql="SELECT 
    				  (SELECT crm.`date_input` FROM `ln_client_receipt_money` AS crm , `ln_client_receipt_money_detail` AS crmd WHERE crm.`id`=crmd.`crm_id` AND crmd.`lfd_id`=lf.`id` AND crmd.`loan_number`=lm.`loan_number` ORDER BY `crm`.`date_input` DESC LIMIT 1) AS last_pay_date,
					  lm.`loan_number`,
					  lm.`currency_type`,
					  lm.`client_id`,
					  lm.`interest_rate`,
					  lm.`pay_after`,
					  (SELECT SUM(lm.`total_capital`) FROM `ln_loan_member` AS lm WHERE lm.`group_id` = lg.`g_id` GROUP BY lm.`loan_number`) AS total_capital,
					  (SELECT c.client_number FROM `ln_client` AS c WHERE c.client_id=lm.`client_id`) AS client_code,
					  (SELECT c.name_kh FROM `ln_client` AS c WHERE c.client_id=lm.`client_id`) AS client_name,
					  lg.`level`,
					  DATE_FORMAT(lg.`date_release`, '%d-%m-%Y') AS `date_release`,
					  lg.`co_id`,
					  lg.`total_duration`,
					  lg.`collect_typeterm`,
					  lg.`payment_method`,
					  DATE_FORMAT(lf.`date_payment`, '%d-%m-%Y') AS `payment_date`,
					   SUM(lf.`total_principal`) AS total_principal,
					  SUM(lf.`principle_after`) AS principle_after,
					  SUM(lf.`total_interest_after`) AS total_interest_after,
					  SUM(lf.`penelize`) AS penelize,
					  SUM(lf.`service_charge`) AS service_charge,
					  lf.`date_payment`
					FROM
					  `ln_loanmember_funddetail` AS lf,
					  `ln_loan_member` AS lm,
					  `ln_loan_group` AS lg,
					  `ln_client` AS lc 
					WHERE lf.`member_id` = lm.`member_id` 
					  AND lm.`group_id` = lg.`g_id` 
					  AND lg.`group_id` = lc.`client_id` 
					  AND lf.`is_completed` = 0 
					  AND lg.`loan_type`=2
					  AND lg.`is_reschedule`!=1
					  AND lm.`loan_number`='$loan_number'
					  GROUP BY lm.`loan_number`,lf.`date_payment`
		   			";
   		}
   		return $db->fetchAll($sql);
   }
   
   function getAllLoanPaymentByLoanNumber($data){
   	$db = $this->getAdapter();
   	$loan_number= $data['loan_number'];
   	
   	$where = 'lm.`loan_number`='.$loan_number;
   	$sql ="SELECT 
			  SUM(lf.`principle_after`) AS principle_after,
			  SUM(lf.`total_interest_after`) AS total_interest_after,
			  SUM(lf.`penelize`) AS penelize,
			  SUM(lf.`service_charge`) AS service_charge,
			  SUM(lf.`total_payment_after`) AS total_payment_after,
			  lf.`date_payment`,
			  lf.`is_completed`,
			  lm.`pay_after`,
			  c.`name_kh` AS client_name,
			  (SELECT `ln_currency`.`symbol` FROM `ln_currency` WHERE (`ln_currency`.`id` = lm.`currency_type`)) AS `currency_type`
			FROM
			  `ln_loanmember_funddetail` AS lf,
			  `ln_loan_member` AS lm,
			  `ln_loan_group` AS lg,
			  `ln_client` AS c
			WHERE lm.`member_id` = lf.`member_id` 
			  AND lg.`g_id` = lm.`group_id` 
			  AND lg.`loan_type` = 2
			  AND lm.`client_id`=c.`client_id`
			  AND lm.`loan_number`='$loan_number'
			  GROUP BY lm.`group_id`,lf.`date_payment` 
			   	";
//    		return $sql;
   		return $db->fetchAll($sql);
   		}
   		function getAllLoanHasPayed($data){
   			$db = $this->getAdapter();
   			$loan_number= $data['loan_number'];
   		
   			$where = 'lm.`loan_number`='.$loan_number;
   			$sql ="SELECT 
					  lcm.`receipt_no`,
					  lcm.`date_input`,
					  lcmd.`loan_number`,
					  lcmd.`remain_capital`,
					  SUM(lcmd.`principal_permonth`) AS principal_permonth,
					  SUM(lcmd.`total_interest`) AS total_interest,
					  SUM(lcmd.`penelize_amount`) AS penelize_amount,
					  SUM(lcmd.`service_charge`) AS service_charge,
					  SUM(lcmd.`total_payment`) AS total_payment,
					  SUM(lcmd.`total_recieve`) AS total_recieve,
					  lcmd.`date_payment`,
					  lcmd.`is_completed`,
					  (SELECT `ln_currency`.`symbol` FROM `ln_currency` WHERE (`ln_currency`.`id` = lcm.`currency_type`)) AS `currency_type`
					FROM
					  `ln_client_receipt_money` AS lcm,
					  `ln_client_receipt_money_detail` AS lcmd 
					WHERE lcm.id = lcmd.`crm_id` 
					AND lcmd.`loan_number`='$loan_number'
					GROUP BY lcmd.`loan_number`,lcmd.`date_payment`
   				";
   			//    		return $sql;
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
    				'group_id'						=>		$data["client_code"],
    				'receiver_id'					=>		$data['reciever'],
    				'receipt_no'					=>		$reciept_no,
    				'branch_id'						=>		$data['branch_id'],
    				'date_input'					=>		$data["date_input"],
    				'principal_amount'				=>		$data["priciple_amount"],
    				'total_principal_permonth'		=>		$data["os_amount"],
    				'total_payment'					=>		$data["total_payment"],
    				'total_interest'				=>		$data["total_interest"],
    				'recieve_amount'				=>		$data["amount_receive"],
    				'penalize_amount'				=>		$data['penalize_amount'],
    				'return_amount'					=>		$data["amount_return"],
    				'service_charge'				=>		$data["service_charge"],
    				'note'							=>		$data['note'],
    				'user_id'						=>		$user_id,
    				'is_group'						=>		1,
    				'payment_option'				=>		1,
    				'currency_type'					=>		$data["currency_type"],
    				'status'						=>		1,
    				'amount_payment'				=>		$data["amount_receive"]-$data["amount_return"],
    				'is_completed'					=>		1
    		);
			$this->_name = "ln_client_receipt_money";
			
    		$client_recipt_money = $this->insert($arr_client_pay);
    		
    		$identify = explode(',',$data['identity']);
    		foreach($identify as $i){
    			$client_detail = $data["mfdid_".$i];
    			$sub_recieve_amount = $data["sub_recive_amount_".$i];
    			$sub_service_charge = $data["sub_service_charge_".$i];
    			$sub_peneline_amount = $data["sub_penelize_".$i];
    			$sub_interest_amount = $data["sub_interest_".$i];
    			$sub_principle= $data["sub_principal_permonth_".$i];
    			$sub_total_payment = $data["sub_payment_".$i];
    			if($client_detail!=""){
    				//$reciept_no=$this->getIlPaymentNumber();
    				if($sub_recieve_amount>=$sub_total_payment){
	    				$arr_money_detail = array(
	    						'crm_id'				=>		$client_recipt_money,
	    						'loan_number'			=>		$data["loan_number_".$i],
	    						'lfd_id'				=>		$data["mfdid_".$i],
	    						'client_id'				=>		$data["client_id_".$i],
	    						'date_payment'			=>		$data["date_payment_".$i],
	    						'capital'				=>		$data["sub_total_priciple_".$i],
	    						'remain_capital'		=>		$data["sub_total_priciple_".$i] - $data["sub_principal_permonth_".$i],
	    						'principal_permonth'	=>		$data["sub_principal_permonth_".$i],
	    						'total_interest'		=>		$data["sub_interest_".$i],
	    						'total_payment'			=>		$data["sub_payment_".$i],
	    						'total_recieve'			=>		$data["sub_recive_amount_".$i],
	    						'currency_id'			=>		$data["currency_type"],
	    						'pay_after'				=>		$data['multiplier_'.$i],
	    						'is_completed'			=>		0,
	    						'is_verify'				=>		0,
	    						'verify_by'				=>		0,
	    						'is_closingentry'		=>		0,
	    						'status'				=>		1
	    				);
	    				$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
	    				 
	    				$arr_update_fun_detail = array(
	    					'is_completed'		=> 	1,
	    				);
	    				$this->_name="ln_loanmember_funddetail";
	    				$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
	    				
	    				$this->update($arr_update_fun_detail, $where);
    				}else{
		   					$new_sub_interest_amount = $data["sub_interest_".$i];
		   					$new_sub_penelize = $data["sub_penelize_".$i];
		   					$new_sub_service_charge = $data["sub_service_charge_".$i];
		   					$new_sub_principle = $data["sub_principal_permonth_".$i];
			   				if($sub_recieve_amount>0){
			   					$new_amount_after_service = $sub_recieve_amount-$sub_service_charge;
			   					if($new_amount_after_service>=0){
			   						$new_sub_service_charge = 0;
			   						$new_amount_after_penelize = $new_amount_after_service - $sub_peneline_amount;
			   						if($new_amount_after_penelize>=0){
			   							$new_sub_penelize = 0;
			   							$new_amount_after_interest = $new_amount_after_penelize - $sub_interest_amount;
			   							if($new_amount_after_interest>=0){
			   								$new_sub_interest_amount = 0;
			   								$new_sub_principle = $sub_principle - $new_amount_after_interest;
			   							}else{
			   								$new_sub_interest_amount = abs($new_amount_after_interest);
			   							}
			   						}else{
			   							$new_sub_penelize = abs($new_amount_after_penelize);
			   						}
			   					}else{
			   						$new_sub_service_charge = abs($new_amount_after_service);
			   					}
			   				}
			   				
			   				$arr_money_detail = array(
			   						'crm_id'				=>		$client_recipt_money,
			   						'loan_number'			=>		$data["loan_number_".$i],
			   						'lfd_id'				=>		$data["mfdid_".$i],
			   						'client_id'				=>		$data["client_id_".$i],
			   						'date_payment'			=>		$data["date_payment_".$i],
			   						'capital'				=>		$data["sub_total_priciple_".$i],
			   						'remain_capital'		=>		$data["sub_total_priciple_".$i] - $data["sub_principal_permonth_".$i],
			   						'principal_permonth'	=>		$sub_principle,
			   						'total_interest'		=>		$sub_interest_amount,
			   						'total_payment'			=>		$sub_total_payment,
			   						'total_recieve'			=>		$data["sub_recive_amount_".$i],
			   						'currency_id'			=>		$data["currency_type"],
			   						'pay_after'				=>		$data['multiplier_'.$i],
			   						'is_completed'			=>		0,
			   						'is_verify'				=>		0,
			   						'verify_by'				=>		0,
			   						'is_closingentry'		=>		0,
			   						'status'				=>		1
			   				);
			   				
			   				$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
			   				
			   				$arr_update_fun_detail = array(
			   						'is_completed'			=> 	0,
			   						'total_interest_after'	=>  $new_sub_interest_amount,
			   						'total_payment_after'	=>	$new_sub_principle,
			   						'penelize'				=>	$new_sub_penelize,
			   						'principle_after'		=>	$new_sub_principle,
			   						'service_charge'		=>	$new_sub_service_charge,
			   						'payment_option'		=>	1
			   				);
			   				$this->_name="ln_loanmember_funddetail";
			   				$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
			   				
			   				$this->update($arr_update_fun_detail, $where);
		   				}
		   				$loan_number = $data["loan_number_".$i];
		   				$sql_payment ="SELECT
						   					l.*
						   				FROM
							   				`ln_loanmember_funddetail` AS l,
							   				`ln_loan_member` AS m
						   				WHERE l.`member_id` = m.`member_id`
							   				AND m.`loan_number` = '$loan_number'
							   				AND l.`is_completed` = 0 ";
		   				$rs_payment = $db->fetchRow($sql_payment);
		   				
		   				$group_id = $data["client_code"];
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
    			}
    		}
    		$db->commit();
    		
    	}catch (Exception $e){
    		$db->rollBack();
    		$err =$e->getMessage();
    		Application_Model_DbTable_DbUserLog::writeMessageError($err);
    	}
    }
    function updateGroupPayment($data,$id){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$query = new Application_Model_DbTable_DbGlobal();
    	//$id= $data["id"];
    	try{
    		$arr_client_pay = array(
    				'co_id'							=>		$data['co_id'],
    				'group_id'						=>		$data["client_code"],
    				'receiver_id'					=>		$data['reciever'],
    				'branch_id'						=>		$data['branch_id'],
    				'date_input'					=>		$data["date_input"],
    				'principal_amount'				=>		$data["priciple_amount"],
    				'total_principal_permonth'		=>		$data["os_amount"],
    				'total_payment'					=>		$data["total_payment"],
    				'total_interest'				=>		$data["total_interest"],
    				'recieve_amount'				=>		$data["amount_receive"],
    				'penalize_amount'				=>		$data['penalize_amount'],
    				'return_amount'					=>		$data["amount_return"],
    				'service_charge'				=>		$data["service_charge"],
    				'note'							=>		$data['note'],
    				'user_id'						=>		$user_id,
    				'is_group'						=>		1,
    				'payment_option'				=>		1,
    				'currency_type'					=>		$data["currency_type"],
    				'status'						=>		1,
    				'amount_payment'				=>		$data["amount_receive"]-$data["amount_return"],
    				'is_completed'					=>		1
    		);
    		$this->_name = "ln_client_receipt_money";
    		$where = $db->quoteInto("id=?", $id);
    		
    		$client_pay = $this->update($arr_client_pay, $where);
    		
    		$loan_fun = $this->getGroupPaymentDetail($id);
    			
    		$sql_delete = "DELETE FROM ln_client_receipt_money_detail WHERE crm_id =$id";
    		
    		$db->query($sql_delete);
    		
    		if(!empty($loan_fun)){
    			foreach ($loan_fun as $rs){
    				$principle = $rs["principal_permonth"];
    				$interest = $rs["total_interest"];
    				$recieve_amount = $rs["total_recieve"];
    				$total_pay = $rs["total_payment"];
    				$penelize = $rs["penelize_amount"];
    				$service_charge = $rs["service_charge"];
    		
    				$db_fun = new Loan_Model_DbTable_DbLoanILPayment();
    				$fun = $db_fun->getFunDetail($rs["lfd_id"]);
    				foreach ($fun as $row_fun){
    						
    					if($row_fun["is_completed"]==1){
    						$arr_fun = array(
    								'is_completed'	=>	0,
    						);
    						$this->_name= "ln_loanmember_funddetail";
    						$where = $db->quoteInto("id=?", $rs["lfd_id"]);
    		
    						$this->update($arr_fun, $where);
    						
    					}else{
    						$arr_fun = array(
    								'principle_after'	=>	$principle,
    								'total_interest_after'	=> $interest,
    								'total_payment_after'	=>	$total_pay,
    								'penelize'				=>	$penelize,
    								'service_charge'		=>	$service_charge,
    						);
    						$this->_name= "ln_loanmember_funddetail";
    						$where = $db->quoteInto("id=?", $rs["lfd_id"]);
    						
    						$this->update($arr_fun, $where);
    						
    					}
    				}
    			}
    		}
    	
    		$identify = explode(',',$data['identity']);
    		foreach($identify as $i){
    			$client_detail = $data["mfdid_".$i];
    			$sub_recieve_amount = $data["sub_recive_amount_".$i];
    			$sub_service_charge = $data["sub_service_charge_".$i];
    			$sub_peneline_amount = $data["sub_penelize_".$i];
    			$sub_interest_amount = $data["sub_interest_".$i];
    			$sub_principle= $data["sub_principal_permonth_".$i];
    			$sub_total_payment = $data["sub_payment_".$i];
    			if($client_detail!=""){
    				//$reciept_no=$this->getIlPaymentNumber();
    				if($sub_recieve_amount>=$sub_total_payment){
    					$arr_money_detail = array(
    							'crm_id'				=>		$id,
    							'loan_number'			=>		$data["loan_number_".$i],
    							'lfd_id'				=>		$data["mfdid_".$i],
    							'client_id'				=>		$data["client_id_".$i],
    							'date_payment'			=>		$data["date_payment_".$i],
    							'capital'				=>		$data["sub_total_priciple_".$i],
    							'remain_capital'		=>		$data["sub_total_priciple_".$i] - $data["sub_principal_permonth_".$i],
    							'principal_permonth'	=>		$data["sub_principal_permonth_".$i],
    							'total_interest'		=>		$data["sub_interest_".$i],
    							'total_payment'			=>		$data["sub_payment_".$i],
    							'total_recieve'			=>		$data["sub_recive_amount_".$i],
    							'currency_id'			=>		$data["cu_id_".$i],
    							'pay_after'				=>		$data['multiplier_'.$i],
    							'is_completed'			=>		0,
    							'is_verify'				=>		0,
    							'verify_by'				=>		0,
    							'is_closingentry'		=>		0,
    							'status'				=>		1
    					);
    					
    					
    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    					
    					
    					$arr_update_fun_detail = array(
    							'is_completed'		=> 	1,
    							'payment_option'	=>	1
    					);
    					$this->_name="ln_loanmember_funddetail";
    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
    					
    					
    					$this->update($arr_update_fun_detail, $where);
    					
    				}else{
    					$new_sub_interest_amount = $data["sub_interest_".$i];
    					$new_sub_penelize = $data["sub_penelize_".$i];
    					$new_sub_service_charge = $data["sub_service_charge_".$i];
    					$new_sub_principle = $data["sub_principal_permonth_".$i];
    					if($sub_recieve_amount>0){
    						$new_amount_after_service = $sub_recieve_amount-$sub_service_charge;
    						if($new_amount_after_service>=0){
    							$new_sub_service_charge = 0;
    							$new_amount_after_penelize = $new_amount_after_service - $sub_peneline_amount;
    							if($new_amount_after_penelize>=0){
    								$new_sub_penelize = 0;
    								$new_amount_after_interest = $new_amount_after_penelize - $sub_interest_amount;
    								if($new_amount_after_interest>=0){
    									$new_sub_interest_amount = 0;
    									$new_sub_principle = $sub_principle - $new_amount_after_interest;
    								}else{
    									$new_sub_interest_amount = abs($new_amount_after_interest);
    								}
    							}else{
    								$new_sub_penelize = abs($new_amount_after_penelize);
    							}
    						}else{
    							$new_sub_service_charge = abs($new_amount_after_service);
    						}
    					}
    					 
    					$arr_money_detail = array(
    							'crm_id'				=>		$id,
    							'loan_number'			=>		$data["loan_number_".$i],
    							'lfd_id'				=>		$data["mfdid_".$i],
    							'client_id'				=>		$data["client_id_".$i],
    							'date_payment'			=>		$data["date_payment_".$i],
    							'capital'				=>		$data["sub_total_priciple_".$i],
    							'remain_capital'		=>		$data["sub_total_priciple_".$i] - $data["sub_principal_permonth_".$i],
    							'principal_permonth'	=>		$sub_principle,
    							'total_interest'		=>		$sub_interest_amount,
    							'total_payment'			=>		$sub_total_payment,
    							'total_recieve'			=>		$data["sub_recive_amount_".$i],
    							'currency_id'			=>		$data["cu_id_".$i],
    							'pay_after'				=>		$data['multiplier_'.$i],
    							'is_completed'			=>		0,
    							'is_verify'				=>		0,
    							'verify_by'				=>		0,
    							'is_closingentry'		=>		0,
    							'status'				=>		1
    					);
    					
    					
    					$db->insert("ln_client_receipt_money_detail", $arr_money_detail);
    					
    					 
    					$arr_update_fun_detail = array(
    							'is_completed'			=> 	0,
    							'total_interest_after'	=>  $new_sub_interest_amount,
    							'total_payment_after'	=>	$new_sub_principle,
    							'penelize'				=>	$new_sub_penelize,
    							'principle_after'		=>	$new_sub_principle,
    							'service_charge'		=>	$new_sub_service_charge,
    							'payment_option'		=>	1
    					);
    					$this->_name="ln_loanmember_funddetail";
    					$where = $db->quoteInto("id=?", $data["mfdid_".$i]);
    					
    					
    					$this->update($arr_update_fun_detail, $where);
    					
    				}
    				
    				$loan_number = $data["loan_number_".$i];
    				$sql_payment ="SELECT
				    					l.*
				    				FROM
				    					`ln_loanmember_funddetail` AS l,
				    					`ln_loan_member` AS m
				    				WHERE l.`member_id` = m.`member_id`
				    					AND m.`loan_number` = '$loan_number'
				    					AND l.`is_completed` = 0 ";
    				$rs_payment = $db->fetchRow($sql_payment);
    				
    				$group_id = $data["client_code"];
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
    		}
    		}
    		$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();
    		Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
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
    	
    	$start_date = $search['start_date'];
    	$end_date = $search['end_date'];
    	
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
    	
    	if(!empty($search['start_date']) or !empty($search['end_date'])){
    		$where.=" AND lcrm.`date_input` BETWEEN '$start_date' AND '$end_date'";
    	}
    	if($search['client_name']>0){
    		$where.=" AND lcrm.`group_id`= ".$search['client_name'];
    	}
    	if($search['branch_id']>0){
    		$where.=" AND lcrm.`branch_id`= ".$search['branch_id'];
    	}
    	if($search['co_id']>0){
    		$where.=" AND lcrm.`co_id`= ".$search['co_id'];
    	}
    	
    	
    	//$where='';
    	$order = " ORDER BY receipt_no DESC";
    	//echo $sql.$where.$order;
    	return $db->fetchAll($sql.$where.$order);
    	
    }
    public function getGroupPaymentById($id){
    	$db = $this->getAdapter();
    	$sql="SELECT 
				(SELECT lcrm.`date_input` FROM `ln_client_receipt_money` AS lcrm,`ln_client_receipt_money_detail` AS lcrmd WHERE lcrm.`id`!=$id AND lcrmd.`crm_id`=lcrm.`id` AND lcrm.`loan_number`=(SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) ORDER BY lcrm.`date_input` DESC LIMIT 1) AS last_paydate ,
				  crm.*,
				  (SELECT lm.amount_collect_principal FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=(SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS amount_term,
				  (SELECT lm.`collect_typeterm` FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=(SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS collect_typeterm,
				  (SELECT lm.`interest_rate` FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=(SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS `interest_rate`,
				  (SELECT lm.`total_capital` FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=(SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS `total_capital`,
				  (SELECT g.`date_release` FROM `ln_loan_group` AS g,`ln_loan_member` AS lm WHERE g.`g_id`=lm.`group_id` AND lm.`loan_number` = (SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS date_release,
				  (SELECT g.`level` FROM `ln_loan_group` AS g,`ln_loan_member` AS lm WHERE g.`g_id`=lm.`group_id` AND lm.`loan_number` = (SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS level,
				  (SELECT g.`total_duration` FROM `ln_loan_group` AS g,`ln_loan_member` AS lm WHERE g.`g_id`=lm.`group_id` AND lm.`loan_number` = (SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS total_duration,
				  (SELECT g.`payment_method` FROM `ln_loan_group` AS g,`ln_loan_member` AS lm WHERE g.`g_id`=lm.`group_id` AND lm.`loan_number` = (SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) LIMIT 1) AS payment_method
				FROM
				  `ln_client_receipt_money` AS crm
				  
				WHERE crm.id =$id";
    	return $db->fetchRow($sql);
    }
    public function getGroupPaymentDetail($id){
    	$db = $this->getAdapter();
    	$sql = "SELECT 
			  lcd.`lfd_id`,
			  lcd.`loan_number`,
			  lcd.`client_id`,
			  lcd.`date_payment`,
			  lcd.`capital`,
			  lcd.`principal_permonth`,
			  lcd.`total_interest`,
			  lcd.`total_payment`,
			  lcd.`total_recieve`,
			  lcd.`service_charge`,
			  lcd.`penelize_amount`,
			  lcd.`pay_after`,
			  (SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=lcd.`client_id`) AS client_name,
			  (SELECT c.`client_number` FROM `ln_client` AS c WHERE c.`client_id`=lcd.`client_id`) AS client_code,
			  (SELECT lm.`collect_typeterm` FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=lcd.`loan_number`) AS payTearm,
			  (SELECT lm.`interest_rate` FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=lcd.`loan_number`) AS interest_rate,
			  (SELECT lm.`currency_type` FROM `ln_loan_member` AS lm WHERE lm.`loan_number`=lcd.`loan_number`) AS currency_type,
			  (SELECT lcrm.`date_input` FROM `ln_client_receipt_money` AS lcrm,`ln_client_receipt_money_detail` AS lcrmd WHERE lcrm.`id`!=$id AND lcrmd.`crm_id`=lcrm.`id` AND lcrm.`loan_number`=(SELECT `loan_number` FROM `ln_client_receipt_money_detail` WHERE `crm_id`=$id LIMIT 1) ORDER BY lcrm.`date_input` DESC LIMIT 1) AS last_paydate 
			FROM
			  `ln_client_receipt_money_detail` AS lcd 
			WHERE lcd.`crm_id` =$id";
    	return $db->fetchAll($sql);
    }
    public function getClientByBranch($id){
    	$db = $this->getAdapter();
    	$sql="SELECT c.`branch_id`,c.`client_id`,c.`client_number`,c.`name_en` FROM `ln_client` AS c WHERE c.`is_group`=1 AND c.`branch_id`=$id";
    	return $db->fetchAll($sql);
    	
    	
    }
    function getAllClient(){
    	$db = $this->getAdapter();
    	$sql = "SELECT c.`client_id` AS id ,c.`name_en` AS name ,c.`branch_id`,c.`client_number` FROM `ln_client` AS c WHERE c.`is_group`=1  AND c.`name_en`!='' " ;
    	return $db->fetchAll($sql);
    }
    
    function getAllClientCode(){
    	$db = $this->getAdapter();
    	$sql = "SELECT c.`client_id` AS id ,CONCAT(c.`client_number`,'-',c.`name_kh`) AS name ,c.`branch_id` FROM `ln_client` AS c WHERE c.`is_group`=1  AND c.`name_en`!='' " ;
    	return $db->fetchAll($sql);
    }
    
}

