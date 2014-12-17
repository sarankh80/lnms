<?php 
Class Other_Form_Frmbranch extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmBranch($data=null){
		
		$br_id = new Zend_Dojo_Form_Element_NumberTextBox('br_id');
		$br_id->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'Calcuhundred()'
				));
		
		$branch_namekh = new Zend_Dojo_Form_Element_TextBox('branch_namekh');
		$branch_namekh->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'onkeyup'=>'Calfifty()'
				));

		$branch_nameen = new Zend_Dojo_Form_Element_TextBox('branch_nameen');
		$branch_nameen->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'onkeyup'=>'Caltweenty()'
				));
		$branch_code = new Zend_Dojo_Form_Element_NumberTextBox('branch_code');
		$branch_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'Calfive()'
		));
		
		$branch_tel = new Zend_Dojo_Form_Element_NumberTextBox('branch_tel');
		$branch_tel->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'Calfive()'
				));
		
		$fax = new Zend_Dojo_Form_Element_TextBox('_fax');
		$fax->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'Calone()'
				));
		
		///*** result of calculator ///***
		$br_other = new Zend_Dojo_Form_Element_TextBox('br_other');
		$br_other->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
// 				'readonly'=>true
				));
		
		$br_status = new Zend_Dojo_Form_Element_TextBox('br_status');
		$br_status->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
// 				'readonly'=>true
				));
		
		$branch_display = new Zend_Dojo_Form_Element_TextBox('branch_display');
		$branch_display->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
// 				'readonly'=>true
				));
		$br_address = new Zend_Dojo_Form_Element_TextBox('br_address');
		$br_address->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				// 				'readonly'=>true
		));
		
		$this->addElements(array($br_id,$branch_namekh,$branch_nameen,$br_address,$branch_code,$branch_tel,$fax,
				
			 $br_other,$br_status,$branch_display ));
		
		return $this;
		
	}
	
}