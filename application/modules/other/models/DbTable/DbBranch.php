<?php

class Other_Model_DbTable_DbBranch extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_branch';
    function addbranch($_data){
    	$arr = array(
    			'branch_namekh'=>$_data['branch_namekh'],
    			'branch_nameen'=>$_data['branch_nameen'],
    			'branch_address'=>$_data['br_address'],
    			'branch_code'=>$_data['branch_code'],
    			'branch_tel'=>$_data['branch_tel'],
    			'fax'=>$_data['_fax'],
    			'other'=>$_data['br_other'],
    			'status'=>$_data['br_status'],
    			'display'=>$_data['branch_display'],
    			);
    	$this->insert($arr);//insert data
//     	$where = 'id = 1';
//     	$this->delete($where);
    }
    function getAllBranch($search=null){
    	$db = $this->getAdapter();
    	$sql = "SELECT br_id,branch_namekh,branch_nameen,branch_address,branch_code,branch_tel,fax,other,status,display FROM 
    	$this->_name ";
    	$where = ' WHERE branch_namekh!="" AND branch_nameen !="" ';
    
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

