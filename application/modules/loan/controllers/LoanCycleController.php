<?php
class Loan_LoanCycleController extends Zend_Controller_Action {
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
			$db = new Loan_Model_DbTable_DbLoanIL();
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'client_id' => -1,
						'status' => -1,
						'from_date' =>date('Y-m-d'),
						'to_date' => date('Y-m-d'),
						 );
			}
			$rs_rows= $db->getAllIndividuleLoan($search);
// 			print_r($rs_rows);
// 			foreach ($rs_rows as $key =>$rs){
// // 				$result[$key]=array(
// // 						'client_id'=>$rs['client_id'],
// // 						'client_number'=>$rs['client_number'],
// // 						'name_kh'=>$rs['name_kh'],
// // 						'name_en'=>$rs['name_en'],
// // 						'sex'=>$this->sex[$rs['sex']],
// // 						'phone'=>$rs['phone'],
// // 						'house'=>$rs['house'],
// // 						'street'=>$rs['street'],
// // 						'village_name'=>$rs['village_name'],
// // 						'spouse_name'=>$rs['spouse_name'],
// // 						'user_name'=>$rs['user_name'],
// // 						'status'=>$rs['status'],
// // 						);
// 			}
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("Client Name","Client NameKh","Release Amount","Interest Rate","Method","Time Collect","Zone","CO",
				"By","status");
			$link=array(
					'module'=>'group','controller'=>'Client','action'=>'edit',
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
  }
  function addAction()
  {
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try {
				$_dbmodel = new Loan_Model_DbTable_DbLoanIL();
				$_dbmodel->addNewLoanIL($_data);
// 				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/index/index");
			}catch (Exception $e) {
				echo $err =$e->getMessage();exit();
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$frm = new Loan_Form_FrmLoan();
		$frm_loan=$frm->FrmAddLoan();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_loan = $frm_loan;
		$frmpopup = new Application_Form_FrmPopupGlobal();
		$this->view->frmpupopclient = $frmpopup->frmPopupClient();
		$this->view->frmPopupCO = $frmpopup->frmPopupCO();
		$this->view->frmPopupZone = $frmpopup->frmPopupZone();
		$this->view->frmPopupCommune = $frmpopup->frmPopupCommune();
		$this->view->frmPopupDistrict = $frmpopup->frmPopupDistrict();
		$this->view->frmPopupVillage = $frmpopup->frmPopupVillage();
		
		
		
		
		
		
	}	
	public function addloanAction(){
		if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Loan_Model_DbTable_DbLoan();
			$id = $db->addNewLoanGroup($data);
			$suc = array('sms'=>'ប្រាក់ឥណទានត្រូវបានបញ្ចូលដោយជោគជ័យ !');
			print_r(Zend_Json::encode($suc));
			exit();
		}
	}
	function addAddAction()
	{
		if($this->getRequest()->isPost()){
		}
		$frm = new Loan_Form_FrmLoan();
		$frm_loan=$frm->FrmAddLoan();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_loan = $frm_loan;
	}
	public function testAction(){
		$start = '2014-01-01';
		$db = new Application_Model_DbTable_DbGlobal();
		$rs = $db->checkHolidayExist(1,$start);
		echo $rs;
// 		print_r($rs);
// 		exit();
		
	}
}

