<?php
class Loan_BadloanController extends Zend_Controller_Action {
	
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	
	public function indexAction()
	{
		try{
			$db = new Loan_Model_DbTable_DbBadloan();
			$rs_rows= $db->getAllBadloan($search=null);//call frome model
// 			$glClass = new Application_Model_GlobalClass();
// 			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH ","CLIENT_CODE","CLIENT_NAME","NUMBER_CODE","DATE","LOSS_DATE"
					,"TOTAL_AMOUNT","INTEREST_AMOUNT","TEM","NOTE");
			$link=array(
					'module'=>'loan','controller'=>'BadLoan','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('branch'=>$link,'client_code'=>$link
					,'client_name'=>$link,'client_code'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
	}
	public function addAction(){
		if($this->getRequest()->isPost()){//check condition return true click submit button
			$_data = $this->getRequest()->getPost();
			try {
		
				$_dbmodel = new Loan_Model_DbTable_DbBadloan();
				$_dbmodel->addbadloan($_data);
				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan/add");
			}catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$fm = new Loan_Form_Frmbadloan();
		$frm = $fm->FrmBadLoan();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_loan = $frm;
	}
	public function editAction()
	{
		// action body
	if($this->getRequest()->isPost()){//check condition return true click submit button
			$_data = $this->getRequest()->getPost();
			try {
		
				$_dbmodel = new Loan_Model_DbTable_DbBadloan();
				$_dbmodel->updatebadloan($_data);
				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan/add");
			}catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
	      }
		$id = $this->getRequest()->getParam('id');
		// 		if(empty($id)){
		// 			Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);
		// 		}
		$db = new Loan_Model_DbTable_DbBadloan();
		$row  = $db->getbadloanbyid($id);
		$fm = new Loan_Form_Frmbadloan();
		$frm = $fm->FrmBadLoan($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_loan = $frm;
	
		 
	}
	public function getLoaninfoAction(){
		if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db=new Loan_Model_DbTable_DbBadloan();
			$row=$db->getLoanInfo($data['loan_id']);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
}

