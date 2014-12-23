<?php
class Accounting_Model_DbTable_DbAsset extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_fixed_asset';
	function addasset($data){
		$arr = array(
				'branch_id'=>$data['branch'],
				'fixed_assetname'=>$data['asset_name'],
				'fixed_asset_type'=>$data['asset_type'],
				'asset_cost'=>$data['asset_cost'],
				'status'=>1,
				'usefull_life'=>$data['usefull_life'],
				'salvagevalue'=>$data['salvage_value'],
				'payment_method'=>$data['payment_method'],
				'date'=>$data['date'],
				'depreciation_start'=>$data['start_date'],
				
		);
		 $this->insert($arr);
	

}
function updatasset($data){
	$arr = array(
				'branch_id'=>$data['branch'],
				'fixed_assetname'=>$data['asset_name'],
				'fixed_asset_type'=>$data['asset_type'],
				'asset_cost'=>$data['asset_cost'],
				'status'=>1,
				'usefull_life'=>$data['usefull_life'],
				'salvagevalue'=>$data['salvage_value'],
				'payment_method'=>$data['payment_method'],
				'date'=>$data['date'],
				'depreciation_start'=>$data['start_date'],
			   
				
		);
	$where=" id = ".$data['id'];
	$this->update($arr, $where);
}
function getassetbyid($id){
	$db = $this->getAdapter();
	$sql=" SELECT id,branch_id,fixed_assetname,fixed_asset_type,asset_cost,status,usefull_life,salvagevalue,payment_method,date,depreciation_start FROM $this->_name where id=$id ";
	return $db->fetchRow($sql);
}

function getAllAsset($search=null){
	$db = $this->getAdapter();
	$sql=" SELECT id,branch_id,fixed_assetname,fixed_asset_type,asset_cost,usefull_life,salvagevalue,payment_method ,status FROM $this->_name ";
	return $db->fetchAll($sql);
}



}