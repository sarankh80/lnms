<?php 
Class Group_Form_FrmClientBlackList extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmClientBlackList($data=null){
		
	
		$_member = new Zend_Dojo_Form_Element_FilteringSelect('group_id');
		$_member->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'getGroupCode();'
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$rows = $db->getClientByType(1);
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['client_id']]=$row['name_en'];
		$_member->setMultiOptions($options);
		
		$_namekh = new Zend_Dojo_Form_Element_TextBox('name_kh');
		$_namekh->setAttribs(array(
						'dojoType'=>'dijit.form.ValidationTextBox',
						'class'=>'fullside',
						//'required' =>'true'
		));
		
		$id_client = $db->getNewClientId();
		$_clientno = new Zend_Dojo_Form_Element_TextBox('client_no');
		$_clientno->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'readonly'=>'readonly',
				'style'=>'color:red;'
		));
		$_clientno->setValue($id_client);
	
		$_nameen = new Zend_Dojo_Form_Element_TextBox('name_en');
		$_nameen->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside',
			//	'required' =>'true'
		));
		
		$_sex = new Zend_Dojo_Form_Element_FilteringSelect('sex');
		$_sex->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt = array(1=>"Male",2=>"Femail");
		$_sex->setMultiOptions($opt);
		
		$_situ_status = new Zend_Dojo_Form_Element_FilteringSelect('situ_status');
		$_situ_status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt_status = $db->getAllSituation();
		$_situ_status->setMultiOptions($opt_status);
		
		$_province = new Zend_Dojo_Form_Element_FilteringSelect('province');
		$_province->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'filterDistrict();'
		));
		$rows =  $db->getAllProvince();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['province_id']]=$row['province_en_name'];
		$_province->setMultiOptions($options);
		
		
		$_district = new Zend_Dojo_Form_Element_FilteringSelect('district');
		$rows =  $db->getAllDistrict();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['dis_id']]=$row['district_name'];
		$_district->setMultiOptions($options);
		$_district->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckDistrict();'
		));
		
		$_commune = new Zend_Dojo_Form_Element_FilteringSelect('commune');
		$rows =  $db->getCommune();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['com_id']]=$row['commune_name'];
		$_commune->setMultiOptions($options);
		$_commune->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckCommune();'
		));
		
		
		$rows =  $db->getVillage();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['vill_id']]=$row['village_name'];
		$_village->setMultiOptions($options);
		
		$_house = new Zend_Dojo_Form_Element_TextBox('house');
		$_house->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside',
		));
		
		$_street = new Zend_Dojo_Form_Element_TextBox('street');
		$_street->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside',
				//'required' =>'true'
		));
		
		$_id_type = new Zend_Dojo_Form_Element_FilteringSelect('id_type');
		$_id_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$rows =  $db->GetAllIDType();
		$_id_type->setMultiOptions($rows);
		
		$_id_no = new Zend_Dojo_Form_Element_TextBox('id_no');
		$_id_no->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		
		
		$_phone = new Zend_Dojo_Form_Element_TextBox('phone');
		$_phone->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		
		$_spouse = new Zend_Dojo_Form_Element_TextBox('spouse');
		$_spouse->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$photo=new Zend_Form_Element_File('photo');
		$photo->setAttribs(array(
		));
		
		
		
		
		
		
		$branch = new Zend_Dojo_Form_Element_TextBox('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$client_code = new Zend_Dojo_Form_Element_FilteringSelect('client_code');
		$client_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				//'onchange'=>'popupCheckVillage();'
		));
		$client_name = new Zend_Dojo_Form_Element_FilteringSelect('client_name');
		$client_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				//'onchange'=>'popupCheckVillage();'
		));
		$problem=new Zend_Dojo_Form_Element_TextBox('problem');
		$problem->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				));
		$chackcall = new Zend_Dojo_Form_Element_CheckBox('chackcall');
		$chackcall->setAttribs(array(
				'dojoType'=>'dijit.form.CheckBox',
				//'onClick'=>''
		));
// 		$_id=new Zend_Form_Element_Hidden('id');
		$_id = new Zend_Form_Element_Hidden("id");
		$_desc = new Zend_Dojo_Form_Element_Textarea('desc');
		$_desc->setAttribs(array('dojoType'=>'dijit.form.SimpleTextarea','class'=>'fullside',
				'style'=>'width:96%;min-height:50px;'));
		
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside',));
		$_status_opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		
// 		$_id = new Zend_Form_Element_Hidden('id');
		if($data!=null){
			$_member->setValue($data['parent_id']);
			$_group->setValue($data['is_group']);
			$_namekh->setValue($data['name_kh']);
			$_nameen->setValue($data['name_en']);
			$_sex->setValue($data['sex']);
			$_situ_status->setValue($data['sit_status']);
			$_province->setValue($data['pro_id']);
			$_district->setValue($data['dis_id']);
			$_commune->setValue($data['com_id']);
			$_village->setValue($data['village_id']);
			$_house->setValue($data['house']);
			$_street->setValue($data['street']);
			$_id_type->setValue($data['id_type']);
			$_id_no->setValue($data['id_number']);
			$_phone->setValue($data['phone']);
			$_spouse->setValue($data['spouse_name']);
			$_desc->setValue($data['remark']);
			$_status->setValue($data['status']);
			$_clientno->setValue($data['client_number']);	
			$photo->setValue($data['photo_name']);
			$_id->setValue($data['client_id']);
			$_group_code->setValue($data['group_code']);
			$job->setValue($data['job']);
			$national_id->setValue($data['national_id']);
		}
		$this->addElements(array($_id,$photo,$job,$national_id,$chackcall,$_group_code,$_branch_id,$_member,$_group,$_namekh,$_nameen,$_sex,$_situ_status,
				$_province,$_district,$_commune,$_village,$_house,$_street,$_id_type,$_id_no,
				$_phone,$_spouse,$_desc,$_status,$_clientno));
		return $this;
		
	}	
}