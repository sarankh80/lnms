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
function rptLoanDisburseAction(){//release all loan
  	$db  = new Report_Model_DbTable_DbLoan();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  	}
  	else{
  		$search = array(
  				'branch_id'=>'',
  				'client_name'=>'',
  				'pay_every'=>-1,
  				'co_id'=>'',
  				'start_date'=> date('Y-m-d'),
  				'end_date'=>date('Y-m-d'));
  	}
  	$this->view->loanrelease_list=$db->getAllLoan($search);
  	$this->view->list_end_date=$search;
  	
  	$frm = new Loan_Form_FrmSearchLoan();
  	$frm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($frm);
  	$this->view->frm_search = $frm;
  }
  function rptLoanDisburseCoAction(){//realease by co
  	$db  = new Report_Model_DbTable_DbLoan();
  	$rs=$db->getAllLoanco();
  	$this->view->loanrelease_list =$rs;
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	
  if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  	}
  	else{
  		$search = array(
  				'branch_id'=>-1,
  				'pay_every'=>'',
  			  	'member'=>'',
  				'co_id'=>-1,
  				'start_date'=> date('Y-m-d'),
  				'end_date'=>date('Y-m-d'));
  			
  	}
  	$this->view->list_end_date=$search;
  	$this->view->loanrelease_list=$db->getAllLoanCo($search);
  	 
  	$frm = new Loan_Form_FrmSearchLoan();
  	$frm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($frm);
  	$this->view->frm_search = $frm;
  }
  function rptLoancollectAction(){//list payment that collect from client
  	$dbs = new Report_Model_DbTable_DbloanCollect();
  	$frm = new Application_Form_FrmSearchGlobal();
  		if($this->getRequest()->isPost()){
  			$search = $this->getRequest()->getPost();
  		}
  		else{
  			$search = array(
  					'branch_id'=>'',
  					'client_name'=>'',
  					'co_id'=>'',
  					'start_date'=> date('Y-m-d'),
  					'end_date'=>date('Y-m-d'));
  			
  		}	
  		$this->view->date_show=$search['end_date'];
  		$this->view->list_end_date=$search;
  		$row = $dbs->getAllLnClient($search);
  		$this->view->tran_schedule=$row;
  		
	  	$db = new Application_Model_DbTable_DbGlobal();
	  	$frm = new Loan_Form_FrmSearchLoan();
	  	$frm = $frm->AdvanceSearch();
	  	Application_Model_Decorator::removeAllDecorator($frm);
	  	$this->view->frm_search = $frm;
	  	
	  	$key = new Application_Model_DbTable_DbKeycode();
	  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptGroupmemberAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$id = $this->getRequest()->getParam("id");
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if (!empty($id)){
  		$this->view->loanmember_list =$db->getALLGroupDisburse($id);
  		print_r($db->getALLGroupDisburse($id));
    }
  }
 
  function rptPaymentAction(){
  	$db  = new Report_Model_DbTable_DbLoan();	
	$key = new Application_Model_DbTable_DbKeycode();
	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	if($this->getRequest()->isPost()){
		$search = $this->getRequest()->getPost();
	}else {
		$search = array(
				'adv_search' => '',
				'status_search' => -1,
				'status' => -1,
				'branch_id' => "",
				'client_name' => "",
				'co_id' => "",
				'start_date'=> date('Y-m-d'),
	  			'end_date'=>date('Y-m-d')
		);
	}
	$this->view->loantotalcollect_list =$rs=$db->getALLLoanPayment($search);
	
	$this->view->list_end_date = $search;
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
//   			$collumn = array("id","branch_name","name_kh","total_principal","principal_permonth","total_interest","total_payment",
//       		"amount_day","date_payment");
//   			$this->exportFileToExcel('ln_staff',$db->getALLLoanlate(),$collumn);
  		
  	}else {
  		$search = array(
  				'adv_search'		=>	"",
  				'end_date' => date('Y-m-d'),
  				'status' => -1,
  				'branch_id'		=>	0,
  		);
  	}
  	$this->view->list_end_date = $search["end_date"];
  	$this->view->loanlate_list =$db->getALLLoanlate($search);
  	$frm = new Loan_Form_FrmSearchLoan();
  	$frm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($frm);
  	$this->view->frm_search = $frm;
  }
  function rptLoanNplAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  			
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
  	}
  	$this->view->LoanCollectionco_list =$db->getALLWritoff($search);
  	$this->view->list_end_date=$search;
  	$fm = new Loan_Form_Frmbadloan();
  	$frm = $fm->FrmBadLoan();
  	Application_Model_Decorator::removeAllDecorator($frm);
  	$this->view->frm_loan = $frm;
  }
  function rptLoanOutstandingAction(){//loand out standing with /collection
	    $db  = new Report_Model_DbTable_DbLoan();
	  	if($this->getRequest()->isPost()){
	  		$search = $this->getRequest()->getPost();
	  	}else {
	  		$search = array(
	  				'adv_search' => "",
	  				'end_date' => date('Y-m-d'),
	  				'status' => "",
	  				'co_id' => "",
	  				'branch_id'		=>"",
	  				'member'=>-1
	  		);
	  	}
	  	$this->view->fordate = $search['end_date'];
	  	$rs= $db->getAllOutstadingLoan($search);
	  	$frm = new Loan_Form_FrmSearchLoan();
	  	$frms = $frm->AdvanceSearch();
	  	$key = new Application_Model_DbTable_DbKeycode();
	  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	  	Application_Model_Decorator::removeAllDecorator($frms);
	  	$this->view->frm_search = $frms;
	  	$this->view->outstandloan = $rs;
  }
  
  function rptUnpaidLoanByCoAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$search = $this->getRequest()->getPost();
  		if(isset($search['btn_submit'])){
  			$this->view->LoanCollectionco_list =$db->getAllLoanByCo($search);
  		}else {
  			$collumn = array("id","branch","co_name","receipt_no","loan_number","team_group","total_principal_permonth"
  					,"total_interest","penalize_amount","amount_payment","service_charge","date_pay");
  			$this->exportFileToExcel('ln_client_receipt_money',$db->getAllLoanByCo(),$collumn);
  		}
  	}else{
  		$search = array(
  				'advance_search' => '',
  				'client_name' => "",
  				'start_date'=> date('Y-m-d'),
  				'end_date'=>date('Y-m-d'),
  				'branch_id'		=>	-1,
  				'co_id'		=> "",
  				'paymnet_type'	=> -1,
  				'status'=>"",);
  		$this->view->LoanCollectionco_list =$db->getAllLoanByCo($search);
  	}
  	$this->view->date_show=$search['end_date'];
	$this->view->start_date=$search['start_date'];
  	$frm = new Loan_Form_FrmSearchGroupPayment();
  	$fm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($fm);
  	$this->view->frm_search = $fm;
  }
  function rptLoanCollectioncoAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
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
	$this->view->date_show=$search['end_date'];
	$this->view->start_date=$search['start_date'];
  	$frm = new Loan_Form_FrmSearchGroupPayment();
  	$fm = $frm->AdvanceSearch();
  	Application_Model_Decorator::removeAllDecorator($fm);
  	$this->view->frm_search = $fm;
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
	$this->view->list_end_date=$search;
	$frm = new Loan_Form_FrmSearchLoan();
	$frm = $frm->AdvanceSearch();
	Application_Model_Decorator::removeAllDecorator($frm);
	$this->view->frm_search = $frm;
}
function rptRescheduleLoanAction(){
	$db  = new Report_Model_DbTable_DbLoan();
	$key = new Application_Model_DbTable_DbKeycode();
	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	if($this->getRequest()->isPost()){
		$search = $this->getRequest()->getPost();
	}
	else{
		$search = array(
				'branch_id'=>'',
				'client_name'=>'',
				'pay_every'=>-1,
				'start_date'=> date('Y-m-d'),
				'end_date'=>date('Y-m-d'));
	}
	$this->view->loanrelease_list=$db->getRescheduleLoan($search);
	$this->view->list_end_date=$search;
	 
	$frm = new Loan_Form_FrmSearchLoan();
	$frm = $frm->AdvanceSearch();
	Application_Model_Decorator::removeAllDecorator($frm);
	$this->view->frm_search = $frm;
}
public function paymentscheduleListAction(){
	try{
		$db = new Report_Model_DbTable_DbRptPaymentSchedule();
		if($this->getRequest()->isPost()){
			$search = $this->getRequest()->getPost();
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
		}
		$rs_rows = $db->getAllClientPaymentListRpt($search);
		
		$glClass = new Application_Model_GlobalClass();
		$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
		
		$collumns = array("BRANCH_NAME","LOAN_NO","CLIENT_NO","CUSTOMER_NAME","LOAN_AMOUNT","AMIN_FEE","INTEREST RATE","TERM_BORROW","METHOD","TIME_COLLECT","ZONE","CO_NAME",
				"STATUS");
		$link=array(
				'module'=>'report','controller'=>'loan','action'=>'rpt-paymentschedules',
		);
		$list = new Application_Form_Frmtable();
		$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array(
				'total_capital'=>$link,'loan_number'=>$link,'client_number'=>$link));
				
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
	if(empty($row)){
		Application_Form_FrmMessage::Sucessfull("RECORD_NOT_EXIST",'/report/loan/paymentschedule-list');
	}
	$db = new Application_Model_DbTable_DbGlobal();
	$rs = $db->getClientByMemberId(@$row[0]['member_id']);
	if($rs['loan_type']==2){//if loan group
		$this->_redirect('report/loan/rpt-groupmember/id/'.$row[0]['member_id']);
	}else{
		
	}
	$this->view->client =$rs;
	$frm = new Application_Form_FrmSearchGlobal();
	$form = $frm->FrmSearchLoadSchedule();
	Application_Model_Decorator::removeAllDecorator($form);
	$this->view->form_filter = $form;
	$db= new Application_Model_DbTable_DbGlobal();
	$day_inkhmer = $db->getDayInkhmerBystr(null);
	$this->view->day_inkhmer = $day_inkhmer;
	
	$key = new Application_Model_DbTable_DbKeycode();
	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
	
 }
 function rptMemberschedulesAction(){//for schedule member
 	$db = new Report_Model_DbTable_DbRptPaymentSchedule();
 	$id =$this->getRequest()->getParam('id');
 	$row = $db->getPaymentSchedule($id);
 	$this->view->tran_schedule=$row;
 	if(empty($row)){
 		Application_Form_FrmMessage::Sucessfull("RECORD_NOT_EXIST",'/report/loan/paymentschedule-list');
 	}
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
 
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 
 }
 function rptGroupschedulesAction(){//for schedule member
 	$db = new Report_Model_DbTable_DbRptPaymentSchedule();
 	$id =$this->getRequest()->getParam('id');
 	$row = $db->getPaymentScheduleGroupById($id);
 	$this->view->tran_schedule=$row;
 	if(empty($row)){
 		Application_Form_FrmMessage::Sucessfull("RECORD_NOT_EXIST",'/report/loan/paymentschedule-list');
 	}
 	$db = new Application_Model_DbTable_DbGlobal();
 	$rs = $db->getClientGroupByMemberId(@$row[0]['member_id']);
 	$this->view->client =$rs;
 	$frm = new Application_Form_FrmSearchGlobal();
 	$form = $frm->FrmSearchLoadSchedule();
 	Application_Model_Decorator::removeAllDecorator($form);
 	$this->view->form_filter = $form;
 	$db= new Application_Model_DbTable_DbGlobal();
 	$day_inkhmer = $db->getDayInkhmerBystr(null);
 	$this->view->day_inkhmer = $day_inkhmer;
 
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 
 }
 function rptGroupchedulesAction(){//for schedule member
 	$db = new Report_Model_DbTable_DbRptPaymentSchedule();
 	$id =$this->getRequest()->getParam('id');
 	$row = $db->getPaymentSchedule($id);
 	$this->view->tran_schedule=$row;
 	if(empty($row)){
 		Application_Form_FrmMessage::Sucessfull("RECORD_NOT_EXIST",'/report/loan/paymentschedule-list');
 	}
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
 
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 
 }
 function rptLoanIncomeAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	 
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
 	$this->view->list_end_date=$search;
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
 	}else{
	 	$search = array(
	 	'adv_search'  => '',
	 	'client_name' => -1,
	 	'start_date'  => date('Y-m-d'),
	 	'end_date'    => date('Y-m-d'),
	 	'branch_id'	  =>	-1,
		'co_id'		  => -1,
		'paymnet_type'=> -1,
	 	'status'      => "",);
 	}
 	$this->view->LoanCollectionco_list =$db->getALLLoanPayoff($search);
 	$this->view->list_end_date=$search;
 	$frm = new Loan_Form_FrmSearchGroupPayment();
 	$fm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($fm);
 	$this->view->frm_search = $fm;
 }
 function rptLoanExpectIncomeAction(){
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
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
 	}
 	$this->view->list_end_date=$search;
 	$db  = new Report_Model_DbTable_DbLoan();
 	$this->view->LoanCollectionco_list =$db->getALLLoanExpectIncome($search);
 	
 	$frm = new Loan_Form_FrmSearchGroupPayment();
 	$fm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($fm);
 	$this->view->frm_search = $fm;
 	
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 }
 function rptBadloanAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
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
 	}
 	$this->view->LoanCollectionco_list =$db->getALLBadloan($search);
 	$this->view->list_end_date=$search;
 	$fm = new Loan_Form_Frmbadloan();
	$frm = $fm->FrmBadLoan();
	Application_Model_Decorator::removeAllDecorator($frm);
	$this->view->frm_loan = $frm;
 }
 function rptWritoffAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
 		
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
 	}
 	$this->view->LoanCollectionco_list =$db->getALLWritoff($search);
 	$this->view->list_end_date=$search;
 	$fm = new Loan_Form_Frmbadloan();
 	$frm = $fm->FrmBadLoan();
 	Application_Model_Decorator::removeAllDecorator($frm);
 	$this->view->frm_loan = $frm;
 }
 function rptLoanXchangeAction(){
 	$db  = new Report_Model_DbTable_DbLoan();
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
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
 		
 	}
 	$this->view->Loanxchange_list =$db->getAllxchange($search);
 	$frm = new Loan_Form_FrmSearchLoan();
 	$frm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($frm);
 	$this->view->frm_search = $frm;
 }
 
 function rptPaymentHistoryAction(){
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
 	$this->view->list_end_date=$search;
 	$frm = new Loan_Form_FrmSearchLoan();
 	$frm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($frm);
 	$this->view->frm_search = $frm;
 }
 function rptLoanTrasferAction(){//release all loan
 	$db  = new Report_Model_DbTable_DbLoan();
 	$key = new Application_Model_DbTable_DbKeycode();
 	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
 	if($this->getRequest()->isPost()){
 		$search = $this->getRequest()->getPost();
 	}
 	else{
 		$search = array(
 				'branch_id'=>'',
 				'client_name'=>'',
 				'pay_every'=>-1,
 				'co_id'=>'',
 				'start_date'=> date('Y-m-d'),
 				'end_date'=>date('Y-m-d'));
 	}
 	$this->view->loantrasfer=$db->getAllTransferoan($search);
 	$this->view->list_end_date=$search;
 	 
 	$frm = new Loan_Form_FrmSearchLoan();
 	$frm = $frm->AdvanceSearch();
 	Application_Model_Decorator::removeAllDecorator($frm);
 	$this->view->frm_search = $frm;
 }
}

