<?php

class Payroll_Model_DbTable_DbSalary extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_salary';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    }
public function addSalary($_data){
		$db = $this->getAdapter();
		$db->beginTransaction();
		try{
			$_arr=array(
				'branch_id'		=>$_data['branch_id'],
				'staff_id'				=>$_data['staff_name'],
				'basic_salary'  => $_data['basic_salary'],
				'date_start'	=> $_data['date_start'],
				'date_get_salary'=> $_data['date_get_salary'],
				'date'			=> date('Y-m-d'),
				'user_id'		=> $this->getUserId(),
				'status'		=> $_data['status']
				
		);
		  $id = $this->insert($_arr);
		  $ids = explode(',', $_data['record_row']);
		  $this->_name='ln_salary_detail';
		  foreach($ids as  $i){
		  	$arr = array(
		  			'bonus_id'=>$id,
		  			'bonus_type'=>$_data['bonus_type_'.$i],
		  			'amount'=>$_data['amount_'.$i],
		  			'note'=>$_data['note_'.$i],
		  			);
		  	$this->insert($arr);
		  }
// 		if(!empty($_data['id'])){
// 			$where = 'staff_id = '.$_data['id'];
// 			return  $this->update($_arr, $where);
// 		}else{
			//return  $this->insert($_arr);
// 		}
		$db->commit();
		}catch(Exception $e){
			$db->rollBack();
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
		$sql = "SELECT id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id) AS branch_name,
		(SELECT co_khname FROM ln_co WHERE co_id = staff_id limit 1 ) AS staff_id,
		 basic_salary,date_start,date_get_salary, date,
		(SELECT user_name FROM rms_users WHERE id = user_id limit 1 ) AS user_id,
		 status
		 FROM $this->_name ";
		$row=$db->fetchAll($sql);
		return $row;
	}	
	function getTypeOption($search=null){
		$db = new Application_Model_GlobalClass();
		$sql = "SELECT key_code ,name_en FROM ln_view WHERE type=9";
		$opt = $db->getOptonsHtml($sql, 'name_en', 'key_code');
		return $opt;
	}
}

