<?php
class Loan_TransfercoController extends Zend_Controller_Action {
	
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	
	public function indexAction()
	{
	try{
 			$db = new Loan_Model_DbTable_DbTransferCo(); 
 			$rs_rows= $db->getAllinfoCo($search=null);//call frome model
// // 			$glClass = new Application_Model_GlobalClass();
// // 			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH_NAME","NAME_FROM","NAME_TO","CODE_FORM","CODE_TO","DATE","NOTE","STATUS",);
 			$link=array(
					'module'=>'loan','controller'=>'transferco','action'=>'edit',
 			);
 			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('from'=>$link,'to'=>$link));
 		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
 			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
 		}
	}
	public function addAction(){
		if($this->getRequest()->isPost()){//check condition return true click submit button			
 			$_data = $this->getRequest()->getPost();
 			//print_r($_data);exit();
 			try {		
 				$db = new Loan_Model_DbTable_DbTransferCo(); 				 				
 				$db->insertTransfer($_data);
 				
// 				$_dbmodel->addbadloan($_data);
 				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/Transferco/add");
 			}catch (Exception $e) {
 				Application_Form_FrmMessage::message("INSERT_FAIL");
 				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
 		}
		$fm = new Loan_Form_FrmTransfer();
		$frm = $fm->FrmTransfer();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_transfer = $frm;
	}
	public function editAction()
	{
		// action body
	if($this->getRequest()->isPost()){//check condition return true click submit button
			$_data = $this->getRequest()->getPost();
			try {		
				$_dbmodel = new Loan_Model_DbTable_DbBadloan();
				if(isset($_data['btn_save'])){
					$_dbmodel->updatebadloan($_data);
					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan/add");
				}else if(isset($_data['btn_save_close"'])){
					$_dbmodel->updatebadloan($_data);
					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/BadLoan");
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

