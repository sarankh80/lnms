<?php

class Group_ClientblacklistController extends Zend_Controller_Action
{

public function init()
    {
        /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
    }

    public function addAction()
    {
//     	if($this->getRequest()->isPost()){
// 			$data=$this->getRequest()->getPost();
// 			$db = new Group_Model_DbTable_DbCallecteralltype();
// 			try {
// 				//print_r($data);exit();
// 				if(isset($data['btn_save'])){
// 					$db->addcallecterall($data);
// 					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
// 				}
// 				if(isset($data['btn_save_close'])){
// 					$db->addcallecterall($data);
// 					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
// 					Application_Form_FrmMessage::redirectUrl('/group/Callecteralltype');
// 				}
// 			} catch (Exception $e) {
// 				Application_Form_FrmMessage::message("INSERT_FAIL");
// 				$err = $e->getMessage();
				
// 				Application_Model_DbTable_DbUserLog::writeMessageError($err);
// 			}
// 		}
       $fm = new Group_Form_FrmClientBlackList();
	   $frm = $fm->FrmClientBlackList(); 
	   Application_Model_Decorator::removeAllDecorator($frm);
	   $this->view->Form_client_blacklist = $frm;
	   
    }
    function indexAction(){
    	
    }
   
}
?>
