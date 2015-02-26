<?php
class Report_LoanController extends Zend_Controller_Action {
	private $activelist = array('មិនប្រើ​ប្រាស់', 'ប្រើ​ប្រាស់');
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
  function rptLoanReleasedAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs=$db->getAllLoan();
  	$this->view->loanrelease_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("member_id","loan_number","client_id","total_capital","interest_rate","total_duration",
  				"date_release","co_name","admin_fee");
  		$this->exportFileToExcel('ln_staff',$rs,$collumn);
  	}
  	
  }
  function rptLoancollectAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$this->view->loancllect_list = $db->getALLLoancollect();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("id","loan_number","client_name","branch_id","co","total_principal","total_interest",
  							"STATUS","total_payment","date_payment");
  		$this->exportFileToExcel('ln_staff',$db->getALLLoancollect(),$collumn);
  	}
  }
  function rptGroupDisburseAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs= $db->getALLGroupDisburse();
  	$this->view->loancllect_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("member_id","chart_id","group_id","loan_number","client_id"
  				,"payment_method","currency_type","sum(total_capital) As total_capital"
  				,"admin_fee","collect_typeterm","interest_rate","status","is_completed","branch_id"
  				,"loan_cycle","loan_purpose","pay_before","pay_after","graice_period"
  				,"amount_collect_principal","show_barcode");
  		$this->exportFileToExcel('ln_staff','$rs','$collumn');
  	}
  }
  function rptIlpaymentAction(){
  }
  function rptPaymentAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs=$db->getALLPayment();
  	$this->view->loanpayment_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("receipt_no","client_id","co_id","receiver_id","date_input","capital","remain_capital",
				"principal_permonth","total_interest","penalize_amount","total_fund","service_charge","recieve_amount"
				,"reuturn_amount","note","is_complete","is_verify","verify_by","is_closingentry");
  		$this->exportFileToExcel('ln_staff',$rs,$collumn);
  	}
  }
  function rptPaymentScheduleAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptLoanLateAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$search = array(
  			'client_id' => -1,
  			'status' => -1,
  			'from_date' =>date('Y-m-d'),
  			'to_date' => date('Y-m-d'),
  	);
  	$rs=$db->getALLLoanlate($search);
  	$this->view->loanlate_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("id","name_kh","total_principal","principal_permonth","total_interest","total_payment",
      	"amount_day","is_approved","branch_id");
  		$this->exportFileToExcel('ln_staff',$rs,$collumn);
  	}
  }
  function rptLoanCycleAction(){
  }
  function rptBadloanAction(){
  }
  function rptLoanOutstandingAction(){
  }
  function rptLoanBereleaseAction(){
  }
  function rptLoanCollectioncoAction(){
  }
  function activeAction(){
  }
  function coletionSheetAction(){
  }
  public function customerpaymentAction(){
  }
  function disbursementAction(){
  }
  function repaymentAction(){
}
function rptLoanDatelineAction(){
	$db  = new Report_Model_DbTable_DbLoan();
	$rs=$db->getALLLoandateline();
	$this->view->loandateline_list =$rs;
	$key = new Application_Model_DbTable_DbKeycode();
	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	if($this->getRequest()->isPost()){
		$collumn = array("level","first_name","last_name","zone_id","date_release","date_line","create_date","total_duration","first_payment","time_collect","pay_term","payment_method","holiday","is_renew","branch_id","loan_type","is_verify","is_badloan","teller_id"
				,"chart_id","member_id","loan_number","currency_type","total_capital","admin_fee","interest_rate","loan_cycle","loan_purpose","pay_before"
				,"pay_after","graice_period","amount_collect_principal","show_barcode","is_completed","semi");
		
				
		$this->exportFileToExcel('ln_staff',$rs,$collumn);
	}
	
	
	
}
function rptLoanTotalCollectAction(){
}
public function paymentscheduleListAction(){
	try{
		$db = new Report_Model_DbTable_DbRptPaymentSchedule();
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
		$rs_rows= $db->getAllClientPaymentListRpt($search);
		$glClass = new Application_Model_GlobalClass();
		$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
		if($this->getRequest()->isPost()){
			$collumn = array("member_id","client_name","total_capital","admin_fee","interest_rate","payment_nameen",
					"time_collect","zone_name","co_khname","status");
			$this->exportFileToExcel('ln_payment',$rs_rows,$collumn);
		}
		$list = new Application_Form_Frmtable();
		$collumns = array("Client Name","Release Amount","Admin Fee","Interest Rate","Method","Time Collect","Zone","CO",
				"status");
		$link=array(
				'module'=>'report','controller'=>'loan','action'=>'rpt-paymentschedules',
		);
		$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('total_capital'=>$link,'client_name'=>$link));
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
public function exportFileToExcel($table,$data,$thead){
	$this->_helper->layout->disableLayout();
	$db = new Report_Model_DbTable_DbExportfile();
	$finalData = $db->getFileby($table,$data,$thead);
	$filename = APPLICATION_PATH . "/tmp/$table-" . date( "m-d-Y" ) . ".xlsx";
	$realPath = realpath( $filename );
	if ( false === $realPath ){
		touch( $filename );
		chmod( $filename, 0777 );
	}
	$filename = realpath( $filename );
	$handle = fopen( $filename, "w" );
	fputcsv( $handle, $thead, "\t" );
	$this->getResponse()->setRawHeader( "Content-Type: application/vnd.ms-excel; charset=utf-8" )
	->setRawHeader( "Content-Disposition: attachment; filename=excel.xls" )
	->setRawHeader( "Content-Transfer-Encoding: binary" )
	->setRawHeader( "Expires: 0" )
	->setRawHeader( "Cache-Control: must-revalidate, post-check=0, pre-check=0" )
	->setRawHeader( "Pragma: public" )
	->setRawHeader( "Content-Length: " . filesize( $filename ) )
	->sendResponse();
	foreach ( $finalData AS $finalRow )
	{
		fputcsv( $handle,$finalRow, "\t" );
	}
	fclose( $handle );
	$this->_helper->viewRenderer->setNoRender();
	readfile( $filename );//exit();
}
function rptPaymentschedulesAction(){
	$db = new Report_Model_DbTable_DbRptPaymentSchedule();
	$id =$this->getRequest()->getParam('id');
	$row = $db->getPaymentSchedule($id);
	$this->view->tran_schedule=$row;
	$db = new Application_Model_DbTable_DbGlobal();
	$rs = $db->getClientByMemberId(@$row[0]['member_id']);
	$this->view->client =$rs;
	$frm = new Application_Form_FrmSearchGlobal();
	$form = $frm->FrmSearchLoadSchedule();
	Application_Model_Decorator::removeAllDecorator($form);
	$this->view->form_filter = $form;
	$db= new Application_Model_DbTable_DbGlobal();
	$day_inkhmer = $db->getDayInkhmerBystr(null);
	$this->view->day_inkhmer = $day_inkhmer;
 }
}

