<?php
class Report_Model_DbTable_DbLoan extends Zend_Db_Table_Abstract
{
      public function getAllLoan($search = null){//rpt-loan-released/
      	 $db = $this->getAdapter();
    	 $sql="SELECT g.member_id,g.loan_number,
    	 (SELECT branch_namekh FROM ln_branch WHERE br_id=g.branch_id LIMIT 1) AS branch_name
    	 ,(SELECT name_kh FROM ln_client WHERE client_id=g.client_id LIMIT 1) AS client_id
    	 ,(SELECT name_en FROM ln_client WHERE client_id=g.client_id LIMIT 1) AS client_name,
    	 g.total_capital,g.interest_rate,
    	 (SELECT symbol FROM `ln_currency` WHERE id =g.currency_type) AS currency_type,
    	 g.currency_type AS curr_type
    	 ,(SELECT total_duration FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS total_duration
    	 ,(SELECT name_en FROM `ln_view` WHERE TYPE=14 AND key_code=(SELECT pay_term FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1)) AS pay_term
    	 ,(SELECT date_release FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS date_release
    	 ,(SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS co_name,
    	 (SELECT name_en FROM `ln_view` WHERE type = 14 AND key_code =lg.pay_term ) AS name_en
    	 ,g.admin_fee FROM `ln_loan_group` AS lg, ln_loan_member AS g WHERE lg.g_id = g.group_id AND g.status=1 ";
    	 $Other =" ORDER BY g.branch_id ,g.currency_type , g.member_id DESC";
    	 $where = '';
    	 if(!empty($search['txtsearch'])){
    	 	$s_where = array();
    	 	$s_search = $search['txtsearch'];
    	 	$s_where[] = " loan_number LIKE '%{$s_search}%'";
    	 	$s_where[]=" client_id LIKE '%{$s_search}%'";
    	 	$where .=' AND '.implode(' OR ',$s_where).'';
    	 
    	 }
      return $db->fetchAll($sql.$where.$Other);
      }
      public function getAllLoanCo($search = null){//rpt-loan-released
      	$db = $this->getAdapter();
      	$sql="SELECT g.member_id,g.loan_number
      	,(SELECT name_kh FROM ln_client WHERE client_id=g.client_id LIMIT 1) AS client_id
      	,(SELECT name_en FROM ln_client WHERE client_id=g.client_id LIMIT 1) AS client_name,
      	g.total_capital,
      	(SELECT symbol FROM `ln_currency` WHERE id =g.currency_type) AS currency_type,
      	g.currency_type AS curr_type
      	,(SELECT total_duration FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS total_duration
      	,(SELECT name_en FROM `ln_view` WHERE TYPE=14 AND key_code=(SELECT pay_term FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1)) AS pay_term
      	,(SELECT date_release FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS date_release
      	,(SELECT co_code FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS co_code
      	,(SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS co_name
      	,(SELECT co_firstname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS co_name_en
      	,(SELECT sex FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS sex
      	,(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS co_id
      	,(SELECT name_en FROM `ln_view` WHERE type = 14 AND key_code =lg.pay_term ) AS name_en
      	,g.admin_fee FROM `ln_loan_group` AS lg, ln_loan_member AS g WHERE lg.g_id = g.group_id AND g.status=1 ";
      	$Other =" ORDER BY co_id DESC ,g.branch_id ,g.currency_type , g.member_id DESC";
      	$where = '';
      	if(!empty($search['txtsearch'])){
      		$s_where = array();
      		$s_search = $search['txtsearch'];
      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
      		$s_where[]=" client_id LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';
      
      	}
      	return $db->fetchAll($sql.$where.$Other);
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
      public function getAllOutstadingLoan($search=null){//
//       	$sql = 'SELECT * FROM `ln_loanmember_funddetail` WHERE STATUS=1 AND is_completed=0 GROUP BY member_id ORDER BY id DESC ';
	      	$db = $this->getAdapter();//
	      	$sql="SELECT g.member_id,g.loan_number,
	      	(SELECT branch_namekh FROM ln_branch WHERE br_id=g.branch_id LIMIT 1) AS branch_name
	      	,CONCAT((SELECT name_kh FROM ln_client WHERE client_id=g.client_id LIMIT 1),'<br />',
	      	(SELECT name_en FROM ln_client WHERE client_id=g.client_id LIMIT 1)) AS client_name,
	      	g.total_capital,g.interest_rate,
	      	(SELECT symbol FROM `ln_currency` WHERE id =g.currency_type) AS currency_type,g.currency_type as curr_type,
	      	(SELECT SUM(total_payment) AS total_payment FROM `ln_client_receipt_money` WHERE loan_number =g.loan_number) AS total_payment
	      	,(SELECT total_duration FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS total_duration
	      	,(SELECT name_en FROM `ln_view` WHERE TYPE=14 AND key_code=(SELECT pay_term FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1)) AS pay_term
	      	,(SELECT date_release FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS date_release
	      	,(SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS co_name,
	      	(SELECT name_en FROM `ln_view` WHERE TYPE = 14 AND key_code =lg.pay_term ) AS name_en
	      	,g.admin_fee FROM `ln_loan_group` AS lg, ln_loan_member AS g WHERE lg.g_id = g.group_id AND g.status=1 AND is_completed=0 AND g.is_reschedule!=2 GROUP BY member_id ";//IF BAD LOAN STILL GET IT 
	      	$order =" ORDER BY g.currency_type ,g.branch_id , g.member_id DESC";
	      	$where = '';
	      	if(!empty($search['txtsearch'])){
	      		$s_where = array();
	      		$s_search = $search['txtsearch'];
	      		$s_where[] = " loan_number LIKE '%{$s_search}%'";
	      		$s_where[]=" client_id LIKE '%{$s_search}%'";
	      		$where .=' AND '.implode(' OR ',$s_where).'';
	      	
	      	}
	      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLGroupDisburse($search = null){
      	$db = $this->getAdapter();
      	$sql="SELECT member_id
		,chart_id,group_id,loan_number,client_id,payment_method
		,client_id,currency_type,admin_fee,SUM(total_capital) AS tastotal_capital ,collect_typeterm
		,interest_rate,is_completed,branch_id,loan_cycle,loan_purpose
		,pay_before,pay_after,graice_period,amount_collect_principal,show_barcode
		 FROM `ln_loan_member` WHERE 1";
      	$Other =" ORDER BY member_id ASC";
      	$where = '';
      	if(!empty($search['txtsearch'])){
      		$s_where = array();
      		$s_search = $search['txtsearch'];
      		$s_where[] = " chart_id LIKE '%{$s_search}%'";
      		$s_where[]=" group_id LIKE '%{$s_search}%'";
      		$where .=' AND '.implode(' OR ',$s_where).'';      		 
      	}
      	return $db->fetchAll($sql.$where.$Other);
      }
      public function getALLPayment(){
      	$db = $this->getAdapter();
      	$sql="select receipt_no,client_id,co_id,receiver_id,date_input,capital,remain_capital,
				principal_permonth,total_interest,penalize_amount,total_fund,service_charge,recieve_amount
				,reuturn_amount,note,is_complete,is_verify,verify_by,is_closingentry from ln_client_receipt_money";
      	return $db->fetchAll($sql);
      }
      public function getALLLoanlate($search = null){
      	$start_date = $search['start_date'];
     	//$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
      	$sql="SELECT mf.id,(SELECT co_khname FROM `ln_co` WHERE co_id=mf.member_id) AS name_kh,
			mf.total_principal,mf.principal_permonth,mf.total_interest,mf.total_payment, 
			(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=mf.branch_id) AS branch_name,m.`currency_type`,
			(SELECT symbol FROM `ln_currency` WHERE id =m.currency_type) AS currency_typeshow ,
			mf.date_payment, mf.amount_day,mf.is_approved FROM ln_loanmember_funddetail AS mf,`ln_loan_member` AS m
			WHERE mf.member_id = m.member_id AND mf.is_completed = 0 ";
      	$where='';
      	if(!empty($search['adv_search'])){
      		//print_r($search);
      		$s_where = array();
      		$s_search = $search['adv_search'];
      		$s_where[] = " mf.total_principal LIKE '%{$s_search}%'";
      		$s_where[] = " mf.`principal_permonth` LIKE '%{$s_search}%'";
      		$s_where[] = " mf.`total_payment` LIKE '%{$s_search}%'";
      		$s_where[] = " mf.`total_interest` LIKE '%{$s_search}%'";
      		$s_where[] = " mf.`date_payment` LIKE '%{$s_search}%'";
      		$s_where[] = " mf.`amount_day` LIKE '%{$s_search}%'";
      		$where .=' AND ('.implode(' OR ',$s_where).')';
      	}
      	if(($search['status']>0)){
    		$where.=" AND mf.status =".$search['status'];
    	}   	 
      	if(!empty($search['start_date'])){
      		$where.=" AND mf.date_payment < '$start_date'";
      	}
      	if($search['branch_id']>0){
      		$where.=" AND mf.branch_id = ".$search['branch_id'];
      	}
      	$order = " ORDER BY m.currency_type";
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
      public function getALLLoanTotalcollect(){
//       	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
//       	$sql="SELECT id,lfd_id,receipt_no,branch_id,loan_number,client_id,co_id,receiver_id
//       	,date_pay,date_input,capital,remain_capital,principal_permonth,total_interest
// 		,service_charge,recieve_amount,return_amount,note,user_id,is_complete,is_verify
//       	,verify_by,is_closingentry FROM `ln_client_receipt_money`";
		$sql='SELECT id,lfd_id,receipt_no,branch_id,loan_number,client_id,co_id,receiver_id
      	,date_pay,date_input,capital,remain_capital,principal_permonth,total_interest
		,service_charge,recieve_amount,note,user_id,is_complete,is_verify
      	,verify_by,is_closingentry FROM `ln_client_receipt_money`';
      	return $db->fetchAll($sql);
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
				FROM ln_loan_member AS m, `ln_loan_group` AS g WHERE m.group_id = g.g_id ";
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
    				(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=lcrm.`branch_id`) AS branch
				FROM `ln_client_receipt_money` AS lcrm WHERE lcrm.is_group=0 AND is_payoff= 1";
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
      public function getALLLoanExpectIncome($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      
      	$db = $this->getAdapter();
      	$sql = "SELECT f.id,f.`total_interest`,f.`status`,(SELECT b.`branch_namekh` FROM `ln_branch` AS b WHERE b.`br_id`=f.branch_id) AS branch,
				m.`currency_type`,(SELECT symbol FROM `ln_currency` WHERE id = m.currency_type) AS currency_typeshow,m.loan_number,
				(SELECT CONCAT(c.client_number,' - ',c.name_kh ,' - ',c.name_en) AS client_name FROM ln_client AS c WHERE c.`client_id` = m.client_id LIMIT 1) AS client_name,
				f.`date_payment` FROM `ln_loanmember_funddetail`AS f,`ln_loan_member` AS m WHERE f.`member_id` = m.`member_id`";
      	$where ='';
      	if(!empty($search['advance_search'])){
      		//print_r($search);
      		$s_where = array();
      		$s_search = $search['advance_search'];
      		$s_where[] = " f.total_interest LIKE '%{$s_search}%'";
      		$s_where[] = " f.date_payment LIKE '%{$s_search}%'";
      		$where .=' AND ('.implode(' OR ',$s_where).')';
      	}
      	if($search['status']!=""){
      		$where.= " AND f.status = ".$search['status'];
      	}
      
      	if(!empty($search['start_date']) or !empty($search['end_date'])){
      		$where.=" AND f.date_payment BETWEEN '$start_date' AND '$end_date'";
      	}
      	if($search['branch_id']>0){
      		$where.=" AND f.`branch_id`= ".$search['branch_id'];
      	}
      	//$where='';
      	$order = " ORDER BY m.currency_type";
      	//echo $sql.$where.$order;
      	return $db->fetchAll($sql.$where.$order);
      }
      public function getALLBadloan($search=null){
      	$start_date = $search['start_date'];
      	$end_date = $search['end_date'];
      
      	$db = $this->getAdapter();
    	
    	$sql = "SELECT l.id,b.branch_namekh,
    	CONCAT((SELECT client_number FROM `ln_client` WHERE client_id = l.client_code LIMIT 1),' - ',		
    	(SELECT name_en FROM `ln_client` WHERE client_id = l.client_code LIMIT 1)) AS client_name_en,
  		l.loss_date, l.`cash_type`,(SELECT c.symbol FROM `ln_currency` AS c WHERE c.status = 1 AND c.id = l.`cash_type`) AS currency_typeshow,
		l.total_amount ,l.intrest_amount ,CONCAT (l.tem,' Days')as tem,l.note,l.date,l.status FROM `ln_badloan` AS l,ln_branch AS b 
		WHERE b.br_id = l.branch";    	
    	$where='';
    	if(($search['status']>0)){
    		$where.=" AND l.status =".$search['status'];
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
 }

