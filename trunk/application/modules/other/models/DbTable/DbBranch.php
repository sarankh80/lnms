<?php

class Other_Model_DbTable_DbBranch extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_branch';
    function addbranch($_data){
    	$_arr = array(
    			'branch_namekh'=>$_data['branch_namekh'],
    			'branch_nameen'=>$_data['branch_nameen'],
    			'br_address'=>$_data['br_address'],
    			'branch_code'=>$_data['branch_code'],
    			'branch_tel'=>$_data['branch_tel'],
    			'fax'=>$_data['branch_fax'],
    			'other'=>$_data['branch_note'],
    			'status'=>$_data['branch_status'],
    			'displayby'=>$_data['branch_display'],
    			);
    	$this->insert($_arr);//insert data
//     	$where = 'id = 1';
//     	$this->delete($where);
    }
    public function updateBranch($_data,$id){
    	$_arr = array(
    			'branch_namekh'=>$_data['branch_namekh'],
    			'branch_nameen'=>$_data['branch_nameen'],
    			'br_address'=>$_data['br_address'],
    			'branch_code'=>$_data['branch_code'],
    			'branch_tel'=>$_data['branch_tel'],
    			'fax'=>$_data['branch_fax'],
    			'other'=>$_data['branch_note'],
    			'status'=>$_data['branch_status'],
    			'displayby'=>$_data['branch_display'],
    			);
    	$where=$this->getAdapter()->quoteInto("br_id=?", $id);
    	$this->update($_arr, $where);
    }
    	
    function getAllBranch($search=null){
    	$db = $this->getAdapter();
    	$sql = "SELECT br_id,branch_namekh,branch_nameen,br_address,branch_code,branch_tel,fax,displayby,other,status FROM 
    	$this->_name ";
    	$where = ' WHERE branch_namekh!="" AND branch_nameen !="" ';
   
   return $db->fetchAll($sql.$where);
    }
    
 function getBranchById($id){
    	$db = $this->getAdapter();
    	$sql = "SELECT br_id,branch_namekh,branch_nameen,br_address,branch_code,branch_tel,fax,displayby,other,status FROM
    	$this->_name ";
    	$where = " WHERE `br_id`= $id" ;
  
   return $db->fetchRow($sql.$where);
    }
}  
	  

