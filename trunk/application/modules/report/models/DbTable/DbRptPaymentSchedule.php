<?php
class Report_Model_DbTable_DbRptPaymentSchedule extends Zend_Db_Table_Abstract
{

  
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    }
    public function getPaymentSchedule($id){
    	$db=$this->getAdapter();
    	$sql = "SELECT id,member_id,total_principal,
    	principal_permonth,total_interest,total_payment,
    	amount_day,status,is_completed,is_approved,date_payment,
    	branch_id from ln_loanmember_funddetail";
    	return $db->fetchAll($sql);
    }
    public function getAllClientPaymentListRpt(){
    	$sql="SELECT m.member_id,
    	(SELECT c.name_en FROM `ln_client` AS c  WHERE c.client_id=m.client_id LIMIT 1) AS client_name
    	,m.total_capital,m.admin_fee,m.interest_rate,
    	(SELECT payment_nameen FROM `ln_payment_method` WHERE id = m.payment_method) AS payment_nameen,
    	(SELECT time_collect FROM `ln_loan_group` WHERE g_id = m.group_id LIMIT 1) AS time_collect,
    	(SELECT `zone_name` FROM `ln_zone` WHERE zone_id = ( SELECT zone_id FROM `ln_loan_group` WHERE g_id = m.group_id LIMIT 1) LIMIT 1 ) AS zone_name,
    	(SELECT co_khname FROM `ln_co` WHERE co_id = ( SELECT co_id FROM `ln_loan_group` WHERE g_id = m.group_id LIMIT 1) LIMIT 1 ) AS co_khname,
    	m.status FROM `ln_loan_member` AS m ORDER BY member_id ";
    	$db = $this->getAdapter();
    	return $db->fetchAll($sql); 
    }
	
}

