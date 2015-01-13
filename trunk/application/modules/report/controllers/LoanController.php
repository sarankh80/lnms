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
}

