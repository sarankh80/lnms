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
    			'fax'=>$_data['fax'],
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
    			'fax'=>$_data['fax'],
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
    	
    	if($search['status_search']>-1){
    		$where.= " AND status = ".$search['status_search'];
    	}
    	
    	if(!empty($search['adv_search'])){
    		$s_where=array();
    		$s_search=$search['adv_search'];
    		$s_where[]=" branch_namekh LIKE '%{$s_search}%'";
    		$s_where[]=" branch_nameen LIKE '%{$s_search}%'";
    		$s_where[]=" br_address LIKE '%{$s_search}%'";
    		$s_where[]=" branch_code LIKE '%{$s_search}%'";
    		$s_where[]=" branch_tel LIKE '%{$s_search}%'";
    		$s_where[]=" fax LIKE '%{$s_search}%'";
    		$s_where[]=" other LIKE '%{$s_search}%'";
    		$s_where[]=" displayby LIKE '%{$s_search}%'";
    		$where.=' AND ('.implode(' OR ',$s_where).')';
    	}
   //echo $sql.$where;
   return $db->fetchAll($sql.$where);
    }
    
 function getBranchById($id){
    	$db = $this->getAdapter();
    	$sql = "SELECT br_id,branch_namekh,branch_nameen,br_address,branch_code,branch_tel,fax,displayby,other,status FROM
    	$this->_name ";
    	$where = " WHERE `br_id`= $id" ;
  
   		return $db->fetchRow($sql.$where);
    }
    public static function getBranchCode(){
    	$db = new Application_Model_DbTable_DbGlobal();
    	$sql = "SELECT COUNT(br_id) AS amount FROM `ln_branch`";
    	$acc_no= $db->getGlobalDbRow($sql);
    	$acc_no=$acc_no['amount'];
    	$new_acc_no= (int)$acc_no+1;
    	$acc_no= strlen((int)$acc_no+1);
    	$pre = "";
    	for($i = $acc_no;$i<3;$i++){
    		$pre.='0';
    	}
    	return "B".$pre.$new_acc_no;
    }
}  
	  

