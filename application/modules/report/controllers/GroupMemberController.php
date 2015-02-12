<?php
class Report_GroupMemberController extends Zend_Controller_Action {
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
  function rptIndividulAction(){
  	
  }
  function rptClientInformationAction(){
	  	 
  }
  function rptClientAgreementAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptCalleteralAction(){
  	$db  = new Report_Model_DbTable_DbLnClient();
  	$this->view->calleteral_list = $db->getAllCalleteral();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("branch_id","code_call","co_id","getter_name","giver_name","date_delivery",
  				"client_code","contracts_borrow","mortgage_Contract","name_borrower");
  		$this->exportFileToExcel('ln_callect',$db->getAllCalleteral(),$collumn);
  	}
  }
  function rptClientAction($table='ln_account_name'){
  	header('Content-Type: text/html; charset=utf-8');
    $db  = new Report_Model_DbTable_DbLnClient();
    $rs = $db->getAllLnClient();
  	$this->view->client_list =$rs;
  	//  	print_r($rows);exit();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	
  	if($this->getRequest()->isPost()){
  		$collumn = array("client_number","name_kh","name_en","sex","branch_name","pro_id","dis_id","com_id",
  				"village_id");
  		$this->exportFileToExcel($table,$rs,$collumn);
  	}
  	
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
  function rptGroupAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptAgreementAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptCalleteralValueAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
 
}

