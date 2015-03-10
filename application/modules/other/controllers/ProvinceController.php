<?php
class Other_ProvinceController extends Zend_Controller_Action {
	const REDIRECT_URL ='/other';
	protected $tr;
	public function init()
	{
		/* Initialize action controller here */
		$this->tr=Application_Form_FrmLanguages::getCurrentlanguage();
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
		try{
			if($this->getRequest()->isPost()){
				$_data=$this->getRequest()->getPost();
				$search = array(
						'title' => $_data['title'],
						'status' => $_data['status_search']);
			}
			else{
		
				$search = array(
						'title' => '',
						'status' => -1,
				);
		
			}
			$db = new Other_Model_DbTable_DbProvince();
			$rs_rows= $db->getAllProvince($search);
		
			$glClass = new Application_Model_GlobalClass();
			$rs = $glClass->getImgActive($rs_rows, BASE_URL, true,null,1);
		
			$list = new Application_Form_Frmtable();
			$collumns = array("EN_PROVINCE","KH_PROVINCE","DISPLAY_BY","MODIFY_DATE","STATUS","BY_USER");
			$link=array(
					'module'=>'other','controller'=>'Province','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs,array('province_kh_name'=>$link,'province_en_name'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$frm = new Other_Form_FrmSearch();
		$frm =$frm->searchProvinnce();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
	}
	function addAction()
	{
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try {
				$_dbmodel = new Other_Model_DbTable_DbProvince();
				$_dbmodel->addNewProvince($_data);
				if(!empty($_data['save_new'])){
					Application_Form_FrmMessage::message($this->tr->translate("INSERT_SUCCESS"));
				}else{
					Application_Form_FrmMessage::Sucessfull($this->tr->translate("INSERT_SUCCESS"),self::REDIRECT_URL."/Province/index");
				}
			}catch (Exception $e) {
				Application_Form_FrmMessage::message($this->tr->translate("INSERT_FAIL"));
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$fm=new Other_Form_FrmProvince();
		$frm_province=$fm->FrmProvince();
		Application_Model_Decorator::removeAllDecorator($frm_province);
		$this->view->frm_province = $frm_province;
	}
	function editAction(){
		$id=$this->getRequest()->getParam("id");
		$db=new Other_Model_DbTable_DbProvince();
		$row=$db->getProvinceById($id);
		if($this->getRequest()->isPost())
		{
			$data = $this->getRequest()->getPost();
			$db = new Other_Model_DbTable_DbProvince();
			try {
			$db->updateProvince($data,$id);
				Application_Form_FrmMessage::Sucessfull($this->tr->translate("EDIT_SUCCESS"),self::REDIRECT_URL . "/Province/index");
			}catch (Exception $e){
				Application_Form_FrmMessage::message($this->tr->translate("EDIT_FAIL"));
				$err=$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$frm= new Other_Form_FrmProvince();
		$update=$frm->FrmProvince($row);
		$this->view->frm_province=$update;
		Application_Model_Decorator::removeAllDecorator($update);
	}
}
