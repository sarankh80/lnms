<?php
class Group_indexController extends Zend_Controller_Action {
	
	public function indexAction(){
		$this->_redirect("/group/client");
	}
}

