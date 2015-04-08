<?php

class Group_Model_DbTable_DbClient extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_client';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
	public function addClient($_data){
		$photoname = str_replace(" ", "_", $_data['name_en']) . '.jpg';
		$upload = new Zend_File_Transfer();
		$upload->addFilter('Rename',
				array('target' => PUBLIC_PATH . '/images/'. $photoname, 'overwrite' => true) ,'photo');
		$receive = $upload->receive();
		if($receive)
		{
			$_data['photo'] = $photoname;
		}
		else{
			$_data['photo']="";
		}
		
		try{
		$_arr=array(
				'is_group'	  => $_data['is_group'],
				//'parent_id'	  =>$parent,
				'parent_id'	  =>($_data['group_id']!=-1)?$_data['group_id']:"",
				'group_code' => ($_data['is_group']==1)?$_data['group_code']:"",
				'client_number'=> $_data['client_no'],
				'name_kh'	  => $_data['name_kh'],
				'name_en'	  => $_data['name_en'],
				'sex'	      => $_data['sex'],
				'spouse_nationid'=>$_data['spouse_nationid'],
				'sit_status'  => $_data['situ_status'],
				'pro_id'      => $_data['province'],
				'dis_id'      => $_data['district'],
				'com_id'      => $_data['commune'],
				'village_id'  => $_data['village'],
				'street'	  => $_data['street'],
				'house'	      => $_data['house'],
				'photo_name'  =>$_data['photo'],
				'job'        =>$_data['job'],
				'id_number'=>$_data['national_id'],
				'phone'	      => $_data['phone'],
				'spouse_name' => $_data['spouse'],
				'remark'	  => $_data['desc'],
				'status'      => $_data['status'],
				'user_id'	  => $this->getUserId()
		);
		if(!empty($_data['id'])){
			$where = 'client_id = '.$_data['id'];
			return  $this->update($_arr, $where);
		}else{
			return  $this->insert($_arr);
		}
		}catch(Exception $e){
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
	}
	public function getClientById($id){
		$db = $this->getAdapter();
		$sql = "SELECT * FROM $this->_name WHERE client_id = ".$db->quote($id);
		$sql.=" LIMIT 1 ";
		$row=$db->fetchRow($sql);
		return $row;
	}
    function getViewClientByGroupId($group_id){
    	$db = $this->getAdapter();
    	$sql=" SELECT * FROM $this->_name WHERE client_id=
    	(SELECT client_id FROM `ln_loan_member` WHERE group_id=".$db->quote($group_id)." LIMIT 1)";
    	$row=$db->fetchRow($sql);
    	return $row;
    }
	function getAllClients($search = null){
		$db = $this->getAdapter();
		$sql = " 
		SELECT client_id,client_number,name_kh,name_en,
		(SELECT name_en FROM `ln_view` WHERE TYPE =11 AND sex=key_code LIMIT 1) AS sex
		,phone,house,street,
			(SELECT village_name FROM `ln_village` WHERE vill_id= village_id) AS village_name
		    ,spouse_name,(SELECT  CONCAT(first_name,' ', last_name) FROM rms_users WHERE id=user_id )AS user_name,
			status FROM $this->_name WHERE 1 ";
		$order=" ORDER BY client_id DESC";
		$where = '';
		
		if(!empty($search['adv_search'])){
			$s_where = array();
			$s_search = $search['adv_search'];
			$s_where[] = "client_number LIKE '%{$s_search}%'";
			$s_where[] = " name_en LIKE '%{$s_search}%'";
			$s_where[] = " name_kh LIKE '%{$s_search}%'";
			$s_where[] = " phone LIKE '%{$s_search}%'";
			$s_where[] = " house LIKE '%{$s_search}%'";
			$s_where[] = " street LIKE '%{$s_search}%'";
			$s_where[] = " spouse_name LIKE '%{$s_search}%'";
			$where .=' AND ('.implode(' OR ',$s_where).')';
		}
		if($search['status']>-1){
			$where.= " AND status = ".$search['status'];
		}
		if($search['province_id']>0){
			$where.=" AND pro_id= ".$search['province_id'];
		}
		if(!empty($search['district_id'])){
			$where.=" AND dis_id= ".$search['district_id'];
		}
		if(!empty($search['comm_id'])){
			$where.=" AND com_id= ".$search['comm_id'];
		}
		if(!empty($search['village'])){
			$where.=" AND village_id= ".$search['village'];
		}
		
// 		echo $sql.$where.$order;
		return $db->fetchAll($sql.$where.$order);	
	}
	public function getGroupCode($data){
		$db = $this->getAdapter();
		if($data['is_group']==1){
			$sql = "SELECT COUNT(client_id) AS number FROM `ln_client`
			WHERE is_group =1 ";
		}else{
			$sql = " SELECT group_code FROM `ln_client`
			WHERE client_id = ".$data['group_id'] ;
			return $db->fetchOne($sql);
		}
		$acc_no = $db->fetchOne($sql);
		$new_acc_no= (int)$acc_no+1;
		$acc_no= strlen((int)$acc_no+1);
		$pre = "";
		for($i = $acc_no;$i<6;$i++){
			$pre.='0';
		}
		return "G".$pre.$new_acc_no;
	}	
}

