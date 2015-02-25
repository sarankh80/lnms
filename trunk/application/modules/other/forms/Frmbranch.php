<?php 
Class Other_Form_Frmbranch extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function Frmbranch($data=null){
		
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
		
		$_fax = new Zend_Dojo_Form_Element_TextBox('fax ');
		$_fax->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'Calone()'
				));
		
		///*** result of calculator ///***
		$branch_note = new Zend_Dojo_Form_Element_TextBox('branch_note');
		$branch_note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
// 				'readonly'=>true
				));
		
		$branch_status = new Zend_Dojo_Form_Element_FilteringSelect('branch_status');
		$branch_status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
// 				'readonly'=>true
				));
		$options = array(1=>"ប្រើប្រាស់", 2=>"មិនប្រើប្រាស់");
		$branch_status->setMultiOptions($options);
		
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
				//'readonly'=>true
		));
	
		
		$_id = new Zend_Form_Element_Hidden('id');
		
		$this->addElements(array($br_id,$branch_namekh,$branch_nameen,$br_address,$branch_code,$branch_tel,$_fax ,$branch_note,
				$branch_status,$branch_display));
		
		if(!empty($data)){
			  
			$br_id->setValue($data['br_id']);
			$branch_namekh->setValue($data['branch_namekh']);
			$branch_nameen->setValue($data['branch_nameen']);
			$br_address->setValue($data['br_address']);
			$branch_tel->setValue($data['branch_tel']);
			$branch_code->setValue($data['branch_code']);
			$_fax->setValue($data['fax']);
			$branch_note->setValue($data['other']);
			$branch_status->setValue($data['status']);
			$branch_display->setValue($data['displayby']);
			
		}
		return $this;
		
	}
	
}