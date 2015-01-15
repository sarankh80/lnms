<?php 
Class Callecterall_Form_Frmcallecteralllist extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		
	}
	public function callecteralllist(){
		
		$branch = new Zend_Dojo_Form_Element_FilteringSelect('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"សាខា កណ្តាល",2=>"សាខា ទី១");
		$branch->setMultiOptions($options);
	
		
		$db = new Application_Model_DbTable_DbGlobal();
		$customer_name = new Zend_Dojo_Form_Element_FilteringSelect('customer_name');
		$customer_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckCO();'
		));
		$opt= $db->getVewOptoinTypeByType(2);
		$customer_name->setMultiOptions($opt);
		$customer_name->setValue(1);
		
		
		$cus_code = new Zend_Dojo_Form_Element_NumberTextBox('cus_code');
		$cus_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
				));
		
		$num_vi = new Zend_Dojo_Form_Element_NumberTextBox('num_vi');
		$num_vi->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$date = new Zend_Dojo_Form_Element_DateTextBox('$date');
		$date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		
		$time_think = new Zend_Dojo_Form_Element_TextBox('time_think');
		$time_think->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$time_short = new Zend_Dojo_Form_Element_NumberTextBox('time_short');
		$time_short->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$date_call = new Zend_Dojo_Form_Element_DateTextBox('date_call');
		$date_call->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$callecterall_type = new Zend_Dojo_Form_Element_FilteringSelect('callecterall_type');
		$callecterall_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt= $db->getVewOptoinTypeByType(13,1);
		$callecterall_type->setMultiOptions($opt);
		$callecterall_type->setValue(1);
		
		$callecterall_code = new Zend_Dojo_Form_Element_NumberTextBox('callecterall_code');
		$callecterall_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$note = new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		
		$cash_type = new Zend_Dojo_Form_Element_FilteringSelect('cash_type');
		$cash_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		
		$much_boro = new Zend_Dojo_Form_Element_NumberTextBox('much_boro');
		$much_boro->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		$this->addElements(array($branch,$customer_name,$cus_code,$num_vi,$date,$time_think,$time_short,
				$date_call,$callecterall_type,$callecterall_code,$note,$cash_type,$much_boro));
		return $this;
		
	}	
}