<?php

class Callecterall_ChengcallecterallController extends Zend_Controller_Action
{

    public function init()
    {
        
    	
    }

    public function addAction()
    {
    	$db = new Application_Model_DbTable_DbGlobal();
    	$a = $db->getOwnerByType();
    	//print_r($a);exit();
       $fm = new Callecterall_Form_Frmchengcallecterall();
	   $frm = $fm->Frmchengcallecterall(); 
	   Application_Model_Decorator::removeAllDecorator($frm);
	   $this->view->Form_Frmcallecterall = $frm;
	   
    }
    function getChangeinfoAction(){
    	if($this->getRequest()->isPost()){
    		$data = $this->getRequest()->getPost();
    		$db = new Callecterall_Model_DbTable_DbChangeCallecterall();
    		$row = $db->getOwnerbyid($data['owner_id']);
    		print_r(Zend_Json::encode($row));
    		exit();
    	}
    }
}