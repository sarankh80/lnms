<?php

class Callecterall_Model_DbTable_DbChangeCallecterall extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_view';
    function addcallecterall($data){
    	$db = $this->getAdapter();
    	$sql=" SELECT key_code FROM ln_view WHERE type=13 AND status = 1 
    	ORDER BY key_code DESC LIMIT 1 ";
    	$numer_record = $db->fetchOne($sql);
    	
    	
    	$arr = array(
    			'name_en'=>$data['name_en'],
    			'name_kh'=>$data['name_kh'],
    			'key_code'=>$numer_record+1,
    			'type'=>13,
    			);
         $id=$this->insert($arr);
     
    }
    function updatcallecterall($data){
    	$arr = array(
    			'name_en'=>$data['name_en'],
    			'name_kh'=>$data['name_kh'],
    			'key_code'
    			);
    	$where=" id = ".$data['id'];
    	$this->update($arr, $where);
    }
    function getOwnerbyid($id){
    	$db = $this->getAdapter();
		$sql = "SELECT v.id,v.name_en FROM  ln_cheng_colleterall AS cc, ln_client AS  c,ln_view AS v 
				WHERE cc.owner = c.client_id AND cc.from = v.id AND cc.owner= $id LIMIT 1";
		return $db->fetchRow($sql);
    }
    function geteAllid($type,$id){
    	$db = $this->getAdapter();
    	$sql=" SELECT id,name_en,name_kh,key_code,status FROM $this->_name where type=13 ORDER BY id DESC";
    	return $db->fetchAll($sql);
    	
    }
}

