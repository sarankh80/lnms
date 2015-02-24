<?php
class Loan_RepaymentscheduleController extends Zend_Controller_Action {
	public function init()
	{
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	private $sex=array(1=>'M',2=>'F');
	public function indexAction(){
		try{
			$db = new Loan_Model_DbTable_DbRepaymentSchedule();
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'client_id' => -1,
						'status' => -1,
						'from_date' =>date('Y-m-d'),
						'to_date' => date('Y-m-d'),
				);
			}
			$rs_rows= $db->getAllGroupLoan($search);
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("Loan Number","Client Name","Client NameKh","Release Amount","Interest Rate","Method","Zone","CO",
					"Branch","status");
			$link=array(
					'module'=>'loan','controller'=>'GroupDisburse','action'=>'edit',
			);
			$link_info=array('module'=>'group','controller'=>'client','action'=>'view-clientinfo',);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('loan_number'=>$link,'client_name_kh'=>$link_info,'client_name_en'=>$link_info));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$frm = new Loan_Form_FrmRepaymentSchedule();
		$frm = $frm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
	}
  function addAction()
  {
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try {
				$db = new Loan_Model_DbTable_DbLoanGroup();
				$db->addNewLoanGroup($_data);
				if(!empty($_data['saveclose'])){
// 					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/GroupDisburse/index");
				}else{
					//Application_Form_FrmMessage::message("INSERT_SUCCESS");
				}
				
				
			}catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				echo $err;exit();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$frm = new Loan_Form_FrmLoan();
		$frm_loan=$frm->FrmAddLoan();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_loan = $frm_loan;
		$frmpopup = new Application_Form_FrmPopupGlobal();
		$this->view->frmpupopclient = $frmpopup->frmPopupClient();
		$this->view->frmPopupCO = $frmpopup->frmPopupCO();
		$this->view->frmPopupZone = $frmpopup->frmPopupZone();
		$this->view->frmPopupCommune = $frmpopup->frmPopupCommune();
		$this->view->frmPopupDistrict = $frmpopup->frmPopupDistrict();
		$this->view->frmPopupVillage = $frmpopup->frmPopupVillage();
		$db_option = new Application_Model_GlobalClass();
		$this->view->member_option = $db_option->getAllClientGroupOption();
		$this->view->code_option = $db_option->getAllClientCodeOption();
		
	}
	function editAction()
	{
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try {
				$db = new Loan_Model_DbTable_DbLoanGroup();
				$db->upDateLoanDisburse($_data);
				if(!empty($_data['saveclose'])){
					// 					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/GroupDisburse/index");
				}else{
					//Application_Form_FrmMessage::message("INSERT_SUCCESS");
				}
	
	
			}catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				echo $err;exit();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$id = $this->getRequest()->getParam('id');
		$db = new Loan_Model_DbTable_DbLoanIL();
		$row = $db->getTranLoanByIdWithBranch($id);
		$frm = new Loan_Form_FrmLoan();
		$frm_loan=$frm->FrmAddLoan($row);
		$db = new Loan_Model_DbTable_DbLoanGroup();
		$this->view->list_members = $db->getAllMemberLoanById($id);
	
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_loan = $frm_loan;
		$frmpopup = new Application_Form_FrmPopupGlobal();
		$this->view->frmpupopclient = $frmpopup->frmPopupClient();
		$this->view->frmPopupCO = $frmpopup->frmPopupCO();
		$this->view->frmPopupZone = $frmpopup->frmPopupZone();
		$this->view->frmPopupCommune = $frmpopup->frmPopupCommune();
		$this->view->frmPopupDistrict = $frmpopup->frmPopupDistrict();
		$this->view->frmPopupVillage = $frmpopup->frmPopupVillage();
		$db_option = new Application_Model_GlobalClass();
		$this->view->member_option = $db_option->getAllClientGroupOption();
		$this->view->code_option = $db_option->getAllClientCodeOption();
	
	}	
// 	public function addloanAction(){
// 		if($this->getRequest()->isPost()){
// 			$data=$this->getRequest()->getPost();
// 			$db = new Loan_Model_DbTable_DbLoan();
// 			$id = $db->addNewLoanGroup($data);
// 			$suc = array('sms'=>'ប្រាក់ឥណទានត្រូវបានបញ្ចូលដោយជោគជ័យ !');
// 			print_r(Zend_Json::encode($suc));
// 			exit();
// 		}
// 	}
	function getclientgroupAction()
	{
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoanGroup();
			$result = $db->getAllMemberByGroup($data['group_id']);
			print_r(Zend_Json::encode($result));
			exit();
		}
	}
}

