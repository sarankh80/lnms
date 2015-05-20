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
  function rptLoanReleasedAction(){//release all loan
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs=$db->getAllLoan();
  	
//   	$db = new Loan_Model_DbTable_DbLoanIL();
//   	$rs_rows= $db->getAllIndividuleLoan($search);
  	
  	$this->view->loanrelease_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  		if(@$search["exportexcel"]== 1){
  			unset($rs['curr_type']);
  			$collumn = array("member_id","loan_number","client_id","client_name","total_capital","interest_rate","currency_type","total_duration",
  					"date_release","co_name","admin_fee");
  			$this->exportFileToExcel('ln_staff',$rs,$collumn);
  		}	
  		elseif(!empty($search['txtsearch'])){
  			//print_r($search);exit();
  			$rs= $db->getAllLoan($search);
  			$this->view->loanrelease_list = $rs;
  		}
  	}
  	
  	
  }
  function rptLoanReleasedCoAction(){//realease by co
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs=$db->getAllLoanCo();
  	 
  	//   	$db = new Loan_Model_DbTable_DbLoanIL();
  	//   	$rs_rows= $db->getAllIndividuleLoan($search);
  	 
  	$this->view->loanrelease_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  		if(@$search["exportexcel"]== 1){
  			unset($rs['curr_type']);
  			$collumn = array("member_id","loan_number","client_id","client_name","total_capital","interest_rate","currency_type","total_duration",
  					"date_release","co_name","admin_fee");
  			$this->exportFileToExcel('ln_staff',$rs,$collumn);
  		}
  		elseif(!empty($search['txtsearch'])){
  			//print_r($search);exit();
  			$rs= $db->getAllLoan($search);
  			$this->view->loanrelease_list = $rs;
  		}
  	}
  	 
  	 
  }
  function rptLoancollectAction(){//list payment that collect from client
  	$dbs = new Report_Model_DbTable_DbloanCollect();
  	$frm = new Application_Form_FrmSearchGlobal();
//   	$key = new Application_Model_DbTable_DbKeycode();
//   	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  		if($this->getRequest()->isPost()){
  			$search = $this->getRequest()->getPost();
  			
  			if(isset($search['btn_search'])){
  				$this->view->tran_schedule=$dbs->getAllLnClient($search);
  				Application_Model_Decorator::removeAllDecorator($frm);
  				//.print_r($frm->FrmSearchLoadSchedule($search));
  				$this->view->form_filter = $frm->FrmSearchLoadSchedule($search);
  			}
  		}
  		else{
  			$search = array(
  					'from_date'=> date('Y-m-d'),
  					'to_date'=>date('Y-m-d'));
  			$this->view->tran_schedule=$dbs->getAllLnClient($search);
  		
  		$row = $dbs->getAllLnClient($search);
  		$this->view->tran_schedule=$row;
  		

	
	  	
  		}	
	  	$db = new Application_Model_DbTable_DbGlobal();
	  	$rs = $db->getClientByMemberId(@$row[0]['member_id']);
	  	$this->view->client =$rs;
  		
	  	
	  	$form = $frm->FrmSearchLoadSchedule();
	  	Application_Model_Decorator::removeAllDecorator($form);
	  	$this->view->form_filter = $form;
  }
  function rptGroupDisburseAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs= $db->getALLGroupDisburse();
  	$this->view->loancllect_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  		if(@$search["exportexcel"]== 1){
  		$collumn = array("member_id","chart_id","group_id","loan_number","client_id"
  				,"payment_method","currency_type","sum(total_capital) As total_capital"
  				,"admin_fee","collect_typeterm","interest_rate","status","is_completed","branch_id"
  				,"loan_cycle","loan_purpose","pay_before","pay_after","graice_period"
  				,"amount_collect_principal","show_barcode");
  		$this->exportFileToExcel('ln_staff','$rs','$collumn');
  		}elseif(!empty($search['txtsearch'])){
  			$this->view->loancllect_list =$db->getALLGroupDisburse($search);
  		}
  	}
  }
  function rptIlpaymentAction(){
  }
  
  function rptPaymentAction(){
  	$db  = new Report_Model_DbTable_DbLoan();	
	$key = new Application_Model_DbTable_DbKeycode();
	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	if($this->getRequest()->isPost()){
		$search = $this->getRequest()->getPost();
		if(isset($search['btn_search'])){
			$this->view->loantotalcollect_list=$db->getALLLoanPayment($search);
		}
	}else {
	$search = array(
			'adv_search' => '',
			'status_search' => -1,
			'status' => -1,
			'branch_id' => "",
			'client_name' => "",
			'co_id' => "",
			'start_date' =>date('Y-m-d'),
			'end_date' => date('Y-m-d'),
	);
	$this->view->loantotalcollect_list =$rs=$db->getALLLoanPayment($search);
	}
	$frm = new Loan_Form_FrmSearchLoan();
	$frm = $frm->AdvanceSearch();
	Application_Model_Decorator::removeAllDecorator($frm);
	$this->view->frm_search = $frm;
  }
  function rptLoanLateAction(){
  	$db  = new Report_Model_DbTable_DbLoan();  	
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  		if(@$search["exportexcel"]== 1){
  			$collumn = array("id","branch_name","name_kh","total_principal","principal_permonth","total_interest","total_payment",
      		"amount_day","date_payment");
  			$this->exportFileToExcel('ln_staff',$db->getALLLoanlate(),$collumn);
  		}elseif(!empty($search['btn_search'])){
  			//print_r($search);exit();
  			$this->view->loanlate_list =$db->getALLLoanlate($search);
  		}
  		
  	}else {
  		$search = array(
  				'adv_search'		=>	"",
  				'start_date' => date('Y-m-d'),
  				'status' => "",
  				'branch_id'		=>	0,
  		);
  		$this->view->loanlate_list =$db->getALLLoanlate($search);
  	}
  	$frm = new Loan_Form_FrmSearchLoan();
  	$frm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($frm);
  	$this->view->frm_search = $frm;
  }
  function rptLoanCycleAction(){
  }
  
  function rptLoanOutstandingAction(){//loand out standing with /collection
	    $db  = new Report_Model_DbTable_DbLoan();
	  	$key = new Application_Model_DbTable_DbKeycode();
	  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	  	$rs= $db->getAllOutstadingLoan($search=array());
	  	if($this->getRequest()->isPost()){
	  		$search = $this->getRequest()->getPost();
	  		if(@$search["exportexcel"]== 1){
	  			unset($rs['curr_type']);
	  			$collumn = array("member_id","loan_number","client_id","client_name","total_capital","interest_rate","currency_type","total_duration",
	  					"date_release","co_name","admin_fee");
	  			$this->exportFileToExcel('ln_staff',$rs,$collumn);
	  		}	
	  		elseif(!empty($search['txtsearch'])){
	  			
	  			
	  		}
	  	}
	  	$rs= $db->getAllOutstadingLoan($search);
	  	print_r($rs);
	  	$this->view->outstandloan = $rs;
  }
  function rptLoanBereleaseAction(){
  }
  function rptLoanCollectioncoAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
