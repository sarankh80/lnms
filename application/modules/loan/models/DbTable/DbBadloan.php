<?php

class Loan_Model_DbTable_DbBadloan extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_badloan';
    function addbadloan($_data){
    	$arr = array(
    			'cli_name'=>$_data['client_name'],
    			'to_amount'=>$_data['Total_amount'],
    			'inter_amount'=>$_data['Interest_amount'],
    			'date_'=>$_data['Date'],
    			'term_'=>$_data['Term'],
    			'note_'=>$_data['Note'],
    			);
    	$this->insert($arr);//insert data
//     	$where = 'id = 1';
//     	$this->delete($where);
    }
    function getAllBadloan($search=null){
    	$db = $this->getAdapter();
    	$sql = "SELECT cli_name,to_amount,inter_amount,date_,term_,note_ FROM 
    	$this->_name ";
    	$where = ' WHERE cli_name!=""';
    
//     	if($search['status']>-1){
//     		$where.= " AND status = ".$search['status'];
//     	}
//     	if(!empty($search['adv_search'])){
//     		$s_where = array();
//     		$search = ($search['adv_search']);
//     		$s_where[] = " co_code LIKE '%{$search}%'";
//     		$s_where[] = "co_khname LIKE '%{$search}%'";
//     		$s_where[] = " co_firstname LIKE '%{$search}%'";
//     		$s_where[] = "co_lastname LIKE '%{$search}%'";
//     		$s_where[] = " tel LIKE '%{$search}%'";
//     		$s_where[] = "email LIKE '%{$search}%'";
//     		$s_where[] = "address LIKE '%{$search}%'";
//     		$where .=' AND ('.implode(' OR ',$s_where).')';
//     	}
    
    	// 		echo $sql.$where;
    	return $db->fetchAll($sql.$where);
    }
    
   
    
	
   
}

