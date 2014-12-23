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
    	$sql=" SELECT lg.g_id,lm.loan_number,
    	(SELECT name_kh FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_kh,
  		(SELECT name_en FROM `ln_client` WHERE client_id = lm.client_id LIMIT 1) AS client_name_en,
  		lm.total_capital,lm.interest_rate,
  	   (SELECT payment_nameen FROM `ln_payment_method` WHERE id = lm.payment_method LIMIT 1) AS payment_method,
  	   (SELECT payment_nameen FROM `ln_payment_method` WHERE id = lm.payment_method LIMIT 1) AS payment_method,
       (SELECT zone_name FROM `ln_zone` WHERE zone_id=lg.zone_id LIMIT 1) AS zone_name,
       (SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_name,
       (SELECT branch_namekh FROM `ln_branch` WHERE br_id =lg.branch_id LIMIT 1) AS branch,
        lg.status  FROM `ln_loan_group` AS lg,`ln_loan_member` AS lm
				WHERE lg.g_id = lm.group_id ";
    	if($search['status']>1){
    		$where.= "lm.status = ".$search['status'];
    		
    	}
    	$db = $this->getAdapter();
    	
    	return $db->fetchAll($sql.$where);
    }
//     (SELECT co_firstname FROM `ln_co` WHERE co_id =lg.co_id LIMIT 1) AS co_name,
    function getTranLoanByIdWithBranch($id){
    	$sql = "SELECT lg.g_id,lg.level,lg.co_id,lg.zone_id,lg.pay_term,lm.payment_method,
    		lm.interest_rate,lm.amount_collect_principal,
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
    					'total_capital'=>$data['total_amount'],//$data[''],
    					'admin_fee'=>$data['loan_fee'],
    					'interest_rate'=>$data['interest_rate'],
    					'status'=>1,
    					'is_completed'=>0,
    					'branch_id'=>$data['branch_id'],
    					'pay_before'=>$data['pay_before'],
    					'pay_after'=>$data['pay_late'],
    					'graice_period'=>$data['graice_pariod'],
    					'amount_collect_principal'=>$data['amount_collect']
    			);
    			$this->_name='ln_loan_member';
    			$g_id = $this->insert($datamember);//add member loan
    			$remain_principal = $data['total_amount'];
    			$next_payment = $data['first_payment'];
    			$start_date = $data['release_date'];//loan release;
//     			$next_payment = $start_date;
    			
    			$old_remain_principal = 0;
    			$old_pri_permonth = 0;
    			$old_interest_paymonth = 0;
    			$old_amount_day = 0;
    			$amount_collect = 1;
    			$ispay_principal=1;//for payment type = 5;
    			$is_subremain = 0;
    			$curr_type = $data['currency_type'];
    			
    			$this->_name='ln_loanmember_funddetail';
    			for($i=1;$i<=($data['period']/$data['amount_collect']);$i++){
    				$payment_method = $data['repayment_method'];
    				
    				//return amount next day collection
    				$amount_collect = $data['amount_collect'];
    				$day_perterm = $dbtable->getSubDaysByPaymentTerm($data['pay_every'],$amount_collect);//return amount day for payterm
    				$str_next = $dbtable->getNextDateById($data['pay_every'],$data['amount_collect']);//for next,day,week,month;
    				
    				if($payment_method==1){//decline//completed
    					$pri_permonth = ($data['total_amount']/($data['period']-$data['graice_pariod'])*$amount_collect);
    					$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
    					
    					if($i*$amount_collect<=$data['graice_pariod']){//check here//for graice period
    						$pri_permonth = 0;
    					}
    					if($i!=1){
    						if($data['graice_pariod']!=0){//if collect =1 not other check
    							if($i*$amount_collect>$data['graice_pariod']+$amount_collect){//not wright
    								$remain_principal = $remain_principal-$pri_permonth;
    							}else{
    								
    							}
    						}else{
    							$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា}
    						}
    						
    						if($i==($data['period']/$data['amount_collect'])){//check condition here//for end of record only
    							$pri_permonth = $data['total_amount']-$pri_permonth*($i-(($data['graice_pariod']/$amount_collect)+1));//code error here
    						}
    						if($data['amount_collect']!=1){//many day
    							$start_date = $next_payment;
    							$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    							$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    							$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    						}else{//is good 
    							$start_date = $next_payment;
    							$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    							$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    							$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
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
    						
    						$ispay_principal++;
    						$is_subremain++;
    						$pri_permonth = ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
    						$pri_permonth = ($curr_type==1)?round($pri_permonth,-2):$pri_permonth;
    						
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
//     						if($ispay_principal!=$data['amount_collect_pricipal']){
//     							$pri_permonth =0;// ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
//     							$ispay_principal=0;
//     						}
//     						if($i*$amount_collect==$data['amount_collect_pricipal']){
//     							$pri_permonth = ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
//     						}elseif(($is_subremain-1)==$data['amount_collect_pricipal']){
//     							$pri_permonth = ($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
//     							$remain_principal = $remain_principal-($data['total_amount']/$data['period'])*$data['amount_collect_pricipal'];
//     							$is_subremain=1;
//     						}
//     						$start_date = $next_payment;
//     						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
//     						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
//     						$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					
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
    				}
    				$old_remain_principal =$old_remain_principal+$remain_principal;
    				$old_pri_permonth = $old_pri_permonth+$pri_permonth;
    				
    				$old_interest_paymonth = $old_interest_paymonth+$interest_paymonth;
    				$old_amount_day =$old_amount_day+ $amount_day;
    				
    				if($data['amount_collect']==$amount_collect){
    					
    					$datapayment = array(
    							'member_id'=>$g_id,
    							'total_principal'=>$remain_principal,//good
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
    					
    				}else{
    					
    					//if(){ the old record;
    						
    					//}
    					//if record not cherk min smer 0
    					
    				}
    				$amount_collect++;
    			}
    		$db->commit();
    		return 1;
    	}catch (Exception $e){
    		$db->rollBack();
    	}
    }
    function getLoanPaymentByLoanNumber($data){
    	$db = $this->getAdapter();
    	$loan_number= $data['loan_number'];
    	if($data['type']!=2){
    		$where =($data['type']==1)?'loan_number = '.$loan_number:'client_id='.$loan_number;
    	    $sql=" SELECT *,
					(SELECT currency_type FROM `ln_loan_member` WHERE $where LIMIT 1  ) AS curr_type
    	     FROM `ln_loanmember_funddetail` WHERE member_id =
		    		(SELECT  member_id FROM `ln_loan_member` WHERE $where AND status=1 LIMIT 1)
		    		AND status = 1 ";
    	}elseif($data['type']==2){
    		$sql="SELECT * FROM `ln_loanmember_funddetail` WHERE status = 1 AND member_id = 
    		       ( SELECT member_id FROM `ln_loan_member` WHERE client_id =
    		       (SELECT client_id FROM `ln_client` WHERE client_number = ".$loan_number." LIMIT 1) LIMIT 1) ";
    	}
    	return $db->fetchAll($sql);
    }
  
}

