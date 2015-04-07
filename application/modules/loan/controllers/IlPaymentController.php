<?php
class Loan_IlPaymentController extends Zend_Controller_Action {
	private $activelist = array('មិនប្រើ​ប្រាស់', 'ប្រើ​ប្រាស់');
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	private $sex=array(1=>'M',2=>'F');
	public function indexAction(){
		try{
			$db = new Loan_Model_DbTable_DbLoanILPayment();
// 			if($this->getRequest()->isPost()){
// 				$search=$this->getRequest()->getPost();
// 			}
// 			else{
// 				$search = array(
// 						'adv_search' => '',
// 						'status' => -1);
// 			}
			$rs_rows= $db->getAllIndividuleLoan();
			$result = array();
			$list = new Application_Form_Frmtable();
			$collumns = array("Branch","Client Name","Reciept No","Loan Number","Principal","Paid Principal","Total Pay","Due Date",
				"CO","status");
			$link=array(
					'module'=>'loan','controller'=>'il-payment','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('client_name'=>$link,'receipt_no'=>$link,'branch'=>$link));
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
  	$db = new Loan_Model_DbTable_DbLoanILPayment();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			$identify = $_data["identity"];
			try {
				if($identify==""){
					Application_Form_FrmMessage::Sucessfull("Client no laon to pay!","/loan/il-payment/");
					//exit();
				}else {
					
					$db->addILPayment($_data);
					Application_Form_FrmMessage::Sucessfull("EDIT_SUCCESS","/loan/il-payment/");
				}
			}catch (Exception $e) {
				echo $e->getMessage();
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmAddIlPayment();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_ilpayment = $frm_loan;
		
		$list = new Application_Form_Frmtable();
		$collumns = array("ឈ្មោះមន្ត្រីឥណទាន","ថ្ងៃបង់ប្រាក់","ប្រាក់ត្រូវបង់","ប្រាក់ដើមត្រូវបង់","អាត្រាការប្រាក់","ប្រាក់ផាកពិន័យ","ប្រាក់បានបង់សរុប","សមតុល្យ","កំណត់សម្គាល់");
		$link=array(
				'module'=>'group','controller'=>'Client','action'=>'edit',
		);
		$this->view->list=$list->getCheckList(0, $collumns, array(),array('client_number'=>$link,'name_kh'=>$link,'name_en'=>$link));
		
		$db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$this->view->client = $db->getAllClient();
		$this->view->clientCode = $db->getAllClientCode();
		
		$session_user=new Zend_Session_Namespace('auth');
		$this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
	}	
	
	function editAction()
	{
		$id = $this->getRequest()->getParam("id");
		$db = new Loan_Model_DbTable_DbLoanILPayment();
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			$identify = $_data["identity"];
			try {
				if($identify==""){
					Application_Form_FrmMessage::Sucessfull("Client no laon to pay!","/loan/il-payment/");
					//exit();
				}else {
					$db->updateIlPayment($_data);
					Application_Form_FrmMessage::Sucessfull("EDIT_SUCCESS","/loan/il-payment/");
				}
			}catch (Exception $e) {
				echo $e->getMessage();
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$payment_il = $db->getIlPaymentByID($id);
		
		$getIlDetail = $db->getIlDetail($id);
		
// 		merge array;
// 		$condiction = array(
// 				'type'	=>	3,
// 				'loan_number' =>$payment_il["group_id"]
// 		);
// 		$db_il = new Loan_Model_DbTable_DbLoanILPayment();
// 			$row = $db_il->getLoanPaymentByLoanNumber($condiction);
			
// 		$new_array = array_merge($getIlDetail,$row);
			//print_r($new_array);
		$frm = new Loan_Form_FrmIlPayment();
		$frm_loan=$frm->FrmAddIlPayment($payment_il);
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		//$aaray = array_m
		$this->view->frm_ilpayment = $frm_loan;
		$this->view->ilPayent = $getIlDetail;
		$this->view->client_id=$payment_il["group_id"];
		$this->view->client_code=$payment_il["group_id"];
		$this->view->branch_id=$payment_il["branch_id"];
		$this->view->loan_number=$payment_il["loan_number"];
		
		$this->view->client = $db->getAllClient();
		$this->view->clientCode = $db->getAllClientCode();
		
		$db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$session_user=new Zend_Session_Namespace('auth');
		$this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
	
	}
	function getLoannumberAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoanIL();
			$row = $db->getLoanPaymentByLoanNumber($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	
	}
	public function generateBarcodeAction(){
		$loan_code = $this->getRequest()->getParam('loan_code');
// 		if(!empty($id)){
// 			$db = new Application_Model_DbTable_DbGlobal();
// 			$sql=" SELECT p_code FROM tb_product WHERE pro_id = ".$id." LIMIT 1 ";
// 			$row=$db->getGlobalDbRow($sql);
// 			$_itemcode=$row["p_code"];
			header('Content-type: image/png');
			
			$this->_helper->layout()->disableLayout();
			//$barcodeOptions = array('text' => "$_itemcode",'barHeight' => 30);
			$barcodeOptions = array('text' => "$loan_code",'barHeight' => 40);
			//'font' => 4(set size of label),//'barHeight' => 40//set height of img barcode
			$rendererOptions = array();
			$renderer = Zend_Barcode::factory(
					'code128', 'image', $barcodeOptions, $rendererOptions
			)->render();
// 		}
	
	}
	public function showBarcodesAction(){
		$this->_helper->layout()->disableLayout();
		$id = $this->getRequest()->getParam('id');
		if(!empty($id)){
			$ids=explode(',', $id);
			$this->view->pro_id = $ids;
		}
		else{
			//$this->_redirect("/product/index/index");
		}
	
	}
	public function generateBarcodevssAction(){
		$id = $this->getRequest()->getParam('id');
		header('Content-type: image/png');
		$this->_helper->layout()->disableLayout();
		//$barcodeOptions = array('text' => "$_itemcode",'barHeight' => 30);
		$barcodeOptions = array('text' => "Developed By VSS",'barHeight' => 20);
		//'font' => 4(set size of label),//'barHeight' => 40//set height of img barcode
		$rendererOptions = array();
		$renderer = Zend_Barcode::factory(
				'code128', 'image', $barcodeOptions, $rendererOptions
		)->render();
	
	}
	
	function getIlLoanDetailAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoanILPayment();
			$row = $db->getLoanPaymentByLoanNumber($data);
			print_r(Zend_Json::encode($row));
			exit();
		}
	}
}

