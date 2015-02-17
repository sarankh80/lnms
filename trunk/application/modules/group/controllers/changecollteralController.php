<?php
class Group_ChangecollteralController extends Zend_Controller_Action {
	const REDIRECT_URL='/group';
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
			try{
				$db = new Group_Model_DbTable_DbCallteral();
			    		if($this->getRequest()->isPost()){
			    			$search=$this->getRequest()->getPost();
			    		}
			    		else{
			    			$search = array(
			    					'adv_search' => '',
			    					'status_search' => -1);
			    		}
			$rs_rows= $db->geteAllcallteral($search);//call frome model
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH","CODE_CALLTERAL","STAFF_NAME ","CLIENT_CODE","CLIENT_NAME","OWNER","COLLTERAL_TYPE","CONTRACT_CODE","DATE","NOTE","STATUS");
			$link=array(
					'module'=>'group','controller'=>'callteral','action'=>'edit',
			);
// 			print_r($rs_rows);exit();
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('branch_name'=>$link,'code_call'=>$link,'co_id'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$fm=new Group_Form_Frmcallterals();
		$frm=$fm->FrmCallTeral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_callteral=$frm;
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$calldata=$this->getRequest()->getPost();
			$db_call = new Group_Model_DbTable_DbCallteral();
			try {
				$db = $db_call->addcallteral($calldata);
				if(!empty($calldata['save_new'])){
					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
				}else{
					Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL . '/Callteral/index');
				}
			} catch (Exception $e) { 
				echo $e->getMessage();exit();
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
		$fm = new Group_Form_Frmchangecollteral();
		$frm = $fm->FrmChangeCollteral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_changeCollteral = $frm;
		
	}
	public function editAction()
	{
	if($this->getRequest()->isPost()){
			$calldata=$this->getRequest()->getPost();
			$db_call = new Group_Model_DbTable_DbCallteral();
			try {
				$db = $db_call->updatecallteral($calldata);
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL. '/Callteral/index');
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
		$fm = new Group_Form_Frmchangecollteral();
		$frm = $fm->FrmChangeCollteral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_changeCollteral = $frm;
	
    }
    public function getOwnerinfo(){
    	if($this->getRequest()->isPost()){
    		$data=$this->getRequest()->isPost();
    		$db =new Group_Model_DbTable_DbChangeCollteral();
    		$row=$db->getOwnerInfo($data['owner_id']);
    		print_r(Zend_Json::encode($row));
    		exit();
    	}
    }
}
