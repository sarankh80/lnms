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
				'staff_id'		=>$_data['staff_name'],
				'basic_salary'  => $_data['basic_salary'],
				'date_start'	=> $_data['date_start'],
				'date_get_salary'=> $_data['date_get_salary'],
				'for_month'		=>$_data['for_month'],
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
	public function updateSalary($_data){
		$db = $this->getAdapter();
		$db->beginTransaction();
		try{
			$_arr=array(
					'branch_id'		=>$_data['branch_id'],
					'staff_id'		=>$_data['staff_name'],
					'basic_salary'  => $_data['basic_salary'],
					'date_start'	=> $_data['date_start'],
					'date_get_salary'=> $_data['date_get_salary'],
					'for_month'		=>$_data['for_month'],
					'date'			=> date('Y-m-d'),
					'user_id'		=> $this->getUserId(),
					'status'		=> $_data['status']
			);
			$where = " id = ".$_data['id'];
			$this->update($_arr,$where);
			
			$where = " bonus_id = ".$_data['id'];
			$_arr = array('status'=>0);
			$this->_name='ln_salary_detail';
			
			$this->update($_arr,$where);
			$ids = explode(',', $_data['record_row']);
			foreach($ids as  $i){
				$arr = array(
						'bonus_id'=>$_data['id'],
						'bonus_type'=>$_data['bonus_type_'.$i],
						'amount'=>$_data['amount_'.$i],
						'note'=>$_data['note_'.$i],
				);
				$this->insert($arr);
			}
			$db->commit();
		}catch(Exception $e){
			$db->rollBack();
		}
	}
	public function getSalaryById($id){
		$db = $this->getAdapter();
		$sql = "SELECT * FROM $this->_name WHERE id = ".$db->quote($id);
		$sql.=" LIMIT 1 ";
		$row=$db->fetchRow($sql);
		return $row;
	}
	function getAllSalary($search=null){
		$db = $this->getAdapter();
		$sql = "SELECT id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id) AS branch_name,
		(SELECT co_khname FROM ln_co WHERE co_id = staff_id limit 1 ) AS staff_id,basic_salary,
		(SELECT position_en FROM ln_position WHERE id = 
		(SELECT position_id FROM ln_co WHERE co_id = staff_id limit 1 ) limit 1) as position_name,
		 date_start,date_get_salary,(SELECT end_date FROM ln_co WHERE co_id=staff_id limit 1) AS end_date,
		 date,(SELECT user_name FROM rms_users WHERE id = user_id limit 1 ) AS user_id,
		 status,detail
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
	function getStaffInfo($type,$id){//ajax
		$db = $this->getAdapter();
		$where = ($type==1)? " co_id = $id ":" co_code = $id ";
		$sql = "SELECT co_id ,branch_id,co_code,basic_salary,start_date,end_date,position_id FROM 
			ln_co WHERE status =1 AND $where  LIMIT 1";
		return $db->fetchRow($sql);
	}
	function getReportDetail($id){
		$db=$this->getAdapter();
		$sql = " SELECT id,
		(SELECT co_code FROM ln_co WHERE co_id = staff_id) AS co_code,
		(SELECT co_khname FROM ln_co WHERE co_id = staff_id) AS co_kh,
		(SELECT position_en FROM ln_position WHERE id = 
		(SELECT position_id FROM ln_co WHERE co_id = staff_id limit 1 ) limit 1) as position_name,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id) AS branch_namekh,
		 basic_salary,date_start,date_get_salary,
		(SELECT end_date FROM ln_co WHERE co_id=staff_id limit 1) AS end_contract,for_month,
		(SELECT name_kh FROM ln_view WHERE type=3 AND key_code=status) AS status
		 FROM $this->_name WHERE id = $id ";
		$row=$db->fetchRow($sql);
		return $row;
	}
	function getReceiptDetailById($id){
		$db=$this->getAdapter();
		$sql=" SELECT id,bonus_type,(SELECT name_en FROM ln_view WHERE type=9 AND key_code = bonus_type) AS bonus_name ,amount,note
 			   FROM ln_salary_detail WHERE bonus_id = $id and status=1";
		return $db->fetchAll($sql);
		
	}
}

