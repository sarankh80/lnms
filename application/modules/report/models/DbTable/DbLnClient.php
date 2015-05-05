<?php
class Report_Model_DbTable_DbLnClient extends Zend_Db_Table_Abstract
{
      
       protected  $db_name='ln_client';

    public function getAllLnClient($search = null){
    	 $db = $this->getAdapter();
    	 $from_date =(empty($search['start_date']))? '1': "create_date >= '".$search['start_date']." 00:00:00'";
    	 $to_date = (empty($search['end_date']))? '1': "create_date <= '".$search['end_date']." 23:59:59'";
    	 $where = " WHERE ".$from_date." AND ".$to_date;
          $sql="SELECT client_id,client_number,name_kh,name_en, 
			(SELECT name_en FROM `ln_view` WHERE TYPE =11 AND sex=key_code LIMIT 1) AS sex ,phone,house,street, 
	        (SELECT `branch_nameen` FROM `ln_branch` WHERE `br_id`= branch_id) AS branch_name ,
			(SELECT village_name FROM `ln_village` WHERE vill_id= village_id) AS village_name ,
			(SELECT c.`commune_name` FROM `ln_commune` AS c WHERE c.com_id = com_id LIMIT 1) AS com_name,
			(SELECT d.`district_name` FROM `ln_district` AS d WHERE d.dis_id = dis_id LIMIT 1) AS dis_name,
			(SELECT `province_en_name` FROM `ln_province` WHERE `province_id` = pro_id LIMIT 1) AS pro_name,spouse_name, create_date, 
			(SELECT CONCAT(first_name,' ', last_name) FROM rms_users WHERE id=user_id )AS user_name, STATUS FROM ln_client";
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
			if($search['province']>0){
				$where.=" AND pro_id= ".$search['province'];
			}
			if($search['district']>0){
				$where.=" AND dis_id= ".$search['district'];
			}
			if($search['commune']>0){
				$where.=" AND com_id= ".$search['commune'];
			}
			if($search['village']>0){
				$where.=" AND village_id= ".$search['village'];
			}
			if($search['branch_id']>0){
				$where.=" AND branch_id= ".$search['branch_id'];
			}
			$order=" ORDER BY client_id DESC";
	          return $db->fetchAll($sql.$where.$order);
    } 
    public function getAllGroup(){
    	$db = $this->getAdapter();
    	$sql="SELECT client_number,name_kh,name_en,sex,status,(SELECT branch_namekh FROM ln_branch WHERE br_id =branch_id limit 1) AS branch_name
    	,pro_id,dis_id,com_id,village_id,spouse_name,phone FROM ln_client ORDER BY client_id";
    	return $db->fetchAll($sql);
    }
    public function getAllCalleteral($search=null){
    	$db = $this->getAdapter();
//     	$sql="SELECT branch_id,code_call,(SELECT co_khname FROM ln_co WHERE co_id=co_id limit 1) As co_id,getter_name,giver_name,date_delivery,client_code
//     	,contracts_borrow,mortgage_Contract,name_borrower,'with',relativewith,owner,withs,relativewiths,
//     	callate_type,note,date_registration,status FROM ln_client_callecteral ORDER BY branch_id";
		$sql ="SELECT branch_id,code_call,(SELECT co_khname FROM ln_co WHERE co_id=co_id LIMIT 1) AS co_id,
		getter_name,giver_name,date_delivery,client_code
    	,mortgage_Contract,'with',relativewith,OWNER,withs,relativewiths,
    	callate_type,note,date_registration,STATUS FROM ln_client_callecteral ";
		$where='';
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
		echo $sql.$where;
    	return $db->fetchAll($sql.$where);
    }
//     public function getAllCalleteral_value(){
//     	$db = $this->getAdapter();
//     	$sql="SELECT branch_id,code_call,(SELECT co_khname FROM ln_co WHERE co_id=co_id limit 1) As co_id,getter_name,giver_name,date_delivery,client_code
//     	,contracts_borrow,mortgage_Contract,name_borrower,'with',relativewith,owner,withs,relativewiths,
//     	callate_type,note,date_registration,status FROM ln_client_callecteral ORDER BY branch_id";
//     	return $db->fetchAll($sql);
//     }
function geteAllcallteral($search=null){
		$db = $this->getAdapter();
		
		$from_date =(empty($search['start_date']))? '1': "date_registration >= '".$search['start_date']." 00:00:00'";
		$to_date = (empty($search['end_date']))? '1': "date_registration <= '".$search['end_date']." 23:59:59'";
		$where = " WHERE ".$from_date." AND ".$to_date;
		
		
		$sql=" SELECT id,
		(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1) as branch_name
		,(SELECT client_number FROM ln_client WHERE client_id=client_code) AS client_code
		,(SELECT name_en FROM ln_client WHERE client_id=client_code) AS client_name
		,code_call,(SELECT ln_co.co_khname FROM ln_co WHERE ln_co.co_id=ln_client_callecteral.co_id limit 1) AS co_id
		,owner
		,(SELECT title_kh FROM ln_callecteral_type WHERE id=callate_type) AS collteral_type
		,number_collteral,date_registration,note,status FROM ln_client_callecteral ";
		if($search['status_search']>-1){
			$where.=" AND status=".$search['status_search'];
		}
		if(!empty($search['branch_id'])){
			$where.=" AND ln_client_callecteral.branch_id = ".$search['branch_id'];
		}
		if(!empty($search['co_name'])){
			$where.=" AND co_id = ".$search['co_name'];
		}
		if(!empty($search['collteral_type'])){
			$where.=" AND callate_type = ".$search['collteral_type'];
		}
		if(!empty($search['client_code'])){
			$where.=" AND client_code = ".$search['client_code'];
		}
		if(!empty($search['adv_search'])){
			$s_where=array();
			$s_search=$search['adv_search'];
			$s_where[]="code_call LIKE '%{$s_search}%'";
			$s_where[]="owner LIKE'%{$s_search}%'";
			$s_where[]="number_collteral LIKE'%{$s_search}%'";
			$s_where[]="note LIKE'%{$s_search}%'";
			$where .=' AND ('.implode(' OR ',$s_where).')';
		}
		$order = " ORDER BY id DESC ";
		//echo $sql.$where.$order;
		return $db->fetchAll($sql.$where.$order);
	}
}

