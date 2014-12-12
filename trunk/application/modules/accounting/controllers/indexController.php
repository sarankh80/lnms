<?php
class Accounting_IndexController extends Zend_Controller_Action {
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
		
	}
	public function addAction(){
		$fm = new Accounting_Form_Frmassetname();
		$frm = $fm->FrmFixedAsset();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_fixedasset = $frm;
	}
	public function addNewclientAction(){
		if($this->getRequest()->isPost()){
			$db = new Group_Model_DbTable_DbClient();
			$data = $this->getRequest()->getPost();
			$_data['status']=1;
			$id = $db->addClient($data);
			print_r(Zend_Json::encode($id));
			exit();
		}
		
	}
}
