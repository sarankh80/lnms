<?php
class accounting_ChartaccountController extends Zend_Controller_Action {
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Accounting_Model_DbTable_DbChartaccount();
			//print_r($db);exit();
			try {
				$db->addchartaccount($data);
				Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$fm = new Accounting_Form_FrmChartaccount();
		$frm = $fm->FrmChartaccount();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_fixedasset = $frm;
	}
public function indexAction()
	{
	try{
			$db = new Accounting_Model_DbTable_DbChartaccount();
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'adv_search' => '',
						'status' => -1);
			}
			
			$rs_rows= $db->getAllchartaccounts($search);
			
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("ACCOUNT_TYPE","PARENT","CATEGORY","ACCOUNT_CODE","ACCOUNT_NAME_EN","ACCOUNT_NAME_KH","STATUS");
			$link=array(
					'module'=>'accounting','controller'=>'chartaccount','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('account_name_en'=>$link,));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error"); 
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$fm = new Application_Form_FrmAdvanceSearch();
		$frm = $fm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
		
		$fms = new Accounting_Form_FrmChartaccount();
		$frms = $fms->FrmChartaccount();
		Application_Model_Decorator::removeAllDecorator($frms);
		$this->view->frm_chartaccount = $frms;
	
	}
	public function editAction()
	{
		if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Accounting_Model_DbTable_DbChartaccount();
			try {
				$db->updatchartaccount($data);
				Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err = $e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
					
			}
		}
		$id = $this->getRequest()->getParam('id');
			
		$db = new Accounting_Model_DbTable_DbChartaccount();
		$row  = $db->getechartaccountbyid($id);
		$fm = new Accounting_Form_FrmChartaccount();
		$frm = $fm->FrmChartaccount($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_fixedasset = $frm;
	
	}
}
