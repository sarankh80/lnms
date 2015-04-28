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
	    			'branch_id'=>$data['branch_id'],
	    			'client_id'=>$data['client_name'],
	    			'giver_name'=>$data['receiver_name'],
	    			'collteral_id'=>$data['client_coll_id'],
	    			'receiver_name'=>$data['giver_name'],
	    			'date'=>$data['date'],//date('Y-m-d'),
	    			'note'=>$data['note'],
	    			'status'=>$data['stutas'],
	    			'user_id'=>$this->getUserId(),
	    			);
	    		$this->insert($_arr);
    	        $db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    		echo $e->getMessage();
    		exit();
    	}
	}
	function updateReturnCollteral($data){
		$db=$this->getAdapter();
		$db->beginTransaction();
		try {
		$_arr=array(
				'branch_id'=>$data['branch_id'],
	    			'client_id'=>$data['client_name'],
	    			'giver_name'=>$data['receiver_name'],
	    			'collteral_id'=>$data['client_coll_id'],
	    			'receiver_name'=>$data['giver_name'],
	    			'date'=>$data['date'],//date('Y-m-d'),
	    			'note'=>$data['note'],
	    			'status'=>$data['stutas'],
	    			'user_id'=>$this->getUserId()
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
			$from_date =(empty($search['start_date']))? '1': " rc.date >= '".$search['start_date']." 00:00:00'";
			$to_date = (empty($search['end_date']))? '1': " rc.date <= '".$search['end_date']." 23:59:59'";
			$where = " AND ".$from_date." AND ".$to_date;
			
			$sql=" SELECT rc.return_id,rc.giver_name,rc.receiver_name,
			       (SELECT title_kh FROM `ln_callecteral_type` WHERE id =cl.callate_type LIMIT 1) AS collect_type
			        ,cl.number_collteral
			        ,rc.date,rc.note,rc.status,
			       (SELECT user_name FROM rms_users WHERE id=rc.user_id LIMIT 1) AS user_id
			       FROM `ln_return_collteral` AS rc , 
			       ln_client_callecteral AS cl WHERE rc.collteral_id = cl.id ";
			if($search['status_search']>-1){
				$where.=" AND rc.status=".$search['status_search'];
			}
			if(!empty($search['collteral_type'])){
				$where.=" AND cl.callate_type=".$search['collteral_type'];
			}
			
			if(!empty($search['adv_search'])){
				$s_where=array();
				$s_search=$search['adv_search'];
				$s_where[]=" rc.giver_name LIKE '%{$s_search}%'";
				$s_where[]=" rc.receiver_name LIKE '%{$s_search}%'";
				$s_where[]=" rc.note LIKE '%{$s_search}%'";
				$s_where[]=" cl.number_collteral LIKE '%{$s_search}%'";
				
				$where .=' AND ('.implode(' OR ',$s_where).')';
			}

            $order = " ORDER BY rc.return_id DESC";
            //echo $sql.$where.$order;
			return $db->fetchAll($sql.$where.$order);
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

