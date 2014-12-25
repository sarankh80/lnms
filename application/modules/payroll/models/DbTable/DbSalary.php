<?php

class Payroll_Model_DbTable_DbSalary extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_salary';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    }
	public function addSalary($_data){
		$_arr=array(
				'branch_id'		=>$_data['branch_id'],
				'staff_code'		=>$_data['staff_code'],
				'staff_name'	=> $_data['staff_name'],
				'sex'			=>$_data['sex'],
				'position'		=> $_data['position'],
				'basic_salary'  => $_data['basic_salary'],
				'date_start'	=> $_data['date_start'],
				'date_get_salary'=> $_data['date_get_salary'],
				'date'			=> date('Y-m-d'),
				'user_id'		=> $this->getUserId(),
				'status'		=> $_data['status']
				
		);
		if(!empty($_data['id'])){
			$where = 'staff_id = '.$_data['id'];
			return  $this->update($_arr, $where);
		}else{
			return  $this->insert($_arr);
		}
	}
	public function getSalaryById($id){
		$db = $this->getAdapter();
		$sql = "SELECT * FROM $this->_name WHERE staff_id = ".$db->quote($id);
		$sql.=" LIMIT 1 ";
		$row=$db->fetchRow($sql);
		return $row;
	}
	function getAllSalary($search=null){
		$db = $this->getAdapter();
		$sql = "SELECT staff_id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id) AS branch_name,staff_code,
		(SELECT co_khname FROM ln_co WHERE co_id = staff_name limit 1 ) AS staff_name,
		(SELECT name_kh FROM ln_view WHERE type=8 AND key_code =sex limit 1) AS types,
		position,basic_salary,date_start,date_get_salary, date,
		(SELECT user_name FROM rms_users WHERE id = user_id limit 1 ) AS user_id,
		 status
		 FROM $this->_name ";
		$row=$db->fetchAll($sql);
		return $row;
	}	
	function getType(){
		$db=$this->getAdapter();
		$sql="SELECT name_en FROM ln_view";
	}
}

