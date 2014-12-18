<?php 
Class Other_Form_FrmPosition extends Zend_Dojo_Form {
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
	public function FrmAddPosition($_data=null){
		$position_en = new Zend_Dojo_Form_Element_TextBox('position_en');
		$position_en->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$position_kh = new Zend_Dojo_Form_Element_TextBox('position_kh');
		$position_kh->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>$this->filter,'class'=>'fullside',));
		$_status_opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		
		$_display=  new Zend_Dojo_Form_Element_FilteringSelect('display');
		$_display->setAttribs(array('dojoType'=>$this->filter,'class'=>'fullside',));
		$_display_opt = array(
				1=>$this->tr->translate("NAME_KHMER"),
				2=>$this->tr->translate("NAME_ENGLISH"));
		$_display->setMultiOptions($_display_opt);
		
		$_id = new Zend_Form_Element_Hidden('id');
		
// 			$position_en->setValue($_data['position_en']);
		
		if(!empty($_data)){
			$position_en->setValue($_data['position_en']);
			$position_kh->setValue($_data['position_kh']);
			$_status->setValue($_data['status']);
			$_display->setValue($_data['displayby']);
			$_id->setValue($_data['id']);

		}
		$this->addElements(array($_id,$position_en,$position_kh,$_status,$_display));
		
		return $this;
	}
}