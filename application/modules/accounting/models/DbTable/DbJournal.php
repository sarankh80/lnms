<?php
class Accounting_Model_DbTable_DbJournal extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_journal';
	public function getUserId(){
		$session_user=new Zend_Session_Namespace('auth');
		return $session_user->user_id;
	
	}
	function addTransactionJournal($data){
		
		$arr =array(
				'branch_id'=>$data['branch_id'],
				'client_id'=>$data['client_id'],
				'receipt_number'=>$data['receipt_number'],
				'date'=>$data['date'],
				'create_date'=>date('Y-m-d'),
				'note'=>$data['note'],
				'user_id'=>$this->getUserId(),
				'from_location'=>$data['from_location'],
				'receipt_number'=>$data['receipt_number'],
				); 
		$id =  $this->insert($arr);
		unset($arr);
		$this->_name='ln_journal_detail';
		$acc_id =1 ;
		$db_g = new Application_Model_DbTable_DbGlobal();
		$db_g->getAccountBranchByOther($acc_id,$data['branch_id'],$data['currency_type'],$data['balance'],1);//update data to server 
		
		$arr = array(
				'jur_id'=>$id,
				'branch_id'=>$data['branch_id'],
				'account_type'=>1,
				'balance'=>$data['balance'],
				'account_id'=>$acc_id,//for loan number
				'is_increase'=>1,//for loan
				'currency_type'=>$data['currency_type']
				
		);
		$this->insert($arr);
		$arr['is_increase']=0;
		$acc_id=2;
		$arr['account_id']=$acc_id;
		$arr['account_type']=2;
		$accs = $db_g->getAccountBranchByOther($arr['account_id'], $data['branch_id'], $data['currency_type'],$data['balance'],$arr['is_increase']);
		$this->insert($arr);
		
		if(!empty($data['loan_fee'])){
			$arr['is_increase']=1;
			$arr['account_id']=2;
			$arr['note']='Admin fee from disburse loan ';
			$this->insert($arr);
			$db_g->getAccountBranchByOther($arr['account_id'], $data['branch_id'], $data['currency_type'],$data['loan_fee'],$arr['is_increase']);
			
			$arr['is_increase']=1;
			$arr['account_id']=3;
			$this->insert($arr);
			$db_g->getAccountBranchByOther($arr['account_id'], $data['branch_id'], $data['currency_type'],$data['loan_fee'],$arr['is_increase']);
		}
	}
	function addJournalDetail($data){
		$this->_name='ln_journal_detail';
		for($i=0;$i<=$data['count'];$i++){
			$arr = array(
					'jur_id'=>$data['jurnal_id'],
					'branch_id'=>$data['branch_id'],
					'account_id'=>$data['account_id'],
					'amount'=>$data['amount'],
					'account_type'=>$data['account_type'],
					'note'=>$data['note']
					);
			$this->insert($data);
		}
		
	}


}