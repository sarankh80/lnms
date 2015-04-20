<?php
class Group_ChangecollteralController extends Zend_Controller_Action {
	const REDIRECT_URL='/group';protected $tr;
	public function init()
	{$this->tr=Application_Form_FrmLanguages::getCurrentlanguage();
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
			try{
				$db = new Group_Model_DbTable_DbChangeCollteral();
			    		if($this->getRequest()->isPost()){
			    			$search=$this->getRequest()->getPost();
			    		}
			    		else{
			    			$search = array(
			    					'adv_search' => '',
			    					'status_search' => -1);
			    		}
			$rs_rows= $db->getAllChangeCollteral($search);//call frome model
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH_NAME","CUSTOMER_CODE","OWNER_NAME","FROM_COLL","TO_COLL","COLLTERAL_TYPE","NUMBER_COLLTERAL","OWNER_NAME","DATE","NOTE","STATUS","BY");
			$link=array(
					'module'=>'group','controller'=>'changecollteral','action'=>'edit',
			);
// 			print_r($rs_rows);exit();
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('branch_id'=>$link,'owner_code_id'=>$link,'owner_id'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$fm = new Group_Form_Frmchangecollteral();
		$frm = $fm->FrmChangeCollteral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_changeCollteral = $frm;
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Group_Model_DbTable_DbChangeCollteral();
			try {
				 $db->addChangeCollteral($data);
				if(!empty($data['save_new'])){
					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
				}else{
					Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL . '/changecollteral/index');
				}
			} catch (Exception $e) { 
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
	$db = new Group_Model_DbTable_DbChangeCollteral();
	if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			try {
				$db->updateChangeCollteral($data);
				Application_Form_FrmMessage::Sucessfull($this->tr->translate('EDIT_SUCCESS'), self::REDIRECT_URL. '/changecollteral/index');
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$id = $this->getRequest()->getParam('id');
		if(empty($id)){
			Application_Form_FrmMessage::Sucessfull($this->tr->translate('EDIT_SUCCESS'), self::REDIRECT_URL);
		}
		$row  = $db->getChangeCollteralbyid($id);
		$fm = new Group_Form_Frmchangecollteral();
		$frm = $fm->FrmChangeCollteral($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_changeCollteral = $frm;
	
    }
    public function getOwnerinfoAction(){
    	if($this->getRequest()->isPost()){
    		$data=$this->getRequest()->getPost();
    		$db =new Group_Model_DbTable_DbChangeCollteral();
    		$row=$db->getOwnerInfo($data['owner_id']);
    		print_r(Zend_Json::encode($row));
    		exit();
    	}
    }
}
