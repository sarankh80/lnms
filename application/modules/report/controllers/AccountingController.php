<?php
class Report_AccountingController extends Zend_Controller_Action {
	private $activelist = array('មិនប្រើ​ប្រាស់', 'ប្រើ​ប្រាស់');
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
function rptFixedAssetAction(){
	
}
function  rptBuyFixedAssetAction(){
	
}
  function rptGeneralJurnalAction(){
  
 
}
function rptSaleFixedAssetAction(){
	
}
function rptIncomeAction(){
	
}
function rptBalanceSheetAction(){
	
}
function rptIncomeStatementAction(){
	
}
function rptAccountNameAction(){
	
}
function rptLegerAction(){
	
}
function rptBalanceAction(){
	
}
function rptClosingAction(){
	
}
function rptCashflowAction(){
	
}
function rptJurnalAction(){
	
}
function rptAccountcateAction(){
	
}
function rptChartaccountAction(){
	
}
function rptOwnerequityAction(){
	
}
function rptBalancsheetAction(){
	
}
function rptOwerEquityAction(){
	
}
}

