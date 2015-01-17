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
  	$this->view->loanrelease_list = $db->getAllLoan();
  	
  }
  function rptLoancollectAction(){
  	$db  = new Report_Model_DbTable_DbLoan();
  	$this->view->loancllect_list = $db->getALLLoancollect();
  	 
  }
  function rptGroupDisburseAction(){
  	
  }
  function rptIlpaymentAction(){
  	
  }
  function rptPaymentAction(){
  	
  }
  function rptPaymentScheduleAction(){
  	
  }
  function rptLoanLateAction(){
  	
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
function rptPaymentschedulesAction(){
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
}

