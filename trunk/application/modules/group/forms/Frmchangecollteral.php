<?php 
Class Group_Form_Frmchangecollteral extends Zend_Dojo_Form {
	protected $tr=null;
	protected $tvalidate=null ;//text validate
	protected $filter=null;
	protected $text=null;
	protected $tarea=null;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
		$this->tvalidate = 'dijit.form.ValidationTextBox';
		$this->filter = 'dijit.form.FilteringSelect';
		$this->text = 'dijit.form.TextBox';
		$this->tarea = 'dijit.form.SimpleTextarea';
	}
	public function FrmChangeCollteral($data=null){
		$db = new Application_Model_DbTable_DbGlobal();
		$request=Zend_Controller_Front::getInstance()->getRequest();
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array(
				'dojoType'=>$this->tvalidate,
				'onkeyup'=>'this.submit()',
				'placeholder'=>$this->tr->translate("SEARCH_COLLTERAL")
		));
		$_title->setValue($request->getParam("adv_search"));
		
		$_client_code = new Zend_Dojo_Form_Element_FilteringSelect('client_code');
		$_client_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'getOwnerInfo();'
		));
		$group_opt = $db ->getGroupCodeById(1,0,1);//code,individual,option
		$_client_code->setMultiOptions($group_opt);
		$_client_code->setValue($request->getParam('client_code'));
		
		
		$_status_search=  new Zend_Dojo_Form_Element_FilteringSelect('status_search');
		$_status_search->setAttribs(array('dojoType'=>$this->filter));
		$_status_opt = array(
				-1=>$this->tr->translate("ALL"),
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status_search->setMultiOptions($_status_opt);
		$_status_search->setValue($request->getParam("status_search"));
		
		$_btn_search = new Zend_Dojo_Form_Element_SubmitButton('btn_search');
		$_btn_search->setAttribs(array(
				'dojoType'=>'dijit.form.Button',
				'iconclass'=>'dijitIconSearch'
		));
		
		
		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
    	$_branch_id->setAttribs(array(
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
    	$_branch_id->setMultiOptions($options);
    	$_branch_id->setValue($request->getParam('branch_id'));
		
		
		$db = new Application_Model_DbTable_DbGlobal();
		$co_name = new Zend_Dojo_Form_Element_FilteringSelect('co_name');
		$rows = $db ->getAllCOName();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
		$co_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckCO();'
		));
		
		$Date=new Zend_Dojo_Form_Element_DateTextBox('date');
		$Date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
				));
		
		$number_code = new Zend_Dojo_Form_Element_NumberTextBox('number_code');
		$number_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$contract_code = new Zend_Dojo_Form_Element_NumberTextBox('contract_code');
		$contract_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$_code = new Zend_Dojo_Form_Element_NumberTextBox('code');
		$_code ->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));

		$clint_name = new Zend_Dojo_Form_Element_FilteringSelect('client_name');
		$clint_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'checkClientCode()'
		));
		$options = $db->getGroupCodeById(2,0,1);
		$clint_name->setMultiOptions($options);
		
		$owner=new Zend_Dojo_Form_Element_ValidationTextBox('owner');
		$owner->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside'
		));
		
        $db = new Application_Model_DbTable_DbGlobal();
		$collteral_type=new Zend_Dojo_Form_Element_FilteringSelect('collteral_type');
		$collteral_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'
				));
		$opt= $db->getCollteralType(1);
		$opt=array(1=>'ផ្ទាល់ខ្លួន',2=>'អ្នកធានាជំនួស');
		$collteral_type->setMultiOptions($opt);
		$collteral_type->setValue(1);
		
		
		$note=new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$Date=new Zend_Dojo_Form_Element_DateTextBox('date');
		$Date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
		));
		$Date->setValue(date('Y-m-d'));
		$stutas = new Zend_Dojo_Form_Element_FilteringSelect('Stutas');
		$stutas ->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"ប្រើប្រាស់",2=>"មិនប្រើប្រាស់");
		$stutas->setMultiOptions($options);
		
		$cod_cal = new Zend_Dojo_Form_Element_TextBox('cod_cal');
		$cod_cal ->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'readOnly'=>'readOnly',
				'class'=>'fullside',
				'style'=>'color:red'
		));
		$code = Group_Model_DbTable_DbCallteral::getCallteralCode();
		$cod_cal->setValue($code);
		
		$db = new Application_Model_DbTable_DbGlobal();
		$from = new Zend_Dojo_Form_Element_FilteringSelect('from');
		$from->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$opt= $db->getVewOptoinTypeByType(13,1);
		$from->setMultiOptions($opt);
		$from->setValue($request->getParam('from'));
		
		$to = new Zend_Dojo_Form_Element_FilteringSelect('to');
		$to->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		
		$opt= $db->getCollteralType(1);
		$to->setMultiOptions($opt);
		
		$id = new Zend_Form_Element_Hidden("id");
		if($data!=null){
		
			$_branch_id->setValue($data['branch_id']);
			$cod_cal->setValue($data['code_call']);
			$co_name->setValue($data['co_id']);
			$contract_code->setValue($data['contract_code']);
			$clint_name->setValue($data['client_name']);
			$_client_code->setValue($data['client_code']);
			$owner->setValue($data['owner']);
			$collteral_type->setValue($data['callate_type']);
			$note->setValue($data['note']);
			$Date->setValue($data['date_registration']);
			$stutas->setValue($data['status']);
			$id->setValue($data['id']);
			
		}

		$this->addElements(array($from,$to,$_client_code,$_btn_search,$_status_search,$_title,$co_name,$Date,$number_code,$contract_code,$_code,
				$clint_name,$owner,$collteral_type,$note,
				$Date,$_branch_id,$id,$stutas,$cod_cal));
		return $this;
		
	}	
}