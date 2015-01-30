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
				'asset_code'=>$data['asset_code'],
				'pay_type'=>$data['paid_type'],
				'status'=>$data['status'],
				'usefull_life'=>$data['usefull_life'],
				'salvagevalue'=>$data['salvage_value'],
				'payment_method'=>$data['payment_method'],
				'date'=>$data['date'],
				'depreciation_start'=>$data['start_date'],
				'some_payamount'=>$data['some_payamount'],
				'note'=>$data['note']
		);
		 $this->insert($arr);
}
function updatasset($data){
		$arr = array(
				'branch_id'=>$data['branch'],
				'fixed_assetname'=>$data['asset_name'],
				'fixed_asset_type'=>$data['asset_type'],
				'asset_cost'=>$data['asset_cost'],
				'asset_code'=>$data['asset_code'],
				'pay_type'=>$data['paid_type'],
				'status'=>$data['status'],
				'usefull_life'=>$data['usefull_life'],
				'salvagevalue'=>$data['salvage_value'],
				'payment_method'=>$data['payment_method'],
				'date'=>$data['date'],
				'depreciation_start'=>$data['start_date'],
				'some_payamount'=>$data['some_payamount'],
				'note'=>$data['note']
		);
	$where=" id = ".$data['id'];
	$this->update($arr, $where);
}
function getassetbyid($id){
	$db = $this->getAdapter();
	$sql=" SELECT id,
 	branch_id,fixed_assetname,fixed_asset_type,asset_cost,asset_code,pay_type,
	status,usefull_life,salvagevalue,payment_method,date,depreciation_start,some_payamount,note FROM $this->_name where id=$id ";
	return $db->fetchRow($sql);
}

function getAllAsset($search=null){
	$db = $this->getAdapter();
	$sql=" SELECT id,
	(SELECT branch_namekh FROM ln_branch WHERE br_id = branch_id limit 1)as branch_name,fixed_assetname,
	(SELECT name_en FROM ln_view WHERE TYPE=17 AND key_code=fixed_asset_type LIMIT 1)AS fixed_asset_type,asset_cost,
	(SELECT name_en FROM ln_view WHERE type=19 AND key_code=pay_type LIMIT 1) AS pay_type,usefull_life,salvagevalue,
	(SELECT name_en FROM ln_view WHERE TYPE=16 AND key_code=payment_method LIMIT 1)AS payment_method ,status,note FROM $this->_name ";
	$where = ' WHERE 1 ';
	if($search['status']>-1){
		$where.= " AND status = ".$search['status'];
	}
	if(!empty($search['branch_id'])){
		$where.= " AND branch_id = ".$search['branch_id'];
	}
	if(!empty($search['asset_type'])){
		$where.= " AND fixed_asset_type = ".$search['asset_type'];
	}
	if(!empty($search['payment_method'])){
		$where.= " AND payment_method = ".$search['payment_method'];
	}
	if(!empty($search['adv_search'])){
		$s_where = array();
		$search = $search['adv_search'];
		$s_where[] = " fixed_assetname LIKE '%{$search}%'";
		$s_where[] = "branch_id LIKE '%{$search}%'";
		$where.=' AND ('.implode(' OR ',$s_where).')';
	}
	return $db->fetchAll($sql.$where);
   
}



}