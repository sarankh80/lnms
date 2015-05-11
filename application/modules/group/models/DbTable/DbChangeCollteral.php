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
	    	
    	$array=array(
	    			'branch_id'=>$data['branch_id'],
	    			'client_id'=>$data['client_name'],
	    			'date'=>$data['date'],
	    			'note'=>$data['note'],
	    			'status'=>$data['Stutas'],
	    			'user_id'=>$this->getUserId()
	    			);
	    $change_id = $this->insert($array);  
	    
	    $_arr=array(
	    		'change_id'=>$change_id,
	    		'branch_id'=>$data['branch_id'],
	    		'client_id'=>$data['client_name'],
	    		'giver_name'=>$data['giver_name'],
	    		'receiver_name'=>$data['receiver_name'],
	    		'date'=>$data['date'],
	    		'user_id'=>$this->getUserId(),
	    		'note'=>$data['_note'],
	    );
	    $this->_name='ln_return_collteral';
	    $return_id = $this->insert($_arr);
	    
	    $ids =  explode(',', $data['record_row']);
	   
	   foreach($ids as $i){
	   	
	     	$this->_name='ln_client_callecteral_detail';//what relationship
	   	    $array = array(
					'note'=>'return by change collateral',
	   	    		'is_return'=>1
					);	
			$where = " id = ".$data['coid'.$i];
			$this->update($array, $where);

// 			$array = array(
// 					'changecollteral_id'=>$change_id,
// 					'collecteral_type'=>$data['tocollect_type'.$i],
// 					'owner_type'=>$data['toowner_type'.$i],
// 					'owner_name'=>$data['toowner_name'.$i],
// 					'number_collecteral'=>$data['tonumber_collteral'.$i],
// 					'note'=>$data['tonote'.$i],
// 					'is_changed'=>1,
// 			);
// 			$this->insert($array);
			
			$this->_name='ln_changecollteral_detail';
			$array = array(
					'client_coll_id'=>$data['coid'.$i],
					'change_id'=>$change_id,
					'from_collateral_type'=>$data['collect_type'.$i],
					'from_owner_id'=>$data['owner_type'.$i],
					'from_owner_name'=>$data['owner_name'.$i],
					'from_number_collateral'=>$data['number_collteral'.$i],
					
					'collateral_type'=>$data['tocollect_type'.$i],
					'owner_id'=>$data['toowner_type'.$i],
					'toowner_name'=>$data['toowner_name'.$i],
					'number_collateral'=>$data['tonumber_collteral'.$i],
					'note'=>$data['tonote'.$i],
// 					'is_changed'=>1,
					
			); 
			 $this->insert($array);
			 
			 $this->_name='ln_return_collteral_detail';
			 $array=array(
			 		'return_id'=>$return_id,
			 		'collect_type'=>$data['collect_type'.$i],
			 		'owner_type'=>$data['owner_type'.$i],
			 		'owner_name'=>$data['owner_name'.$i],
			 		'number_collteral'=>$data['number_collteral'.$i]
			 		);
			 $this->insert($array);
	   }
			
    	$db->commit();
    	}catch (Exception $e){
    		$db->rollBack();
    	}
	}
	function updateChangeCollteral($data){
		$db=$this->getAdapter();
		$db->beginTransaction();
		try {
			
			$array=array(
					'branch_id'=>$data['branch_id'],
					'client_id'=>$data['client_name'],
					'date'=>$data['date'],
					'note'=>$data['note'],
					'status'=>$data['Stutas'],
					'user_id'=>$this->getUserId()
			);
			
			$where="id = ".$data['id'];
			$this->update($array,$where);//table change collateral
			
			$this->_name='ln_changecollteral_detail';//DELETE ALL OLD COLLATERAL DETAIL
			$where=" change_id = ".$data['id'];
			$this->delete($where);
			
			///////////////////////////update return and delete return detail////////////////////////////
			$_arr=array(
					'branch_id'=>$data['branch_id'],
					'client_id'=>$data['client_name'],
					'giver_name'=>$data['giver_name'],
					'receiver_name'=>$data['receiver_name'],
					'date'=>$data['date'],
					'user_id'=>$this->getUserId(),
					'note'=>$data['_note'],
			);
			$this->_name='ln_return_collteral';//table return collateral
			$where=" change_id = ".$data['id'];
			$this->update($array,$where);
			//delete return detail here
			$this->_name='ln_return_collteral_detail';
			$rows = $this->getReturnDetailById($data['id']);
			foreach ($rows as $rs){
				$where = ' id = '.$rs['id'];
				$this->delete($where);
			}
			
			$ids =  explode(',', $data['record_row']);
			foreach($ids as $i){
// 				$this->_name='ln_client_callecteral_detail';//what relationship
// 				$array = array(
// 						'change_detail'=>$data['id'],
// 						'collecteral_type'=>$data['tocollect_type'.$i],
// 						'owner_type'=>$data['toowner_type'.$i],
// 						'owner_name'=>$data['toowner_name'.$i],
// 						'number_collecteral'=>$data['tonumber_collteral'.$i],
// 						'note'=>$data['tonote'.$i],
// 						'is_changed'=>1
// 				);
// 				$where = " id = ".$data['coid'.$i];
// 				$this->update($array, $where);
					
				$this->_name='ln_changecollteral_detail';
				$array = array(
						'client_coll_id'=>$data['coid'.$i],
						'change_id'=>$data['id'],
						'from_collateral_type'=>$data['collect_type'.$i],
						'from_owner_id'=>$data['owner_type'.$i],
						'from_owner_name'=>$data['owner_name'.$i],
						'from_number_collateral'=>$data['number_collteral'.$i],
							
						'collateral_type'=>$data['tocollect_type'.$i],
						'owner_id'=>$data['toowner_type'.$i],
						'toowner_name'=>$data['toowner_name'.$i],
						'number_collateral'=>$data['tonumber_collteral'.$i],
						'note'=>$data['tonote'.$i],
						// 					'is_changed'=>1,
							
				);
				$this->insert($array);
			
				$this->_name='ln_return_collteral_detail';
				$array=array(
						'return_id'=>$data['id'],
						'collect_type'=>$data['collect_type'.$i],
						'owner_type'=>$data['owner_type'.$i],
						'owner_name'=>$data['owner_name'.$i],
						'number_collteral'=>$data['number_collteral'.$i]
				);
				$this->insert($array);
			}
			
			
			
// 			$this->_name='ln_client_callecteral';
// 			$arr_collteral = array(
// 					'branch_id'=>$data['branch_id'],
// 					'changecollteral_id'=>$data['changecollteral_id'],
// 					'client_code'=>$data['client_code'],
// 					'number_collteral'=>$data['number_code'],
// 					'client_name'=>$data['client_name'],
// 					'owner'=>$data['owner_name'],
// 					'callate_type'=>$data['to'],
// 					'note'=>$data['note'],
// 					'date_registration'=>$data['date'],
// 					'status'=>$data['Stutas'],
// 					'user_id'=>$this->getUserId(),
// 			);
// 			$where="id = ".$data['collteral_id'];
// 			$this->update($arr_collteral,$where);
// 			$this->_name = 'ln_changecollteral';
			
			
// 		$arr = array(
//     			'branch_id'=>$data['branch_id'],
// 				//'collteral_id'=>$data['collteral_id'],
// 				'owner_code_id'=>$data['client_code'],
//     			'owner_id'=>$data['client_name'],
//     			'from_id'=>$data['from'],
//     			'to_id'=>$data['to'],
//     			'collteral_type'=>$data['collteral_type'],
//     			'number_code'=>$data['number_code'],
//     			'owner'=>$data['owner_name'],
//     			'date'=>$data['date'],
//     			'note'=>$data['_note'],
//     			'status'=>$data['Stutas'],
//     			'user_id'=>$this->getUserId()
// 				);
// 		$where=" id = ".$data['id'];
// 		$this->update($arr, $where);
		
		$db->commit();
		}catch (Exception $e){
			$db->rollBack();
			echo $e->getMessage();
		}
	}
	function getReturnDetailById($id){
		$db = $this->getAdapter();
		$sql=" SELECT rd.id FROM `ln_return_collteral` AS rc ,`ln_return_collteral_detail` AS rd
				WHERE rc.id = rd.return_id AND rc.change_id = $id";
		return $db->fetchAll($sql);
	}
	function getChangeCollteralbyid($id){
		$db = $this->getAdapter();
		$db->beginTransaction();
		$sql=" SELECT cl.* , rc.giver_name , rc.receiver_name ,rc.note AS return_note
		FROM $this->_name AS cl, ln_return_collteral AS rc  WHERE rc.change_id  = cl.id AND cl.id = ".$db->quote($id);
		$sql.="limit 1";
		return $db->fetchRow($sql);
		
	}
	function  getAllCollateralDetailById($id){
		$db = $this->getAdapter();
		$sql = " SELECT * FROM ln_changecollteral_detail WHERE change_id = $id ";
		return $db->fetchAll($sql);
	}
	function getAllChangeCollteral($search=null){
		$db = $this->getAdapter();
		
		$from_date =(empty($search['start_date']))? '1': " date >= '".$search['start_date']." 00:00:00'";
		$to_date = (empty($search['end_date']))? '1': " date <= '".$search['end_date']." 23:59:59'";
		$where = " WHERE ".$from_date." AND ".$to_date;
		

		try {
			 $sql=" SELECT id, (SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id LIMIT 1) AS branch_id, 
			(SELECT CONCAT(client_number,' ',name_kh,' ',name_en) FROM ln_client AS c WHERE c.client_id=client_id LIMIT 1) AS client_name, 
			 'to',date,note,status, (SELECT user_name FROM rms_users WHERE id=user_id) AS user_id
			 FROM $this->_name WHERE 1";
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
			if(!empty($search['adv_search'])){
				$s_where=array();
				$s_search=$search['adv_search'];
				$s_where[]="note LIKE '%{$s_search}%'";
				$where .=' AND ('.implode(' OR ',$s_where).')';
		}
// 	echo  $sql.$where;
			$dbs=$db->fetchAll($sql.$where);
			return $dbs;
		}catch (Exception $e){
			
		}
	}
	function getColleteralById($id){//get id by change collaterall id 
			$db = $this->getAdapter();
			$sql = "SELECT id,
					(SELECT ct.title_en FROM `ln_callecteral_type` AS ct WHERE  ct.id =collateral_type ) AS collateral  FROM `ln_changecollteral_detail` 
					WHERE change_id = $id";
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
	function getOwnerInfo($id){//ajax
		$db = $this->getAdapter();
		$sql = "SELECT id,
		    (SELECT name_en FROM ln_client WHERE client_id=client_code) AS client_name,owner,
			callate_type,(SELECT id FROM `ln_changecollteral` WHERE id=$id) AS changecollteral_id,
			number_collteral FROM `ln_client_callecteral` WHERE client_code=$id AND status=1  LIMIT 1";
		return $db->fetchRow($sql);
	}
}

