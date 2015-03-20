<?php 
Class Loan_Form_FrmTransferCoClient extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmTransfer($data=null){
		
		$db = new Application_Model_DbTable_DbGlobal();
		$db_co = new Loan_Model_DbTable_DbTransferCoClient();
    	$row_co = $db_co->getcoinfo();
		$request=Zend_Controller_Front::getInstance()->getRequest();
		$branch_name = new Zend_Dojo_Form_Element_FilteringSelect('branch_name');
    	$branch_name->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'required' =>'true'
    	));
    	$rows = $db->getAllBranchName();
    	$options=array(''=>"------Select------");
    	if(!empty($rows))
    		foreach($rows AS $row){
    		$options[$row['br_id']]=$row['branch_namekh'];
    	}
    	$branch_name->setMultiOptions($options);
    	$branch_name->setValue($request->getParam('branch_id'));    	
		
		$_date= new Zend_Dojo_Form_Element_DateTextBox('Date');
		$_date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				
		));
		$_date->setValue(date('Y-m-d'));
		$co_code = new Zend_Dojo_Form_Element_FilteringSelect('co_code');
		$co_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(1);"
		));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['co_id']] = $row_from['co_code'];
		}
		$co_code->setMultiOptions($options_from);
		
		$formc_co = new Zend_Dojo_Form_Element_FilteringSelect('name_co');
		$formc_co->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
			    'onchange'=>"getClientInfo(2);"
				));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['co_id']] = $row_from['co_khname'];
		}
		$formc_co->setMultiOptions($options_from);
		
		$name_client = new Zend_Dojo_Form_Element_FilteringSelect('name_client');
		$name_client->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(3);"
		));
		$row_co = $db_co->getcoinfcoclient();
		$options_co =array(''=>"------Select------");
		if (!empty($row_co))
			foreach ($row_co AS $row_cos){
			$options_co[$row_cos['member_id']] = $row_cos['client_name'];
		}
		$name_client->setMultiOptions($options_co);
		
		$code_client = new Zend_Dojo_Form_Element_FilteringSelect('code_client');
		$code_client->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(4);"
		));
		$row_froms = $db_co->getcoinfcoclient();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['member_id']] = $row_from['client_code'];
		}
		$code_client->setMultiOptions($options_from);
		
		$note = new Zend_Dojo_Form_Element_Textarea('Note');
		$note ->setAttribs(array(
				'dojoType'=>'dijit.form.SimpleTextarea',
				'class'=>'fullside',
				'style'=>'width:98%'
		));
		
		$user_id = new Zend_Dojo_Form_Element_FilteringSelect('user_id');
		$user_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
		}
		$user_id->setMultiOptions($options_from);	

		$_arr = array(1=>$this->tr->translate("ACTIVE"),0=>$this->tr->translate("DACTIVE"));
		$_status = new Zend_Dojo_Form_Element_FilteringSelect("status");
		$_status->setMultiOptions($_arr);
		$_status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'missingMessage'=>'Invalid Module!',
				'class'=>'fullside'));
		
		if($data!=null){				
			$branch_name->setValue($data['branch_id']);
			$co_code->setValue($data['name_co']);
			$formc_co->setValue($data['name_co']);
			$name_client->setValue($data['member_code_client']);
			$code_client->setValue($data['member_code_client']);			
			$_status->setValue($data['status']);
			$_date->setValue($data['date']);
			$note->setValue($data['note']);
		}		
		
		$this->addElements(array($_status,$branch_name,$_date,$formc_co,$name_client,$co_code,$code_client,$note,$user_id));
		return $this;
		
	}	
}