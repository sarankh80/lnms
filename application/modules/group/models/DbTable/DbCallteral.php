<?php

class Group_Model_DbTable_DbCallteral extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_client_callecteral';
    function addcallteral($data){
    	$arr = array(
    			'branch_id'=>$data['branch_id'],
				'code_call'=>$data['cod_cal'],
    			'co_id'=>$data['co_name'],
    			'contract_code'=>$data['contract_code'],
    			'client_name'=>$data['borrower'],
    			'with'=>$data['name'],
    			'relativewith'=>$data['names'],
    			'owner'=>$data['owner'],
    			'withs'=>$data['and_name'],
    			'relativewiths'=>$data['and_names'],
				'callate_type'=>$data['represent_property'],
				'note'=>$data['note'],
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
    			'contract_code'=>$data['contract_code'],
    			'client_name'=>$data['borrower'],
    			'with'=>$data['name'],
    			'relativewith'=>$data['names'],
    			'owner'=>$data['owner'],
    			'withs'=>$data['and_name'],
    			'relativewiths'=>$data['and_names'],
				'callate_type'=>$data['represent_property'],
				'note'=>$data['note'],
				'date_registration'=>$data['date_estate'],
				'status'=>$data['Stutas'],
				    	);
		$where=" id = ".$data['id'];
		$this->update($arr, $where);
	}
	function getecallteralbyid($id){
		$db = $this->getAdapter();
		$sql=" SELECT id,branch_id,code_call,co_id,getter_name,giver_name,date_delivery,client_code,contract_code,mortgage_Contract,
				client_name,'with',relativewith,owner,withs,relativewiths,callate_type,note,date_registration,status FROM $this->_name where id=$id ";
		//echo $sql;exit();
		return $db->fetchRow($sql);
	}
	function geteAllcallteral($id){
		$db = $this->getAdapter();
		$sql=" SELECT id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1) as branch_name
		,code_call,(SELECT ln_co.co_khname FROM ln_co WHERE ln_co.co_id=ln_client_callecteral.co_id limit 1) AS co_id
		,(SELECT name_en FROM ln_client WHERE client_id=client_name) AS client_name,owner,
		(SELECT title_kh FROM ln_callecteral_type WHERE id=callate_type) AS collteral_type,
		contract_code,date_registration,note,status FROM $this->_name ";
		return $db->fetchAll($sql);
	}
	public static function getCallteralCode(){
		$db = new Application_Model_DbTable_DbGlobal();
		$sql = "SELECT COUNT(id) AS amount FROM `ln_client_callecteral`";
		$acc_no= $db->getGlobalDbRow($sql);
		$acc_no=$acc_no['amount'];
		$new_acc_no= (int)$acc_no+1;
		$acc_no= strlen((int)$acc_no+1);
		$pre = "";
		for($i = $acc_no;$i<6;$i++){
			$pre.='0';
		}
		return "CL".$pre.$new_acc_no;
	}
}

