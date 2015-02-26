<?php
class Report_Model_DbTable_DbLoan extends Zend_Db_Table_Abstract
{
      public function getAllLoan(){
      	 $db = $this->getAdapter();
    	 $sql="SELECT g.member_id,g.loan_number
    	 ,(SELECT name_kh FROM ln_client WHERE client_id=g.client_id LIMIT 1) AS client_id,
    	 g.total_capital,g.interest_rate
    	 ,(SELECT total_duration FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS total_duration
    	 ,(SELECT name_en FROM `ln_view` WHERE TYPE=14 AND key_code=(SELECT pay_term FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1)) AS pay_term
    	 ,(SELECT date_release FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1) AS date_release
    	 ,(SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id = g.group_id LIMIT 1))AS co_name,
    	 g.loan_purpose
    	 ,g.admin_fee FROM ln_loan_member AS g";
      return $db->fetchAll($sql);
      }
      public function getALLLoancollect(){
      	$db = $this->getAdapter();
      	$sql="SELECT id,
      	(SELECT loan_number FROM ln_loan_member WHERE loan_number=(SELECT lm.loan_number FROM ln_loan_member AS lm  WHERE lm.member_id LIMIT 1) LIMIT 1 ) AS loan_number,
      	(SELECT name_kh FROM ln_client WHERE client_id = (SELECT lm.client_id FROM ln_loan_member AS lm  WHERE lm.member_id LIMIT 1) LIMIT 1 ) AS client_name
      	,(SELECT branch_namekh FROM ln_branch WHERE br_id= branch_id LIMIT 1) AS branch_id,
      	(SELECT co_khname FROM ln_co WHERE co_id=(SELECT co_id FROM ln_loan_group WHERE g_id=(SELECT lm.client_id FROM ln_loan_member AS lm  WHERE lm.member_id LIMIT 1) LIMIT 1 )LIMIT 1 ) AS co,
      	total_principal,total_interest,STATUS
      	,total_payment,date_payment FROM ln_loanmember_funddetail ORDER BY member_id";
      	
      	return $db->fetchAll($sql);
      }
      public function getALLGroupDisburse(){
      	$db = $this->getAdapter();
      	$sql="SELECT member_id
		,chart_id,group_id,loan_number,client_id,payment_method
		,client_id,currency_type,admin_fee,SUM(total_capital) AS tastotal_capital ,collect_typeterm
		,interest_rate,is_completed,branch_id,loan_cycle,loan_purpose
		,pay_before,pay_after,graice_period,amount_collect_principal,show_barcode
		 FROM `ln_loan_member`";
      	 
      	return $db->fetchAll($sql);
      }
      public function getALLPayment(){
      	$db = $this->getAdapter();
      	$sql="select receipt_no,client_id,co_id,receiver_id,date_input,capital,remain_capital,
				principal_permonth,total_interest,penalize_amount,total_fund,service_charge,recieve_amount
				,reuturn_amount,note,is_complete,is_verify,verify_by,is_closingentry from ln_client_receipt_money";
      	return $db->fetchAll($sql);
      }
      public function getALLLoanlate($search){
     	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
      	$sql="select id,(SELECT co_khname FROM `ln_co` WHERE co_id=member_id) AS name_kh,total_principal,principal_permonth,total_interest,total_payment,
      	amount_day,is_approved,branch_id from ln_loanmember_funddetail WHERE status=1 AND is_completed=0 AND $to_date";
      	return $db->fetchAll($sql);
      }
      public function getALLLoandateline(){
      	//$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
      	$db = $this->getAdapter();
      	$sql="select g.level,(select first_name from rms_users where id=g.group_id) as first_name,(select last_name from rms_users where id=g.co_id)as last_name
		,g.zone_id,g.date_release,g.date_line,g.create_date,g.total_duration,g.first_payment,g.time_collect
		,g.collect_typeterm,g.pay_term,g.payment_method,g.holiday,g.is_renew,g.branch_id,g.loan_type,g.status,g.is_verify,g.is_badloan,g.teller_id
		,m.chart_id,m.member_id,m.loan_number,m.currency_type,m.total_capital,m.admin_fee,m.interest_rate,m.loan_cycle,m.loan_purpose,m.pay_before
		,m.pay_after,m.graice_period,m.amount_collect_principal,m.show_barcode,m.is_completed,m.semi from ln_loan_group as g,ln_loan_member as m where m.group_id = g.g_id";
      	return $db->fetchAll($sql);
      }
 }

