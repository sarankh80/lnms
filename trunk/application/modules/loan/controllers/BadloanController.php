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
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
				//print_r($search);exit();
			}
			else{
				$search = array(
						'adv_search' => '',
						'status' => -1);
			}
			$rs_rows= $db->getAllBadloan($search);//call frome model
			$glClass = new Application_Model_GlobalClass();
			$rs_row = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH ","CLIENT_CODE","CLIENT_NAME","DATE","LOSS_DATE"
					,"TOTAL_AMOUNT","INTEREST_AMOUNT","TEM","NOTE","STATUS");
			$link=array(
					'module'=>'loan','controller'=>'BadLoan','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns,$rs_row,array('client_number'=>$link,'branch_namekh'=>$link
					,'client_name'=>$link,'client_code'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$fm = new Loan_Form_Frmbadloan();
		$frm = $fm->FrmBadLoan();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_loan = $frm;
	}
	public function addAction(){
		if($this->getRequest()->isPost()){//check condition return true click submit button
			$_data = $this->getRequest()->getPost();
			//print_r($_data);exit();
			try {		
				$_dbmodel = new Loan_Model_DbTable_DbBadloan();
				if(isset($_data['save'])){
					$_dbmodel->addbadloan($_data);
					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan/add");
				}elseif(isset($_data['save_close'])){
					$_dbmodel->addbadloan($_data);
					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan");
				}				
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
				//print_r($_data);exit();
				$_dbmodel = new Loan_Model_DbTable_DbBadloan();
				if(isset($_data['save'])){
					if($this->getRequest()->getParam('id')==$_data['client_name']){
						$_dbmodel->updatebadloan($_data);
						Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan/add");
					}else{
						$_dbmodel->updatebadloan_bad($_data);
						Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan/add");
					}
				}elseif(isset($_data['save_close'])){
					if($this->getRequest()->getParam('id')==$_data['client_name']){
						$_dbmodel->updatebadloan($_data);
						Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan");
					}else{
						$_dbmodel->updatebadloan_bad($_data);
						Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan");
					}
				}
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