//   
  	
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  		if(isset($search['btn_submit'])){
  			$this->view->LoanCollectionco_list =$db->getALLLoanCollectionco($search);
  		}else {
  		$collumn = array("id","branch","co_name","receipt_no","loan_number","team_group","total_principal_permonth"
  				,"total_interest","penalize_amount","amount_payment","service_charge","date_pay");
  		$this->exportFileToExcel('ln_client_receipt_money',$db->getALLLoanCollectionco(),$collumn);
  		}
  	}else{
			$search = array(
				'adv_search' => '',
				'client_name' => -1,
				'start_date'=> date('Y-m-d'),
				'end_date'=>date('Y-m-d'),
				'branch_id'		=>	-1,
				'co_id'		=> -1,
				'paymnet_type'	=> -1,
				'status'=>"",);
			$this->view->LoanCollectionco_list =$db->getALLLoanCollectionco($search);
	}
  	$frm = new Loan_Form_FrmSearchGroupPayment();
  	$fm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($fm);
  	$this->view->frm_search = $fm;
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
	$db  = new Report_Model_DbTable_DbLoan();	
	$key = new Application_Model_DbTable_DbKeycode();
	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	if($this->getRequest()->isPost()){
		$search = $this->getRequest()->getPost();
		if(isset($search['btn_search'])){
			$this->view->loantotalcollect_list=$db->getALLLoanTotalcollect($search);
		}
	}else {
	$search = array(
			'adv_search' => '',
			'status_search' => -1,
			'status' => -1,
			'branch_id' => "",
			'client_name' => "",
			'co_id' => "",
			'start_date' =>date('Y-m-d'),
			'end_date' => date('Y-m-d'),
	);
	$this->view->loantotalcollect_list =$rs=$db->getALLLoanTotalcollect($search);
	}
	$frm = new Loan_Form_FrmSearchLoan();
	$frm = $frm->AdvanceSearch();
	Application_Model_Decorator::removeAllDecorator($frm);
	$this->view->frm_search = $frm;
}
public function paymentscheduleListAction(){
	try{
		$db = new Report_Model_DbTable_DbRptPaymentSchedule();
		$rs_rows= $db->getAllClientPaymentListRpt();
		$glClass = new Application_Model_GlobalClass();
		$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
		$list = new Application_Form_Frmtable();
		$collumns = array("Client Name","Release Amount","Admin Fee","Interest Rate","Method","Time Collect","Zone","CO",
				"status");
		$link=array(
				'module'=>'report','controller'=>'loan','action'=>'rpt-paymentschedules',
		);
		$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('total_capital'=>$link,'client_name'=>$link));
		if($this->getRequest()->isPost()){
			$search = $this->getRequest()->getPost();
			if(empty($search["exportexcel"])){
			$rs_rows = $db->getAllClientPaymentListRpt($search);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('total_capital'=>$link,'client_name'=>$link));
			}	
		}
		else{
			$search = array(
					'adv_search' => '',
					'status_search' => -1,
					'client_id' => -1,
					'status' => -1,
					'from_date' =>date('Y-m-d'),
					'to_date' => date('Y-m-d'),
			);
			$session_loan=new Zend_Session_Namespace('search_loan');
			$session_loan->s_loan=$search;//for creat session
		
		
		}
		if($this->getRequest()->isPost()){
			if(!empty($search["exportexcel"])){
				$session_loan=new Zend_Session_Namespace('search_loan');
				$search=$session_loan->s_loan;//for creat session
				$rs_rows = $db->getAllClientPaymentListRpt($search);
				$collumn = array("member_id","client_name","total_capital","admin_fee","interest_rate","payment_nameen",
						"time_collect","zone_name","co_khname","status");
				$this->exportFileToExcel('ln_payment',$rs_rows,$collumn);
			}
		}
		}catch (Exception $e){
		Application_Form_FrmMessage::message("Application Error");
		echo $e->getMessage();
		Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
	}
