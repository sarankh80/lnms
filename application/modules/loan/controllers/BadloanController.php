<?php
class Loan_BadloanController extends Zend_Controller_Action {
	
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
// 		try{
// 			if($this->getRequest()->isPost()){
// 				$_data=$this->getRequest()->getPost();
// 				$search = array(
// 						'title' => $_data['title'],
// 						'status' => $_data['status_search']);
// 			}
// 			else{
		
// 				$search = array(
// 						'title' => '',
// 						'status' => -1,
// 				);
		
// 			}
// 			$db = new Callteral_Model_DbTable_DbBadloan();
// 			$rs_rows= $db->getAllBadloan($search);
		
// 			$glClass = new Application_Model_GlobalClass();
// 			$rs = $glClass->getImgActive($rs_rows, BASE_URL, true,null,1);
		
// 			$list = new Application_Form_Frmtable();
// 			$collumns = array("Client Name","Total Amount","Interest amount","Date","Term","Note");
// 			$link=array(
// 					'module'=>'callteral','controller'=>'badloan','action'=>'loan',
// 			);
// 			$this->view->list=$list->getCheckList(0, $collumns, $rs,array('province_kh_name'=>$link,'province_en_name'=>$link));
// 		}catch (Exception $e){
// 			Application_Form_FrmMessage::message("Application Error");
// 			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
// 		}
// 		$frm = new Application_Form_FrmAdvanceSearch();
// 		$frm = $frm->AdvanceSearch();
// 		Application_Model_Decorator::removeAllDecorator($frm);
// 		$this->view->frm_search = $frm;
	}
	public function addAction(){
		if($this->getRequest()->isPost()){//check condition return true click submit button
			$_data = $this->getRequest()->getPost();
			try {
		
				$_dbmodel = new Loan_Model_DbTable_DbBadloan();
				$_dbmodel->addbadloan($_data);
				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/callteral/badloan/index");
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

}

