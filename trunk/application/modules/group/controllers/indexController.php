<?php
class Group_indexController extends Zend_Controller_Action {
	const REDIRECT_URL = '/group/index';
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	private $sex=array(1=>'M',2=>'F');
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
						);
			}
			else{
				$search = array(
						'adv_search' => '',
						'status' => -1,
						'province_id'=>-1,
						'district_id'=>-1,
						'comm_id'=>-1,
						'village'=>-1,);
			}
			
			$rs_rows= $db->getAllClients($search);
			$result = array();
			foreach ($rs_rows as $key =>$rs){
				$result[$key]=array(
						'client_id'=>$rs['client_id'],
						'client_number'=>$rs['client_number'],
						'name_kh'=>$rs['name_kh'],
						'name_en'=>$rs['name_en'],
						'sex'=>$this->sex[$rs['sex']],
						'phone'=>$rs['phone'],
						'house'=>$rs['house'],
						'street'=>$rs['street'],
						'village_name'=>$rs['village_name'],
						'spouse_name'=>$rs['spouse_name'],
						'user_name'=>$rs['user_name'],
						'status'=>$rs['status'],
				);
			}
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($result, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("Client N.","Name Khmer","Name Eng","Sex","Phone","House","Street","Village","Spouse Name",
					"By","status");
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
// 	function provinceidAction(){
	
// 		if($this->getRequest()->isPost()){
// 			$db = new Group_Model_DbTable_DbClient();
// 			$data = $this->getRequest()->getPost();
// 			$row = $db->getClientById($data);
// 			print_r($row);exit();
// 			$this->view->row=$row;
// 		}
// 	}
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
				else if (isset($data['close'])){
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
				Application_Form_FrmMessage::Sucessfull("ការកែប្រែដោយ​ជោគ​ជ័យ !","/group/index");
			}catch (Exception $e){
				Application_Form_FrmMessage::message("INSERT_FAILE");
				echo $e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			}
		}
		$id = $this->getRequest()->getParam("id");
		$row = $db->getClientById($id);
	    $this->view->row=$row;
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

