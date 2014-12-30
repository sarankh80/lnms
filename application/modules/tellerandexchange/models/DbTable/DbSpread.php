<?php

class Tellerandexchange_Model_DbTable_DbSpread extends Zend_Db_Table_Abstract
{

    protected $_name = 'cs_rate';
    
    /**
     * Get current rate 
     * @return array(6);
     */
    function getCurrentRate(){
    	$db = $this->getAdapter();
    	$sql = "SELECT `id`,`in_cur_id`,`out_cur_id`,`rate_in`,`rate_out`
				FROM `ln_exchangerate` as r
    			WHERE r.`active` = 1
				ORDER BY r.`in_cur_id`, r.`out_cur_id`";
    	$rows = $db->fetchAll($sql);
    	
    	$result =array(
    					'DB'=>0,
		    			'BD'=>0,
		    			'DR'=>0,
		    			'RD'=>0,
		    			'BR'=>0,
		    			'RB'=>0
    				);
		foreach ($rows AS $i => $r){
			echo "<br/><br/>";
			if($r['in_cur_id'] == 1 && $r['out_cur_id'] == 2){
				$result['DB'] = $r['rate_in'];
				$result['BD'] = $r['rate_out'];
			}
			elseif($r['in_cur_id'] == 1 && $r['out_cur_id'] == 3){
				$result['DR'] = $r['rate_in'];
				$result['RD'] = $r['rate_out'];				
			}
			elseif($r['in_cur_id'] == 2 && $r['out_cur_id'] == 3){
				$result['BR'] = $r['rate_in'];
				$result['RB'] = $r['rate_out'];
			}
		}
    	return $result;
    }
}
?>
