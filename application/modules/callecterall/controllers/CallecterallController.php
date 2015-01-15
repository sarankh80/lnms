<?php

class Callecterall_CallecterallController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
    }

    public function addAction()
    {
    	if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Callecterall_Model_DbTable_DbCallecterall();
			try {
				$db->addcallecterall($data);
				Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err = $e->getMessage();
				
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
       $fm = new Callecterall_Form_Frmcallecterall();
	   $frm = $fm->Frmcallecterall(); 
	   Application_Model_Decorator::removeAllDecorator($frm);
	   $this->view->Form_Frmcallecterall = $frm;
	   
    }
    public function indexAction()
    {
    	try{
    		$db = new Callecterall_Model_DbTable_DbCallecterall();
    			
    		$rs_rows= $db->geteAllid($search=null);//call frome model
    		$glClass = new Application_Model_GlobalClass();
    		$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
    		$list = new Application_Form_Frmtable();
    		$collumns = array("name_en ","name_kh ","key_code","status");
    		$link=array(
    				'module'=>'callecterall','controller'=>'Callecterall','action'=>'edit',
    		);
    		$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('name_en'=>$link,'name_kh'=>$link));
    	}catch (Exception $e){
    		Application_Form_FrmMessage::message("Application Error");
    		echo $e->getMessage();
    		Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
    	}
    }
    public function editAction()
    {
    if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
			$db = new Callecterall_Model_DbTable_DbCallecterall();
			try {
				$db->updatcallecterall($data);
				Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err = $e->getMessage();
				
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		
    	}
    	$id = $this->getRequest()->getParam('id');
    		
    	$db = new Callecterall_Model_DbTable_DbCallecterall();
    	$row  = $db->getcallecterallbyid($id);
    	$fm = new Callecterall_Form_Frmcallecterall();
	    $frm = $fm->Frmcallecterall($row); 
	    Application_Model_Decorator::removeAllDecorator($frm);
	    $this->view->Form_Frmcallecterall = $frm;
    		
    
    }
}
?>
