<?php

class Application_Form_FrmAdvanceSearch extends Zend_Dojo_Form
{

protected $tr;
	protected $tvalidate =null;//text validate
	protected $filter=null;
	protected $t_num=null;
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
	public function AdvanceSearch($data=null,$type=null){
		$request=Zend_Controller_Front::getInstance()->getRequest();
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array('dojoType'=>$this->tvalidate,
				'onkeyup'=>'this.submit()'));
		$_title->setValue($request->getParam("adv_search"));
		
		
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>$this->filter));
		$_status_opt = array(
				-1=>$this->tr->translate("ALL"),
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		$_status->setValue($request->getParam("status"));
		
		
		$db = new Application_Model_DbTable_DbGlobal(); 
		
		$employee = new Zend_Dojo_Form_Element_FilteringSelect('employee');
		$rows = $db ->getAllCOName();
		$options=array(''=>"---ស្វែងរកតាមរយៈឈ្មោះ---");
		if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
		$employee->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckCO();'
		));
		$employee->setMultiOptions($options);
		$employee->setValue($request->getParam('employee'));
		
		$_btn_search = new Zend_Dojo_Form_Element_SubmitButton('btn_search');
		$_btn_search->setAttribs(array('dojoType'=>'dijit.form.Button','iconclass'=>'dijitIconSearch'));
		
		$this->addElements(array($employee,$_title,$_title,$_status,$_btn_search));
		return $this;
	}
	
}