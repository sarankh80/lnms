<?php

class Callecterall_CallecteralllistController extends Zend_Controller_Action
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
    		$db = new Callecterall_Model_DbTable_DbCallecteralllist();
    		try {
    			//print_r($data);exit();
    			if(isset($data['save_close'])){
	    			$db->addcallecteralllist($data);
	    			Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
	    			Application_Form_FrmMessage::redirectUrl('/callecterall/callecteralllist');
    			}
    			if(isset($data['save_new'])){
    				$db->addcallecteralllist($data);
    				Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
    			}
    		} catch (Exception $e) {
    			Application_Form_FrmMessage::message("INSERT_FAIL");
    			$err = $e->getMessage();
    			echo $err;
    	
    			Application_Model_DbTable_DbUserLog::writeMessageError($err);
    		}
    	}
       $fm = new Callecterall_Form_Frmcallecteralllist();
	   $frm = $fm->callecteralllist(); 
	   Application_Model_Decorator::removeAllDecorator($frm);
	   $this->view->Form_Frmcallecterall = $frm;   
	   
    }
    
    public function indexAction()
    {
    	try{
    		$db = new Callecterall_Model_DbTable_DbCallecteralllist();
    		 
    		$rs_rows= $db->getcallecteralllistAllid($search=null);//call frome model
//     		$glClass = new Application_Model_GlobalClass();
//     		$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
    		$list = new Application_Form_Frmtable();
    		$collumns = array("សាខា ","លេខវិក័យបត្រ ","លេខកូដបពាំ្ច",
    				   "ឈ្មោះអតិថជន ","ថ្ញៃបពាំ្ច","រយះពេលខ្ចីគិតជា",
    				   "រយះពេលខ្ចី","ថ្ញៃផុតកំណត់","ប្រភេទប្រាក់","ចំនួនខ្ចី","សំគាល់");
    		$link=array(
    				'module'=>'callecterall','controller'=>'Callecteralllist','action'=>'edit',
    		);
    		$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('customer_name'=>$link,'date_debt'=>$link));
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
    		$db = new Callecterall_Model_DbTable_DbCallecteralllist();
    		//print_r($data);exit();
    		try {
    			if(isset($data['save_close'])){
	    			$db->updatcallecteralllist($data);
	    			//print_r($data);exit();
	    			Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
	    			Application_Form_FrmMessage::redirectUrl('/callecterall/Callecteralllist/');
	    		}
	    		if(isset($data['save_new'])){
	    			$db->updatcallecteralllist($data);
	    			Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
	    			Application_Form_FrmMessage::redirectUrl('/callecterall/Callecteralllist/add');
	    		}
    		} catch (Exception $e) {
    			Application_Form_FrmMessage::message("INSERT_FAIL");
    			$err = $e->getMessage();
    	
    			Application_Model_DbTable_DbUserLog::writeMessageError($err);
    		}
    	}
    	$id = $this->getRequest()->getParam('id');
    
    	$db = new Callecterall_Model_DbTable_DbCallecteralllist();
    	$row  = $db->getcallecteralllistbyid($id);
    	$fm = new Callecterall_Form_Frmcallecteralllist();
	    $frm = $fm->callecteralllist($row); 
	    Application_Model_Decorator::removeAllDecorator($frm);
	    $this->view->Form_Frmcallecterall = $frm;
    }   
}
?>
