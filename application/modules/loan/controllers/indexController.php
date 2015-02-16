<?php
class Loan_indexController extends Zend_Controller_Action {
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
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("Loan Number","Client Name","Client NameKh","Release Amount","Interest Rate","Method","Zone","CO",
				"Branch","status");
			$link=array(
					'module'=>'loan','controller'=>'index','action'=>'edit',
			);
			$link_info=array('module'=>'group','controller'=>'client','action'=>'view-clientinfo',);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('loan_number'=>$link,'client_name_kh'=>$link_info,'client_name_en'=>$link_info));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}	
		$frm = new Loan_Form_FrmSearchLoan();
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
				if(empty($_data['saveclose'])){
					Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan");
				}else{
					Application_Form_FrmMessage::message("INSERT_SUCCESS");
				}
			}catch (Exception $e) {
				 $err =$e->getMessage();
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
	public function editAction(){
		if($this->getRequest()->isPost()){
			$_data = $this->getRequest()->getPost();
			try{
				$_dbmodel = new Loan_Model_DbTable_DbLoanIL();
				$_dbmodel->addNewLoanIL($_data);
				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/loan/index/index");
			}catch (Exception $e) {
				echo $err =$e->getMessage();exit();
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		
		$id = $this->getRequest()->getParam('id');
		$db = new Loan_Model_DbTable_DbLoanIL();
		$row = $db->getTranLoanByIdWithBranch($id);
		
		$frm = new Loan_Form_FrmLoan();
		$frm_loan=$frm->FrmAddLoan($row);
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
// 	function getLoannumberAction(){
// 		if($this->getRequest()->isPost()){
// 			$data = $this->getRequest()->getPost();
// 			$db = new Loan_Model_DbTable_DbLoanIL();
// 			$row = $db->getLoanPaymentByLoanNumber($data['loan_number']);
// 			print_r(Zend_Json::encode($row));
// 			exit();
// 		}
		
// 	}
	public function testAction($result=null,$table='ln_branch'){
// 		$start = '2014-01-01';
// 		$db = new Application_Model_DbTable_DbGlobal();
// 		$rs = $db->checkHolidayExist(1,$start);
// 		echo $rs;
			//set_time_limit(0);
			$sql="CALL stgetAllPaymentById(3);";
			$db = new Application_Model_DbTable_DbGlobal();
			$data=$db->getGlobalDb($sql);
			
			$sql = "SHOW COLUMNS FROM $table ";
			$datahead=$db->getGlobalDb($sql);
			foreach($datahead as $id =>$rs){
				$thead[]=$rs['Field'];
			}
			 
			$filename = APPLICATION_PATH . "/tmp/$table-" . date( "m-d-Y" ) . ".xlsx";
			 
			$realPath = realpath( $filename );
			 
			if ( false === $realPath )
			{
				touch( $filename );
				chmod( $filename, 0777 );
			}
			 
			$filename = realpath( $filename );
			$handle = fopen( $filename, "w" );
			fputcsv( $handle, $thead, "\t" );
			$finalData = array();
			 
			foreach ( $data AS $row )
			{
				$finalData[] = array(
						utf8_decode($row["total_principal"] ), // For chars with accents.
						utf8_decode($row["principal_permonth"] ),
						utf8_decode($row["total_interest"] ),
				);
			}
// 			print_r($finalData);exit();
			 
			foreach ( $finalData AS $finalRow )
			{
				fputcsv( $handle, $finalRow, "\t" );
			}
			 
			fclose( $handle );
			 
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			 
			$this->getResponse()->setRawHeader( "Content-Type: application/vnd.ms-excel; charset=UTF-8" )
			->setRawHeader( "Content-Disposition: attachment; filename=excel.xls" )
			->setRawHeader( "Content-Transfer-Encoding: binary" )
			->setRawHeader( "Expires: 0" )
			->setRawHeader( "Cache-Control: must-revalidate, post-check=0, pre-check=0" )
			->setRawHeader( "Pragma: public" )
			->setRawHeader( "Content-Length: " . filesize( $filename ) )
			->sendResponse();
			 
			readfile( $filename );// exit();
		
	}
}

