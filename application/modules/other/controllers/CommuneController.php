<?php
class Other_CommuneController extends Zend_Controller_Action {
	protected $tr;
	const REDIRECT_URL='/other';
	public function init()
	{
		$this->tr=Application_Form_FrmLanguages::getCurrentlanguage();
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
		try{
			$db = new Other_Model_DbTable_DbCommune();
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'adv_search' => '',
						'search_status' => -1);
			}
			$rs_rows= $db->getAllCommune($search);
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("COMMUNENAME_KH","COMMUNENAME_EN","DISTRICT_NAME","DATE","STATUS","BY");
			$link=array(
					'module'=>'other','controller'=>'Commune','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('commune_namekh'=>$link,'district_name'=>$link,'commune_name'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$frm = new Other_Form_FrmCommune();
		$frm = $frm->FrmAddCommune();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_district = $frm;
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try{
				$db_district = new Other_Model_DbTable_DbCommune();				
				if(!empty($_data['save_new'])){
					$db_district->addCommune($_data);
					Application_Form_FrmMessage::Sucessfull($this->tr->translate("INSERT_SUCCESS"),self::REDIRECT_URL . '/Commune/add');
				}else{
					$db_district->addCommune($_data);
					Application_Form_FrmMessage::Sucessfull($this->tr->translate("INSERT_SUCCESS"),self::REDIRECT_URL . '/Commune/index');
				}
			}catch(Exception $e){
				Application_Form_FrmMessage::message($this->tr->translate("INSERT_FAIL"));
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$fm = new Other_Form_FrmCommune();
		$frm = $fm->FrmAddCommune();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_commune = $frm;
	 $db= new Application_Model_DbTable_DbGlobal();
	 $this->view->district = $db->getAllDistricts();	
	
	}
	public function editAction(){
		$id = $this->getRequest()->getParam('id');
		$db = new Other_Model_DbTable_DbCommune();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			//print_r($_data);exit();
			try{				
				$db->addCommune($_data,$id);
				Application_Form_FrmMessage::Sucessfull($this->tr->translate("EDIT_SUCCESS"),self::REDIRECT_URL.'/Commune/');
			}catch(Exception $e){
				Application_Form_FrmMessage::message($this->tr->translate("EDIT_FAIL"));
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}		
		$row = $db->getCommuneById($id);
		$this->view->row=$row;
		$fm = new Other_Form_FrmCommune();
		$frm = $fm->FrmAddCommune($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_commune = $frm;
		
		$db= new Application_Model_DbTable_DbGlobal();
		$this->view->district = $db->getAllDistricts();
	}
	public function addNewcommuneAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$data['status']=1;
			$db_com = new Other_Model_DbTable_DbCommune();
			$id = $db_com->addCommune($data);
			print_r(Zend_Json::encode($id));
			exit();
		}
	}
}
