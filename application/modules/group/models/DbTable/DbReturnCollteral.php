<?php

class Group_Model_DbTable_DbReturnCollteral extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_return_collteral';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    }
    function addReturnCollteral($data){
    	$db=$this->getAdapter();
    	$db->beginTransaction();
    	try {
	    		$_arr=array(
	    			'giver_name'=>$data['giver_name'],
	    			'receiver_name'=>$data['receiver_name'],
	    			'date'=>date('Y-m-d'),
	    			'note'=>$data['note'],
	    			'status'=>$data['stutas'],
	    			'user_id'=>$this->getUserId(),
	    			);
	    		$this->insert($_arr);
    	$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();
    	}
	}
	function updateReturnCollteral($data){
		$db=$this->getAdapter();
		$db->beginTransaction();
		try {
		
		$_arr=array(
				'giver_name'=>$data['giver_name'],
	    		'receiver_name'=>$data['receiver_name'],
	    		'date'=>date('Y-m-d'),
				'note'=>$data['note'],
	    		'status'=>$data['stutas'],
	    		'user_id'=>$this->getUserId(),
				);
		$where=" return_id = ".$data['id'];
		echo $this->update($_arr,$where);
		$db->commit();
		}catch (Exception $e){
			$db->rollBack();
		}
	}
	function getReturnCollteralbyid($id){
		$db = $this->getAdapter();
		$db->beginTransaction();
		try {
			$sql=" SELECT * FROM $this->_name WHERE return_id =".$db->quote($id);
			$sql.="limit 1";
			return $db->fetchRow($sql);
			$db->commit();
		}catch (Exception $e){
			$db->rollBack();
		}
	}
	function getAllReturnCollteral($search=null){
		$db=$this->getAdapter();
		$db->beginTransaction();
		try {
			$sql="SELECT return_id,giver_name,receiver_name,date,note,status,
			(SELECT user_name FROM rms_users WHERE id=user_id limit 1) AS user_id FROM $this->_name WHERE 1";
			$where='';
			if($search['status_search']>-1){
				$where.=" AND status=".$search['status_search'];
			}
			if(!empty($search['adv_search'])){
				$s_where=array();
				$s_search=$search['adv_search'];
// 				$s_where[]="number_code LIKE '%{$s_search}%'";
				$s_where[]=" giver_name LIKE '%{$s_search}%'";
				$s_where[]=" receiver_name LIKE '%{$s_search}%'";
				$s_where[]=" note LIKE '%{$s_search}%'";
				$where .=' AND ('.implode(' OR ',$s_where).')';
			}
// 			echo $sql.$where;
			return $db->fetchAll($sql.$where);
			$db->commit();
		}catch (Exception $e){
			$db->rollBack();
			echo $e->getMessage();
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

