<?php
class Report_Model_DbTable_DbLnClient extends Zend_Db_Table_Abstract
{
      
       protected  $db_name='ln_client';

    public function getAllLnClient(){
    	 $db = $this->getAdapter();
          $sql="SELECT client_number,name_kh,name_en,sex,status,(SELECT branch_namekh FROM ln_branch WHERE br_id =branch_id limit 1) AS branch_name
          ,pro_id,dis_id,com_id,village_id,spouse_name,phone FROM ln_client ORDER BY client_id";
          return $db->fetchAll($sql);
    }
    public function getAllGroup(){
    	$db = $this->getAdapter();
    	$sql="SELECT client_number,name_kh,name_en,sex,status,(SELECT branch_namekh FROM ln_branch WHERE br_id =branch_id limit 1) AS branch_name
    	,pro_id,dis_id,com_id,village_id,spouse_name,phone FROM ln_client ORDER BY client_id";
    	return $db->fetchAll($sql);
    }
    public function getAllCalleteral(){
    	$db = $this->getAdapter();
    	$sql="SELECT branch_id,code_call,co_id,getter_name,giver_name,date_delivery,client_code,contracts_borrow,mortgage_Contract,STATUS
    	 FROM ln_client_callecteral ORDER BY branch_id";
    	return $db->fetchAll($sql);
    }
}

