<?php 
Class Group_Form_FrmClientBlackList extends Zend_Dojo_Form {
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
	public function FrmClientBlackList($data=null){
		$request=Zend_Controller_Front::getInstance()->getRequest();
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array('dojoType'=>$this->tvalidate,
				'onkeyup'=>'this.submit()',
				'placeholder'=>$this->tr->translate("SEARCH_FACULTY_NAME")
		));
		$_title->setValue($request->getParam("adv_search"));
		
		
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status_search');
		$_status->setAttribs(array('dojoType'=>$this->filter));
		$_status_opt = array(
				-1=>$this->tr->translate("ALL"),
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		$_status->setValue($request->getParam("status"));
		
		
		$db = new Application_Model_DbTable_DbGlobal();
		
// 		$employee = new Zend_Dojo_Form_Element_FilteringSelect('employee');
// 		$rows = $db ->getAllCOName();
// 		$options=array(''=>"---ស្វែងរកតាមរយៈឈ្មោះ---");
// 		if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
// 		$employee->setAttribs(array(
// 				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
// 				'onchange'=>'popupCheckCO();'
// 		));
// 		$employee->setMultiOptions($options);
// 		$employee->setValue($request->getParam('employee'));
		
		$_btn_search = new Zend_Dojo_Form_Element_SubmitButton('btn_search');
		$_btn_search->setAttribs(array(
				'dojoType'=>'dijit.form.Button',
				'iconclass'=>'dijitIconSearch',
		
		));
		
		
		$db = new Application_Model_DbTable_DbGlobal();
		$branch = new Zend_Dojo_Form_Element_FilteringSelect('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$rows = $db->getAllBranchName();
		$options='';
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['br_id']]=$row['branch_namekh'];
		}
		$branch->setMultiOptions($options);
		
		
		
		$client_code = new Zend_Dojo_Form_Element_FilteringSelect('client_code');
		$client_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				'onchange'=>'getmemberIdGroup();'
		));
		$group_opt = $db ->getGroupCodeById(1,0,1);//code,individual,option
		$client_code->setMultiOptions($group_opt);
		
		$client_name = new Zend_Dojo_Form_Element_FilteringSelect('client_name');
		$client_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				'onchange'=>'checkMember()'
		));
		$options = $db->getGroupCodeById(2,0,1);
		$client_name->setMultiOptions($options);
		
		$problem=new Zend_Dojo_Form_Element_TextBox('problem');
		$problem->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				));
		$date = new Zend_Dojo_Form_Element_DateTextBox('date');
		$date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$date->setValue(date('Y-m-d'));
		$status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$status->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside',));
		$opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$status->setMultiOptions($opt);
	
// 		$_id = new Zend_Form_Element_Hidden('id');
		if($data!=null){
			
		}
		$this->addElements(array($_title,$_status,$_btn_search,$branch,$client_code,$client_name,$problem,$date,$status));
				
		return $this;
		
	}	
}