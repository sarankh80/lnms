<?php 
Class Group_Form_Frmreturncollteral extends Zend_Dojo_Form {
	protected $tr=null;
	protected $tvalidate=null ;//text validate
	protected $filter=null;
	protected $text=null;
	protected $tarea=null;
	public function getUserName(){
		$session_user=new Zend_Session_Namespace('auth');
		return $session_user->user_name;
	}
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
		$this->tvalidate = 'dijit.form.ValidationTextBox';
		$this->filter = 'dijit.form.FilteringSelect';
		$this->text = 'dijit.form.TextBox';
		$this->tarea = 'dijit.form.SimpleTextarea';
	}
	
	public function FrmReturnCollteral($data=null){
		$db = new Application_Model_DbTable_DbGlobal();
		$request=Zend_Controller_Front::getInstance()->getRequest();
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array(
				'dojoType'=>$this->tvalidate,
				'onkeyup'=>'this.submit()',
				'placeholder'=>$this->tr->translate("SEARCH_CHANGE_COLLTERAL")
		));
		$_title->setValue($request->getParam("adv_search"));

		$_status_search=  new Zend_Dojo_Form_Element_FilteringSelect('status_search');
		$_status_search->setAttribs(array('dojoType'=>$this->filter));
		$_status_opt = array(
				-1=>$this->tr->translate("ALL"),
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status_search->setMultiOptions($_status_opt);
		$_status_search->setValue($request->getParam("status_search"));
		
		$_btn_search = new Zend_Dojo_Form_Element_SubmitButton('btn_search');
		$_btn_search->setAttribs(array(
				'dojoType'=>'dijit.form.Button',
				'iconclass'=>'dijitIconSearch'
		));
		
		$Date=new Zend_Dojo_Form_Element_DateTextBox('date');
		$Date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
				));
		
		$note=new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
	
		$Date->setValue(date('Y-m-d'));
		$stutas = new Zend_Dojo_Form_Element_FilteringSelect('stutas');
		$stutas ->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"ប្រើប្រាស់",0=>"មិនប្រើប្រាស់");
		$stutas->setMultiOptions($options);
		
		$receiver_name=new Zend_Dojo_Form_Element_TextBox('receiver_name');
		$receiver_name->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
				));
		
		$giver_name=new Zend_Dojo_Form_Element_TextBox('giver_name');
		$giver_name->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$id = new Zend_Form_Element_Hidden("id");
		$receiver_name->setValue($this->getUserName());
		if($data!=null){
			$giver_name->setValue($data['giver_name']);
			$receiver_name->setValue($data['receiver_name']);
			$note->setValue($data['note']);
			$Date->setValue($data['date']);
			$stutas->setValue($data['status']);
			$id->setValue($data['return_id']);
		}
// 		print_r($data);exit();
		$this->addElements(array($giver_name,$receiver_name,$_btn_search,$_status_search,
				$_title,$Date,$note,$Date,$id,$stutas));
		return $this;
		
	}	
}