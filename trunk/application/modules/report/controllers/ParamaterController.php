<?php
class Report_ParamaterController extends Zend_Controller_Action {
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
  
  function  rptStaffAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$key = new Application_Model_DbTable_DbKeycode();
  	//$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$data = $this->getRequest()->getPost();
  		if(isset($data['btn_search'])){
  			//print_r($data);exit();
  			$this->view->staff_list = $db->getAllstaff($data);
  		}else{
  		$collumn = array("co_code","co_khname","co_firstname","sex","email","basic_salary",
  				"start_date","end_date","contract_no","shift","workingtime","position","tel",
  				"basic_salary","national_id","address","degree","branch_name","note");
  		$this->exportFileToExcel('ln_staff',$db->getAllstaff(),$collumn);
  		}
  	}else{
  		$search = array('txtsearch' => '');
  		$this->view->staff_list = $db->getAllstaff($data);
  	}
  	
  }
  function  rptVillageAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->village_list = $db->getAllVillage();
  	//print_r($db->getAllstaff());
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$data = $this->getRequest()->getPost();
  		//
  		if(isset($data['btn_search'])){
  			//print_r($data);exit();
  			$this->view->village_list = $db->getAllVillage($data);
  		}else{
  		$collumn = array("vill_id","village_name","village_namekh","com_id","commune_name","commune_namekh",
  				"district_id","district_name","district_namekh","province_id","province_en_name",
  				"province_kh_name","modify_date",
  				"status","user_name");
  		$this->exportFileToExcel('ln_staff',$db->getAllVillage(),$collumn);
  		} 		
  	}else $search = array('txtsearch' => '');
  }
  function rptZoneAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->zone_list = $db->getAllZone();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$data = $this->getRequest()->getPost();
  		//print_r($data);exit();
  		if(isset($data['btn_search'])){
  			$this->view->zone_list = $db->getAllZone($data);
  		}else{
  		$collumn = array("zone_id","zone_name","zone_num","modify_date","status");
  		$this->exportFileToExcel('ln_zone',$db->getAllZone(),$collumn);
  		}
  	}else $search = array('txtsearch' => '');
  }
  function rptHolidayAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->holiday_list = $db->getAllHoliday();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$data = $this->getRequest()->getPost();
  		if(isset($data['btn_search'])){
  			$this->view->holiday_list = $db->getAllHoliday($data);
  		}else{
  		//print_r($search);exit();
	  		$collumn = array("id","holiday_name","amount_day","start_date","end_date","status","modify_date","note");
	  		$this->exportFileToExcel('ln_holiday',$db->getAllHoliday(),$collumn);
  		}
  	}else $search = array('txtsearch' => '');
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
  function rptBranchAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->branch_list = $db->getAllBranch();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	if($this->getRequest()->isPost()){
  		$collumn = array("br_id","branch_namekh","branch_nameen","br_address","branch_code","branch_tel",
  				"status","fax","other","displayby");
  		$this->exportFileToExcel('ln_branch',$db->getAllBranch(),$collumn);
  	}
  }
}

