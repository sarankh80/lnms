<?php

class Group_Model_DbTable_DbClientBlackList extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_client';
    
    function updatBlackList($data){
    	$arr = array(
//     			'branch_id'=>$data['branch'],
    			'is_blacklist'=>1,
    			'date_blacklist'=>$data['date'],
    			'reasonblack_list'=>$data['problem'],
    			'status_blacklist'=>$data['status'],
    			);
    	$where=" client_id= ".$data['client_name'];
    	$this->update($arr, $where);
    }
    function updatClientBlackList($data){
    	$arr = array(
    			'is_blacklist'=>1,
    			'date_blacklist'=>$data['date'],
    			'reasonblack_list'=>$data['problem'],
    			'status_blacklist'=>$data['status'],
    	);
    	$where=" client_id= ".$data['id'];
    	$this->update($arr, $where);
    }
    function getAllBlackList($search=null){
    	$db=$this->getAdapter();
    	
    	$from_date =(empty($search['start_date']))? '1': " date_blacklist >= '".$search['start_date']." 00:00:00'";
    	$to_date = (empty($search['end_date']))? '1': " date_blacklist <= '".$search['end_date']." 23:59:59'";
    	$where = " AND ".$from_date." AND ".$to_date;
    	
    	$sql = "SELECT client_id
    	        ,(SELECT `branch_namekh` FROM `ln_branch` WHERE `br_id` = branch_id ) branch_id
    	        ,name_kh,name_en
				,client_number
				,(SELECT name_en FROM ln_view WHERE `type` = 11 AND key_code = sex) AS sex
				,reasonblack_list
				,(SELECT name_en FROM ln_view WHERE `type` = 22 AND key_code = is_blacklist)AS is_blacklist
				,date_blacklist,
    			status FROM ln_client WHERE status_blacklist=1 AND is_blacklist= 1";
    	//(SELECT name_en FROM ln_view WHERE `type` = 22 AND key_code = status_blacklist)AS status_blacklist,
    	if(!empty($search['adv_search'])){
    		$s_where = array();
    		$s_search = $search['adv_search'];
    		$s_where[] = "client_number LIKE '%{$s_search}%'";
    		$s_where[] = " name_en LIKE '%{$s_search}%'";
    		$s_where[] = " name_kh LIKE '%{$s_search}%'";
    		$s_where[] = " reasonblack_list LIKE '%{$s_search}%'";
    		$where .=' AND ('.implode(' OR ',$s_where).')';
    	}
    	if($search['status_search']>-1){
    		$where.= " AND status = ".$search['status_search'];
    	}
    	if(!empty($search['branch_id'])){
    		$where.= " AND branch_id = ".$search['branch_id'];
    	}
    	$order = " ORDER BY client_id DESC ";
     	//echo $sql.$where.$order;
    	return $db->fetchAll($sql.$where.$order);
    }
    public function getBlackListById($id){
    	$db = $this->getAdapter();
    	$sql = "SELECT * FROM $this->_name WHERE client_id = ".$db->quote($id);
    	$sql.=" LIMIT 1 ";
    	$row=$db->fetchRow($sql);
    	return $row;
    }
   
}

