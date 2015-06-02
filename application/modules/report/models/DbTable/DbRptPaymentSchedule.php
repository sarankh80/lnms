<?php
class Report_Model_DbTable_DbRptPaymentSchedule extends Zend_Db_Table_Abstract
{

  
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    }
    public function getPaymentSchedule($id){
    	$db=$this->getAdapter();
    	$sql = "SELECT * FROM `ln_loanmember_funddetail` WHERE member_id= $id AND status=1";
//     	$sql = "SELECT id,member_id,total_principal,
//     	principal_permonth,total_interest,total_payment,
//     	amount_day,status,is_completed,is_approved,date_payment,
//     	branch_id from ln_loanmember_funddetail";
    	return $db->fetchAll($sql);
    }
    public function getAllClientPaymentListRpt($search = null ){
    	$db = $this->getAdapter();
    	//$sql="select * FROM v_loanpaymentschedulelist";
    	$sql="SELECT m.member_id
    	,(SELECT `b`.`branch_namekh` FROM `ln_branch` AS b WHERE `b`.`br_id` =lg.`branch_id` LIMIT 1) AS `branch_namekh`
        ,`m`.`loan_number` ,`c`.`client_number`
  		,c.name_en ,m.total_capital,m.admin_fee
  		,m.interest_rate,
    	CONCAT( lg.total_duration,' ',(SELECT name_en FROM `ln_view` WHERE type = 14 AND key_code =lg.pay_term )),
    	(SELECT payment_nameen FROM `ln_payment_method` WHERE id = m.payment_method) AS payment_nameen,
    	lg.time_collect
    	,(SELECT `zone_name` FROM `ln_zone` WHERE zone_id = lg.zone_id) AS zone_name
    	,(SELECT co_khname FROM `ln_co` WHERE co_id = lg.co_id ) AS co_khname, m.status 
    	    FROM `ln_loan_member` AS m,`ln_loan_group` AS lg,`ln_client` AS c 
    		WHERE lg.g_id = m.group_id AND c.client_id = m.client_id ";
    	$Other =" ORDER BY member_id DESC ";
    	$where = '';
    	//echo $search['adv_search'];
    	if(!empty($search['adv_search'])){
    		$s_where = array();
    		$s_search = $search['adv_search'];
    		$s_where[] = " c.name_en LIKE '%{$s_search}%'";
    		$s_where[]=" total_capital LIKE '%{$s_search}%'";
    		$where .=' AND '.implode(' OR ',$s_where).'';
    		
    	}
    	//echo ($sql.$where.$Other)."<br /><br />";
    	return $db->fetchAll($sql.$where.$Other); 
    }
	
}

