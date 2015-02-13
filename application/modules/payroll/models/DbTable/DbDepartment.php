<?php

class Payroll_Model_DbTable_DbDepartment extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_department';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    function addDepartment($_data){
    	$arr = array(
    			'department_kh'=>$_data['department_kh'],
    			'department_en'=>$_data['department_en'],
    			'status'=>$_data['status'],
    			'date'=>date('Y-m-d'),
    			'displayby'=>$_data['display'],
    			'user_id'=>$this->getUserId(),
    	);
    	$this->insert($arr);//insert data
    }
    function upDateDepartment($_data){
    	$arr = array(
    			'department_kh'=>$_data['department_kh'],
    			'department_en'=>$_data['department_en'],
    			'status'=>$_data['status'],
    			'date'=>date('Y-m-d'),
    			'displayby'=>$_data['display'],
    			'user_id'=>$this->getUserId(),
    	);
    	$where = " id = ".$_data['id'];
    	$this->update($arr, $where);//update old data
    }
	public function getDepartmemtById($id){
		$db = $this->getAdapter();
		$sql = "SELECT * FROM $this->_name WHERE id = ".$db->quote($id);
		$sql.=" LIMIT 1 ";
		$row=$db->fetchRow($sql);
		return $row;
	}
	
	function getAllStaffDepartment($search=null){
		$db = $this->getAdapter();
		$str=$search['adv_search'];
		$status=$search['status_search'];
		$sql="CALL stGetAllStaffDepartment()";
// 		$order=" order by id DESC";
		$where = '';
		
		if(!empty($search['adv_search'])){
			$s_where = array();
			$s_search = $search['adv_search'];
			$s_where[] = " department_kh LIKE '%{$s_search}%'";
			$s_where[] = " department_en LIKE '%{$s_search}%'";
			$s_where[] = " status LIKE '%{$s_search}%'";
			$s_where[] = " displayby LIKE '%{$s_search}%'";
			$where .=' AND ('.implode(' OR ',$s_where).')';
		}
// 		print_r($search); exit();
		if($search['status_search']>-1){
			$where.= " AND status = ".$search['status_search'];
		}
		return $db->fetchAll($sql.$where);	
	}	
}

