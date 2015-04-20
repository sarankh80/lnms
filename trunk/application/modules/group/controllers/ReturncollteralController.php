<?php
class Group_ReturncollteralController extends Zend_Controller_Action {
	const REDIRECT_URL='/group';protected $tr;
	public function init()
	{$this->tr=Application_Form_FrmLanguages::getCurrentlanguage();
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
			try{
				$db = new Group_Model_DbTable_DbReturnCollteral();
			    		if($this->getRequest()->isPost()){
			    			$search=$this->getRequest()->getPost();
			    		}
			    		else{
			    			$search = array(
			    					'adv_search' => '',
			    					'status_search' => -1);
			    		}//print_r($search);exit();
			$rs_rows= $db->getAllReturnCollteral($search);//call frome model
			$glClass = new Application_Model_GlobalClass();
			$rs_rowss = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("GIVER_NAME","RECEIVER_NAME","COLETERAL_TYPE","NUMBER_COLLTERAL","DATE","NOTE","STATUS","BY_USER");
			$link=array(
					'module'=>'group','controller'=>'Returncollteral','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rowss,array('giver_name'=>$link,'receiver_name'=>$link,'date'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$fm = new Group_Form_Frmreturncollteral();
		$frm = $fm->FrmReturnCollteral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_returnCollteral = $frm;
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Group_Model_DbTable_DbReturnCollteral();
			try {
				 $db->addReturnCollteral($data);
				if(!empty($data['save_new'])){
					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
				}else{
					Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL . '/Returncollteral/index');
				}
			} catch (Exception $e) { 
				Application_Form_FrmMessage::message("Application Error");
				Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$fm = new Group_Form_Frmreturncollteral();
		$frm = $fm->FrmReturnCollteral();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_returnCollteral = $frm;
		
	}
	public function editAction()
	{
	$db = new Group_Model_DbTable_DbReturnCollteral();
	if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			try {
				$db->updateReturnCollteral($data);
				Application_Form_FrmMessage::Sucessfull("EDIT_SUCCESS", self::REDIRECT_URL. '/Returncollteral/index');
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("Application Error");
				Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$id = $this->getRequest()->getParam('id');
		if(empty($id)){
			Application_Form_FrmMessage::Sucessfull($this->tr->translate("EDIT_SUCCESS"), self::REDIRECT_URL);
		}
		$row  = $db->getReturnCollteralbyid($id);
		$fm = new Group_Form_Frmreturncollteral();
		$frm = $fm->FrmReturnCollteral($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_returnCollteral = $frm;
	
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
