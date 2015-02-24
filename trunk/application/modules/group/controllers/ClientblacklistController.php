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
    	if($this->getRequest()->isPost()){
			$data=$this->getRequest()->getPost();
	  //      print_r($data);exit();
			$db = new Group_Model_DbTable_DbClientBlackList();
			try {
				//print_r($data);exit();
				if(isset($data['btn_save'])){
					$db->updatBlackList($data);
					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
				}
				if(isset($data['btn_save_close'])){
					$db->updatBlackList($data);
					Application_Form_FrmMessage::message('ការ​បញ្ចូល​​ជោគ​ជ័យ');
					Application_Form_FrmMessage::redirectUrl('/group/Clientblacklist');
				}
			} catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err = $e->getMessage();
				
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
       $fm = new Group_Form_FrmClientBlackList();
	   $frm = $fm->FrmClientBlackList(); 
	   Application_Model_Decorator::removeAllDecorator($frm);
	   $this->view->Form_client_blacklist = $frm;
	   
    }
    function indexAction()
    {
    	try{
    		$db = new Group_Model_DbTable_DbClientBlackList();
    		if($this->getRequest()->isPost()){
    			$search=$this->getRequest()->getPost();
    		}
    		else{
    			$search = array(
    					'adv_search' => '',
    					'status_search' => -1);
    		}
    		$rs_rows= $db->getAllBlackList($search);//call frome model
    		//print_r($rs_rows);exit();
    					$glClass = new Application_Model_GlobalClass();
    					$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
    		$list = new Application_Form_Frmtable();
    		$collumns = array("name_kh","name_en","sex","client_number","branch_id","is_blacklist","reasonblack_list","date_blacklist","status_blacklist");
    		$link=array(
    				'module'=>'group','controller'=>'Clientblacklist','action'=>'',
    		);
    		$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array(''=>$link,''=>$link,''=>$link));
    	}catch (Exception $e){
    		Application_Form_FrmMessage::message("Application Error");
    		echo $e->getMessage();
    		Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
    	
    	}
    	$frm = new Group_Form_FrmClientBlackList();
    	$frm = $frm->FrmClientBlackList();
    	Application_Model_Decorator::removeAllDecorator($frm);
    	$this->view->frm_search = $frm;
    	 
    	
    }
   
}
?>
