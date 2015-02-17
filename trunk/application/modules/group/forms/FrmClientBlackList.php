<?php 
Class Group_Form_FrmClientBlackList extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmClientBlackList($data=null){
		
		$branch = new Zend_Dojo_Form_Element_TextBox('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$client_code = new Zend_Dojo_Form_Element_FilteringSelect('client_code');
		$client_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				//'onchange'=>'popupCheckVillage();'
		));
		$client_name = new Zend_Dojo_Form_Element_FilteringSelect('client_name');
		$client_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				//'onchange'=>'popupCheckVillage();'
		));
		$problem=new Zend_Dojo_Form_Element_TextBox('problem');
		$problem->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				));
		$date = new Zend_Dojo_Form_Element_DateTextBox('date');
		$date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$date->setValue(date('Y-m-d'));
		$status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$status->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside',));
		$opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$status->setMultiOptions($opt);
	
// 		$_id = new Zend_Form_Element_Hidden('id');
		if($data!=null){
			
		}
		$this->addElements(array($branch,$client_code,$client_name,$problem,$date,$status));
				
		return $this;
		
	}	
}