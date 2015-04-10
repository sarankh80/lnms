<?php
class Group_indexController extends Zend_Controller_Action {
	const REDIRECT_URL = '/group/index';protected $tr;
	public function init()
	{$this->tr=Application_Form_FrmLanguages::getCurrentlanguage();
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	private $_sex = array(1=>'M',2=>'F');
	public function indexAction(){
		try{
			$db = new Group_Model_DbTable_DbClient();
			if($this->getRequest()->isPost()){
				$formdata=$this->getRequest()->getPost();
				$search = array(
						'adv_search' => $formdata['adv_search'],
						'province_id'=>$formdata['province'],
						'comm_id'=>$formdata['commune'],
						'district_id'=>$formdata['district'],
						'village'=>$formdata['village'],
						'status'=>$formdata['status'],
						'start_date'=> $formdata['start_date'],
						'end_date'=>$formdata['end_date']
						);
			}
			else{
				$search = array(
						'adv_search' => '',
						'status' => -1,
						'province_id'=>0,
						'district_id'=>'',
						'comm_id'=>'',
						'village'=>'',
						'start_date'=> date('Y-m-01'),
						'end_date'=>date('Y-m-d'));
			}
			
			$rs_rows= $db->getAllClients($search);
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("CUSTOMER_CODE","CLIENTNAME_KH","CLIENTNAME_EN","SEX","PHONE","HOUSE","STREET","VILLAGE","SPOUSE_NAME",
					"DATE","BY_USER","STATUS");
			$link=array(
					'module'=>'group','controller'=>'index','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
	
		$frm = new Application_Form_FrmAdvanceSearch();
		$frm = $frm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
		
		$fm = new Group_Form_FrmClient();
		$frm = $fm->FrmAddClient();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_client = $frm;
		$db= new Application_Model_DbTable_DbGlobal();
		$this->view->district = $db->getAllDistricts();
		$this->view->commune_name = $db->getCommune();
		$this->view->village_name = $db->getVillage();
		
		$this->view->result=$search;	
	}
	public function addAction(){
		if($this->getRequest()->isPost()){
				$data = $this->getRequest()->getPost();
				//print_r($data);exit();
				$db = new Group_Model_DbTable_DbClient();
				try{
				 if(isset($data['save_new'])){
					$db->addClient($data);
					Application_Form_FrmMessage::message("ការ​បញ្ចូល​ជោគ​ជ័យ !");
				}
				else if (isset($data['save_close'])){
					$db->addClient($data);
					Application_Form_FrmMessage::message("ការ​បញ្ចូល​ជោគ​ជ័យ !");
					Application_Form_FrmMessage::redirectUrl("/group/index");
				}
			}catch (Exception $e){
				Application_Form_FrmMessage::message("Application Error");
				echo $e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$fm = new Group_Form_FrmClient();
		$frm = $fm->FrmAddClient();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_client = $frm;
		
		$db= new Application_Model_DbTable_DbGlobal();
		$this->view->district = $db->getAllDistricts();
		$this->view->commune_name = $db->getCommune();
		$this->view->village_name = $db->getVillage();
	}
	public function editAction(){
		$db = new Group_Model_DbTable_DbClient();
		if($this->getRequest()->isPost()){
			try{
				$data = $this->getRequest()->getPost();
			    
				$db->addClient($data);
				Application_Form_FrmMessage::Sucessfull($this->tr->translate('EDIT_SUCCESS'),"/group/index");
			}catch (Exception $e){
				Application_Form_FrmMessage::message("INSERT_FAILE");
				echo $e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$id = $this->getRequest()->getParam("id");
		$row = $db->getClientById($id);
	    $this->view->row=$row;
	    echo $row['photo_name'];
		$this->view->photo = $row['photo_name'];
		if(empty($row)){
			$this->_redirect("/group/Client");
		}
		$fm = new Group_Form_FrmClient();
		$frm = $fm->FrmAddClient($row);
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_client = $frm;
		
		$db= new Application_Model_DbTable_DbGlobal();
		$this->view->district = $db->getAllDistricts();
		$this->view->commune_name = $db->getCommune();
		$this->view->village_name = $db->getVillage();
	}
	function viewAction(){
		$id = $this->getRequest()->getParam("id");
		$db_client = new Group_Model_DbTable_DbClient();
		$this->view->client_list = $db_client->getViewClientByGroupId($id);
	}
	public function addNewclientAction(){//ajax
		if($this->getRequest()->isPost()){
			$db = new Group_Model_DbTable_DbClient();
			$data = $this->getRequest()->getPost();
			$_data['status']=1;
			$id = $db->addClient($data);
			print_r(Zend_Json::encode($id));
			exit();
		}
	}
	function getgroupcodeAction(){
		if($this->getRequest()->isPost()){
			$db = new Group_Model_DbTable_DbClient();
			$data = $this->getRequest()->getPost();
			$code = $db->getGroupCode($data);
			print_r(Zend_Json::encode($code));
			exit();
		}
	}
}

