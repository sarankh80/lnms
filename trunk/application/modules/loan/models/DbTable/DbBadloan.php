<?php

class Loan_Model_DbTable_DbBadloan extends Zend_Db_Table_Abstract
{
    protected $_name = 'ln_badloan';
    function addbadloan($_data){
    	$session_transfer=new Zend_Session_Namespace();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$arr = array(
    			'branch'=>$_data['branch'],
    			'client_code'=>$_data['client_code'],
    			'client_name'=>$_data['client_name'],
    			'number_code'=>$_data['number_code'],
    			'date'=>$_data['Date'],
    			'loss_date'=>$_data['date_loss'],
    			'cash_type'=>$_data['cash_type'],
    			'total_amount'=>$_data['Total_amount'],
    			'intrest_amount'=>$_data['Interest_amount'],
    			'tem'=>$_data['Term'],
    			'note'=>$_data['Note'],
    			'status'=>$_data['status'],
    			'create_by'=>$user_id
    			);
    	$this->insert($arr);//insert data
    	$this->_name = 'ln_loan_group'; 
    	$arr_loan_group = array(
    		'is_badloan' =>1,
    	);
    	$where=" group_id = ".$_data['client_code'];
		$this->update($arr_loan_group, $where);
    }
    function updatebadloan($_data){
    	$session_transfer=new Zend_Session_Namespace();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$arr = array(
    			'branch'=>$_data['branch'],
    			'client_code'=>$_data['client_code'],
    			'client_name'=>$_data['client_name'],
    			'number_code'=>$_data['number_code'],
    			'date'=>$_data['Date'],
    			'loss_date'=>$_data['date_loss'],
    			'cash_type'=>$_data['cash_type'],
    			'total_amount'=>$_data['Total_amount'],
    			'intrest_amount'=>$_data['Interest_amount'],
    			'tem'=>$_data['Term'],
    			'note'=>$_data['Note'],
    			'status'=>$_data['status'],
    			'create_by'=>$user_id
    			);
    	$where=" id = ".$_data['id'];
    	$this->update($arr, $where);
    }
    function updatebadloan_bad($_data){
    	$session_transfer=new Zend_Session_Namespace();
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$arr = array(
    			'branch'=>$_data['branch'],
    			'client_code'=>$_data['client_code'],
    			'client_name'=>$_data['client_name'],
    			'number_code'=>$_data['number_code'],
    			'date'=>$_data['Date'],
    			'loss_date'=>$_data['date_loss'],
    			'cash_type'=>$_data['cash_type'],
    			'total_amount'=>$_data['Total_amount'],
    			'intrest_amount'=>$_data['Interest_amount'],
    			'tem'=>$_data['Term'],
    			'note'=>$_data['Note'],
    			'status'=>0,
    			'create_by'=>$user_id
    	);
    	$where=" id = ".$_data['id'];
    	$this->update($arr, $where);
    	 
    	$this->_name = 'ln_loan_group';
    	$arr_loan_group = array('is_badloan' =>0,	);
    	$where=" group_id = ".$_data['client_code'];
    	$this->update($arr_loan_group, $where);
    }
    function getbadloanbyid($id){
    	$db = $this->getAdapter();
    	$sql="SELECT id,branch,client_code,client_name,number_code,date,loss_date,cash_type,total_amount,intrest_amount
    	,tem,note,status FROM  $this->_name where id=$id AND status = 1";
    	return $db->fetchRow($sql);
    }
    function getAllBadloan($search=null){
    	$db = $this->getAdapter();
    	$sql = "SELECT id,(SELECT branch_namekh FROM ln_branch WHERE br_id = branch limit 1)as branch,
    	(SELECT client_number FROM `ln_client` WHERE client_id=client_code limit 1)AS client_code,
    	(SELECT name_en FROM `ln_client` WHERE client_id=client_name limit 1) AS client_name,number_code,date,loss_date,total_amount,intrest_amount
    	,tem,note FROM  $this->_name where status = 1";
    	
        return $db->fetchAll($sql);
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
    	$options=array(0=>'------Select------');
    	if(!empty($rows))foreach($rows AS $row){
    		 if($type==1){
    			$lable = $row['client_number'];
    		}elseif($type==2){ $lable = $row['name_en'];}
    		else{$lable = $row['loan_number'];}
    		$options[$row['client_id']]=$lable;
    	}
		return $options;
    }
    public function getClientByTypess($type=null,$client_id=null ,$row=null){
    	$this->_name='ln_loan_member';
    	$where='';
    	if($type!=null){
    		$where=' AND is_group = 1';
    	}
    	$sql ="SELECT client_id,
       (SELECT lf.total_principal FROM `ln_loanmember_funddetail` AS lf WHERE lf. member_id= member_id AND STATUS=1 AND is_completed=0 LIMIT 1) AS total_principal,
       (SELECT lf.total_interest FROM `ln_loanmember_funddetail` AS lf WHERE lf. member_id= member_id AND STATUS=1 AND is_completed=0 LIMIT 1) AS total_interest
        FROM `ln_loan_member`";
    	$db = $this->getAdapter();
    	if($row!=null){
    		if($client_id!=null){
    			$where.=" AND client_id  =".$client_id ." LIMIT 1";
    		}
    		return $db->fetchRow($sql.$where);
    	}
    	return $db->fetchAll($sql.$where);
    }
    public function getLoanInfo($id){
    	$db=$this->getAdapter();
    	$sql="SELECT  (SELECT lf.total_principal FROM `ln_loanmember_funddetail` AS lf WHERE lf. member_id= l.member_id AND STATUS=1 AND lf.is_completed=0 LIMIT 1)  AS total_principal,
    	                (SELECT lf.total_interest FROM `ln_loanmember_funddetail` AS lf WHERE lf. member_id= l.member_id AND STATUS=1 AND lf.is_completed=0 LIMIT 1)  AS total_interest
       ,l.currency_type FROM `ln_loan_member` AS l WHERE l.client_id=$id AND STATUS=1 AND l.is_completed=0
       ";
    	return $db->fetchRow($sql);
    }
    public function getLoanedit($id){
    	$db=$this->getAdapter();
    	$sql="SELECT  * FROM ln_badloan WHERE id=$id AND STATUS=1";
    	return $db->fetchRow($sql);
    }
  }

