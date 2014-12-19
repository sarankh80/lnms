<?php

class Loan_Model_DbTable_DbLoanIL extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_loan_group';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    public function getAllIndividuleLoan($search){
    	$from_date =(empty($search['from_date']))? '1': "lg.date_release >= '".$search['from_date']." 00:00:00'";
    	$to_date = (empty($search['to_date']))? '1': "lg.date_release <= '".$search['to_date']." 23:59:59'";
    	$where = " AND ".$from_date." AND ".$to_date;
    	
    	$db = $this->getAdapter();
    	$sql=" SELECT lg.g_id,
    	(SELECT name_kh FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_kh,
  		(SELECT name_en FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_en,
  		lm.total_capital,lm.interest_rate,lm.payment_method,
    	lg.time_collect,
    	lg.zone_id,
    	(SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_enname,
    	lg.status AS str ,lg.status FROM `ln_loan_group` AS lg,`ln_loan_member` AS lm
				WHERE lg.g_id = lm.group_id ";
    	$db = $this->getAdapter();
//     	echo $sql.$where;
    	return $db->fetchAll($sql.$where);
    }
    function getTranLoanByIdWithBranch($id){
    	$sql = "SELECT lg.g_id,lg.level,lg.co_id,lg.zone_id,lg.pay_term,lm.payment_method,
    		lm.interest_rate,lm.amount_collect_pricipal,
    		lm.client_id,lm.admin_fee,
	    	(SELECT name_kh FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_kh,
	  		(SELECT name_en FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_en,
	  		lm.total_capital,lm.interest_rate,lm.payment_method,
	    	lg.time_collect,
	    	lg.zone_id,
	    	(SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_enname,
	    	lg.status AS str ,lg.status FROM `ln_loan_group` AS lg,`ln_loan_member` AS lm
			WHERE lg.g_id = lm.group_id AND lg.g_id = $id LIMIT 1 ";
    	return $this->getAdapter()->fetchRow($sql);
    }
    public function addNewLoanIL($data){
    	
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try{
    		$datagroup = array(
    				'group_id'=>$data['member'],
    				'co_id'=>$data['co_id'],
    				'zone_id'=>$data['zone'],
    				'level'=>$data['level'],
    				'date_release'=>$data['release_date'],
    				'create_date'=>date("Y-m-d"),
    				'branch_id'=>$data['branch_id'],
    				'total_duration'=>$data['period'],
    				'first_payment'=>$data['first_payment'],
    				'time_collect'=>$data['time'],
    				'pay_term'=>$data['pay_every'],
    				'payment_method'=>$data['repayment_method'],
    				'holiday'=>$data['every_payamount'],
    				'is_renew'=>0,
    				'loan_type'=>1
    				);
    		$g_id = $this->insert($datagroup);//add group loan
    		
    		$dbtable = new Application_Model_DbTable_DbGlobal();
    			$datamember = array(
    					'group_id'=>$g_id,
    					'client_id'=>$data['member'],
    					'payment_method'=>$data['pay_every'],
    					'currency_type'=>$data['currency_type'],
    					'total_capital'=>$data['total_amount']+$data['loan_fee'],//$data[''],
    					'admin_fee'=>$data['loan_fee'],
    					'interest_rate'=>$data['interest_rate'],
    					'status'=>1,
    					'is_completed'=>0,
    					'branch_id'=>$data['branch_id'],
    					'pay_before'=>$data['pay_before'],
    					'pay_after'=>$data['pay_late'],
    					
    			);
    			$this->_name='ln_loan_member';
    			$g_id = $this->insert($datamember);//add member loan
//     			$data['total_amount'] = $data['total_amount']+$data['loan_fee'];
    			$remain_principal = $data['total_amount'];
    			$next_payment = $data['first_payment'];
    			$start_date = $data['release_date'];//loan release;
//     			$next_payment = $start_date;
    			
    			$old_remain_principal = 0;
    			$old_pri_permonth = 0;
    			$old_interest_paymonth = 0;
    			$old_total_amount = 0;
    			$old_amount_day = 0;
    			$amount_collect = 1;
    			$is_first_record=1;
    			$change_remain = 0;
    			$ispay_principal=1;//for payment type = 5;
    			$total_fundamount = 0;
    			$is_subremain = 0;
    			$curr_type = $data['currency_type'];
    			
    			$this->_name='ln_loanmember_funddetail';
    			for($i=1;$i<=($data['period']/$data['amount_collect']);$i++){
    				$payment_method = $data['repayment_method'];
    				
    				//return amount next day collection
    				$amount_collect = $data['amount_collect'];
    				$day_perterm = $dbtable->getSubDaysByPaymentTerm($data['pay_every'],$amount_collect);//return amount day for payterm
    				$str_next = $dbtable->getNextDateById($data['pay_every'],$data['amount_collect']);//for next,day,week,month;
    				
    				if($payment_method==1){//decline
    					$pri_permonth = ($data['total_amount']/($data['period']-$data['graice_pariod'])*$amount_collect);
    					
//     					echo $data['total_amount'];exit();
    					$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
//     					$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): $pri_permonth;
//     					echo $pri_permonth;exit();
    					if($i*$amount_collect<=$data['graice_pariod']){//check here
    						$pri_permonth = 0;
    					}
//     					if($i==($data['period']/$data['amount_collect'])){
//     						$pri_permonth = $data['total_amount']-$pri_permonth*($i-1);
//     						$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
//     						echo $remain_principal;
//     						exit();
//     					}
    					if($i!=1){
//     						$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    					}
    					if($i!=1){
    						if($data['graice_pariod']!=0){//if collect =1 not other check
    							if($i*$amount_collect>$data['graice_pariod']+1){//not wright
    								$remain_principal = $remain_principal-$pri_permonth;
    							}
    						}else{
    							$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា}
    						}
    						
    						//$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    						
    						if($i==($data['period']/$data['amount_collect'])){//check condition here
//     							$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    							$pri_permonth = $data['total_amount']-$pri_permonth*(($i-($data['graice_pariod']+1)));
//     							$pri_permonth = $data['total_amount']-$pri_permonth*(($i-$data['graice_pariod'])-1);
//     							$pri_permonth = $data['total_amount']-$pri_permonth*($i-1);
    						}
    						if($data['amount_collect']!=1){//many day
//     							$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    							$start_date = $next_payment;
    							$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    							$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    							$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
// 								$old_amount_day = $old_amount_day+$amount_day;
    						}else{//is good 
//     							$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    							$start_date = $next_payment;
    							$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    							$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    							$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
//     							$old_amount_day = $old_amount_day+$amount_day;
    						}
    					}else{
    						$next_payment = $dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = ($data['total_amount'])*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}
    				
    					//////////////////////////////
    				}elseif($payment_method==2){//baloon
    					$pri_permonth=0;
    					if(($i*$amount_collect)==$data['period']){
    						$pri_permonth = ($curr_type==1)?round($data['total_amount'],-2):$data['total_amount'];
    						$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
    						$remain_principal = $pri_permonth;//$remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    					}
    					if($i!=1){
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
//     						$interest_paymonth = $data['total_amount']*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}else{
    						$next_payment = $dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}
    					$interest_paymonth = $data['total_amount']*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					
    				}elseif($payment_method==3){//fixed rate
    					////////////////////////////
    					$pri_permonth = ($data['total_amount']/$data['period']*$amount_collect);
    					$pri_permonth = ($curr_type==2)? round($pri_permonth,-2): $pri_permonth;
    					
    					if($i!=1){
    						$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}else{
    						$next_payment = $dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}
    						$interest_paymonth = $data['total_amount']*($data['interest_rate']/100)*($amount_day/$day_perterm);
    						
    				}elseif($payment_method==4){//fixed payment full last period yes
    					if($i!=1){
    						$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = $data['total_amount']*($data['interest_rate']/100)*($amount_day/$day_perterm);
    							
    					}else{
    						$next_payment = $dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}
    					$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					$pri_permonth = $data['amount_collect_pricipal']-$interest_paymonth;
    					if(($i*$amount_collect)==$data['period']){
    						$pri_permonth = $remain_principal;
    					}
    				}elseif($payment_method==5){//semi baloon
    					
    					$ispay_principal++;
    					$is_subremain++;
    					$pri_permonth = ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
    					$pri_permonth = ($curr_type==1)?round($pri_permonth,-2):$pri_permonth;
    						
    					if($i!=1){
    						if($ispay_principal!=$data['amount_collect_pricipal']){
    							$pri_permonth =0;// ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
    							$ispay_principal=0;
    						}
    						if($i*$amount_collect==$data['amount_collect_pricipal']){
    							$pri_permonth = ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
    						}elseif(($is_subremain-1)==$data['amount_collect_pricipal']){
    							$pri_permonth = ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
    							$remain_principal = $remain_principal-($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
    							$is_subremain=1;
    						}
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					
    					}else{
    						$pri_permonth = 0;//check if get pri first too much change;
    							
    						$next_payment = $dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = $data['total_amount']*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}
    				}else{//    fixed payment with fixed rate
    					    $pri_permonth = $data['total_amount']/$data['period']*$amount_collect;
    					        
    					    $pri_permonth = ($curr_type==1)?round($pri_permonth,-2):$pri_permonth;
    					    	if($i!=1){
    					    			$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    					    	        $start_date = $next_payment;
    					    			$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    					    			$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					    	}else{
    					    			$next_payment = $dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    					    			$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					    	}
    					    			$interest_paymonth = ($data['total_amount']*($data['interest_rate']/100)/$data['period']*($amount_day/$day_perterm));
    					    			
//     					    			
//     					    			
    					    			
    				}
    				$old_remain_principal =$old_remain_principal+$remain_principal;
    				$old_pri_permonth = $old_pri_permonth+$pri_permonth;
    				
    				$old_interest_paymonth = $old_interest_paymonth+$interest_paymonth;
    				$old_amount_day =$old_amount_day+ $amount_day;
    				
    				if($data['amount_collect']==$amount_collect){
    					
    					
    					$datapayment = array(
    							'member_id'=>$g_id,
    							'total_principal'=>($change_remain)==1?$remain_p_manyday:$remain_principal,//good
    							'principal_permonth'=> $old_pri_permonth,//good
    							'total_interest'=>$old_interest_paymonth,//good
    							'total_payment'=>$old_pri_permonth+$old_interest_paymonth,//good
    							'date_payment'=>$next_payment,//good
    							'is_completed'=>0,
    							'branch_id'=>1,
    							'status'=>1,
    							'amount_day'=>$old_amount_day,
    					);
    					$this->insert($datapayment);
    					$amount_collect=0;
    					$old_remain_principal = 0;
    					$old_pri_permonth = 0;
    					$old_interest_paymonth = 0;
    					$old_amount_day = 0;
//     					$change_remain = 0;
    					
    				}else{
    					
    					//if(){ the old record;
    						
    					//}
    					//if record not cherk min smer 0
    					
    				}
    				$amount_collect++;
    			
//     				$datapayment = array(
//     						'member_id'=>$g_id,
//     						'total_principal'=>$remain_principal,
//     						'principal_permonth'=> $pri_permonth,
//     						'total_interest'=>$interest_paymonth,
//     						'total_payment'=>$pri_permonth+$interest_paymonth,
//     						'date_payment'=>$next_payment,
//     						'is_completed'=>0,
//     						'branch_id'=>1,
//     						'status'=>1,
//     						'amount_day'=>$amount_day,
//     				);
//     				$this->insert($datapayment);
    			}
    		$db->commit();
    		return 1;
    	}catch (Exception $e){
    		$db->rollBack();
//     		echo $e->getMessage();
//     		exit();
    		
    	}
    }
//     public function getNextPayment($str_next,$next_payment,$amount_amount,$holiday_status=null){
//     	for($i=0;$i<$amount_amount;$i++){
//     		$d = new DateTime($next_payment);
//     		$d->modify($str_next);
//     		$next_payment =  $d->format('Y-m-d');
//     	}
//     	return $next_payment;//if get last date pls check if holiday
//     }
//     public function getNextDateById($pay_term,$amount_next_day){
//     	if($pay_term==3){
//     		$str_next = 'next month';
//     	}elseif($pay_term==2){
//     		$str_next = 'next week';
//     	}else{
//     		$str_next = 'next day';
//     	}
//     	return $str_next;
//     }
//     public function getSubDaysByPaymentTerm($pay_term,$amount_collect = null){
//     	if($pay_term==3){
//     		$amount_days =30;
// //     		if($amount_collect!=1){
    			
// //     		}
//     	}elseif($pay_term==2){
//     		$amount_days =7;
//     	}else{
//     		$amount_days =1;
//     	}
    	
//     	return $amount_days*$amount_collect;//return all next day collect laon form customer 
    	
//     }
//     public function CountDayByDate($start,$end){
//     	$db = new Application_Model_DbTable_DbGlobal();
//     	return ($db->countDaysByDate($start,$end));
//     }
//     public function CalculateByMethod($method_type){
    	
//     }
  
}

