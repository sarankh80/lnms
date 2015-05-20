<?php
class Report_Model_DbTable_DbloanCollect extends Zend_Db_Table_Abstract
{
      
       protected  $db_name='ln_loanmember_funddetail';
//     public function getUserId(){
//     	$session_user=new Zend_Session_Namespace('auth');
//     	return $session_user->user_id;
//     }
    public function getAllLnClient($search=null){
    	$db=$this->getAdapter();
    	$from_date =(empty($search['from_date']))? '1': "date_payment < '".$search['from_date']." 00:00:00'";
    	$to_date = (empty($search['to_date']))? '1': "date_payment <= '".$search['to_date']." 23:59:59'";
    	$where = " AND ".$from_date." OR ".$to_date;
    	$sql = "SELECT f.id,f.`member_id`,f.`total_principal`,f.principal_permonth,f.total_interest,f.total_payment,f.amount_day,f.date_payment,
				(SELECT  co_khname FROM ln_co WHERE co_id=f.`collect_by` ) AS co_name,
				(SELECT branch_namekh FROM ln_branch WHERE br_id=f.branch_id) AS branch_kh,
				(SELECT CONCAT (client_number,' - ',name_kh,'-',name_en,' <br /> ',phone,'-','st:',street,';No:',house)  FROM ln_client WHERE client_id= (SELECT client_id FROM ln_loan_member WHERE member_id=f.member_id limit 1) limit 1)
				AS client_name FROM `ln_loanmember_funddetail` AS f WHERE is_completed=0 AND status=1 ";
    	if(!empty($search['client_code'])){
    		$s_where = array();
    		$s_search = $search['btn_search'];
    		$s_where[] = "name_kh,name_en LIKE '%{$s_search}%'";
    		$s_where[] = " co_khname LIKE '%{$s_search}%'";
    		$s_where[] = " branch_namekh LIKE '%{$s_search}%'";
    		    		$s_where[] = " f.total_principal LIKE '%{$s_search}%'";
    		    		$s_where[] = " f.principal_permonth LIKE '%{$s_search}%'";
    		    		$s_where[] = " f.total_interest LIKE '%{$s_search}%'";
    		    		$s_where[] = " f.amount_day LIKE '%{$s_search}%'";
    		    		$s_where[] = " f.date_payment LIKE '%{$s_search}%'";
    		$where .=' AND '.implode(' OR ',$s_where).'';
    	}
//     	if($search['status']>0){
//     		$where.= " AND status = ".$search['status'];
//     	}
    	//     	if($search['province']>0){
    	//     		$where.=" AND pro_id= ".$search['province'];
    	//     	}
//     	if($search['branch_id']>0){
//     		$where.=" AND branch_id= ".$search['branch_id'];
//     	}
    	//$order=" ORDER BY client_id DESC";
    	//echo $sql.$where;
    	return $db->fetchAll($sql.$where);
    	//return $db->fetchAll($sql);
    }

	
}

