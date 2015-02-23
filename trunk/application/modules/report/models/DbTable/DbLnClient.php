<?php
class Report_Model_DbTable_DbLnClient extends Zend_Db_Table_Abstract
{
      
       protected  $db_name='ln_client';

    public function getAllLnClient(){
    	 $db = $this->getAdapter();
          $sql="SELECT client_number,name_kh,name_en,(SELECT name_kh FROM ln_view WHERE TYPE = 11 AND key_code=sex ) AS sex,status,
          (SELECT branch_namekh FROM ln_branch WHERE br_id =branch_id limit 1) AS branch_name
          ,(SELECT province_kh_name FROM ln_province WHERE province_id=pro_id) As pro_id
          ,(SELECT district_name FROM ln_district WHERE dis_id=dis_id limit 1)As dis_id
          ,(SELECT commune_name FROM ln_commune WHERE com_id=com_id limit 1) As com_id
          ,(SELECT village_name FROM ln_village WHERE vill_id=village_id limit 1) As village_id 
          ,spouse_name,phone FROM ln_client ORDER BY client_id";
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
    	$sql="SELECT branch_id,code_call,(SELECT co_khname FROM ln_co WHERE co_id=co_id limit 1) As co_id,getter_name,giver_name,date_delivery,client_code
    	,contracts_borrow,mortgage_Contract,name_borrower,'with',relativewith,owner,withs,relativewiths,
    	callate_type,note,date_registration,status FROM ln_client_callecteral ORDER BY branch_id";
    	return $db->fetchAll($sql);
    }
//     public function getAllCalleteral_value(){
//     	$db = $this->getAdapter();
//     	$sql="SELECT branch_id,code_call,(SELECT co_khname FROM ln_co WHERE co_id=co_id limit 1) As co_id,getter_name,giver_name,date_delivery,client_code
//     	,contracts_borrow,mortgage_Contract,name_borrower,'with',relativewith,owner,withs,relativewiths,
//     	callate_type,note,date_registration,status FROM ln_client_callecteral ORDER BY branch_id";
//     	return $db->fetchAll($sql);
//     }
}