// 	$frm = new Application_Form_FrmAdvanceSearch();
// 	$frm = $frm->AdvanceSearch();
// 	Application_Model_Decorator::removeAllDecorator($frm);
// 	$this->view->frm_search = $frm;
	
	$frm = new Loan_Form_FrmSearchLoan();
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
 function rptLoanIncomeAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	//
 	 
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 	$search = $this->getRequest()->getPost();
 	if(isset($search['btn_submit'])){
  			$this->view->LoanCollectionco_list =$db->getALLLoanIcome($search);
  			$this->view->LoanFee_list =$db->getALLLFee($search);
 	}else {
 	$collumn = array("id","branch","co_name","receipt_no","loan_number","team_group","total_principal_permonth"
  				,"total_interest","penalize_amount","amount_payment","service_charge","date_pay"	);
   						$this->exportFileToExcel('ln_client_receipt_money',$db->getALLLoanIcome(),$collumn);
 	}
 	}else{
 	$search = array(
 	'adv_search' => '',
 	'client_name' => -1,
 	'start_date'=> date('Y-m-d'),
 	'end_date'=>date('Y-m-d'),
 			'branch_id'		=>	-1,
				'co_id'		=> -1,
				'paymnet_type'	=> -1,
 			'status'=>"",);
			$this->view->LoanCollectionco_list =$db->getALLLoanIcome($search);
			$this->view->LoanFee_list =$db->getALLLFee($search);
 	}
 	$frm = new Loan_Form_FrmSearchGroupPayment();
 	$fm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($fm);
 	$this->view->frm_search = $fm;
 }
 function rptLoanPayoffAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	//
 	 
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 	$search = $this->getRequest()->getPost();
 	if(isset($search['btn_submit'])){
  			$this->view->LoanCollectionco_list =$db->getALLLoanPayoff($search);
 	}else {
 	$collumn = array("id","branch","co_name","receipt_no","loan_number","team_group","total_principal_permonth"
  				,"total_interest","penalize_amount","amount_payment","date_pay"	);
   						$this->exportFileToExcel('ln_client_receipt_money',$db->getALLLoanPayoff(),$collumn);
 	}
 	}else{
 	$search = array(
 	'adv_search' => '',
 	'client_name' => -1,
 	'start_date'=> date('Y-m-d'),
 	'end_date'=>date('Y-m-d'),
 			'branch_id'		=>	-1,
				'co_id'		=> -1,
				'paymnet_type'	=> -1,
 			'status'=>"",);
			$this->view->LoanCollectionco_list =$db->getALLLoanPayoff($search);
 	}
 	$frm = new Loan_Form_FrmSearchGroupPayment();
 	$fm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($fm);
 	$this->view->frm_search = $fm;
 }
 function rptLoanExpectIncomeAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	//
 		
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
 		if(isset($search['btn_submit'])){
 			$this->view->LoanCollectionco_list =$db->getALLLoanExpectIncome($search);
 		}else {
 			$collumn = array("id","branch","loan_number","client_name","total_interest","date_payment"	);
 			$this->exportFileToExcel('ln_loanmember_funddetail',$db->getALLLoanExpectIncome(),$collumn);
 		}
 	}else{
 		$search = array(
 				'adv_search' => '',
 				'client_name' => -1,
 				'start_date'=> date('Y-m-d'),
 				'end_date'=>date('Y-m-d'),
 				'branch_id'		=>	-1,
 				'co_id'		=> -1,
 				'paymnet_type'	=> -1,
 				'status'=>"",);
 		$this->view->LoanCollectionco_list =$db->getALLLoanExpectIncome($search);
 	}
 	$frm = new Loan_Form_FrmSearchGroupPayment();
 	$fm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($fm);
 	$this->view->frm_search = $fm;
 }
 function rptBadloanAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
 		if(isset($search['btn_search'])){
 			$this->view->LoanCollectionco_list =$db->getALLBadloan($search);
 		}else {
 			$collumn = array("id","branch_namekh","client_name_en","loss_date","cash_type","currency_typeshow","total_amount","intrest_amount","tem","note","date");
 			$this->exportFileToExcel('ln_loanmember_funddetail',$db->getALLBadloan(),$collumn);
 		}
 	}else{
 		$search = array(
 				'adv_search'=>'',
				'branch' => '',
				'client_name' =>'',
				'client_code'=>'',
				'Term'=>'',
				'status' =>'',
				'cash_type'=>'',
				'start_date'=> date('Y-m-01'),
				'end_date'=>date('Y-m-d'));
 		$this->view->LoanCollectionco_list =$db->getALLBadloan($search);
 	}
 	$fm = new Loan_Form_Frmbadloan();
	$frm = $fm->FrmBadLoan();
	Application_Model_Decorator::removeAllDecorator($frm);
	$this->view->frm_loan = $frm;
 }
}

