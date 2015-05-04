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
     	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
      	$sql="select id,(SELECT co_khname FROM `ln_co` WHERE co_id=member_id) AS name_kh,total_principal,principal_permonth,total_interest,total_payment,
      	amount_day,is_approved,branch_id from ln_loanmember_funddetail WHERE status=1 AND is_completed=0 AND $to_date";
      	return $db->fetchAll($sql);
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
      public function getALLLoanCollectionco(){
//       	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
//       	$db = $this->getAdapter();
      	//       	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
      	$sql="SELECT id,(SELECT m.client_id FROM `ln_loan_member` AS m WHERE m.member_id=member_id LIMIT 1) AS Client_id
		,(SELECT l.co_id FROM `ln_loan_group` AS l  WHERE l.branch_id=branch_id LIMIT 1)AS co_id
		,total_principal,principal_permonth,total_interest,total_payment,amount_day
		,STATUS,is_completed,is_approved,date_payment FROM `ln_loanmember_funddetail`";
      	return $db->fetchAll($sql);
      }
 }

