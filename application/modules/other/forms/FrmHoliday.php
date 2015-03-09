<?php 
Class Other_Form_FrmHoliday extends Zend_Dojo_Form {
	protected $tr;
	protected $tvalidate ;//text validate
	protected $filter;
	protected $text;
	protected $date;
	protected $tarea=null;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
		$this->tvalidate = 'dijit.form.ValidationTextBox';
		$this->filter = 'dijit.form.FilteringSelect';
		$this->text = 'dijit.form.TextBox';
		$this->date = 'dijit.form.DateTextBox';
		$this->tarea = 'dijit.form.SimpleTextarea';
	}
	public function FrmAddHoliday($_data=null){
	
		$request=Zend_Controller_Front::getInstance()->getRequest();
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array('dojoType'=>$this->tvalidate,
				'onkeyup'=>'this.submit()',
				'placeholder'=>$this->tr->translate("SEARCH_HILIDAY_INFO")
		));
		$_title->setValue($request->getParam("adv_search"));
		
		
		$_status_search=  new Zend_Dojo_Form_Element_FilteringSelect('search_status');
		$_status_search->setAttribs(array('dojoType'=>$this->filter));
		$_status_opt = array(
				-1=>$this->tr->translate("ALL"),
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status_search->setMultiOptions($_status_opt);
		$_status_search->setValue($request->getParam("search_status"));
		
		$_btn_search = new Zend_Dojo_Form_Element_SubmitButton('btn_search');
		$_btn_search->setAttribs(array(
				'dojoType'=>'dijit.form.Button',
				'iconclass'=>'dijitIconSearch',
		
		));
		
		$_holiday_name = new Zend_Dojo_Form_Element_TextBox('holiday_name');
		$_holiday_name->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_startdate = new Zend_Dojo_Form_Element_DateTextBox('start_date');
		$_startdate->setAttribs(array('dojoType'=>$this->date,'required'=>'true',
				'class'=>'fullside',
				'onchange'=>'CalculateDate();'));
		$date = date("Y-m-d");
		$_startdate->setValue($date);
		
		$_enddate = new Zend_Dojo_Form_Element_DateTextBox('end_date');
		$_enddate->setAttribs(array('dojoType'=>$this->date,'required'=>'true','class'=>'fullside',
				));
		$_date = date("Y-m-d");
		$_enddate->setValue($_date);
		
		$_amount_day = new Zend_Dojo_Form_Element_NumberTextBox('amount_day');
		$_amount_day->setAttribs(array('dojoType'=>'dijit.form.NumberTextBox','required'=>'true',
				'class'=>'fullside',
				'onkeyup'=>'CalculateDate();',
				));
		
		$_note = new Zend_Dojo_Form_Element_TextBox('note');
		$_note->setAttribs(array('dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>$this->filter,'class'=>'fullside',));
		$_status_opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		
		$_id = new Zend_Form_Element_Hidden('id');
		if(!empty($_data)){
			$_holiday_name->setValue($_data['holiday_name']);
			$_startdate->setValue($_data['start_date']);
			$_amount_day->setValue($_data['amount_day']);
			$_enddate->setValue($_data['end_date']);
			$_status->setValue($_data['status']);
			$_id->setValue($_data['id']);
			$_note->setValue($_data['note']);
		}
		$this->addElements(array($_btn_search,$_status_search,$_title,$_id,$_holiday_name,$_note,$_startdate,$_enddate,$_amount_day,$_status));
		return $this;
	}
	
}