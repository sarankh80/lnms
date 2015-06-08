<?php 
Class Other_Form_FrmDistrict extends Zend_Dojo_Form {
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
	public function FrmAddDistrict($data=null){
		
		$request=Zend_Controller_Front::getInstance()->getRequest();
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array('dojoType'=>$this->tvalidate,
				'onkeyup'=>'this.submit()',
				'placeholder'=>$this->tr->translate("SEARCH_DISTRICT_INFO")
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
		
		$district_name = new Zend_Dojo_Form_Element_TextBox('district_name');
		$district_name->setAttribs(array('dojoType'=>'dijit.form.ValidationTextBox',
				'required'=>'true','missingMessage'=>'Invalid Module!','class'=>'fullside'
				));
		
		$district_namekh = new Zend_Dojo_Form_Element_TextBox('district_namekh');
		$district_namekh->setAttribs(array('dojoType'=>'dijit.form.ValidationTextBox',
				'required'=>'true','missingMessage'=>'Invalid Module!','class'=>'fullside'
		));
		
		$popupdistrict_name = new Zend_Dojo_Form_Element_TextBox('pop_district_name');
		$popupdistrict_name->setAttribs(array('dojoType'=>'dijit.form.ValidationTextBox',
				'required'=>'true','missingMessage'=>'Invalid Module!','class'=>'fullside'
		));
		
		$pop_district_namekh = new Zend_Dojo_Form_Element_TextBox('pop_district_namekh');
		$pop_district_namekh->setAttribs(array('dojoType'=>'dijit.form.ValidationTextBox',
				'required'=>'true','missingMessage'=>'Invalid Module!','class'=>'fullside'
		));
		
		$_display =  new Zend_Dojo_Form_Element_FilteringSelect('display');
		$_display->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside',));
		$_display_opt = array(
				1=>$this->tr->translate("NAME_KHMER"),
				2=>$this->tr->translate("NAME_EN"));
		$_display->setMultiOptions($_display_opt);

		$_db = new Application_Model_DbTable_DbGlobal();		
		$rows_province = $_db->getAllProvince();
		$opt_province = array(''=>$this->tr->translate("SELECT_PROVINCE"));
		if(!empty($rows_province))foreach($rows_province AS $row) $opt_province[$row['province_id']]=$row['province_en_name'];
		
		$_province = new Zend_Dojo_Form_Element_FilteringSelect('province_name');
		$_province->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'
		));
		
		$_province->setMultiOptions($opt_province);
		$_province->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'class'=>'fullside',
				));
		$_province->setValue($request->getParam('province_name'));
		
		if(!empty($rows_province))foreach($rows_province AS $row) $opt_province[$row['province_id']]=$row['province_en_name'];
		
		$_provincess=new Zend_Dojo_Form_Element_FilteringSelect('province_names');
		$_provincess->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'filterDistrict();',
		));
		$_provincess->setMultiOptions($opt_province);
		
		
		$_arr = array(1=>$this->tr->translate("ACTIVE"),0=>$this->tr->translate("DACTIVE"));
		$_status = new Zend_Dojo_Form_Element_FilteringSelect("status");
		$_status->setMultiOptions($_arr);
		$_status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'missingMessage'=>'Invalid Module!',
				'class'=>'fullside'));
		$id = new Zend_Form_Element_Hidden('id');
		if(!empty($data)){
			$id->setValue($data['dis_id']);
			$district_name->setValue($data['district_name']);
			$district_namekh->setValue($data['district_namekh']);
			$_display->setValue($data['displayby']);
			$_province->setValue($data['pro_id']);
			
			$_status->setValue($data['status']);
		}
		$this->addElements(array($pop_district_namekh,$_provincess,$_status_search,$_title,$id,$district_name,$popupdistrict_name,$district_namekh,$_display,$_province, $_status));
		return $this;
		
	}
	
	
}