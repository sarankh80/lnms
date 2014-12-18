<?php 
Class Accounting_Form_Frmaccountcate extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function Frmaccountcate($data=null){
		
		$Categoryname_kh = new Zend_Dojo_Form_Element_TextBox('categoryname_kh');
		$Categoryname_kh->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
				));
		
		$Categoryname_Eng = new Zend_Dojo_Form_Element_TextBox('categoryname_eng');
		$Categoryname_Eng->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$Type = new Zend_Dojo_Form_Element_FilteringSelect('type');
		$Type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$opt=array(1=>'Asset',2=>'Liabilities',3=>'Equity');
		$Type->setMultiOptions($opt);
		
		
		
		$Date=new Zend_Dojo_Form_Element_DateTextBox('date');
		$Date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
				));
		$Date->setValue(date('Y-m-d'));
		
		$_display=  new Zend_Dojo_Form_Element_FilteringSelect('display');
		$_display->setAttribs(array('dojoType'=>$this->filter,'class'=>'fullside',));
		$_display_opt = array(
				1=>$this->tr->translate("NAME_KHMER"),
				2=>$this->tr->translate("NAME_ENGLISH"));
		$_display->setMultiOptions($_display_opt);
		
		$Status = new Zend_Dojo_Form_Element_FilteringSelect('status');
		$Status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$opt=array(1=>'Active',2=>'Deactive');
		$Status->setMultiOptions($opt);
		
		
		
		
// 		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
// 		$_branch_id->setAttribs(array(
// 				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
// 				'required' =>'true'
// 		));
// 		$db = new Application_Model_DbTable_DbGlobal();
// 		$rows = $db->getAllBranchName();
// 		$options='';
// 		if(!empty($rows))foreach($rows AS $row){
// 			$options[$row['br_id']]=$row['branch_namekh'];
// 		}
// 		$_branch_id->setMultiOptions($options);
		 
// 		$_id = new Zend_Form_Element_Hidden('id');
		
		$this->addElements(array($Categoryname_kh,$Categoryname_Eng,$Type,
				$Date,$_display,$Status));
		return $this;
		
	}	
}