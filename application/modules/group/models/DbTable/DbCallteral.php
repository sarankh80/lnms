<?php

class Group_Model_DbTable_DbCallteral extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_client_callecteral';
    function addcallteral($data){
    	$arr = array(
    			'branch_id'=>$data['branch_id'],
    			'co_id'=>$data['co_name'],
    			'getter_name'=>$data['getter_name'],
    			'giver_name'=>$data['giver_name'],
    			'date_delivery'=>$data['date'],
    			'client_code'=>$data['customer_code'],
    			'contracts_borrow'=>$data['contract_code'],
    			'mortgage_Contract'=>$data['code'],
    			'name_borrower'=>$data['borrower'],
    			'with'=>$data['name'],
    			'relativewith'=>$data['names'],
    			'owner'=>$data['owner'],
    			'withs'=>$data['and_name'],
    			'relativewiths'=>$data['and_names'],
    			'callate_type'=>$data['represent_property'],
    			'note'=>$data['estate_code'],
    			'date_registration'=>$data['date_estate'],
    			'status'=>$data['Stutas'],
    	);
    	$this->insert($arr);
	}
	function updatecallteral($data){
		$arr = array(
				'branch_id'=>$data['branch_id'],
				'code_call'=>$data['cod_cal'],
				
    			'co_id'=>$data['co_name'],
    			'getter_name'=>$data['getter_name'],
    			'giver_name'=>$data['giver_name'],
    			'date_delivery'=>$data['date'],
    			'client_code'=>$data['customer_code'],
    			'contracts_borrow'=>$data['contract_code'],
    			'mortgage_Contract'=>$data['code'],
    			'name_borrower'=>$data['borrower'],
    			'with'=>$data['name'],
    			'relativewith'=>$data['names'],
    			'owner'=>$data['owner'],
    			'withs'=>$data['and_name'],
    			'relativewiths'=>$data['and_names'],
				'callate_type'=>$data['represent_property'],
				'note'=>$data['estate_code'],
				'date_registration'=>$data['date_estate'],
				'status'=>$data['Stutas'],
    	);
		$where=" id = ".$data['id'];
		$this->update($arr, $where);
	}
	function getecallteralbyid($id){
		$db = $this->getAdapter();
		$sql=" SELECT id,branch_id,code_call,co_id,getter_name,giver_name,date_delivery,client_code,contracts_borrow,mortgage_Contract,
				name_borrower,'with',relativewith,owner,withs,relativewiths,callate_type,note,date_registration,status FROM $this->_name where id=$id ";
		//echo $sql;exit();
		return $db->fetchRow($sql);
	}
	function geteAllcallteral($id){
		$db = $this->getAdapter();
		$sql=" SELECT id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1) as branch_name
		,code_call,co_id,getter_name,giver_name,date_delivery,client_code,contracts_borrow,mortgage_Contract,status FROM $this->_name ";
		//echo $sql;exit();
		return $db->fetchAll($sql);
	}
}

