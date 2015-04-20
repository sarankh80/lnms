<?php

class Group_Model_DbTable_DbCallteral extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_client_callecteral';
    function addcallteral($data){
    	$arr = array(
    			'branch_id'=>$data['branch_id'],
				'code_call'=>$data['cod_cal'],
    			'co_id'=>$data['co_name'],
    			'client_code'=>$data['client_code'],
    			'number_collteral'=>$data['number_collteral'],
    			'client_name'=>$data['client_name'],
    			'with'=>$data['name'],
    			'relativewith'=>$data['names'],
    			'owner'=>$data['owner'],
    			'withs'=>$data['and_name'],
    			'relativewiths'=>$data['and_names'],
				'callate_type'=>$data['collteral_type'],
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
    			'client_code'=>$data['client_code'],
				'number_collteral'=>$data['number_collteral'],
    		    'client_name'=>$data['client_name'],
    			'with'=>$data['name'],
    			'relativewith'=>$data['names'],
    			'owner'=>$data['owner'],
    			'withs'=>$data['and_name'],
    			'relativewiths'=>$data['and_names'],
				'callate_type'=>$data['collteral_type'],
				'note'=>$data['note'],
				'date_registration'=>$data['date_estate'],
				'status'=>$data['Stutas'],
				    	);
		$where=" id = ".$data['id'];
		$this->update($arr, $where);
	}
	function getecallteralbyid($id){
		$db = $this->getAdapter();
		$sql=" SELECT id,branch_id,code_call,co_id,client_code,getter_name,giver_name,date_delivery,client_code,number_collteral,mortgage_Contract,
				client_name,'with',relativewith,owner,withs,relativewiths,callate_type,note,date_registration,status FROM $this->_name where id=$id ";
		//echo $sql;exit();
		return $db->fetchRow($sql);
	}
	function geteAllcallteral($search=null){
		$db = $this->getAdapter();
		
		$from_date =(empty($search['start_date']))? '1': "date_registration >= '".$search['start_date']." 00:00:00'";
		$to_date = (empty($search['end_date']))? '1': "date_registration <= '".$search['end_date']." 23:59:59'";
		$where = " WHERE ".$from_date." AND ".$to_date;
		
		
		$sql=" SELECT id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1) as branch_name
		,(SELECT client_number FROM ln_client WHERE client_id=client_code) AS client_code
		,(SELECT name_en FROM ln_client WHERE client_id=client_code) AS client_name
		,code_call,(SELECT ln_co.co_khname FROM ln_co WHERE ln_co.co_id=ln_client_callecteral.co_id limit 1) AS co_id
		,owner
		,(SELECT title_kh FROM ln_callecteral_type WHERE id=callate_type) AS collteral_type
		,number_collteral,date_registration,note,status FROM $this->_name ";
		if($search['status_search']>-1){
			$where.=" AND status=".$search['status_search'];
		}
		if(!empty($search['branch_id'])){
			$where.=" AND ln_client_callecteral.branch_id = ".$search['branch_id'];
		}
		if(!empty($search['co_name'])){
			$where.=" AND co_id = ".$search['co_name'];
		}
		if(!empty($search['collteral_type'])){
			$where.=" AND callate_type = ".$search['collteral_type'];
		}
		if(!empty($search['client_code'])){
			$where.=" AND client_code = ".$search['client_code'];
		}
		if(!empty($search['adv_search'])){
			$s_where=array();
			$s_search=$search['adv_search'];
			$s_where[]="code_call LIKE '%{$s_search}%'";
			$s_where[]="owner LIKE'%{$s_search}%'";
			$s_where[]="number_collteral LIKE'%{$s_search}%'";
			$s_where[]="note LIKE'%{$s_search}%'";
			$where .=' AND ('.implode(' OR ',$s_where).')';
		}
		$order = "ORDER BY id DESC ";
		return $db->fetchAll($sql.$where.$order);
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

