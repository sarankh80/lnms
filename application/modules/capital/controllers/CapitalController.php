<?php
class Capital_CapitalController extends Zend_Controller_Action {
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	
		public function indexAction(){
		try{
			$db = new Capital_Model_DbTable_DbCapital();
			$rs_rows= $db->getAllCapital($search=null);
			$glClass = new Application_Model_GlobalClass();//status
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL,true);
			$list = new Application_Form_Frmtable();
			$collumns = array("សាខា","ស្ថានភាព","ថ្ងៃ","សម្គាល់","ចំនួនប្រាក់ដុល្លា","ចំនួនប្រាក់រៀល","ចំនួនប្រាក់បាត");
			$link=array(
					'module'=>'capital','controller'=>'capital','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0,$collumns,$rs_rows,array('brance'=>$link,'status'=>$link,'date'=>$link,'note'));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		
	}
	public function addAction()
	{
		if($this->getRequest()->isPost()){
			$accdata=$this->getRequest()->getPost();
			$db_acc = new Capital_Model_DbTable_DbCapital();
			try {
				$db = $db_acc->getUserId($accdata);
				Application_Form_FrmMessage::Sucessfull("ការ​បញ្ចូល​ជោគ​ជ័យ !",'/capital/capital');
			} catch (Exception $e) {
	
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
		$fm = new Capital_Form_FrmCapitale();
		$frm = $fm->frmCapital();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm= $frm;
	}
	function editAction(){
		$db_deposite = new Capital_Model_DbTable_DbCapital();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try{
				$db_deposite->updateCapital($_data);
				Application_Form_FrmMessage::Sucessfull("ការ​បញ្ចូល​ជោគ​ជ័យ !",'/capital/capital');
			}catch(Exception $e){
				Application_Form_FrmMessage::message("ការ​បញ្ចូល​មិន​ជោគ​ជ័យ");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$id = $this->getRequest()->getParam("id");
		$row = $db_deposite->getpartnerById($id);
		$deposite=new Capital_Form_FrmCapitale();
		$frm = $deposite->frmCapital($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm=$frm;
// 		$db = new Application_Model_DbTable_DbGlobal();
// 		$this->view->currency_type = $db->CurruncyTypeOption();
	
// 		$this->view->rs_rows = $db_deposite->getAllCapital($id);
	}
	
}
