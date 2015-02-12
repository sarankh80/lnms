<?php
class Report_Model_DbTable_DbExportfile extends Zend_Db_Table_Abstract
{
      public function getFileby($data ,$table){
		$db = $this->getAdapter();
      	$db = new Application_Model_DbTable_DbGlobal();
      	$sql = "SHOW COLUMNS FROM $table ";
      	$datahead=$db->getGlobalDb($sql);
      	foreach($datahead as $id =>$rs){
      		$thead[]=$rs['Field'];
      	}
      	foreach ($data  AS $index => $row)
      	{
      		foreach($datahead as $id =>$rs){
      			$finalData[$index][$id]=utf8_decode($row[$rs['Field']]);
      		}
      	}
      	return array('data'=>$finalData,'header_title'=>$thead);
      }
 }

