<?php 
Class Other_Form_FrmCO extends Zend_Dojo_Form {
	protected $tr;
	protected $tvalidate ;//text validate
	protected $filter;
	protected $text;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
		$this->tvalidate = 'dijit.form.ValidationTextBox';
		$this->filter = 'dijit.form.FilteringSelect';
		$this->text = 'dijit.form.TextBox';
	}
	public function FrmAddCO($_data=null){
	
		$_co_id = new Zend_Dojo_Form_Element_TextBox('co_id');
		$_co_id->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_name_kh = new Zend_Dojo_Form_Element_TextBox('name_kh');
		$_name_kh->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_enname = new Zend_Dojo_Form_Element_TextBox('first_name');
		$_enname->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_lname = new Zend_Dojo_Form_Element_TextBox('last_name');
		$_lname->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));
		
		$_tel = new Zend_Dojo_Form_Element_TextBox('tel');
		$_tel->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_email = new Zend_Dojo_Form_Element_TextBox('email');
		$_email->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));
		
		$_address = new Zend_Dojo_Form_Element_TextBox('address');
		$_address->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));
		
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>$this->filter,'class'=>'fullside',));
		$_status_opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		
		$_id = new Zend_Form_Element_Hidden('id');
		
		if(!empty($_data)){
			$_co_id->setValue($_data['co_code']);
			$_name_kh->setValue($_data['co_khname']);
			$_enname->setValue($_data['co_firstname']);
			$_lname->setValue($_data['co_lastname']);
			$_tel->setValue($_data['tel']);
			$_email->setValue($_data['email']);
			$_address->setValue($_data['address']);
			$_status->setValue($_data['status']);
			$_id->setValue($_data['co_id']);
		}
		$this->addElements(array($_id,$_co_id,$_name_kh,$_enname,$_lname,$_tel,$_email,$_address,$_status));
		
		return $this;
		
	}
	
}