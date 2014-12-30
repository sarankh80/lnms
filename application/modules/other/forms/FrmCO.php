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
		
		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
		$_branch_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$rows = $db->getAllBranchName();
		$options='';
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['br_id']]=$row['branch_namekh'];
		}
		$_branch_id->setMultiOptions($options);
		
		$_name_kh = new Zend_Dojo_Form_Element_TextBox('name_kh');
		$_name_kh->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_enname = new Zend_Dojo_Form_Element_TextBox('first_name');
		$_enname->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_lname = new Zend_Dojo_Form_Element_TextBox('last_name');
		$_lname->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));
		
		$_sex = new Zend_Dojo_Form_Element_FilteringSelect('co_sex');
		$_sex->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt = array(1=>"Male",2=>"Femail");
		$_sex->setMultiOptions($opt);
		
		$_tel = new Zend_Dojo_Form_Element_TextBox('tel');
		$_tel->setAttribs(array('dojoType'=>$this->tvalidate,'required'=>'true','class'=>'fullside',));
		
		$_position = new Zend_Dojo_Form_Element_FilteringSelect('position');
		$_position->setAttribs(array('dojoType'=>$this->filter,
				'required'=>'true','class'=>'fullside',));
		
		$db = new Application_Model_DbTable_DbGlobal();
		$opt = $db->getAllStaffPosition(null,1);
		$_position->setMultiOptions($opt);
		
		$_email = new Zend_Dojo_Form_Element_TextBox('email');
		$_email->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));

		$_national_id = new Zend_Dojo_Form_Element_TextBox('national_id');
		$_national_id->setAttribs(array('dojoType'=>'dijit.form.NumberTextBox','class'=>'fullside',));
		
		
		$_address = new Zend_Dojo_Form_Element_TextBox('address');
		$_address->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));
		
		$_pob = new Zend_Dojo_Form_Element_TextBox('pob');
		$_pob->setAttribs(array('dojoType'=>$this->text,'class'=>'fullside',));
		
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
		
		$_degree=  new Zend_Dojo_Form_Element_FilteringSelect('degree');
		$_degree->setAttribs(array('dojoType'=>$this->filter,'class'=>'fullside',));
		$degree_opt = $db->getAllDegree();
		$_degree->setMultiOptions($degree_opt);
		
		$_basic_salary=  new Zend_Dojo_Form_Element_NumberTextBox('basic_salary');
		$_basic_salary->setAttribs(array('dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
				));
		
		$_start_work=  new Zend_Dojo_Form_Element_DateTextBox('start_date');
		$_start_work->setAttribs(array('dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'));
		$_start_work->setValue(date('Y-m-d'));
		
		$_end_work=  new Zend_Dojo_Form_Element_DateTextBox('end_date');
		$_end_work->setAttribs(array('dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'));
		
		$_contract=  new Zend_Dojo_Form_Element_TextBox('contract_no');
		$_contract->setAttribs(array('dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside'));
		
		$_note =  new Zend_Dojo_Form_Element_TextBox('note');
		$_note->setAttribs(array('dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside'));
		
		$opt_shift=array(1=>'ពេញម៉ោង',2=>'ក្រៅម៉ោង');
		$_shift =  new Zend_Dojo_Form_Element_FilteringSelect('shift');
		$_shift->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'));
		$_shift->setMultiOptions($opt_shift);
		
		$opt_workingtime=array(1=>'ពេលព្រឹក',2=>'ពេលល្ងាច',3=>'ពេលព្រឹក និង ពេលល្ងាច​');
		$_workingtime =  new Zend_Dojo_Form_Element_FilteringSelect('workingtime');
		$_workingtime->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'));
		$_workingtime->setMultiOptions($opt_workingtime);
		
		$_id = new Zend_Form_Element_Hidden('id');
		
		if(!empty($_data)){
			$_co_id->setValue($_data['co_code']);
			$_name_kh->setValue($_data['co_khname']);
			$_enname->setValue($_data['co_firstname']);
			$_lname->setValue($_data['co_lastname']);
			
			$_display->setValue($_data['displayby']);
			$_national_id->setValue($_data['national_id']);
			$_pob->setValue($_data['pob']);
			$_degree->setValue($_data['degree']);
			
			$_tel->setValue($_data['tel']);
			$_email->setValue($_data['email']);
			$_address->setValue($_data['address']);
			$_status->setValue($_data['status']);
			$_id->setValue($_data['co_id']);
			$_basic_salary->setValue($_data['basic_salary']);
			$_start_work->setValue($_data['start_date']);
			$_end_work->setValue($_data['end_date']);
			$_contract->setValue($_data['contract_no']);
			$_note->setValue($_data['note']);//echo $_data['note']; exit();
			$_shift->setValue($_data['shift']);
			$_workingtime->setValue($_data['workingtime']);
		}
		$this->addElements(array($_id,$_co_id,$_name_kh,$_branch_id,$_degree,$_national_id,$_display,$_enname,$_lname,
				$_sex,$_tel,$_email,$_pob,$_address,$_shift,$_workingtime,$_status,$_position,$_basic_salary,$_start_work,$_end_work,$_contract,$_note));
		
		return $this;
	}
}