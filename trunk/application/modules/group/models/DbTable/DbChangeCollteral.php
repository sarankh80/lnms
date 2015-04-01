<?php

class Group_Model_DbTable_DbChangeCollteral extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_changecollteral';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    }
    function addChangeCollteral($data){
    	$db=$this->getAdapter();
    	$db->beginTransaction();
    	try {
	    	$this->_name='ln_client_callecteral';
	    	$where = " id = ".$data['collteral_id'];
	    	$_arr_=array('is_changed'=>2);
	    	$this->update($_arr_, $where);
	    	
	    		$this->_name = 'ln_changecollteral';
	    		$arr = array(
	    			'branch_id'=>$data['branch_id'],
	    			//'collteral_id'=>$data['collteral_id'],
					'owner_code_id'=>$data['client_code'],
	    			'owner_id'=>$data['client_name'],
	    			'from_id'=>$data['from'],
	    			'to_id'=>$data['to'],
	    			'collteral_type'=>$data['collteral_type'],
	    			'number_code'=>$data['number_code'],
	    			'owner'=>$data['owner_name'],
	    			'date'=>$data['date'],
	    			'note'=>$data['note'],
	    			'status'=>$data['Stutas'],
	    			'user_id'=>$this->getUserId()
	    		);
	    		$id=$this->insert($arr);
	    		
	    		
	    		$arr_collteral = array(
	    				'changecollteral_id'=>$id,
	    				'branch_id'=>$data['branch_id'],
	    				'client_code'=>$data['client_code'],
	    				'number_collteral'=>$data['number_code'],
	    				'client_name'=>$data['client_name'],
	    				'owner'=>$data['owner_name'],
	    				'callate_type'=>$data['to'],
	    				'note'=>$data['note'],
	    				'date_registration'=>$data['date'],
	    				'status'=>$data['Stutas'],
	    				'user_id'=>$this->getUserId(),
	    		);
	    		$this->_name='ln_client_callecteral';
	    		$this->insert($arr_collteral);//to collecterall
	    		
	    		
	    		$_arr=array(
	    			'change_id'=>$id,
	    			'collteral_id'=>$data['collteral_id'],
	    			'giver_name'=>$data['giver_name'],
	    			'receiver_name'=>$data['receiver_name'],
	    			'date'=>date('Y-m-d'),
	    			'user_id'=>$this->getUserId(),
	    			);
	    		$this->_name='ln_return_collteral';
	    		$this->insert($_arr);
    	$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();
    	}
	}
	function updateChangeCollteral($data){
		$db=$this->getAdapter();
		$db->beginTransaction();
		try {
			$this->_name='ln_client_callecteral';
			$where=" id = ".$data['collteral_id'];
			
			$arr_collteral = array(
					'branch_id'=>$data['branch_id'],
					'changecollteral_id'=>$data['changecollteral_id'],
					'client_code'=>$data['client_code'],
					'number_collteral'=>$data['number_code'],
					'client_name'=>$data['client_name'],
					'owner'=>$data['owner_name'],
					'callate_type'=>$data['to'],
					'note'=>$data['note'],
					'date_registration'=>$data['date'],
					'status'=>$data['Stutas'],
					'user_id'=>$this->getUserId(),
			);
			$this->update($arr_collteral,$where);
			$this->_name = 'ln_changecollteral';
			
		$arr = array(
    			'branch_id'=>$data['branch_id'],
				'collteral_id'=>$data['collteral_id'],
				'owner_code_id'=>$data['client_code'],
    			'owner_id'=>$data['client_name'],
    			'from_id'=>$data['from'],
    			'to_id'=>$data['to'],
    			'collteral_type'=>$data['collteral_type'],
    			'number_code'=>$data['number_code'],
    			'owner'=>$data['owner_name'],
    			'date'=>$data['date'],
    			'note'=>$data['note'],
    			'status'=>$data['Stutas'],
    			'user_id'=>$this->getUserId()
				);
		$where=" id = ".$data['id'];
		$this->update($arr, $where);
		
		
		$_arr=array(
				'collteral_id'=>$data['collteral_id'],
				'giver_name'=>$data['giver_name'],
				'receiver_name'=>$data['receiver_name'],
				'date'=>date('Y-m-d'),
				'user_id'=>$this->getUserId(),
				);
		$this->_name="ln_return_collteral";
		$where="change_id= ".$data['id'];
		$this->update($_arr, $where);
		$db->commit();
		}catch (Exception $e){
			$db->rollBack();
		}
	}
	function getChangeCollteralbyid($id){
		$db = $this->getAdapter();
		$db->beginTransaction();
		try {
		$sql=" SELECT * FROM $this->_name WHERE id=".$db->quote($id);
		$sql.="limit 1";
		return $db->fetchRow($sql);
		$db->commit();
		}catch (Exception $e){
			$db->rollBack();
		}
	}
	function getAllChangeCollteral($search=null){
		$db = $this->getAdapter();
		$db->beginTransaction();
		try {
			$sql=" SELECT id,
			(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1) as branch_id,
			(SELECT client_number FROM ln_client WHERE client_id=owner_code_id) AS owner_code_id,
			(SELECT name_en FROM ln_client WHERE client_id=owner_id) AS owner_id,
			(SELECT title_en FROM ln_callecteral_type WHERE id=from_id) AS fromd_id,
			(SELECT title_en FROM ln_callecteral_type WHERE id=to_id) AS to_id,
			(SELECT name_kh FROM ln_view WHERE TYPE=21 AND key_code=collteral_type) AS collteral_type,
			number_code,owner,date,note,status,
			(SELECT user_name FROM rms_users WHERE id=user_id) AS user_id FROM $this->_name WHERE 1";
			$where='';
			if($search['status_search']>-1){
				$where.=" AND status=".$search['status_search'];
			}
			if(!empty($search['branch_id'])){
				$where.=" AND branch_id = ".$search['branch_id'];
			}
			if(!empty($search['client_code'])){
				$where.=" AND owner_code_id = ".$search['client_code'];
			}
			if(!empty($search['client_name'])){
				$where.=" AND owner_id = ".$search['client_name'];
			}
			if(!empty($search['to'])){
				$where.=" AND to_id = ".$search['to'];
			}
			if(!empty($search['collteral_type'])){
				$where.=" AND collteral_type=".$search['collteral_type'];
			}
			if(!empty($search['from'])){
				$where.=" AND from_id=".$search['from'];
			}
			if(!empty($search['adv_search'])){
				$s_where=array();
				$s_search=$search['adv_search'];
				$s_where[]="number_code LIKE '%{$s_search}%'";
				$s_where[]="owner LIKE'%{$s_search}%'";
				$s_where[]="note LIKE'%{$s_search}%'";
				$where .=' AND ('.implode(' OR ',$s_where).')';
		}
	// echo  $sql.$where;
			$dbs=$db->fetchAll($sql.$where);
			return $dbs;
		$db->commit();
		}catch (Exception $e){
			$db->rollBack();
		}
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
	function getOwnerInfo($id){//ajax
		$db = $this->getAdapter();
		$sql = "SELECT id,(SELECT name_en FROM ln_client WHERE client_id=client_name) AS client_name,owner,
			(SELECT title_kh FROM ln_callecteral_type WHERE id=callate_type) AS collteral_type,
			callate_type,(SELECT id FROM `ln_changecollteral` WHERE id=$id) AS changecollteral_id,
			number_collteral FROM `ln_client_callecteral` WHERE id=$id AND status=1  LIMIT 1";
		return $db->fetchRow($sql);
	}
}

