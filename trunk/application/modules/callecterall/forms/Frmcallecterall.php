<?php 
Class Callecterall_Form_Frmcallecterall extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		
	}
	public function Frmcallecterall($data=null){
		
		$name_en = new Zend_Dojo_Form_Element_TextBox('name_en');
		$name_en->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$name_kh = new Zend_Dojo_Form_Element_TextBox('name_kh');
		$name_kh->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$key_code = new Zend_Dojo_Form_Element_NumberTextBox('key_code');
		$key_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
				));
	  $_id = new Zend_Form_Element_Hidden('id');
		
		if($data!=null){
			$name_en->setValue($data['name_en']);
			$name_kh->setValue($data['name_kh']);
			$key_code->setValue($data['key_code']);
		    $_id->setValue($data['id']);
			
		}
		$this->addElements(array($name_en,$name_kh,$key_code,$_id));
		return $this;
		
	}	
}