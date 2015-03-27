<?php
class Loan_TransfercoLoandController extends Zend_Controller_Action {
	
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	
	public function indexAction()
	{
	try{
 			$db = new Loan_Model_DbTable_DbTransferCoClient(); 
 			$rs_rows= $db->getAllinfoCoLoan($search=null);//call frome model
// // 			$glClass = new Application_Model_GlobalClass();
// // 			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH_NAME","LOAN_NUMBER","NAME_CO","CODE_CO","DATE","NOTE","STATUS",);
 			$link=array(
					'module'=>'loan','controller'=>'transferco-loand','action'=>'edit',
 			);
 			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('loan_number'=>$link,));
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
 				$db = new Loan_Model_DbTable_DbTransferCoClient(); 
 				if(isset($_data['btn_save'])){				 				
	 				$db->insertTransferloan($_data);				
	 				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/transferco-loand/add");
 				}
 				elseif (isset($_data['btn_save_close'])){
 					$db->insertTransferloan($_data);
 					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/transferco-loand/");
 				}
 			}catch (Exception $e) {
 				Application_Form_FrmMessage::message("INSERT_FAIL");
 				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
 		}
		$fm = new Loan_Form_FrmTransferCoClient();
		$frm = $fm->FrmTransfer();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_transfer = $frm;
	}
	public function editAction()
	{
		// action body		
		$id = $this->getRequest()->getParam('id');
		$db = new Loan_Model_DbTable_DbTransferCoClient();
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->getPost();
			//print_r($post);exit(); 			
			if(isset($post['btn_save'])){
				$db->updatTransferloan($post, $id);
				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/transferco-loand/");
			}
		}
		//print_r($id);exit();		
		$data = $db->getAllinfoTransfer($id);
		$fm = new Loan_Form_FrmTransferCoClient();
		$frm = $fm->FrmTransfer($data);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_transfer = $frm;

		 
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

