<?php
class Loan_GroupPaymentController extends Zend_Controller_Action {
	public function init()
	{
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	private $sex=array(1=>'M',2=>'F');
	public function indexAction(){
		try{
			$db = new Group_Model_DbTable_DbClient();
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'adv_search' => '',
						'status' => -1);
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
			$collumns = array("Client No","Client ID","Client Name(Kh)","Release Amount","Method","Time Collection","Zone","CO Name",
				"By","status");
			$link=array(
					'module'=>'group','controller'=>'Client','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, array(),array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$frm = new Application_Form_FrmAdvanceSearch();
		$frm = $frm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
	}
	function addAction()
	{
		
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try {
				
			}catch (Exception $e) {
				
			}
		}
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmGroupPayment();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
	
		$list = new Application_Form_Frmtable();
		$collumns = array("ឈ្មោះមន្ត្រីឥណទាន","ថ្ងៃបង់ប្រាក់","ប្រាក់ត្រូវបង់","ប្រាក់ដើមត្រូវបង់","អាត្រាការប្រាក់","ប្រាក់ផាកពិន័យ","ប្រាក់បានបង់សរុប","សមតុល្យ","កំណត់សម្គាល់");
		$link=array(
				'module'=>'group','controller'=>'Client','action'=>'edit',
		);
		$this->view->list=$list->getCheckList(0, $collumns, array(),array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
	
	}
	function getLoanDetailAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoanIL();
			$row = $db->getGroupLoadDetail($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
	function getLoannumberAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoanGroup();
			$row = $db->getLoanPaymentByLoanNumber($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
}

