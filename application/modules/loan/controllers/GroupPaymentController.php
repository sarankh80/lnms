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
				//print_r($formdata);
				$search = array(
						'advance_search' => $formdata['advance_search'],
						'client_name'=>$formdata['client_name'],
						'date_pay'=>$formdata['date_pay'],
						'due_date'=>$formdata['due_date'],
						'status'=>$formdata['status'],
						);
				//print_r($search);
			}
			else{
				$search = array(
						'adv_search' => '',
						'client_name' => -1,
						'date_pay'=>0,
						'due_date'=>'',
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
				if($identify=""){
					Application_Form_FrmMessage::Sucessfull("Client is no loan to pay", "/loan/GroupPayment");
				}else{
					$db->addGroupPayment($_data);
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
		
		$this->view->client = $db->getAllClient();
		$this->view->clientCode = $db->getAllClientCode();
				
		$session_user=new Zend_Session_Namespace('auth');
		$this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
	
		$list = new Application_Form_Frmtable();
		$collumns = array("ឈ្មោះមន្ត្រីឥណទាន","ថ្ងៃបង់ប្រាក់","ប្រាក់ត្រូវបង់","ប្រាក់ដើមត្រូវបង់","អាត្រាការប្រាក់","ប្រាក់ផាកពិន័យ","ប្រាក់បានបង់សរុប","សមតុល្យ","កំណត់សម្គាល់");
		$link=array(
				'module'=>'group','controller'=>'Client','action'=>'edit',
		);
		$this->view->list=$list->getCheckList(0, $collumns, array(),array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
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
					$db->updateGroupPayment($_data);
					Application_Form_FrmMessage::Sucessfull("Update Success!", "/loan/GroupPayment");
				}
			}catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		$rs = $db->getGroupPaymentById($id);
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmGroupPayment($rs);
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
		
		$this->view->row = $rs;
		$this->view->client = $db->getAllClient();
		$this->view->clientCode = $db->getAllClientCode();
		
		$db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$session_user=new Zend_Session_Namespace('auth');
		$this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
	
		$list = new Application_Form_Frmtable();
		$collumns = array("ឈ្មោះមន្ត្រីឥណទាន","ថ្ងៃបង់ប្រាក់","ប្រាក់ត្រូវបង់","ប្រាក់ដើមត្រូវបង់","អាត្រាការប្រាក់","ប្រាក់ផាកពិន័យ","ប្រាក់បានបង់សរុប","សមតុល្យ","កំណត់សម្គាល់");
		$link=array(
				'module'=>'group','controller'=>'Client','action'=>'edit',
		);
		$this->view->list=$list->getCheckList(0, $collumns, array(),array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
	
		$rs_receipt_detail = $db->getGroupPaymentDetail($id);
		$this->view->reciept_detail = $rs_receipt_detail;
		$this->view->group_id = $rs["group_id"];
		$this->view->client_code = $rs["client_code"];
		$this->view->loan_number = $rs["loan_number"];
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
	
}

