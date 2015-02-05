<?php 
Class Callecterall_Form_Frmrefundcallecterall extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		
	}
	public function Frmrefundcallecterall(){
		$branch = new Zend_Dojo_Form_Element_FilteringSelect('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		
		$callecterall_code = new Zend_Dojo_Form_Element_FilteringSelect('callecterall_code');
		$callecterall_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$client_id = new Zend_Dojo_Form_Element_FilteringSelect('client_id');
		$client_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		
		$fund_amount = new Zend_Dojo_Form_Element_FilteringSelect('fund_amount');
		$fund_amount->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		
		$date = new Zend_Dojo_Form_Element_FilteringSelect('date');
		$date->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		
		$innalization = new Zend_Dojo_Form_Element_TextBox('innalization');
		$innalization->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$note = new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$stastu = new Zend_Dojo_Form_Element_FilteringSelect('stastu');
		$stastu->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		
		
		
		$this->addElements(array($branch,$stastu,$note,$innalization,$date,$fund_amount,$client_id,$callecterall_code));
		return $this;
		
		}
		}