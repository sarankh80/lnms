<?php

class Callecterall_Model_DbTable_DbCallecterall extends Zend_Db_Table_Abstract
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
    function getcallecterallbyid($id){
    	$db = $this->getAdapter();
    	$sql=" SELECT id,name_en,name_kh,key_code FROM $this->_name where id=$id ";
    	return $db->fetchRow($sql);
    }
    function geteAllid($search=null){
    	$db = $this->getAdapter();
    	$sql=" SELECT id,name_en,name_kh,key_code,status FROM $this->_name where type=13 ORDER BY id DESC";
    	return $db->fetchAll($sql);
    	
    }
}

