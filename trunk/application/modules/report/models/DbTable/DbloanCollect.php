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
    	$start_date = $search['start_date'];
   		$end_date = $search['end_date'];
    	$sql = "SELECT * FROM v_getloancollects Where 1";
    	$where ='';
    	if(!empty($search['start_date']) or !empty($search['end_date'])){
    		$where.=" AND date_payment BETWEEN '$start_date' AND '$end_date'";
    	}
    	if($search['branch_id']>0){
    		$where.=" AND branch_id = ".$search['branch_id'];
    	}
    	if($search['client_name']>0){
    		$where.=" AND client_id = ".$search['client_name'];
    	}
    	if($search['co_id']>0){
    		$where.=" AND co_id = ".$search['co_id'];
    	}
    	if(!empty($search['adv_search'])){
    		$s_where = array();
    		$s_search = $search['adv_search'];
    		$s_where[] = "branch_kh LIKE '%{$s_search}%'";
    		$s_where[] = " co_name LIKE '%{$s_search}%'";
    		$s_where[] = " client_name LIKE '%{$s_search}%'";
    		$s_where[] = " total_principal LIKE '%{$s_search}%'";
    		$s_where[] = " principal_permonth LIKE '%{$s_search}%'";
    		$s_where[] = " total_interest LIKE '%{$s_search}%'";
    		$s_where[] = " amount_day LIKE '%{$s_search}%'";
    		$where .=' AND '.implode(' OR ',$s_where).'';
    	}
    	//echo $sql.$where;
    	return $db->fetchAll($sql.$where);
    	
    }

	
}

