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
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'adv_search' => '',
						'status' => -1);
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
		$frm = new Application_Form_FrmAdvanceSearch();
		$frm = $frm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
	}
	function addAction()
	{
		$db = new Loan_Model_DbTable_DbGroupPayment();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			$db->addGroupPayment($_data);
			try {
				
			}catch (Exception $e) {
				
			}
		}
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmGroupPayment();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
		$db_keycode = new Application_Model_DbTable_DbKeycode();
		$a = $db_keycode->getKeyCodeMiniInv();
		print_r($a);
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$db_g = new Application_Model_DbTable_DbGlobal();
		$this->view->inv_no = $db_g ->getNewInvoiceExchange();
		
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
			//print_r($_data);exit();
			try {
				$db->updateGroupPayment($_data);
			}catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		$rs = $db->getGroupPaymentById($id);
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmGroupPayment($rs);
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
	
		$list = new Application_Form_Frmtable();
		$collumns = array("ឈ្មោះមន្ត្រីឥណទាន","ថ្ងៃបង់ប្រាក់","ប្រាក់ត្រូវបង់","ប្រាក់ដើមត្រូវបង់","អាត្រាការប្រាក់","ប្រាក់ផាកពិន័យ","ប្រាក់បានបង់សរុប","សមតុល្យ","កំណត់សម្គាល់");
		$link=array(
				'module'=>'group','controller'=>'Client','action'=>'edit',
		);
		$this->view->list=$list->getCheckList(0, $collumns, array(),array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
	
		$rs_receipt_detail = $db->getGroupPaymentDetail($id);
		print_r($rs_receipt_detail);
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
	
}

