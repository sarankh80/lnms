<?php

class Loan_Model_DbTable_DbLoanILPayment extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_loan_group';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    public function getAllIndividuleLoan($search){
//     	$from_date =(empty($search['from_date']))? '1': "lg.date_release >= '".$search['from_date']." 00:00:00'";
//     	$to_date = (empty($search['to_date']))? '1': "lg.date_release <= '".$search['to_date']." 23:59:59'";
//     	$where = " AND ".$from_date." AND ".$to_date;
    	
//     	$db = $this->getAdapter();
//     	$sql=" SELECT lg.g_id,lm.loan_number,
//     	(SELECT name_kh FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_kh,
//   		(SELECT name_en FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_en,
//   		lm.total_capital,lm.interest_rate,
//   	   (SELECT payment_nameen FROM `ln_payment_method` WHERE id = lm.payment_method LIMIT 1) AS payment_method,
//   	   (SELECT payment_nameen FROM `ln_payment_method` WHERE id = lm.payment_method LIMIT 1) AS payment_method,
//        (SELECT zone_name FROM `ln_zone` WHERE zone_id=lg.zone_id LIMIT 1) AS zone_name,
//        (SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_name,
//        (SELECT branch_namekh FROM `ln_branch` WHERE br_id =lg.branch_id LIMIT 1) AS branch,
//         lg.status  FROM `ln_loan_group` AS lg,`ln_loan_member` AS lm
// 				WHERE lg.g_id = lm.group_id ";
//     	if($search['status']>1){
//     		$where.= "lm.status = ".$search['status'];
    		
//     	}
//     	$db = $this->getAdapter();
    	
//     	return $db->fetchAll($sql.$where);
    }
//     (SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_name,
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
    public function addILPayment($data){
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try{
    		$arr = array(
    				'lfd_id'=>$data[''],
    				'receipt_no'=>$data[''],
    				'branch_id'=>$data['branch_id'],
    				'loan_number'=>$data['loan_number'],
    				'client_id'=>$data['client_id'],
    				'co_id'=>$data['co_id'],
    				'receiver_id'=>$this->getUserId(),
    				'date_pay'=>$data['collect_date'],
    				'date_input'=>date("Y-m-d"),
    				'capital'=>$data['priciple_amount'],
    				'remain_capital'=>$data['priciple_amount']-$data['os_amount'],
    				'principal_permonth'=>$data['priciple_amount'],
    				'total_interest'=>$data['total_interest'],
    				'penalize_amount'=>$data['penalize_amount'],
    				'total_fund'=>$data['total_payment'],
    				'service_charge'=>$data['service_charge'],
    				'recieve_amount'=>$data['amount_receive'],
    				'reuturn_amount'=>$data['amount_return'],
    				//'note'=>$data['total_interest'],
    				'user_id'=>$this->getUserId(),
    				//'is_complete'=>1,
    				//'is_verify'=>0,
    				//'verify_by'=>0,
    				//'is_closingentry'=>0,
    			);
    		$g_id = $this->insert($arr);//add group loan
    					
    		$db->commit();
    		return 1;
    	}catch (Exception $e){
    		$db->rollBack();
    	}
    }
    function getLoanPaymentByLoanNumber($data){
    	$db = $this->getAdapter();
    	$loan_number= $data['loan_number'];
    	if($data['type']!=2){
    		$where =($data['type']==1)?'loan_number = '.$loan_number:'client_id='.$loan_number;
    	    $sql=" SELECT *,
					(SELECT currency_type FROM `ln_loan_member` WHERE $where LIMIT 1  ) AS curr_type
    	     FROM `ln_loanmember_funddetail` WHERE member_id =
		    		(SELECT  member_id FROM `ln_loan_member` WHERE $where AND status=1 LIMIT 1)
		    		AND status = 1 ";
    	}elseif($data['type']==2){
    		$sql="SELECT * FROM `ln_loanmember_funddetail` WHERE status = 1 AND member_id = 
    		       ( SELECT member_id FROM `ln_loan_member` WHERE client_id =
    		       (SELECT client_id FROM `ln_client` WHERE client_number = ".$loan_number." LIMIT 1) LIMIT 1) ";
    	}
    	return $db->fetchAll($sql);
    }
  
}

