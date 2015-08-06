<?php
class Report_Model_DbTable_DbLoan extends Zend_Db_Table_Abstract
{
      public function getAllLoan($search = null){//rpt-loan-released/
      	 $db = $this->getAdapter();
      	 $sql = "SELECT * FROM v_loanreleased WHERE 1";
      	 $where ='';
      
	    $from_date =(empty($search['start_date']))? '1': " date_release >= '".$search['start_date']." 00:00:00'";
	    $to_date = (empty($search['end_date']))? '1': " date_release <= '".$search['end_date']." 23:59:59'";
	    $where.= " AND ".$from_date." AND ".$to_date;

        if($search['branch_id']>0){
    		$where.=" AND branch_id = ".$search['branch_id'];
    	}
    	if($search['client_name']>0){
    		$where.=" AND client_id = ".$search['client_name'];
    	}
    	if($search['co_id']>0){
    		$where.=" AND co_id = ".$search['co_id'];
    	}
    	if($search['pay_every']>0){
    		$where.=" AND pay_term_id = ".$search['pay_every'];
    	}
      	 if(!empty($search['adv_search'])){
      	 	$s_where = array();
      	 	$s_search = trim($search['adv_search']);
      	 	$s_where[] = " branch_name LIKE '%{$s_search}%'";
      	 	$s_where[] = " loan_number LIKE '%{$s_search}%'";
      	 	$s_where[] = " client_number LIKE '%{$s_search}%'";
      	 	$s_where[] = " client_name LIKE '%{$s_search}%'";
      	 	$s_where[] = " co_name LIKE '%{$s_search}%'";
      	 	$s_where[] = " total_capital LIKE '%{$s_search}%'";
      	 	$s_where[] = " other_fee LIKE '%{$s_search}%'";
      	 	$s_where[] = " admin_fee LIKE '%{$s_search}%'";
      	 	$s_where[] = " interest_rate LIKE '%{$s_search}%'";
      	 	$s_where[] = " loan_type LIKE '%{$s_search}%'";
      	 	$where .=' AND '.implode(' OR ',$s_where).'';
      	 }
      	 return $db->fetchAll($sql.$where);
      }
      public function getAllLoanCo($search = null){//rpt-loan-released
      	$db = $this->getAdapter();

      	$sql = "SELECT * FROM v_released_co WHERE 1";
      	$where ='';
      	$from_date =(empty($search['start_date']))? '1': " date_release >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': " date_release <= '".$search['end_date']." 23:59:59'";
      	$where.= " AND ".$from_date." AND ".$to_date;
      	
      	if($search['branch_id']>0){
      		$where.=" AND branch_id = ".$search['branch_id'];
      	}
      	if($search['member']>0){
      		$where.=" AND client_id = ".$search['member'];
      	}
      	if($search['co_id']>0){
      		$where.=" AND co_id = ".$search['co_id'];
      	}
      	if($search['pay_every']>0){
      		$where.=" AND pay_term_id = ".$search['pay_every'];
      	}
      	if(!empty($search['adv_search'])){
      		$s_where = array();
      		$s_search = trim($search['adv_search']);
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      		$s_where[] = " total_capital LIKE '%{$s_search}%'";
      		$s_where[] = " other_fee LIKE '%{$s_search}%'";
      		$s_where[] = " admin_fee LIKE '%{$s_search}%'";
      		$s_where[] = " admin_fee LIKE '%{total_duration}%'";
      		$s_where[] = " interest_rate LIKE '%{$s_search}%'";
      		$s_where[] = " loan_type LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	}
      	return $db->fetchAll($sql.$where);
      }
      public function getAllOutstadingLoan($search=null){
      	$db = $this->getAdapter();

      	$where="";
      	$to_date = (empty($search['end_date']))? '1': " date_release <= '".$search['end_date']." 23:59:59'";
      	$where.= "  AND ".$to_date;

      	$sql="SELECT * FROM v_loanoutstanding WHERE 1 ";//IF BAD LOAN STILL GET IT
      	if($search['branch_id']>0){
      		$where.=" AND br_id = ".$search['branch_id'];
      	}
      	if($search['member']>0){
           		$where.=" AND client_id = ".$search['member'];
      	}
      	if($search['co_id']>0){
      		$where.=" AND co_id = ".$search['co_id'];
      	}
      	if(!empty($search['adv_search'])){
      		$s_where = array();
      		$s_search = trim($search['adv_search']);
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_kh LIKE '%{$s_search}%'";
      		$s_where[] = " co_name LIKE '%{$s_search}%'";
      		$s_where[] = " total_capital LIKE '%{$s_search}%'";
      		$s_where[] = " total_duration LIKE '%{$s_search}%'";
      		$s_where[] = " loan_type LIKE '%{$s_search}%'";
      		$s_where[] = " total_payment LIKE '%{$s_search}%'";
      	   $where .=' AND '.implode(' OR ',$s_where).'';
      	}
      	echo $sql.$where;
      	return $db->fetchAll($sql.$where);
      }
      
      public function getALLLoancollect($search = null){
      	$db = $this->getAdapter();
//       	$sql="SELECT id,
//       	(SELECT loan_number FROM ln_loan_member WHERE loan_number=(SELECT lm.loan_number FROM ln_loan_member AS lm  WHERE lm.member_id LIMIT 1) LIMIT 1 ) AS loan_number,
//       	(SELECT name_kh FROM ln_client WHERE client_id = (SELECT lm.client_id FROM ln_loan_member AS lm  WHERE lm.member_id LIMIT 1) LIMIT 1 ) AS client_name
//       	,(SELECT branch_namekh FROM ln_branch WHERE br_id= branch_id LIMIT 1) AS branch_id,
//       	(SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id=(SELECT lm.client_id FROM ln_loan_member AS lm  WHERE lm.member_id LIMIT 1) LIMIT 1 )LIMIT 1 ) AS co,
//       	total_principal,total_interest,STATUS
//       	,total_payment,date_payment FROM ln_loanmember_funddetail WHERE 1 ";
      	
      	$from_date =(empty($search['start_date']))? '1': "f.date_payment >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': "f.date_payment <= '".$search['end_date']." 23:59:59'";
      	$where = " AND ".$from_date." AND ".$to_date;
      	
      	$Other =" ORDER BY co_name ,id DESC ";
      	$sql = " SELECT 
				  f.id ,
				  f.total_principal ,
				  f.total_interest ,
				  f.status ,
				  f.total_payment ,
				  f.date_payment ,
				  m.loan_number ,  
				  (SELECT name_kh FROM ln_client WHERE client_id=m.client_id) AS client_name , 
				  (SELECT branch_namekh FROM ln_branch WHERE br_id= m.branch_id LIMIT 1) AS branch_id ,
				  (SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id= m.group_id LIMIT 1) LIMIT 1) AS co,
				  (SELECT co_firstname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id= m.group_id LIMIT 1) LIMIT 1) AS co_name
				  FROM `ln_loanmember_funddetail` AS f ,`ln_loan_member` AS m WHERE m.member_id = f.member_id 
				  AND f.is_completed=0 AND f.status=1 AND m.is_completed=0 ";
      	if(!empty($search['txtsearch'])){
      		$s_where = array();
      		$s_search = $search['txtsearch'];
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[]=" client_name LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	
      	}
      	echo $sql.$where.$Other;
      	return $db->fetchAll($sql.$where.$Other);
      }
     
      public function getALLGroupDisburse($id=null){
      	$db = $this->getAdapter();
      	$sql="SELECT *  
				FROM
				`v_loangroupmember` WHERE `group_id`= $id";
      	
      	//$Other =" ORDER BY member_id ASC";
//       	$where = '';
//       	if(!empty($search['txtsearch'])){
//       		$s_where = array();
//       		$s_search = $search['txtsearch'];
//       		$s_where[] = " chart_id LIKE '%{$s_search}%'";
//       		$s_where[]=" group_id LIKE '%{$s_search}%'";
//       		$where .=' AND '.implode(' OR ',$s_where).'';      		 
      //	}
      	return $db->fetchAll($sql);
      }
      public function getALLPayment(){
      	$db = $this->getAdapter();
      	$sql="select * from ln_client_receipt_money";
      	return $db->fetchAll($sql);
      }
      public function getALLLoanlate($search = null){
      	//$start_date = $search['start_date'];
   		$end_date = $search['end_date'];
     	//$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
      	$sql="SELECT * FROM `v_getloanlates` WHERE 1";
      	$where='';
      	if(!empty($search['adv_search'])){
      		//print_r($search);
      		$s_where = array();
      		$s_search = $search['adv_search'];
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " name_kh LIKE '%{$s_search}%'";
      		$s_where[] = " total_principal LIKE '%{$s_search}%'";
      		$s_where[] = " principal_permonth LIKE '%{$s_search}%'";
      		$s_where[] = " total_payment LIKE '%{$s_search}%'";
      		$s_where[] = " total_interest LIKE '%{$s_search}%'";
      		$where .=' AND ('.implode(' OR ',$s_where).')';
      	}
      	if(($search['status']>0)){
    		$where.=" AND status =".$search['status'];
    	}   	 
      	if(!empty($search['end_date'])){
			$where.=" AND date_payment < '$end_date'";
		}
      	if($search['branch_id']>0){
      		$where.=" AND branch_id = ".$search['branch_id'];
      	}
      	$order = " ORDER BY currency_type ,date_payment ASC ";
      	//echo $sql.$where.$order;
      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLLoandateline(){
      	//$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
//       	$sql="select g.level,(select first_name from rms_users where id=g.group_id) as first_name,(select last_name from rms_users where id=g.co_id)as last_name
// 		,g.zone_id,g.date_release,g.date_line,g.create_date,g.total_duration,g.first_payment,g.time_collect
// 		,g.collect_typeterm,g.pay_term,g.payment_method,g.holiday,g.is_renew,g.branch_id,g.loan_type,g.status,g.is_verify,g.is_badloan,g.teller_id
// 		,m.chart_id,m.member_id,m.loan_number,m.currency_type,m.total_capital,m.admin_fee,m.interest_rate,m.loan_cycle,m.loan_purpose,m.pay_before
// 		,m.pay_after,m.graice_period,m.amount_collect_principal,m.show_barcode,m.is_completed,m.semi from ln_loan_group as g,ln_loan_member as m where m.group_id = g.g_id";
      	$sql="SELECT g.level,(SELECT first_name FROM rms_users WHERE id=g.group_id) AS first_name,(SELECT last_name FROM rms_users WHERE id=g.co_id)AS last_name
		,g.zone_id,g.date_release,g.`date_release` AS date_line,g.create_date,g.total_duration,g.first_payment,g.time_collect
		,g.collect_typeterm,g.pay_term,g.payment_method,g.holiday,g.is_renew,g.branch_id,g.loan_type,g.status,g.is_verify,g.is_badloan,g.teller_id
		,m.chart_id,m.member_id,m.loan_number,m.currency_type,m.total_capital,m.admin_fee,m.interest_rate,m.loan_cycle,m.loan_purpose,m.pay_before
		,m.pay_after,m.graice_period,m.amount_collect_principal,m.show_barcode,m.is_completed FROM ln_loan_group AS g,ln_loan_member AS m WHERE m.group_id = g.g_id";
      	return $db->fetchAll($sql);
      }
      public function getALLLoanTotalcollect($search=null){
//       	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
       	$db = $this->getAdapter();
        $start_date = $search['start_date'];
   		$end_date = $search['end_date'];
		$sql="SELECT * FROM v_getcollect WHERE is_completed = 0 ";
		$where ='';		
		if(!empty($search['start_date']) or !empty($search['end_date'])){
			$where.=" AND date_payment BETWEEN '$start_date' AND '$end_date'";
		}
		if($search['branch_id']>0){
			$where.=" AND branch_id= ".$search['branch_id'];
		}
		if($search['client_name']>0){
			$where.=" AND client_id = ".$search['client_name'];
		}
        if($search['co_id']>0){
			$where.=" AND collect_by = ".$search['co_id'];
		}
		if(!empty($search['adv_search'])){
			//print_r($search);
			$s_where = array();
			$s_search = $search['adv_search'];
			$s_where[] = " branch_name LIKE '%{$s_search}%'";
			$s_where[] = " client_name LIKE '%{$s_search}%'";
			$s_where[] = " co_name LIKE '%{$s_search}%'";
			$s_where[] = " total_principal LIKE '%{$s_search}%'";
			$s_where[] = " principal_permonth LIKE '%{$s_search}%'";
			$s_where[] = " total_interest LIKE '%{$s_search}%'";
			$s_where[] = " total_payment LIKE '%{$s_search}%'";
			$s_where[] = " amount_day LIKE '%{$s_search}%'";
			$where .=' AND ('.implode(' OR ',$s_where).')';
		}
		$order=" ORDER BY currency_type DESC ";
		//echo $sql.$where;
		return $db->fetchAll($sql.$where.$order);
      }
      public function getALLLoanPayment($search=null){
      	$db = $this->getAdapter();
      	$sql="SELECT * FROM v_getcollectmoney WHERE 1 ";
      	$from_date =(empty($search['start_date']))? '1': " date_input >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': " date_input <= '".$search['end_date']." 23:59:59'";
      	$where = " AND ".$from_date." AND ".$to_date;
      	
      	if($search['branch_id']>0){
      		$where.=" AND branch_id= ".$search['branch_id'];
      	}
      	if($search['client_name']>0){
      		$where.=" AND client_id = ".$search['client_name'];
      	} 
       	if($search['co_id']>0){
       		$where.=" AND co_id = ".$search['co_id'];
       	}
      	if(!empty($search['adv_search'])){
      		$s_where = array();
      		$s_search = trim($search['adv_search']);
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      		$s_where[] = " co_name LIKE '%{$s_search}%'";
      		$s_where[] = " total_principal_permonth LIKE '%{$s_search}%'";
      		$s_where[] = " total_interest LIKE '%{$s_search}%'";
      		$s_where[] = " amount_payment LIKE '%{$s_search}%'";
      		$s_where[] = " penalize_amount LIKE '%{$s_search}%'";
      		$s_where[] = " service_charge LIKE '%{$s_search}%'";      		
      		$s_where[] = " receipt_no LIKE '%{$s_search}%'";
      		$s_where[] = " receipt_no LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	}
      	$order=" ORDER BY currency_type ASC ,id DESC ";
      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLLoanIcome($search=null){
		$start_date = $search['start_date'];
    	$end_date = $search['end_date'];
    	
    	$db = $this->getAdapter();
    	$sql = "SELECT lcrm.`id`,
					lcrm.`receipt_no`,
					lcrm.`loan_number`,lcrm.service_charge,
					(SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=lcrm.`group_id`) AS team_group ,
					lcrm.`total_principal_permonth`,
					lcrm.`total_payment`,
    			  (SELECT symbol FROM `ln_currency` WHERE id =lcrm.currency_type) AS currency_typeshow ,lcrm.currency_type,
					lcrm.`recieve_amount`,
					lcrm.`total_interest`,lcrm.amount_payment,
					lcrm.`penalize_amount`,
					lcrm.`date_pay`,
					lcrm.`date_input`,
				    (SELECT co.`co_khname` FROM `ln_co` AS co WHERE co.`co_id`=lcrm.`co_id`) AS co_name,
    				(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=lcrm.`branch_id`) AS branch
				FROM `ln_client_receipt_money` AS lcrm WHERE lcrm.is_group=0 AND lcrm.`status`=1";
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
    	$order = " ORDER BY lcrm.currency_type";
    	//echo $sql.$where.$order;
    	return $db->fetchAll($sql.$where.$order);
      }
      
      public function getALLLoanCollectionco($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      	 
      	$db = $this->getAdapter();
      	$sql = "SELECT lcrm.`id`,
					lcrm.`receipt_no`,
					lcrm.`loan_number`,
					(SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=lcrm.`group_id`) AS team_group ,
					lcrm.`total_principal_permonth`,
					lcrm.`total_payment`,
    			  (SELECT symbol FROM `ln_currency` WHERE id =lcrm.currency_type) AS currency_typeshow ,lcrm.currency_type,
					lcrm.`recieve_amount`,
					lcrm.`total_interest`,lcrm.amount_payment,
					lcrm.`penalize_amount`,lcrm.service_charge,
					lcrm.`date_pay`,
					lcrm.`date_input`,
				    (SELECT co.`co_khname` FROM `ln_co` AS co WHERE co.`co_id`=lcrm.`co_id`) AS co_name,
      				(SELECT co.`co_id` FROM `ln_co` AS co WHERE co.`co_id`=lcrm.`co_id`) AS co_id,
    				(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=lcrm.`branch_id`) AS branch
				FROM `ln_client_receipt_money` AS lcrm WHERE lcrm.is_group=0";
      	$where ='';
      	if(!empty($search['advance_search'])){
      		//print_r($search);
      		$s_where = array();
      		$s_search = $search['advance_search'];
      		$s_where[] = "lcrm.`loan_number` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`receipt_no` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`total_payment` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`total_interest` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`penalize_amount` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`service_charge` LIKE '%{$s_search}%'";
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
      	if($search['paymnet_type']>0){
      		$where.=" AND lcrm.`payment_option`= ".$search['paymnet_type'];
      	}
      	 
      	//$where='';
      	$order = " ORDER BY lcrm.currency_type";
      	//echo $sql.$where.$order;
      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLLFee($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      	 
      	$db = $this->getAdapter();
      	$sql = "SELECT m.member_id,(SELECT branch_namekh FROM ln_branch WHERE br_id = m.branch_id LIMIT 1) AS branch,
				m.loan_number,m.admin_fee,m.other_fee,m.currency_type,(SELECT symbol FROM `ln_currency` WHERE id =m.currency_type) AS currency_typeshow,
				g.date_release
				FROM ln_loan_member AS m, `ln_loan_group` AS g WHERE m.group_id = g.g_id AND m.`status`=1";
		$where ='';
      	if(!empty($search['advance_search'])){
      		//print_r($search);
      		$s_where = array();
      		$s_search = $search['advance_search'];
      		$s_where[] = "m.loan_number LIKE '%{$s_search}%'";
      		$s_where[] = "m.admin_fee LIKE '%{$s_search}%'";
      		$s_where[] = "m.other_fee LIKE '%{$s_search}%'";
      		$where .=' AND ('.implode(' OR ',$s_where).')';
      	}
      	if($search['branch_id']>0){
      		$where.=" AND m.`branch_id`= ".$search['branch_id'];
      	}
      	if($search['status']!=""){
      		$where.= " AND m.status = ".$search['status'];
      	}
      	if(!empty($search['start_date']) or !empty($search['end_date'])){
      		$where.=" AND g.date_release BETWEEN '$start_date' AND '$end_date'";
      	}
      	//$where='';
      	$order = " ORDER BY currency_type";
      	//echo $sql.$where.$order;
      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLLoanPayoff($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      
      	$db = $this->getAdapter();
      	$sql = " SELECT * FROM v_getloanpayoff WHERE 1 ";
//       	$sql = "SELECT lcrm.`id`,
// 					lcrm.`receipt_no`,
// 					lcrm.`loan_number`,
// 					(SELECT c.`name_kh` FROM `ln_client` AS c WHERE c.`client_id`=lcrm.`group_id`) AS team_group ,
// 					lcrm.`total_principal_permonth`,
// 					lcrm.`total_payment`,
//     			  (SELECT symbol FROM `ln_currency` WHERE id =lcrm.currency_type) AS currency_typeshow ,lcrm.currency_type,
// 					lcrm.`recieve_amount`,
// 					lcrm.`total_interest`,lcrm.amount_payment,
// 					lcrm.`penalize_amount`,lcrm.service_charge,
// 					lcrm.`date_pay`,
// 					lcrm.`date_input`,
// 				    (SELECT co.`co_khname` FROM `ln_co` AS co WHERE co.`co_id`=lcrm.`co_id`) AS co_name,
//     				(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=lcrm.`branch_id`) AS branch
// 				FROM `ln_client_receipt_money` AS lcrm WHERE lcrm.is_group=0 AND is_payoff= 1";
      	$where ='';
      	if(!empty($search['advance_search'])){

      		$s_where = array();
      		$s_search = $search['advance_search'];
      		$s_where[] = "lcrm.`loan_number` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`receipt_no` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`total_payment` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`total_interest` LIKE '%{$s_search}%'";
      		$s_where[] = " lcrm.`penalize_amount` LIKE '%{$s_search}%'";
      		$where .=' AND ('.implode(' OR ',$s_where).')';
      	}
      	if($search['status']!=""){
      		$where.= " AND status = ".$search['status'];
      	}
      
//       	if(!empty($search['start_date']) or !empty($search['end_date'])){
//       		$where.=" AND lcrm.`date_input` BETWEEN '$start_date' AND '$end_date'";
//       	}
      	if($search['client_name']>0){
      		$where.=" AND lcrm.`group_id`= ".$search['client_name'];
      	}
      	if($search['branch_id']>0){
      		$where.=" AND lcrm.`branch_id`= ".$search['branch_id'];
      	}
      	if($search['co_id']>0){
      		$where.=" AND lcrm.`co_id`= ".$search['co_id'];
      	}
//       	if($search['paymnet_type']>0){
//       		$where.=" AND lcrm.`payment_option`= ".$search['paymnet_type'];
//       	}
      
      	//$where='';
      	$order = " ORDER BY currency_type";
      	echo $sql.$where.$order;
      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLLoanExpectIncome($search=null){
      	$from_date =(empty($search['start_date']))? '1': " date_payment >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': " date_payment <= '".$search['end_date']." 23:59:59'";
      	$where= " AND ".$from_date." AND ".$to_date;
      	
      	$db = $this->getAdapter();
      	$sql = "SELECT *,SUM(total_capital) AS total_capital ,SUM(principle_permonth) AS principle_permonth
      	 ,SUM(total_interest) AS total_interest  FROM `v_getexpectincome` WHERE 1";
      	if(!empty($search['advance_search'])){
      		$s_where = array();
      		$s_search = trim($search['advance_search']);
      		
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      		$s_where[] = " total_capital LIKE '%{$s_search}%'";
      		$s_where[] = " interest_rate LIKE '%{$s_search}%'";
      		$s_where[] = " total_duration LIKE '%{$s_search}%'";
      		$s_where[] = " principle_permonth LIKE '%{$s_search}%'";
      		$s_where[] = " total_interest LIKE '%{$s_search}%'";
      		
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	}
      	if($search['status']!=""){
      		$where.= " AND status = ".$search['status'];
      	}
      	if($search['branch_id']>0){
      		$where.=" AND branch_id = ".$search['branch_id'];
      	}
      	$group_by = " GROUP BY group_id ,date_payment ORDER BY currency_type ASC, date_payment ASC ";
      	return $db->fetchAll($sql.$where.$group_by);
      }
      public function getALLBadloan($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      
      	$db = $this->getAdapter();
    	
    	$sql = "SELECT l.id,number_code,b.branch_namekh,
    	CONCAT((SELECT client_number FROM `ln_client` WHERE client_id = l.client_code LIMIT 1),' - ',		
    	(SELECT name_en FROM `ln_client` WHERE client_id = l.client_code LIMIT 1)) AS client_name_en,
  		l.loss_date, l.`cash_type`,(SELECT c.symbol FROM `ln_currency` AS c WHERE c.status = 1 AND c.id = l.`cash_type`) AS currency_typeshow,
		l.total_amount ,l.intrest_amount ,CONCAT (l.tem,' Days')as tem,l.note,l.date,l.status FROM `ln_badloan` AS l,ln_branch AS b 
		WHERE b.br_id = l.branch AND l.is_writoff= 0";    	
    	$where='';
    	if(($search['status']>0)){
    		$where.=" AND l.status =".$search['status'];
    	}
    	if(!empty($search['start_date']) or !empty($search['end_date'])){
    		$where.=" AND l.date BETWEEN '$start_date' AND '$end_date'";
    	}
    	if(!empty($search['branch'])){
    		$where.=" AND b.br_id = ".$search['branch'];
    	}
    	if(!empty($search['client_name'])){
    		$where.=" AND l.client_code = ".$search['client_name'];
    	}
    	if(!empty($search['client_code'])){
    		$where.=" AND l.client_code = ".$search['client_code'];
    	}
    	if(!empty($search['Term'])){
    		$where.=" AND l.tem = ".$search['Term'];
    	}
    	if(!empty($search['cash_type'])){
    		$where.=" AND l.`cash_type` = ".$search['cash_type'];
    	}
    	if(!empty($search['adv_search'])){
    		$s_where=array();
    		$s_search=$search['adv_search'];
    		$s_where[]=" l.note LIKE '%{$s_search}%'";
    		$s_where[]=" total_amount LIKE '%{$s_search}%'";
    		$s_where[]=" intrest_amount LIKE '%{$s_search}%'";
    		$s_where[]=" l.tem = '{$s_search}' ";
    		$where .=' AND ('.implode(' OR ',$s_where).' )';
    	}
    	$order = ' ORDER BY l.`cash_type` ';
//     	echo $sql.$where;
    	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLWritoff($search=null){
      	
      	$db = $this->getAdapter();
      	 $sql = " 	SELECT * FROM  v_badloan WHERE 1 ";
//       	$sql = " SELECT l.id,b.branch_namekh,
// 			    	CONCAT((SELECT client_number FROM `ln_client` WHERE client_id = l.client_code LIMIT 1),' - ',
// 			    	(SELECT name_en FROM `ln_client` WHERE client_id = l.client_code LIMIT 1)) AS client_name_en,
// 			  		l.loss_date, l.`cash_type`,(SELECT c.symbol FROM `ln_currency` AS c WHERE c.status = 1 AND c.id = l.`cash_type`) AS currency_typeshow,
// 					l.total_amount ,l.intrest_amount ,CONCAT (l.tem,' Days')as tem,l.note,l.date,l.status 
// 		   FROM `ln_badloan` AS l,ln_branch AS b
// 		WHERE b.br_id = l.branch AND l.is_writoff = 1 ";
      	$where='';
      	$from_date =(empty($search['start_date']))? '1': " payof_date >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': " payof_date <= '".$search['end_date']." 23:59:59'";
      	
      	$where.= " AND ".$from_date." AND ".$to_date;

      	if(!empty($search['branch'])){
      		$where.=" AND br_id = ".$search['branch'];
      	}
      	if(!empty($search['client_name'])){
      		$where.=" AND client_code = ".$search['client_name'];
      	}
      	if(!empty($search['client_code'])){
      		$where.=" AND client_code = ".$search['client_code'];
      	}
      	if(!empty($search['Term'])){
      		$where.=" AND tem = ".$search['Term'];
      	}
      	if(!empty($search['cash_type'])){
      		$where.=" AND `curr_type` = ".$search['cash_type'];
      	}
      	if(!empty($search['adv_search'])){
      		$s_where=array();
      		$s_search=trim($search['adv_search']);
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      		$s_where[] = " co_name LIKE '%{$s_search}%'";
      		$s_where[] = " total_capital LIKE '%{$s_search}%'";
      		$s_where[] = " other_fee LIKE '%{$s_search}%'";
      		$s_where[] = " admin_fee LIKE '%{$s_search}%'";
      		$s_where[] = " interest_rate LIKE '%{$s_search}%'";
      		$s_where[] = " loan_type LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      		
      		$where .=' AND ('.implode(' OR ',$s_where).' )';
      	}
//       	$order = ' ORDER BY `cash_type` ';
echo $sql.$where;
      	return $db->fetchAll($sql.$where);
      }
      public function getAllxchange($search = null){
      	$db = $this->getAdapter();
      	$sql = "SELECT * FROM `v_xchange` WHERE 1";
      	$where ='';
      	$from_date =(empty($search['start_date']))? '1': "statusDate >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': "statusDate <= '".$search['end_date']." 23:59:59'";
      	$where.= " AND ".$from_date." AND ".$to_date;
      	
//       	if($search['branch_id']>0){
//       		$where.=" AND branch_id = ".$search['branch_id'];
//       	}
//       	if($search['client_name']>0){
//       		$where.=" AND client_id = ".$search['client_name'];
//       	}
      	if(!empty($search['adv_search'])){
      		$s_where = array();
      		$s_search = $search['adv_search'];
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      		$s_where[] = " changedAmount LIKE '%{$s_search}%'";
      		$s_where[]=" fromAmount LIKE '%{$s_search}%'";
      		$s_where[] = " rate LIKE '%{$s_search}%'";
      		$s_where[]=" recieptNo LIKE '%{$s_search}%'";
      		$s_where[] = " recievedAmount LIKE '%{$s_search}%'";
      		$s_where[]=" status_in LIKE '%{$s_search}%'";
      		$s_where[] = " statusDate LIKE '%{$s_search}%'";
      		$s_where[]=" toAmount LIKE '%{$s_search}%'";
      		$s_where[]=" toAmountType LIKE '%{$s_search}%'";
      		$s_where[]=" fromAmountType LIKE '%{$s_search}%'";
      		$s_where[]=" from_to LIKE '%{$s_search}%'";
      		$s_where[]=" recievedType LIKE '%{$s_search}%'";
      		$s_where[]=" specail_customer LIKE '%{$s_search}%'";
      		
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	
      	}
      	$order=" ORDER BY id DESC";
//       	echo $sql.$where;
      	return $db->fetchAll($sql.$where.$order);
      	
      } 
      public function getRescheduleLoan($search = null){//rpt-loan-released/
      	$db = $this->getAdapter();
      	$sql = "SELECT * FROM v_rescheduleloan WHERE 1";
      	$where ='';
      
      	$from_date =(empty($search['start_date']))? '1': " reschedule_date >= '".$search['start_date']." 00:00:00'";
      	$to_date = (empty($search['end_date']))? '1': " reschedule_date <= '".$search['end_date']." 23:59:59'";
      	$where.= " AND ".$from_date." AND ".$to_date;
      
      	if($search['branch_id']>0){
      		$where.=" AND branch_id = ".$search['branch_id'];
      	}
      	if($search['client_name']>0){
      		$where.=" AND client_id = ".$search['client_name'];
      	}
      	
      	if($search['pay_every']>0){
      		$where.=" AND pay_term_id = ".$search['pay_every'];
      	}
      	if(!empty($search['adv_search'])){
      		$s_where = array();
      		$s_search = trim($search['adv_search']);
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		$s_where[] = " re_loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      		
      		$s_where[] = " total_capital LIKE '%{$s_search}%'";
      		$s_where[] = " re_amount LIKE '%{$s_search}%'";
      		$s_where[] = " re_interest_rate LIKE '%{$s_search}%'";
      		
      		$s_where[] = " loan_type LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	}
      	echo $sql.$where;
      	return $db->fetchAll($sql.$where);
      }
      public function getAllLoanByCo($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      	$db = $this->getAdapter();
      	$sql = "SELECT v.*,
				  CONCAT(c.`co_code`,',',c.`co_khname`,'-',c.`co_firstname`,' ',c.`co_lastname`) AS co_name ,
				  (SELECT `crm`.`date_input` FROM (`ln_client_receipt_money` `crm` JOIN `ln_client_receipt_money_detail` `crmd`) WHERE ((`crm`.`loan_number` = v.`loan_number`)
				          AND (`crm`.`id` = `crmd`.`crm_id`) AND (`crmd`.`lfd_id` = f.`id`)) ORDER BY `crm`.`date_input` DESC LIMIT 1) AS `last_pay_date`,
				    f.`total_principal`,
				    f.`principle_after`,
				    f.`total_interest_after`,
      				f.`total_payment_after`,
				    f.`penelize`,
				    f.`service_charge`,
				    f.`date_payment`
				FROM
				  v_default AS v,
				  `ln_co` AS c,
				  `ln_loanmember_funddetail` AS f
				WHERE v.`co_id` = c.`co_id` 
				  AND f.`member_id`=v.`member_id`
				  AND f.`is_completed`=0
				  ";
      	$where ='';
      	$group_by=" GROUP BY f.`member_id`";
      	
      	//$from_date =(empty($search['start_date']))? '1': " reschedule_date >= '".$search['start_date']." 00:00:00'";
      	//$to_date = (empty($search['end_date']))? '1': " reschedule_date <= '".$search['end_date']." 23:59:59'";
      	//$where.= " AND ".$from_date." AND ".$to_date;
      	
      if(!empty($search['start_date']) or !empty($search['end_date'])){
      		$where.=" AND f.`date_payment` BETWEEN '$start_date' AND '$end_date'";
      	}
      	if($search['client_name']>0){
      		$where.=" AND lcrm.`group_id`= ".$search['client_name'];
      	}
      	if($search['branch_id']>0){
      		$where.=" AND v.`branch_id`= ".$search['branch_id'];
      	}
      	if($search['co_id']>0){
      		$where.=" AND c.`co_id` = ".$search['co_id'];
      	}
      	if($search['paymnet_type']>0){
      		$where.=" AND lcrm.`payment_option`= ".$search['paymnet_type'];
      	}
      	if(!empty($search['adv_search'])){
      		$s_where = array();
      		$s_search = trim($search['adv_search']);
      		$s_where[] = " branch_name LIKE '%{$s_search}%'";
      		//$s_where[] = " re_loan_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_number LIKE '%{$s_search}%'";
      		$s_where[] = " client_name LIKE '%{$s_search}%'";
      	
      		$s_where[] = " total_capital LIKE '%{$s_search}%'";
      		$s_where[] = " re_amount LIKE '%{$s_search}%'";
      		//$s_where[] = " re_interest_rate LIKE '%{$s_search}%'";
      	
      		$s_where[] = " loan_type LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      	}
      	echo $sql.$where.$group_by;
      	return $db->fetchAll($sql.$where.$group_by);
      }
 }

