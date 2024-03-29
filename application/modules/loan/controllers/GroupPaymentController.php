<?php
class Loan_GroupPaymentController extends Zend_Controller_Action {
	public function init()
	{
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	private $sex=array(1=>'M',2=>'F');
	public function indexAction(){
		try{
			$db = new Loan_Model_DbTable_DbGroupPayment();
		if($this->getRequest()->isPost()){
				$formdata=$this->getRequest()->getPost();
				$search = array(
						'advance_search' => $formdata['advance_search'],
						'client_name'=>$formdata['client_name'],
						'start_date'=>$formdata['start_date'],
						'end_date'=>$formdata['end_date'],
						'status'=>$formdata['status'],
						'branch_id'		=>	$formdata['branch_id'],
						'co_id'		=>	$formdata['co_id'],
						);
			}
			else{
				$search = array(
						'adv_search' => '',
						'client_name' => -1,
						'start_date'=> date('Y-m-01'),
						'end_date'=>date('Y-m-d'),
						'branch_id'		=>	-1,
						'co_id'		=> -1,
						'status'=>"",);
			}
			$rs_rows= $db->getAllGroupPPayment($search);

			$list = new Application_Form_Frmtable();
			$collumns = array("Recirpt No","Loan No","Group Client","Total Principle","Total Payment","Recieve Amount","Total Interest","Penalize Amount","Date Pay","Due Date","CO Name","Branch",
				);
			$link=array(
					'module'=>'loan','controller'=>'group-payment','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('receipt_no'=>$link,'team_group'=>$link,'date'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$frm = new Loan_Form_FrmSearchGroupPayment();
		$fm = $frm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($fm);
		$this->view->frm_search = $fm;
	}
	function addAction()
	{
		$db = new Loan_Model_DbTable_DbGroupPayment();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			$identify = $_data["identity"];
			try {
				if($identify==""){
					Application_Form_FrmMessage::Sucessfull("Client is no loan to pay", "/loan/GroupPayment");
				}else{
					
					$db->addGroupPayment($_data);
					if(isset($_data["save"])){
						Application_Form_FrmMessage::Sucessfull("Client has pay sucessfull!", "/loan/GroupPayment/add");
					}elseif (isset($_data["save_close"])){
						Application_Form_FrmMessage::Sucessfull("Client has pay sucessfull!", "/loan/GroupPayment");
					}
				}
			}catch (Exception $e) {
				echo $e->getMessage();
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmGroupPayment();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
		
		$db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$this->view->graiceperiod = $db_keycode->getSystemSetting(9);
		
		$this->view->client = $db->getAllClient();
		$this->view->clientCode = $db->getAllClientCode();
				
		$session_user=new Zend_Session_Namespace('auth');
		$this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
	}
	function editAction()
	{
		$id = $this->getRequest()->getParam("id");
		$db = new Loan_Model_DbTable_DbGroupPayment();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			$identity = $_data["identity"];
			try {
				if($identity==""){
					Application_Form_FrmMessage::Sucessfull("Group Client no loan to pay!", "/loan/GroupPayment");
				}else{
					$db->updateGroupPayment($_data,$id);
					Application_Form_FrmMessage::Sucessfull("Update Success!", "/loan/GroupPayment");
				}
			}catch (Exception $e) {
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$rs = $db->getGroupPaymentById($id);
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmGroupPayment($rs);
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
		
		$this->view->reciept_money = $rs;
		$this->view->client = $db->getAllClient();
		$this->view->clientCode = $db->getAllClientCode();
		
		$db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$this->view->graiceperiod = $db_keycode->getSystemSetting(9);
		
		$session_user=new Zend_Session_Namespace('auth');
		$this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
	
		$list = new Application_Form_Frmtable();
	
		$rs_receipt_detail = $db->getGroupPaymentDetail($id);
		$this->view->reciept_moneyDetail = $rs_receipt_detail;
		$this->view->group_id = $rs["group_id"];
	}
	function getLoanDetailAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoanIL();
			$row = $db->getGroupLoadDetail($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	function getLoannumberAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbGroupPayment();
			$row = $db->getLoanPaymentByLoanNumber($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	
	function getLoanPaymentAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbGroupPayment();
			$row = $db->getLoanByLoanNimber($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	function getAllLoannumberAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbGroupPayment();
			$row = $db->getAllLoanPaymentByLoanNumber($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	function getClientByBranchAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$branch = $data["branch_id"];
			$db = new Loan_Model_DbTable_DbGroupPayment();
			$row = $db->getClientByBranch($branch);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	
	function getAllLoanHasPayedAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbGroupPayment();
			$row = $db->getAllLoanHasPayed($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	
}

