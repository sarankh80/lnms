<?php
class Group_CallteralController extends Zend_Controller_Action {
	const REDIRECT_URL='/group/Callteral';
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
		try{
			$db = new Group_Model_DbTable_DbCallteral();
			//     		if($this->getRequest()->isPost()){
			//     			$search=$this->getRequest()->getPost();
			//     		}
			//     		else{
			//     			$search = array(
			//     					'adv_search' => '',
			//     					'status' => -1);
			//     		}
			$rs_rows= $db->geteAllcallteral($search=null);//call frome model
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("Branch_id ","Code_callteral","Getter_name","Giver_name","Co_id ","Date_delivery","Client_code","Contracts_borrow","Mortgage_Contract","Status");
			$link=array(
					'module'=>'accounting','controller'=>'asset','action'=>'index',
			);
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('asset_name'=>$link,'asset_cost'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$calldata=$this->getRequest()->getPost();
			$db_call = new Group_Model_DbTable_DbCallteral();
			try {
				$db = $db_call->addcallteral($calldata);
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);
			} catch (Exception $e) {
				echo $e->getMessage();exit();
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
		$fm = new Group_Form_Frmcallterals();
		$frm = $fm->FrmCallTeral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_callteral = $frm;
	}
	public function editAction()
	{
	if($this->getRequest()->isPost()){
			$calldata=$this->getRequest()->getPost();
			$db_call = new Group_Model_DbTable_DbCallteral();
			try {
				$db = $db_call->updatecallteral($calldata);
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);
			} catch (Exception $e) {
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
		$id = $this->getRequest()->getParam('id');
		// 		if(empty($id)){
		// 			Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);
		// 		}
		$db = new Group_Model_DbTable_DbCallteral();
		$row  = $db->getecallteralbyid($id);
		$fm = new Group_Form_Frmcallterals();
		$frm = $fm->FrmCallTeral($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_callteral = $frm;
	
    }
}