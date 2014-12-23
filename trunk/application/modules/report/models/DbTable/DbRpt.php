<?php
class Report_Model_DbTable_DbRpt extends Zend_Db_Table_Abstract
{
	
function getbyid($id){
	$db = $this->getAdapter();
	$sql=" SELECT id,Contract Code,Status,Amount,OLB,Creatin Dat,Start Date	,Close Date,Late Day FROM $this->_name where id=$id ";
	return $db->fetchRow($sql);
}

}