<?php

class Callecterall_Model_DbTable_DbCallecteralllist extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_callecteralllist';
    function addcallecteralllist($data){
    	$arr = array(
    			'branch'=>$data['branch'],
    			'name_customer'=>$data['customer_name'],
    			'code'=>$data['cus_code'],
    			'number_invo'=>$data['num_vi'],
    			'date'=>$data['date'],
    			'time_boro'=>$data['time_think'],
    			'huch_bro'=>$data['time_short'],
    			'date_call'=>$data['date_call'],
    			'type_call'=>$data['callecterall_type'],
    			'code_call'=>$data['callecterall_code'],
    			'note'=>$data['note'],
    			'cash_type'=>$data['cash_type'],
    			'maney_boro'=>$data['much_boro'],
    		);
    	
         $id=$this->insert($arr);
         
     
    }
    function updatcallecteralllist($data){
    	$arr = array(
    			'branch'=>$data['branch'],
    			'name_customer'=>$data['customer_name'],
    			'code'=>$data['cus_code'],
    			'number_invo'=>$data['num_vi'],
    			'date'=>$data['date'],
    			'time_boro'=>$data['time_think'],
    			'huch_bro'=>$data['time_short'],
    			'date_call'=>$data['date_call'],
    			'type_call'=>$data['callecterall_type'],
    			'code_call'=>$data['callecterall_code'],
    			'note'=>$data['note'],
    			'cash_type'=>$data['cash_type'],
    			'maney_boro'=>$data['much_boro'],
    			
    		);
    	$where=" id = ".$data['id'];
    	$this->update($arr, $where);
    }
    function getcallecteralllistbyid($id){
    	$db = $this->getAdapter();
    	$sql=" SELECT id,branch,name_customer,code,number_invo,date,time_boro,
    	       huch_bro,date_call,type_call,code_call,note,cash_type,maney_boro FROM $this->_name where id=$id ";
    	return $db->fetchRow($sql);
    }
    function getcallecteralllistAllid($search=null){
    	$db = $this->getAdapter();
    	$sql=" SELECT id,branch,(SELECT name_kh FROM ln_client WHERE client_id =name_customer LIMIT 1) AS name_customer,code,number_invo,date,time_boro,
    	       huch_bro,date_call,(SELECT name_kh FROM ln_view WHERE type =13 and key_code=type_call LIMIT 1) AS type_call
    	       ,code_call,note,(SELECT name_kh FROM ln_view WHERE type =15 and key_code =cash_type LIMIT 1)AS cash_type ,
    	maney_boro FROM $this->_name";
    	return $db->fetchAll($sql);
    	
    }
}

