<?php

class Other_Model_DbTable_DbBranch extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_branch';
    function addbranch($_data){
    	$arr = array(
    			'branch_namekh'=>$_data['branch_namekh'],
    			'branch_nameen'=>$_data['branch_nameen'],
    			'branch_address'=>$_data['br_address'],
    			'branch_code'=>$_data['branch_code'],
    			'branch_tel'=>$_data['branch_tel'],
    			'fax'=>$_data['_fax'],
    			'other'=>$_data['br_other'],
    			'status'=>$_data['br_status'],
    			'display'=>$_data['branch_display'],
    			);
    	$this->insert($arr);//insert data
//     	$where = 'id = 1';
//     	$this->delete($where);
    }
    public function updateBranch($_data,$id){
    	$_arr=array(
    			'province_en_name' => $_data['en_province'],
    			'province_kh_name' => $_data['kh_province'],
    			'displayby'	       => $_data['display'],
    			'modify_date'      => Zend_Date::now(),
    			'status'           => $_data['status'],
    			'user_id'	       => $this->getUserId()
    	);
    	$where=$this->getAdapter()->quoteInto("br_id=?", $id);
    	$this->update($_arr, $where);
    	
    function getAllBranch($search=null){
    	$db = $this->getAdapter();
    	$sql = "SELECT br_id,branch_namekh,branch_nameen,branch_address,branch_code,branch_tel,fax,displayby,other,status FROM 
    	$this->_name ";
    	$where = ' WHERE branch_namekh!="" AND branch_nameen !="" ';

    	return $db->fetchAll($sql.$where);
    }
    
   
    
	
   
}

