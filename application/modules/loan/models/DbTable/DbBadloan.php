<?php

class Loan_Model_DbTable_DbBadloan extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_badloan';
    function addbadloan($_data){
    	$arr = array(
    			'branch'=>$_data['client_name'],
    			'client_code'=>$_data['Total_amount'],
    			'client_name'=>$_data['Interest_amount'],
    			'number_code'=>$_data['Date'],
    			'date'=>$_data['Term'],
    			'loss_date'=>$_data['Note'],
    			'total_amount'=>$_data['Note'],
    			'intrest_amount'=>$_data['Note'],
    			'tem'=>$_data['Note'],
    			'note'=>$_data['Note'],
    			);
    	$this->insert($arr);//insert data
//     	$where = 'id = 1';
//     	$this->delete($where);
    }
    function getAllBadloan($search=null){
    	$db = $this->getAdapter();
    	$sql = "SELECT cli_name,to_amount,inter_amount,date_,term_,note_ FROM 
    	$this->_name ";
    	$where = ' WHERE cli_name!=""';
    
    	return $db->fetchAll($sql.$where);
    }
    public function getClientByTypes($type){
    	$this->_name='ln_loan_member';
    	$sql ="SELECT
    	(SELECT c.client_number FROM `ln_client` AS c WHERE lm.client_id=c.client_id LIMIT 1 )AS client_number,
    	(SELECT c.name_en FROM `ln_client` AS c WHERE lm.client_id=c.client_id LIMIT 1 )AS name_en,
    	lm.client_id ,lm.loan_number
    	FROM `ln_loan_member` AS lm WHERE is_completed = 0 AND status=1 ";
    	$db = $this->getAdapter();
    	$rows = $db->fetchAll($sql);
    	$options=array();
    	if(!empty($rows))foreach($rows AS $row){
    		 if($type==1){
    			$lable = $row['client_number'];
    		}elseif($type==2){ $lable = $row['name_en'];}
    		else{$lable = $row['loan_number'];}
    		$options[$row['client_id']]=$lable;
    	}
		return $options;
    }
    
    
    
 }

