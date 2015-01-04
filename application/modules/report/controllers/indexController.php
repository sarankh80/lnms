<?php
class Report_indexController extends Zend_Controller_Action {
	private $activelist = array('មិនប្រើ​ប្រាស់', 'ប្រើ​ប្រាស់');
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
  function addAction()
  {
		if($this->getRequest()->isPost()){
// 			$_data = $this->getRequest()->getPost();
// 			try {
// 				$_dbmodel = new Global_Model_DbTable_DbProvince();
// 				$_dbmodel->addNewProvince($_data);
// 				Application_Form_FrmMessage::Sucessfull("EDIT_SUCCESS","/global/index/subject-list");
// 			}catch (Exception $e) {
// 				Application_Form_FrmMessage::message("INSERT_FAIL");
// 				$err =$e->getMessage();
// 				Application_Model_DbTable_DbUserLog::writeMessageError($err);
// 			}
		}
		$frm = new Loan_Form_FrmLoan();
		$frm_loan=$frm->FrmAddLoan();
		Application_Model_Decorator::removeAllDecorator($frm_loan);
		$this->view->frm_loan = $frm_loan;
	}
	
	function rptClientAction()
	{
		
		if($this->getRequest()->isPost()){
			// 			$_data = $this->getRequest()->getPost();
			// 			try {
			// 				$_dbmodel = new Global_Model_DbTable_DbProvince();
			// 				$_dbmodel->addNewProvince($_data);
			// 				Application_Form_FrmMessage::Sucessfull("EDIT_SUCCESS","/global/index/subject-list");
			// 			}catch (Exception $e) {
			// 				Application_Form_FrmMessage::message("INSERT_FAIL");
			// 				$err =$e->getMessage();
			// 				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			// 			}
		}
		$db = new Accounting_Model_DbTable_DbExpense();
		$this->view->client_list = $db->getAllExpense();
		
	}

function rptPaymentdetailAction(){
 	
}
function delinquentloansAction(){
	
}
 function rptPaymentscheduleAction(){
 	$db = new Report_Model_DbTable_DbRptPaymentSchedule();
 	$id =$this->getRequest()->getParam('id'); 
 	
 	$row = $db->getPaymentSchedule($id);
 	$this->view->tran_schedule=$row;
 	$db = new Application_Model_DbTable_DbGlobal();
//  	if(!empty($row[0]['member_id'])){
 		 $rs = $db->getClientByMemberId(@$row[0]['member_id']);
//  	}
 	$this->view->client =$rs;
 	
 	$frm = new Application_Form_FrmSearchGlobal();
 	$form = $frm->FrmSearchLoadSchedule();
 	Application_Model_Decorator::removeAllDecorator($form);
 	$this->view->form_filter = $form;
 	$db= new Application_Model_DbTable_DbGlobal();
 	$day_inkhmer = $db->getDayInkhmerBystr(null);
 	$this->view->day_inkhmer = $day_inkhmer;
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
 			$collumns = array("Client Name","Release Amount","Interest Rate","Method","Time Collect","Zone","CO",
 					"By","status");
 			$link=array(
 					'module'=>'report','controller'=>'index','action'=>'rpt-paymentschedule',
 			);
 			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('total_capital'=>$link,'name_kh'=>$link,'name_en'=>$link));
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
 function rptIlpaymentdetailAction(){
 	
 }
 function rptGeneralAction(){
 	// 		$fr=new Application_Form_FrmReportParameter();
 	// 		$form=$fr->getFormReport(array(
 	// 				'budget'=>-1,
 	// 				'division'=>-1,
 	// 				'fund_type'=>-1,
 	// 				'year'=>-1,
 	// 				'wa_type'=>-1,
 	// 				'fund_no'=>-1,
 	// 		),$this,true);
 	// 		$this->view->filter = $form;
 	
 	$file='/budget/budget.html';
 	// 		$head=$report->getHeadBudgetList('project',date('Y'));
 	$report=new Application_Model_DbTable_DbGlobal();
 	$content=$report->getContent($result_row);
 	$param=array(
 			'division'=>1,
 			'budget'=>1,
 			'head'=>1,
 			'content'=>1);
 	$db=new Application_Model_DbTable_DbGlobal();
 	$new=$db->setReportParam($param, $file);
 	$this->view->file=$new;
 }
 function staffSalaryAction(){
 	
 }

 public  function clientPersonalAction(){
 	
 }

 function contractInformationAction(){
 	
 }
 function contractHistoryAction(){
 	
 }

 
//  function indexAction(){
 	
//  }
 function individulAction(){
 	
 }

 function oblAndLlpAction(){
 	
 }

 function rptLoancollectAction(){
 	
 }
 function allRptAction(){
 
 }
 function rptKhmerAction(){
 
 }

 function indexnAction(){
 	
 }
 
 function zendhtmlAction(){
 	
 }
}

