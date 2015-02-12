DROP TABLE cs_keycode;

CREATE TABLE `cs_keycode` (
  `code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyName` varchar(450) DEFAULT NULL,
  `keyValue` varchar(4500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO cs_keycode VALUES("1","rpt-transfer-warnning-kh","???????????????????????????????????????????");
INSERT INTO cs_keycode VALUES("2","rpt-transfer-title-kh","??.???");
INSERT INTO cs_keycode VALUES("3","rpt-transfer-title-eng","??????????? ??? ???????????");
INSERT INTO cs_keycode VALUES("4","rpt-transfer-business-meaning-kh","????????????????????????? ?????????????????????");
INSERT INTO cs_keycode VALUES("5","rpt-transfer-business-meaning-eng","EXCHANGE CURRENCY AND TRANSFER SERIVCE");
INSERT INTO cs_keycode VALUES("6","rpt-transfer-location-adr-kh","????????189(?) ?????????????????????????????????????");
INSERT INTO cs_keycode VALUES("7","rpt-transfer-tel-eng","Tel:017 777 613,011 288 258");
INSERT INTO cs_keycode VALUES("8","rpt-transfer-send-kh","?????");
INSERT INTO cs_keycode VALUES("9","rpt-transfer-recieve-kh","??????");
INSERT INTO cs_keycode VALUES("10","imgPath","images/resolvo.gif");
INSERT INTO cs_keycode VALUES("11","mainbranch","??.???");
INSERT INTO cs_keycode VALUES("12","branch-add","??????? ????????189(?) ?????????????????????????????????????");
INSERT INTO cs_keycode VALUES("13","bracnch-tel","017 777 613,011 288 258");
INSERT INTO cs_keycode VALUES("14","mainbranch-subtitle","???????????????, ???????????????");
INSERT INTO cs_keycode VALUES("15","marquee-word","????????????????????????? ????????????????????? ?????????????, Exchnage and Transfer money");
INSERT INTO cs_keycode VALUES("16","services","???????????????, ???????????????");
INSERT INTO cs_keycode VALUES("17","copyright","&copy 2013 MONOROM Exchange And Transfer Money Management All rights reserved.");
INSERT INTO cs_keycode VALUES("18","comment","????????????????????????????????? Tel:012 288 258");
INSERT INTO cs_keycode VALUES("19","branch-tel","322");
INSERT INTO cs_keycode VALUES("20","rpt-transfer-title-eng","");
INSERT INTO cs_keycode VALUES("21","rpt-transfer-business-meaning-kh","");
INSERT INTO cs_keycode VALUES("22","rpt-transfer-business-meaning-eng","");
INSERT INTO cs_keycode VALUES("23","rpt-transfer-location-adr-kh","");
INSERT INTO cs_keycode VALUES("24","rpt-transfer-tel-eng","");
INSERT INTO cs_keycode VALUES("25","rpt-transfer-warnning-kh","");
INSERT INTO cs_keycode VALUES("26","comment ","");
INSERT INTO cs_keycode VALUES("27","imgPath ","");



DROP TABLE cs_rate;

CREATE TABLE `cs_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we take from customer',
  `out_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we give to customer',
  `rate_in` double DEFAULT NULL,
  `rate_out` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1:active; 0:Disactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_account_category;

CREATE TABLE `ln_account_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_namekh` varchar(100) DEFAULT NULL,
  `cate_nameen` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `account_type` tinyint(4) DEFAULT NULL,
  `deplay` int(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ln_account_category VALUES("1","Dell","Dell","1","2","1","2014-12-17","1","");
INSERT INTO ln_account_category VALUES("2","Apple","Apple","1","3","1","2014-12-10","2","");
INSERT INTO ln_account_category VALUES("3","Acer","Acer","1","2","1","2014-12-02","1","");
INSERT INTO ln_account_category VALUES("4","???","kok","6","1","1","2014-12-25","1","");
INSERT INTO ln_account_category VALUES("12","ass","bbb","","","","","","");
INSERT INTO ln_account_category VALUES("13","ass","bbb","","","","","","");
INSERT INTO ln_account_category VALUES("14","ass","bbb","","","","","","");
INSERT INTO ln_account_category VALUES("15","ass","5544","","","","","","");
INSERT INTO ln_account_category VALUES("16","ass","asdfsadf","","","","","","");



DROP TABLE ln_account_name;

CREATE TABLE `ln_account_name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_code` varchar(20) DEFAULT NULL,
  `account_name_kh` varchar(100) DEFAULT NULL,
  `account_name_en` varbinary(100) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL,
  `disc` text,
  `option_acc` tinyint(1) DEFAULT '1' COMMENT '1=operation acc,2=non operation acc',
  `account_type` tinyint(4) DEFAULT NULL COMMENT '1=asset,2=liabilities,3=equities,4=incomes,5=expense,6=cost of goods sold',
  `parent_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ln_account_name VALUES("1","1","????","daro","1","kondal","1","1","2","1","2014-12-03","1","1");
INSERT INTO ln_account_name VALUES("2","1","?????","phanet","1","komphong cham","2","2","1","2","2014-12-01","1","");
INSERT INTO ln_account_name VALUES("3","2","???","heng","2","house","2","1","1","1","2014-12-03","0","");



DROP TABLE ln_accountname_detail;

CREATE TABLE `ln_accountname_detail` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(20) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `dr` tinyint(4) DEFAULT NULL,
  `cr` tinyint(4) DEFAULT NULL,
  `amount` float(13,3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_adjust` tinyint(4) DEFAULT NULL COMMENT '0=not adjust,1=adjust',
  `status` tinyint(4) DEFAULT NULL,
  `tran_type` tinyint(4) DEFAULT NULL COMMENT 'exchange,laon',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_backupschedule;

CREATE TABLE `ln_backupschedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `note` text,
  `file_name` varchar(40) DEFAULT NULL,
  `action_type` tinyint(4) DEFAULT NULL COMMENT '1=backup,2restore',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_branch;

CREATE TABLE `ln_branch` (
  `br_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_namekh` varchar(200) DEFAULT NULL,
  `branch_nameen` varbinary(100) DEFAULT NULL,
  `branch_address` varchar(100) DEFAULT NULL,
  `branch_code` varchar(100) DEFAULT NULL,
  `branch_tel` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `displayby` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`br_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_branch VALUES("1","???? ??????","Head Office","Phnom Penh","C-001","","","","1","2");
INSERT INTO ln_branch VALUES("2","???? ???","Branch I","Phnom Penh","C-001","","","","1","2");



DROP TABLE ln_branch_capital;

CREATE TABLE `ln_branch_capital` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `amount_dollar` float(18,3) DEFAULT NULL,
  `amount_riel` float(18,3) DEFAULT NULL,
  `amount_bath` float(18,3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ln_branch_capital VALUES("1","1","","1","1000.000","4000000.000","40000.000","2015-01-20","01");
INSERT INTO ln_branch_capital VALUES("2","2","","1","200.000","800000.000","8000.000","2015-01-20","02");
INSERT INTO ln_branch_capital VALUES("6","1","","1","1000.000","4000000.000","40000.000","2015-01-20","01");
INSERT INTO ln_branch_capital VALUES("7","1","","1","0.000","0.000","0.000","2015-02-02","");



DROP TABLE ln_callecteral_type;

CREATE TABLE `ln_callecteral_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(50) DEFAULT NULL,
  `title_kh` varbinary(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO ln_callecteral_type VALUES("1","","វិញ្ញាបនប័ត្រសម្គាល់អចលនវត្ថុ","","");
INSERT INTO ln_callecteral_type VALUES("2","","លិខិតផ្ទេរកម្មសិទ្ធិដីធ្លី","","");
INSERT INTO ln_callecteral_type VALUES("3","","អត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ","","");
INSERT INTO ln_callecteral_type VALUES("4","","សៀវភៅគ្រួសារ","","");
INSERT INTO ln_callecteral_type VALUES("5","","លិខិតស្នាក់នៅ","","");
INSERT INTO ln_callecteral_type VALUES("6","","សំបុត្របញ្ជាក់កំណើត","","");
INSERT INTO ln_callecteral_type VALUES("7","","ប័ណ្ណបើកបរ","","");
INSERT INTO ln_callecteral_type VALUES("8","","ប័ណ្ណសំគាល់យានយន្ត(កាតគ្រី)","","");



DROP TABLE ln_client;

CREATE TABLE `ln_client` (
  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) DEFAULT NULL,
  `is_group` tinyint(4) DEFAULT NULL,
  `group_code` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'group id',
  `client_number` varchar(50) DEFAULT NULL COMMENT 'client_code ,first lenght for branch',
  `name_kh` varchar(150) DEFAULT NULL,
  `name_en` varchar(150) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `position_id` int(1) DEFAULT NULL,
  `sit_status` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `dis_id` int(11) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `house` varchar(50) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `acc_number` varchar(20) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `job` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(100) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `spouse_name` varchar(50) DEFAULT NULL,
  `remark` text,
  `create_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '1',
  `photo_name` varchar(50) DEFAULT NULL,
  `reference` int(11) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1',
  `status_process` tinyint(4) DEFAULT '1' COMMENT '1 padding,2=closed',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO ln_client VALUES("0","","1","B101","","1000001","General Customer","General Customer","1","","1","1","1","1","4","#2222","2","2","1234222","","0121100221","","","","","","Dara","new client","2014-10-26","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("2","","0","","","1000002","????","Vireak","2","","1","1","1","2","3","2222","2","2","2222222","","2222222222","","","","","","narith","","2014-10-28","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("3","","0","G","","1000003","?????","Narin","1","","1","1","1","2","2","271","1111","1","112233","","01220202002","","","","","","Sok Dara","new client","2014-11-01","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("4","","0","","","1000004","??? ????","meas sokkha","1","","3","2","4","3","3","77","123","3","332233","","012020202020","","","","","","Sokea","new client to","2014-11-22","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("5","","0","","","1000005","??? ????????","sok chom rerng","2","","3","1","2","2","2","322","33","1","22334455","","02030303003","","","","","","sok measa","new client","2014-10-31","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("6","","0","","","1000006","?? ?????","meas chitra","1","","1","1","4","4","3","2233","342","3","22334455","","022332222","","","","","","3233222","","2014-10-31","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("7","","0","","","1000007","meas narith","meas sok chitra","1","","4","2","3","3","3","2233","2233","4","2020202","","","","","","","","meas narith","sok dara","2014-10-31","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("8","","0","","","1000008","asf","","1","","1","-1","1","4","2","","","1","","","","","","","","","","","2014-11-01","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("9","","0","","","1000009","rithy","rithy","1","","1","1","2","4","4","123","123","1","2222","","012303030","","","","","","dara","","2014-11-15","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("10","","1","B102","","1000010","Vuthy","vuthy","1","","1","1","2","2","2","123","322","1","333","","","","","","","","","","2014-11-15","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("11","","","","2","1000011","?? ?????","sok","2","","2","1","1","3","5","123","123","2","12345","","123444","","","","","","sok","","2014-11-16","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("12","","0","","2","1000012","??????","rithy","2","","1","5","5","5","3","2222","222","1","22","","22222","","","","","","","","2014-11-16","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("13","","0","","","1000013","???? ????","sok vireak","1","","1","6","2","4","7","123","22","1","12121212111","","012020202","","","","","","Sok reak","","2014-11-22","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("14","","1","B103","","1000014","?? ?????","Chea Veasna","1","","1","5","2","4","3","123","2001","2","2112111","","01020102010","","","","","","Vuthy","","2014-11-22","1","1","1","","","1","1");
INSERT INTO ln_client VALUES("15","","0","","","1000015","32","22","1","","1","3","0","0","0","11","","1","11","","","","","","","","","","2014-12-16","1","1","1","","","1","1");



DROP TABLE ln_client_callecteral;

CREATE TABLE `ln_client_callecteral` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(40) DEFAULT NULL,
  `code_call` int(11) DEFAULT NULL,
  `co_id` int(11) DEFAULT NULL,
  `getter_name` varbinary(50) DEFAULT NULL,
  `giver_name` varchar(50) DEFAULT NULL,
  `date_delivery` date DEFAULT NULL,
  `client_code` int(11) DEFAULT NULL,
  `contracts_borrow` varchar(11) DEFAULT NULL,
  `mortgage_Contract` int(11) DEFAULT NULL,
  `name_borrower` tinyint(4) DEFAULT NULL COMMENT '1=owner,2=????????',
  `with` varchar(50) DEFAULT NULL,
  `relativewith` varchar(50) DEFAULT NULL,
  `owner` varchar(40) DEFAULT NULL,
  `withs` varchar(40) DEFAULT NULL,
  `relativewiths` varchar(40) DEFAULT NULL,
  `callate_type` int(11) DEFAULT NULL,
  `note` varchar(60) DEFAULT NULL,
  `date_registration` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ln_client_callecteral VALUES("1","1","12","7","vy","heng","2014-12-18","12","23","32","0","vons","vo","ronado","neyma","pepe","2","98","2015-12-31","2");
INSERT INTO ln_client_callecteral VALUES("2","1","2","6","lay","kol","2014-12-02","7","8","90","0","with","y","r","g","j","2","65","2014-12-26","1");
INSERT INTO ln_client_callecteral VALUES("3","2","8","8","hy","kola","2014-12-03","5","8","21","0","se","qata","ty","o","yu","2","89","2014-12-25","1");



DROP TABLE ln_client_reciept;

CREATE TABLE `ln_client_reciept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `co_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_pay` date DEFAULT NULL COMMENT 'date client must pay',
  `date` date DEFAULT NULL COMMENT 'date input to system',
  `remain_principal` int(11) DEFAULT NULL COMMENT 'remain before fund',
  `principal_permonth` float(12,2) DEFAULT NULL,
  `interest_rate` float(12,2) DEFAULT NULL,
  `total_payment` float(12,2) DEFAULT NULL COMMENT '????????? ????????',
  `punish_fee` float(12,2) DEFAULT NULL,
  `total_fund` float(12,2) DEFAULT NULL COMMENT '????????? ??????',
  `loan_fundid` int(11) DEFAULT NULL COMMENT '????id ???????????',
  `note` text,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=active,0delete',
  `is_complete` tinyint(4) DEFAULT '1' COMMENT '1=paid,2 not complete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_co;

CREATE TABLE `ln_co` (
  `co_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT '1',
  `co_code` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_khname` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL COMMENT '1=m,2=f',
  `national_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pob` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'date of birth',
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'current addresss',
  `degree` tinyint(4) DEFAULT NULL COMMENT '1=ba,2=phd',
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `create_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1=kh,2=eng',
  `basic_salary` float(12,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `postion_id` int(11) DEFAULT NULL,
  `contract_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shift` tinyint(4) DEFAULT '1' COMMENT '1=???????,2=????????',
  `workingtime` tinyint(4) DEFAULT '1' COMMENT '1=????????,2=????????,3=???????? ??? ?????????',
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO ln_co VALUES("1","1","001","??? ?????","sarons","","1","33333","phnom penhs","Phnom Penhs","2","0121010101s","mok_channy@yahoo.com","1","0000-00-00","1","1","","","","","","","1","1");
INSERT INTO ln_co VALUES("2","1","0012","?? ????","dara","chea","2","3444","","Phnom Penh","1","0191919919","darachea@gmail.com","1","0000-00-00","1","1","","","","","","","1","1");
INSERT INTO ln_co VALUES("5","1","","SSSS","dd","","1","22222","","","2","","","1","0000-00-00","1","1","","","","","","","1","1");
INSERT INTO ln_co VALUES("6","1","123","?????","Narith","","1","12345","12345dd","wq2qww","2","0102200202","abc@gmail.com","1","0000-00-00","1","2","","","","","","","1","1");
INSERT INTO ln_co VALUES("7","1","0002","?????","Chear sok","","1","12345","ph,234","phnom penh","2","02020200202","abc@gmail.com","1","0000-00-00","1","2","","","","","","","1","1");
INSERT INTO ln_co VALUES("8","1","122","??????","abc","","1","555555","PP","PP","2","998552","kh@yahoo.com","1","0000-00-00","1","1","100.00","2014-12-26","2014-12-17","","144","Repay","2","2");
INSERT INTO ln_co VALUES("9","1","","?? ????SS","sok chitra","meas","2","22322","","PP","2","0020200202","narith@gmail.com","1","0000-00-00","1","1","","","","","","","1","1");



DROP TABLE ln_commune;

CREATE TABLE `ln_commune` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` tinyint(10) NOT NULL,
  `commune_name` varchar(60) NOT NULL,
  `commune_namekh` varchar(60) DEFAULT NULL,
  `modify_date` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  `displayby` tinyint(4) DEFAULT NULL COMMENT '1=kh,2=eng',
  `branch_id` int(11) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO ln_commune VALUES("1","1","Dong Kor","??????","Jun 5, 2014 6:37:55 AM","1","1","","1");
INSERT INTO ln_commune VALUES("2","2","Pur Sen Chhey","??????????","Jun 5, 2014 6:37:02 AM","1","1","","1");
INSERT INTO ln_commune VALUES("3","2","Mean Chheay","","Jun 5, 2014 6:38:14 AM","1","1","","1");
INSERT INTO ln_commune VALUES("4","2","Kakab","","Jun 5, 2014 6:37:43 AM","1","1","","1");
INSERT INTO ln_commune VALUES("5","4","long romeans","","Oct 12, 2014 8:32:12 PM","1","1","","1");
INSERT INTO ln_commune VALUES("6","1","sss","","Nov 1, 2014 1:17:05 AM","1","1","","1");
INSERT INTO ln_commune VALUES("7","1","sssaqqq","","Nov 1, 2014 1:17:16 AM","1","1","","1");
INSERT INTO ln_commune VALUES("8","3","Krang Trolat","","Nov 13, 2014 12:59:42 AM","1","1","","1");
INSERT INTO ln_commune VALUES("9","3","123","khmer","Nov 15, 2014 11:18:35 PM","1","1","2","1");
INSERT INTO ln_commune VALUES("10","3","123s","khmers","Nov 15, 2014 11:25:38 PM","1","1","2","1");



DROP TABLE ln_currency;

CREATE TABLE `ln_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curr_namekh` varchar(255) DEFAULT NULL,
  `curr_nameen` varchar(120) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL COMMENT '1kh,2=en',
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=active,0deactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO ln_currency VALUES("2","??????","Dollar","$","","1","1");
INSERT INTO ln_currency VALUES("1","???","Riel","R","","2","1");
INSERT INTO ln_currency VALUES("3","???","Bath","B","","3","1");



DROP TABLE ln_displayby;

CREATE TABLE `ln_displayby` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayby_en` varchar(40) DEFAULT NULL,
  `displayby_kh` varchar(40) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `displayby` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_displayby VALUES("1","Khmer Title","","1","1");
INSERT INTO ln_displayby VALUES("2","English Title","","1","1");



DROP TABLE ln_district;

CREATE TABLE `ln_district` (
  `dis_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` tinyint(10) NOT NULL,
  `district_name` varchar(60) NOT NULL,
  `district_namekh` varchar(60) DEFAULT NULL,
  `modify_date` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  `displayby` tinyint(4) DEFAULT NULL COMMENT '1=kh,2=en',
  `branch_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO ln_district VALUES("1","4","Mean chheys","this is testing","Nov 2, 2014 12:55:39 AM","1","1","2","");
INSERT INTO ln_district VALUES("2","1","7 Markara","","Jun 5, 2014 6:37:02 AM","1","1","1","");
INSERT INTO ln_district VALUES("3","2","Toul Kork","","Jun 5, 2014 6:38:14 AM","1","1","1","");
INSERT INTO ln_district VALUES("4","2","Doung Kor","","Jun 5, 2014 6:37:43 AM","1","1","1","");
INSERT INTO ln_district VALUES("5","1","?????","","Oct 12, 2014 5:58:25 PM","1","1","2","");
INSERT INTO ln_district VALUES("6","1","Mean chheyss","","Oct 12, 2014 6:20:04 PM","1","1","2","");
INSERT INTO ln_district VALUES("7","1","ss","","Nov 1, 2014 1:43:51 AM","1","1","2","");
INSERT INTO ln_district VALUES("8","1","sss","","Nov 1, 2014 1:43:58 AM","1","1","1","");
INSERT INTO ln_district VALUES("9","1","dis eng","dis kh","Nov 15, 2014 10:45:49 PM","1","1","2","");



DROP TABLE ln_exchange;

CREATE TABLE `ln_exchange` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` tinyint(4) DEFAULT NULL,
  `exchange_type` tinyint(4) DEFAULT NULL,
  `is_single` tinyint(4) DEFAULT '1' COMMENT '1 = single,0 multi exchange',
  `receive_dollar` float(15,2) DEFAULT NULL,
  `receive_riel` float(15,2) DEFAULT NULL,
  `receive_bath` float(15,2) DEFAULT NULL,
  `return_dollar` float(10,2) DEFAULT NULL,
  `return_riel` float(10,2) DEFAULT NULL,
  `return_bath` float(10,2) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice_code` varchar(30) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `date` date DEFAULT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ln_exchange VALUES("1","1","1","","22.00","0.00","0.00","0.00","0.00","0.00","1","000001","1","2015-01-11","");



DROP TABLE ln_exchange_detail;

CREATE TABLE `ln_exchange_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exchange_id` int(11) DEFAULT NULL,
  `from_currency_type` varchar(1) DEFAULT NULL,
  `to_currency_type` varchar(1) DEFAULT NULL,
  `from_amount` double DEFAULT NULL,
  `to_amount` double DEFAULT NULL,
  `exchange_rate` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `from_to` varchar(20) DEFAULT NULL COMMENT 'simbal only',
  `specail_customer` tinyint(1) DEFAULT '0' COMMENT '0: normal, 1 : specail customer set new rate',
  `status` tinyint(5) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ln_exchange_detail VALUES("1","1","2","3","22","723.8","32.9","2015-01-11","Dollar - Bath","0","1");



DROP TABLE ln_exchangerate;

CREATE TABLE `ln_exchangerate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we take from customer',
  `out_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we give to customer',
  `rate_in` double DEFAULT NULL,
  `spread` double DEFAULT NULL,
  `rate_out` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT '1:active; 0:Disactive',
  `is_using` tinyint(4) DEFAULT '1',
  `user_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ln_exchangerate VALUES("1","2","3","32.9","32.95","33","2014-02-03 12:07:58","1","","");
INSERT INTO ln_exchangerate VALUES("2","1","2","3990","4000","4100","2014-02-03 12:07:58","1","","");
INSERT INTO ln_exchangerate VALUES("3","3","1","120.6","120.05","121","2014-02-03 12:07:58","1","","");



DROP TABLE ln_fixed_asset;

CREATE TABLE `ln_fixed_asset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `depre_code` varchar(30) DEFAULT NULL,
  `fixed_assetname` varchar(120) DEFAULT NULL,
  `fixed_asset_type` tinyint(4) DEFAULT NULL COMMENT '1=shortterm,2=longterm',
  `asset_code` varchar(30) DEFAULT NULL,
  `asset_cost` float(15,2) DEFAULT NULL,
  `usefull_life` float(10,1) DEFAULT NULL,
  `salvagevalue` float(10,2) DEFAULT NULL,
  `payment_method` float DEFAULT NULL COMMENT '1 Straight line,2 Double-declining banlance,3 Sum of the year',
  `depreciation_start` float DEFAULT NULL,
  `year` int(11) NOT NULL,
  `date` date DEFAULT NULL COMMENT 'create date',
  `user_id` int(11) DEFAULT NULL COMMENT 'create by',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=use,0unuse',
  `pay_type` tinyint(4) DEFAULT NULL COMMENT '1=cash,2=credit,3=other',
  `some_payamount` float(13,3) DEFAULT NULL COMMENT 'input if choose pay_type = 3',
  `note` varchar(77) DEFAULT NULL,
  `is_sold` tinyint(4) DEFAULT '0' COMMENT '1=has sold',
  `is_depreciate` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO ln_fixed_asset VALUES("1","1","","car","2","1","22.00","23.0","24.00","3","2014","0","2014-01-01","","0","3","34.000","pp","0","0");
INSERT INTO ln_fixed_asset VALUES("21","1","","land","1","2","56.00","67.0","68.00","1","2014","0","2014-12-24","","1","2","0.000","dojo","0","0");
INSERT INTO ln_fixed_asset VALUES("22","1","","moto","2","8","78.00","98.0","67.00","2","2014","0","2014-01-01","","0","2","0.000","dara","0","0");
INSERT INTO ln_fixed_asset VALUES("23","1","","ty","1","78","34.00","23.0","12.00","1","2014","0","2014-12-24","","1","1","0.000","yt","0","0");
INSERT INTO ln_fixed_asset VALUES("24","1","","23","1","12","34.00","55.0","56.00","1","2014","0","2014-12-24","","1","1","0.000","","0","0");
INSERT INTO ln_fixed_asset VALUES("25","1","","23","1","12","455.00","566.0","123.00","1","2014","0","2014-12-24","","1","1","0.000","shrfs","0","0");
INSERT INTO ln_fixed_asset VALUES("26","1","","dojo","2","666","2344.00","1234545.0","345656.00","2","2014","0","2014-01-01","","0","2","222.000","sfdghttyh","0","0");
INSERT INTO ln_fixed_asset VALUES("27","1","","tyuyyui","2","325436","12345.00","3455.0","345456.00","1","2014","0","2014-12-24","","0","1","1234.000","sdagty","0","0");
INSERT INTO ln_fixed_asset VALUES("28","1","","yooooo","1","655","7889.00","2334.0","3455.00","1","2014","0","2014-12-24","","0","1","0.000","szgh","0","0");
INSERT INTO ln_fixed_asset VALUES("29","1","","go","1","234","2234.00","12344.0","5667.00","3","2014","0","2014-12-24","","1","1","1233.000","afghhjj","0","0");



DROP TABLE ln_fixed_asset_preposal;

CREATE TABLE `ln_fixed_asset_preposal` (
  `id` int(11) DEFAULT NULL,
  `fixed_asset_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_sold` date DEFAULT NULL,
  `status` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `receipt_type` tinyint(4) DEFAULT '1' COMMENT '1=cash,2=credit,3=other',
  `amount` float(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_holiday;

CREATE TABLE `ln_holiday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(150) DEFAULT NULL,
  `amount_day` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modify_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ln_holiday VALUES("4","Happy New Year 2015","1","2015-01-01","2014-12-02","1","2014-12-31","1","","Stop for khmer New Year");
INSERT INTO ln_holiday VALUES("5","Happy New Year 2015","1","2015-01-01","2015-01-15","","","","","");
INSERT INTO ln_holiday VALUES("6","Happy New Year 2015","1","2015-01-01","","","","","","");
INSERT INTO ln_holiday VALUES("7","","","2015-01-01","","","","","","");



DROP TABLE ln_income_expense;

CREATE TABLE `ln_income_expense` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `total_amount` float(12,2) DEFAULT NULL,
  `fordate` int(11) DEFAULT NULL COMMENT '1to 12',
  `disc` text,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1use,1unuse',
  `user_id` int(11) DEFAULT NULL,
  `tran_type` tinyint(4) DEFAULT NULL COMMENT '1 expense,2 income',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_loan_group;

CREATE TABLE `ln_loan_group` (
  `g_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(20) DEFAULT '1' COMMENT '?????? ???????????????',
  `group_id` int(11) DEFAULT NULL COMMENT '?????????? =client id of group',
  `co_id` int(11) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `date_release` date DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `total_duration` int(11) DEFAULT NULL,
  `first_payment` date DEFAULT NULL,
  `time_collect` varchar(30) DEFAULT NULL,
  `collect_typeterm` tinyint(4) DEFAULT NULL,
  `pay_term` tinyint(4) DEFAULT NULL COMMENT '1=day,2=month',
  `payment_method` int(11) DEFAULT NULL,
  `holiday` tinyint(4) DEFAULT NULL,
  `is_renew` tinyint(4) DEFAULT '0' COMMENT '0=old list,1=new list',
  `branch_id` int(11) DEFAULT '1',
  `loan_type` tinyint(4) DEFAULT '1' COMMENT '1=individule,2=group',
  `status` tinyint(4) DEFAULT '1',
  `loan_group` tinyint(4) DEFAULT '0' COMMENT '1=loan group,0 individule',
  `is_verify` tinyint(4) DEFAULT '0',
  `is_badloan` tinyint(4) DEFAULT NULL,
  `teller_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_loan_member;

CREATE TABLE `ln_loan_member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chart_id` int(11) DEFAULT NULL COMMENT 'from chart account 1',
  `group_id` int(11) DEFAULT NULL,
  `loan_number` varchar(20) NOT NULL COMMENT 'first is branch then 5',
  `client_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `currency_type` tinyint(4) DEFAULT NULL COMMENT '1=khmer ,2=dollar',
  `total_capital` float(15,2) DEFAULT NULL,
  `admin_fee` float(15,2) DEFAULT NULL,
  `collect_typeterm` tinyint(4) DEFAULT NULL,
  `interest_rate` float(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_completed` tinyint(4) DEFAULT '0' COMMENT '0 yet,1 complete,2=some fund',
  `branch_id` int(11) unsigned DEFAULT '1',
  `loan_cycle` tinyint(4) DEFAULT '0' COMMENT '1= is loan cycle,0 not loan cycle',
  `loan_purpose` text,
  `pay_before` varchar(30) DEFAULT '0' COMMENT '??????????????',
  `pay_after` varchar(30) DEFAULT '0' COMMENT '??????????????',
  `graice_period` int(11) DEFAULT '0',
  `amount_collect_principal` float(15,2) DEFAULT NULL,
  `show_barcode` tinyint(4) DEFAULT '0' COMMENT '1 show,0 not show',
  PRIMARY KEY (`member_id`,`loan_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_loanmember_funddetail;

CREATE TABLE `ln_loanmember_funddetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `total_principal` float(15,2) DEFAULT NULL,
  `principal_permonth` float(15,2) DEFAULT NULL,
  `total_interest` float(15,2) DEFAULT NULL,
  `total_payment` float(15,2) DEFAULT NULL,
  `amount_day` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_completed` tinyint(4) DEFAULT '0' COMMENT '0=not complete,1=complete,2=in progress',
  `is_approved` tinyint(4) DEFAULT '0' COMMENT '1=approved paycomplete,not yet',
  `date_payment` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_payment_method;

CREATE TABLE `ln_payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_nameen` varchar(50) DEFAULT NULL,
  `payment_namekh` varchar(50) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ln_payment_method VALUES("1","Decline","","","1");
INSERT INTO ln_payment_method VALUES("2","Baloon","","","1");
INSERT INTO ln_payment_method VALUES("3","Fixed Rate","","","1");
INSERT INTO ln_payment_method VALUES("4","Fixed Pyment(Full Last Period)","","","1");
INSERT INTO ln_payment_method VALUES("5","Semi Baloon","","","1");
INSERT INTO ln_payment_method VALUES("6","Fixed Payment (Fixed Rate)","","","1");



DROP TABLE ln_permission;

CREATE TABLE `ln_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `all_day` varchar(20) DEFAULT NULL,
  `paid_leave` varchar(20) DEFAULT NULL,
  `every_day` varchar(20) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ln_permission VALUES("1","1","1","4","2014-12-10","1","2014-12-23","2014-12-23","00:00:00","0","0","0","???????","1","2014-12-23","");
INSERT INTO ln_permission VALUES("2","3","2","5","2014-12-12","2","2014-12-23","2014-12-23","00:00:00","1","0","0","????????????","1","2014-12-23","");
INSERT INTO ln_permission VALUES("3","1","1","6","2014-12-04","3","2014-12-23","2014-12-23","00:00:00","0","0","1","?????????","1","2014-12-23","1");
INSERT INTO ln_permission VALUES("4","1","1","0","2014-12-04","2","2014-12-23","2014-12-23","00:00:00","0","1","0","????????????","1","2014-12-23","1");



DROP TABLE ln_position;

CREATE TABLE `ln_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(30) DEFAULT NULL,
  `position_en` varchar(100) NOT NULL,
  `position_kh` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 active ,0 deactive',
  `user_id` int(11) NOT NULL COMMENT 'user modify and create',
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1 khmer ,2 english',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO ln_position VALUES("1","","Creditor Officer","????????????","Feb 23, 2014 6:04:30 AM","1","1","1");
INSERT INTO ln_position VALUES("2","","Teller","??????????????","Feb 23, 2014 6:06:30 AM","1","1","1");
INSERT INTO ln_position VALUES("4","","Accountant","?????????","Feb 23, 2014 6:12:47 AM","1","1","1");
INSERT INTO ln_position VALUES("5","","Administrator Officer","???????","Feb 23, 2014 6:17:44 AM","1","1","1");
INSERT INTO ln_position VALUES("6","","Branch Manager","????????????????????","Jun 1, 2014 4:05:12 PM","1","1","1");
INSERT INTO ln_position VALUES("7","","Marketing ","??????","Jun 1, 2014 1:28:44 PM","1","1","1");
INSERT INTO ln_position VALUES("8","","Operation","?????????????????","Jun 1, 2014 1:34:10 PM","1","1","1");



DROP TABLE ln_province;

CREATE TABLE `ln_province` (
  `province_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_en_name` varchar(50) NOT NULL,
  `province_kh_name` varchar(60) NOT NULL,
  `modify_date` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1=kh,2=eng',
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO ln_province VALUES("1","Phnom Penh","???????","Jun 5, 2014 6:37:55 AM","1","1","1","");
INSERT INTO ln_province VALUES("2","Kampong Cham","????????SS","Nov 15, 2014 9:19:53 PM","1","1","2","");
INSERT INTO ln_province VALUES("3","Seim Reap","??????","Jun 5, 2014 6:38:14 AM","1","1","1","");
INSERT INTO ln_province VALUES("4","Kampot","????","Jun 5, 2014 6:37:43 AM","1","1","1","");
INSERT INTO ln_province VALUES("5","kompong spue","?????????","Nov 2, 2014 1:03:41 AM","1","1","1","");
INSERT INTO ln_province VALUES("6","?????","Takeo","Nov 15, 2014 9:12:41 PM","1","1","2","");
INSERT INTO ln_province VALUES("7","Prey veang","???????","Nov 15, 2014 9:16:51 PM","1","1","1","");
INSERT INTO ln_province VALUES("8","Battambong","????????","Nov 22, 2014 4:00:04 PM","1","1","1","");



DROP TABLE ln_receipt_money;

CREATE TABLE `ln_receipt_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lfd_id` int(11) DEFAULT NULL COMMENT 'loan fund detail',
  `receipt_no` varchar(30) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL COMMENT 'pay at which office',
  `loan_number` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `co_id` int(11) DEFAULT NULL COMMENT 'co collect',
  `receiver_id` int(11) DEFAULT NULL COMMENT '??????????????',
  `date_pay` date DEFAULT NULL,
  `date_input` date DEFAULT NULL,
  `capital` float(15,2) DEFAULT NULL COMMENT 'capital before fund',
  `remain_capital` float(15,2) DEFAULT NULL,
  `principal_permonth` float(15,2) DEFAULT NULL COMMENT 'principal pay for month',
  `total_interest` float(15,2) DEFAULT NULL,
  `penalize_amount` float(15,2) DEFAULT NULL COMMENT '??????????????',
  `total_fund` float(15,2) DEFAULT NULL COMMENT '????????????????',
  `service_charge` float(10,2) DEFAULT NULL COMMENT '??????????????',
  `recieve_amount` float(10,2) DEFAULT NULL,
  `reuturn_amount` float(10,2) DEFAULT NULL,
  `note` text,
  `user_id` tinyint(4) DEFAULT NULL,
  `is_complete` tinyint(4) DEFAULT '0' COMMENT '0=not paid complet ,1=complete,2=over paid',
  `is_verify` tinyint(4) DEFAULT '0',
  `verify_by` tinyint(4) DEFAULT '0',
  `is_closingentry` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_referenct;

CREATE TABLE `ln_referenct` (
  `ref_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_salary;

CREATE TABLE `ln_salary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `staff_id` varchar(50) DEFAULT NULL,
  `basic_salary` float(12,2) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_get_salary` date DEFAULT NULL,
  `for_month` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `detail` varchar(10) DEFAULT 'Click',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO ln_salary VALUES("1","1","5","250.00","2014-12-01","2014-12-26","1","2015-01-10","1","0","Click");
INSERT INTO ln_salary VALUES("2","1","8","800.00","2014-12-01","2014-12-29","1","2014-12-31","1","0","Click");
INSERT INTO ln_salary VALUES("4","1","8","800.00","2014-12-01","2014-12-29","1","2014-12-31","1","1","Click");
INSERT INTO ln_salary VALUES("6","2","8","800.00","2014-12-01","2014-12-29","6","2014-12-30","1","1","Click");
INSERT INTO ln_salary VALUES("7","1","2","250.00","2014-12-01","2014-12-31","1","2014-12-31","1","1","Click");
INSERT INTO ln_salary VALUES("8","1","6","100.00","2014-12-26","2014-12-31","1","2014-12-31","1","1","Click");
INSERT INTO ln_salary VALUES("9","1","8","800.00","2014-12-01","2014-12-31","12","2014-12-31","1","1","Click");



DROP TABLE ln_salary_detail;

CREATE TABLE `ln_salary_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bonus_id` int(11) DEFAULT NULL,
  `bonus_type` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `note` text,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

INSERT INTO ln_salary_detail VALUES("1","2","6","88.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("2","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("3","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("4","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("5","4","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("6","5","0","2.00","","0");
INSERT INTO ln_salary_detail VALUES("7","6","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("8","6","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("9","6","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("10","6","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("11","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("12","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("13","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("14","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("16","6","1","200.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("17","6","2","50.00","","1");
INSERT INTO ln_salary_detail VALUES("18","6","3","10.00","","1");
INSERT INTO ln_salary_detail VALUES("19","6","4","5.00","","1");
INSERT INTO ln_salary_detail VALUES("20","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("21","7","1","20.00","Good","0");
INSERT INTO ln_salary_detail VALUES("22","7","2","10.00","C","0");
INSERT INTO ln_salary_detail VALUES("23","7","3","20.00","B","0");
INSERT INTO ln_salary_detail VALUES("24","7","4","2.00","D","0");
INSERT INTO ln_salary_detail VALUES("25","7","5","60.00","B","0");
INSERT INTO ln_salary_detail VALUES("26","7","6","200.00","A","0");
INSERT INTO ln_salary_detail VALUES("27","7","7","55.00","A","0");
INSERT INTO ln_salary_detail VALUES("28","7","8","80.00","A","0");
INSERT INTO ln_salary_detail VALUES("29","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("30","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("31","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("32","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("33","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("34","4","4","50.00","","0");
INSERT INTO ln_salary_detail VALUES("35","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("36","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("37","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("38","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("39","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("40","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("41","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("42","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("43","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("44","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("45","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("46","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("47","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("48","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("49","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("50","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("51","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("52","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("53","2","6","88.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("54","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("55","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("56","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("57","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("58","4","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("59","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("60","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("61","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("62","4","4","50.00","","0");
INSERT INTO ln_salary_detail VALUES("63","7","1","20.00","Good","1");
INSERT INTO ln_salary_detail VALUES("64","7","2","10.00","C","1");
INSERT INTO ln_salary_detail VALUES("65","7","3","20.00","B","1");
INSERT INTO ln_salary_detail VALUES("66","7","4","2.00","D","1");
INSERT INTO ln_salary_detail VALUES("67","7","5","60.00","B","1");
INSERT INTO ln_salary_detail VALUES("68","7","6","200.00","A","1");
INSERT INTO ln_salary_detail VALUES("69","7","7","55.00","A","1");
INSERT INTO ln_salary_detail VALUES("70","7","8","80.00","A","1");
INSERT INTO ln_salary_detail VALUES("71","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("72","1","5","20.00","","0");
INSERT INTO ln_salary_detail VALUES("73","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("74","1","5","20.00","","0");
INSERT INTO ln_salary_detail VALUES("75","1","4","32.00","","0");
INSERT INTO ln_salary_detail VALUES("76","1","2","32.00","","0");
INSERT INTO ln_salary_detail VALUES("77","8","7","20.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("78","8","2","50.00","","1");
INSERT INTO ln_salary_detail VALUES("79","8","3","10.00","","1");
INSERT INTO ln_salary_detail VALUES("80","8","4","5.00","","1");
INSERT INTO ln_salary_detail VALUES("81","8","1","10.00","A","1");
INSERT INTO ln_salary_detail VALUES("82","9","7","20.00","Collection from customer","1");
INSERT INTO ln_salary_detail VALUES("83","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("84","1","5","20.00","","0");
INSERT INTO ln_salary_detail VALUES("85","1","4","32.00","","0");
INSERT INTO ln_salary_detail VALUES("86","1","2","32.00","","0");
INSERT INTO ln_salary_detail VALUES("87","4","1","20.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("88","4","2","50.00","","1");
INSERT INTO ln_salary_detail VALUES("89","4","3","10.00","","1");
INSERT INTO ln_salary_detail VALUES("90","4","4","5.00","","1");
INSERT INTO ln_salary_detail VALUES("91","1","5","100.00","Good","1");
INSERT INTO ln_salary_detail VALUES("92","1","5","20.00","","1");
INSERT INTO ln_salary_detail VALUES("93","1","4","32.00","","1");
INSERT INTO ln_salary_detail VALUES("94","1","2","32.00","","1");



DROP TABLE ln_system_setting;

CREATE TABLE `ln_system_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keycode` varchar(150) DEFAULT NULL,
  `value` varchar(11) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_system_setting VALUES("1","work_saturday","1","1=work on saturday 0 not work");
INSERT INTO ln_system_setting VALUES("2","work_sunday","0","1=work on sunday 0 not work");



DROP TABLE ln_transaction_capital;

CREATE TABLE `ln_transaction_capital` (
  `int` int(11) DEFAULT NULL,
  `branch_int` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `amount_dollar` float(18,3) DEFAULT NULL,
  `amount_riel` float(18,3) DEFAULT NULL,
  `amount_bath` float(18,3) DEFAULT NULL,
  `note` text,
  `is_verify` tinyint(4) DEFAULT '0',
  `user_verify` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_view;

CREATE TABLE `ln_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(50) DEFAULT NULL,
  `name_kh` varchar(50) DEFAULT NULL,
  `key_code` varchar(20) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1khmer',
  `type` int(11) DEFAULT NULL COMMENT '1=term',
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

INSERT INTO ln_view VALUES("1","Daily","??????????","1","1","1","1");
INSERT INTO ln_view VALUES("2","Weekly","?????????????","2","1","1","1");
INSERT INTO ln_view VALUES("3","Monthly","????????","3","1","1","1");
INSERT INTO ln_view VALUES("4","Yearly","???????????","4","1","1","1");
INSERT INTO ln_view VALUES("5","Before","???","1","1","2","1");
INSERT INTO ln_view VALUES("6","Normal","??????","2","1","2","1");
INSERT INTO ln_view VALUES("7","After","?????????","3","1","2","1");
INSERT INTO ln_view VALUES("8","Active","??????????","1","1","3","1");
INSERT INTO ln_view VALUES("10","Khmer","?????","1","1","4","1");
INSERT INTO ln_view VALUES("11","English","English","2","1","4","1");
INSERT INTO ln_view VALUES("12","Single","?????","1","1","5","1");
INSERT INTO ln_view VALUES("13","Married","?????????","2","1","5","1");
INSERT INTO ln_view VALUES("14","Windowed","??????","3","1","5","1");
INSERT INTO ln_view VALUES("15","Mindowed","???????","2","1","5","1");
INSERT INTO ln_view VALUES("16","National ID","National ID","3","1","6","1");
INSERT INTO ln_view VALUES("17","National ID","National ID","2","1","6","1");
INSERT INTO ln_view VALUES("18","dsfkasf","wdfs","3","1","6","1");
INSERT INTO ln_view VALUES("19","Other","asdfsa","4","1","6","");
INSERT INTO ln_view VALUES("23","Deactive","?????????????","2","1","3","1");
INSERT INTO ln_view VALUES("24","Chash","Chash","1","1","7","1");
INSERT INTO ln_view VALUES("25","Cradit","Cradit","2","1","7","1");
INSERT INTO ln_view VALUES("26","other","other","3","1","7","1");
INSERT INTO ln_view VALUES("27","Asset","Asset","1","1","8","1");
INSERT INTO ln_view VALUES("28","Liabilities","Liabilities","2","1","8","1");
INSERT INTO ln_view VALUES("29","Equities","Equities","3","1","8","1");
INSERT INTO ln_view VALUES("30","Incomes","Incomes","4","1","8","1");
INSERT INTO ln_view VALUES("31","Expense","Expense","5","1","8","1");
INSERT INTO ln_view VALUES("32","Operation Account","Operation Account","1","2","10","1");
INSERT INTO ln_view VALUES("33","None Operation Account","None Operation Account","2","1","10","1");
INSERT INTO ln_view VALUES("34","???","???","1","1","12","1");
INSERT INTO ln_view VALUES("35","?????","?????","0","1","12","1");



DROP TABLE ln_village;

CREATE TABLE `ln_village` (
  `vill_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commune_id` tinyint(10) NOT NULL,
  `village_name` varchar(60) NOT NULL,
  `village_namekh` varbinary(60) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL,
  `modify_date` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`vill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO ln_village VALUES("1","1","testing new ","","1","Nov 2, 2014 12:00:31 AM","1","1");
INSERT INTO ln_village VALUES("2","1","Dom nak om pel","","1","Jun 5, 2014 6:37:02 AM","1","1");
INSERT INTO ln_village VALUES("3","1","Lvea Chek","","2","Jun 5, 2014 6:38:14 AM","1","1");
INSERT INTO ln_village VALUES("4","1","Tro sok pherm","","1","Jun 5, 2014 6:37:43 AM","1","1");
INSERT INTO ln_village VALUES("5","1","ssss222","","1","Nov 1, 2014 1:26:52 AM","1","1");
INSERT INTO ln_village VALUES("6","1","www","","2","Nov 1, 2014 1:26:59 AM","1","1");
INSERT INTO ln_village VALUES("7","1","Prey kabas","","2","Nov 1, 2014 11:58:14 PM","1","1");
INSERT INTO ln_village VALUES("8","1","Prey New","","2","Nov 2, 2014 12:00:01 AM","1","1");
INSERT INTO ln_village VALUES("9","3","Prey Port","","","Nov 13, 2014 1:48:28 AM","1","1");
INSERT INTO ln_village VALUES("10","2","Krang trolat","ក្រាំងត្រឡាត់","2","Nov 15, 2014 11:30:56 PM","1","1");



DROP TABLE ln_zone;

CREATE TABLE `ln_zone` (
  `zone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(40) NOT NULL,
  `zone_num` varchar(60) NOT NULL,
  `modify_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO ln_zone VALUES("1","zone 11211","001","2014-10-26","1","1");
INSERT INTO ln_zone VALUES("2","zone 2","002","2014-11-22","1","1");
INSERT INTO ln_zone VALUES("3","zone 5","003","0000-00-00","1","1");
INSERT INTO ln_zone VALUES("4","zone 5","004","0000-00-00","1","1");
INSERT INTO ln_zone VALUES("5","zone 22","222","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("6","zone 13","13","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("7","sdfsadf","222","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("8","dakc","222","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("9","WDFSADF","","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("10","addd","","2014-11-01","1","1");
INSERT INTO ln_zone VALUES("11","vvvvv","vvvvv","2015-01-07","1","1");



DROP TABLE rms_acl_acl;

CREATE TABLE `rms_acl_acl` (
  `acl_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1: display in menu; 0: disable from menu',
  `rank` int(11) DEFAULT NULL COMMENT 'rank to show in submenu',
  PRIMARY KEY (`acl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO rms_acl_acl VALUES("1","rsvAcl","acl","add-acl","1","1");
INSERT INTO rms_acl_acl VALUES("2","rsvAcl","acl","edit-acl","1","2");
INSERT INTO rms_acl_acl VALUES("3","rsvAcl","acl","index","1","3");
INSERT INTO rms_acl_acl VALUES("4","rsvAcl","user-access","index","1","4");
INSERT INTO rms_acl_acl VALUES("5","rsvAcl","user-access","view-user-access","1","5");
INSERT INTO rms_acl_acl VALUES("6","rsvAcl","user-access","update-status","1","6");
INSERT INTO rms_acl_acl VALUES("7","rsvAcl","user-type","index","1","7");
INSERT INTO rms_acl_acl VALUES("8","rsvAcl","user-type","add-user-type","1","8");
INSERT INTO rms_acl_acl VALUES("9","rsvAcl","user-type","edit-user-type","1","9");
INSERT INTO rms_acl_acl VALUES("10","subagent","index","index","1","10");
INSERT INTO rms_acl_acl VALUES("11","subagent","index","add","1","11");
INSERT INTO rms_acl_acl VALUES("12","subagent","index","edited","1","12");
INSERT INTO rms_acl_acl VALUES("13","agent","index","index","1","13");
INSERT INTO rms_acl_acl VALUES("14","agent","index","add","1","14");
INSERT INTO rms_acl_acl VALUES("15","agent","index","edited","1","15");
INSERT INTO rms_acl_acl VALUES("16","user","index","index","1","16");
INSERT INTO rms_acl_acl VALUES("17","user","index","add","1","17");
INSERT INTO rms_acl_acl VALUES("18","user","index","edited","1","18");
INSERT INTO rms_acl_acl VALUES("19","transfer","index","index","1","19");
INSERT INTO rms_acl_acl VALUES("20","transfer","index","add","1","20");
INSERT INTO rms_acl_acl VALUES("21","transfer","index","edited","1","21");
INSERT INTO rms_acl_acl VALUES("22","reports","index","index","1","22");
INSERT INTO rms_acl_acl VALUES("23","reports","index","rpttotal","1","23");
INSERT INTO rms_acl_acl VALUES("24","reports","index","rptautoprint","1","24");
INSERT INTO rms_acl_acl VALUES("25","exchange","index","index","1","25");
INSERT INTO rms_acl_acl VALUES("26","exchange","index","add","1","26");
INSERT INTO rms_acl_acl VALUES("27","exchange","index","edited","1","27");
INSERT INTO rms_acl_acl VALUES("28","exchange","index","rate","1","");
INSERT INTO rms_acl_acl VALUES("29","exchange","index","balance","1","");
INSERT INTO rms_acl_acl VALUES("30","setting","index","index","1","");
INSERT INTO rms_acl_acl VALUES("31","reports","index","rptincome","1","");
INSERT INTO rms_acl_acl VALUES("32","reports","index","rptsummary-exchange","1","");
INSERT INTO rms_acl_acl VALUES("33","reports","index","rptsummary-transfer","1","");
INSERT INTO rms_acl_acl VALUES("34","wer","asdf","asdf","1","");
INSERT INTO rms_acl_acl VALUES("35","asdf","asdfasd","fasdf","1","");
INSERT INTO rms_acl_acl VALUES("36","accounting","index","service-price","1","");



DROP TABLE rms_acl_user_access;

CREATE TABLE `rms_acl_user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acl_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `acl_id` (`acl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

INSERT INTO rms_acl_user_access VALUES("1","1","1","1");
INSERT INTO rms_acl_user_access VALUES("4","2","1","1");
INSERT INTO rms_acl_user_access VALUES("5","3","1","1");
INSERT INTO rms_acl_user_access VALUES("6","4","1","1");
INSERT INTO rms_acl_user_access VALUES("7","5","1","1");
INSERT INTO rms_acl_user_access VALUES("8","6","1","1");
INSERT INTO rms_acl_user_access VALUES("9","7","1","1");
INSERT INTO rms_acl_user_access VALUES("10","8","1","1");
INSERT INTO rms_acl_user_access VALUES("11","9","1","1");
INSERT INTO rms_acl_user_access VALUES("12","10","1","1");
INSERT INTO rms_acl_user_access VALUES("13","11","1","1");
INSERT INTO rms_acl_user_access VALUES("14","12","1","1");
INSERT INTO rms_acl_user_access VALUES("15","13","1","1");
INSERT INTO rms_acl_user_access VALUES("16","14","1","1");
INSERT INTO rms_acl_user_access VALUES("17","15","1","1");
INSERT INTO rms_acl_user_access VALUES("18","16","1","1");
INSERT INTO rms_acl_user_access VALUES("19","17","1","1");
INSERT INTO rms_acl_user_access VALUES("23","21","1","1");
INSERT INTO rms_acl_user_access VALUES("24","22","1","1");
INSERT INTO rms_acl_user_access VALUES("25","23","1","1");
INSERT INTO rms_acl_user_access VALUES("26","24","1","1");
INSERT INTO rms_acl_user_access VALUES("27","10","2","1");
INSERT INTO rms_acl_user_access VALUES("28","11","2","1");
INSERT INTO rms_acl_user_access VALUES("29","12","2","1");
INSERT INTO rms_acl_user_access VALUES("30","13","2","1");
INSERT INTO rms_acl_user_access VALUES("31","14","2","1");
INSERT INTO rms_acl_user_access VALUES("32","15","2","1");
INSERT INTO rms_acl_user_access VALUES("33","19","2","1");
INSERT INTO rms_acl_user_access VALUES("34","20","2","1");
INSERT INTO rms_acl_user_access VALUES("35","21","2","1");
INSERT INTO rms_acl_user_access VALUES("36","22","2","1");
INSERT INTO rms_acl_user_access VALUES("37","23","2","1");
INSERT INTO rms_acl_user_access VALUES("38","24","2","1");
INSERT INTO rms_acl_user_access VALUES("39","19","3","1");
INSERT INTO rms_acl_user_access VALUES("40","20","3","1");
INSERT INTO rms_acl_user_access VALUES("41","21","3","1");
INSERT INTO rms_acl_user_access VALUES("42","25","1","1");
INSERT INTO rms_acl_user_access VALUES("43","26","1","1");
INSERT INTO rms_acl_user_access VALUES("44","27","1","1");
INSERT INTO rms_acl_user_access VALUES("45","28","1","1");
INSERT INTO rms_acl_user_access VALUES("46","29","1","1");
INSERT INTO rms_acl_user_access VALUES("47","25","2","1");
INSERT INTO rms_acl_user_access VALUES("48","26","2","1");
INSERT INTO rms_acl_user_access VALUES("49","27","2","1");
INSERT INTO rms_acl_user_access VALUES("50","28","2","1");
INSERT INTO rms_acl_user_access VALUES("51","29","2","1");
INSERT INTO rms_acl_user_access VALUES("52","25","4","1");
INSERT INTO rms_acl_user_access VALUES("53","26","4","1");
INSERT INTO rms_acl_user_access VALUES("54","27","4","1");
INSERT INTO rms_acl_user_access VALUES("55","28","5","1");
INSERT INTO rms_acl_user_access VALUES("56","25","5","1");
INSERT INTO rms_acl_user_access VALUES("57","29","4","1");
INSERT INTO rms_acl_user_access VALUES("58","30","1","1");
INSERT INTO rms_acl_user_access VALUES("59","31","1","1");
INSERT INTO rms_acl_user_access VALUES("60","32","1","1");
INSERT INTO rms_acl_user_access VALUES("61","33","1","1");
INSERT INTO rms_acl_user_access VALUES("62","33","2","1");
INSERT INTO rms_acl_user_access VALUES("63","32","2","1");
INSERT INTO rms_acl_user_access VALUES("64","31","2","1");
INSERT INTO rms_acl_user_access VALUES("65","30","2","1");
INSERT INTO rms_acl_user_access VALUES("66","22","3","1");
INSERT INTO rms_acl_user_access VALUES("67","23","3","1");
INSERT INTO rms_acl_user_access VALUES("68","31","3","1");
INSERT INTO rms_acl_user_access VALUES("69","24","3","1");
INSERT INTO rms_acl_user_access VALUES("70","33","3","1");
INSERT INTO rms_acl_user_access VALUES("71","32","4","1");
INSERT INTO rms_acl_user_access VALUES("72","30","4","1");



DROP TABLE rms_acl_user_type;

CREATE TABLE `rms_acl_user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO rms_acl_user_type VALUES("1","Operation Manager","0","1");
INSERT INTO rms_acl_user_type VALUES("2","Administrator","1","1");
INSERT INTO rms_acl_user_type VALUES("3","Credit Officer","2","1");



DROP TABLE rms_hold;

CREATE TABLE `rms_hold` (
  `hold_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stu_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`hold_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE rms_rate;

CREATE TABLE `rms_rate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rate_type` tinyint(4) DEFAULT NULL,
  `rate` float unsigned DEFAULT NULL,
  `modify_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO rms_rate VALUES("1","1","4100","","");



DROP TABLE rms_setting;

CREATE TABLE `rms_setting` (
  `code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyName` varchar(450) DEFAULT NULL,
  `keyValue` varchar(4500) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `access_type` int(11) NOT NULL DEFAULT '1' COMMENT '1=access all,2=foundation access,3=accounting access,4=no access',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO rms_setting VALUES("1","sms-warnning-kh","???????????????????????????????????????????","1","0");
INSERT INTO rms_setting VALUES("2","system_name","????????????????? ???????????","1","0");
INSERT INTO rms_setting VALUES("3","branch","VSS SERVICE","1","0");
INSERT INTO rms_setting VALUES("4","power_by","VSS SERVICE","1","0");
INSERT INTO rms_setting VALUES("5","label_animation","????????????????????? : ????????????? ??????????? ?????????????????????????????","1","0");
INSERT INTO rms_setting VALUES("6","branch-tel","TEL :(855) 10 78 55 44","1","0");
INSERT INTO rms_setting VALUES("7","branch_email","E-mail : Borachhay@yahoo.com","1","0");
INSERT INTO rms_setting VALUES("8","branch_add","??????? ??? ???????? ??? ??????? ????????? ?????? ???????","1","0");
INSERT INTO rms_setting VALUES("10","logo-path-name","images/loan-animation.gif","1","4");
INSERT INTO rms_setting VALUES("11","website","www.vssservice.com","1","0");
INSERT INTO rms_setting VALUES("12","branch-add-client","??????? ????????189(?) ?????????????????????????????????????","1","0");
INSERT INTO rms_setting VALUES("13","tel-client","092 515 555, 012 438 283","1","0");
INSERT INTO rms_setting VALUES("14","mainbranch-subtitle","???????????????, ???????????????","1","0");
INSERT INTO rms_setting VALUES("15","marquee-word","????????????????????????? ????????????????????? ?????????????, Exchnage and Transfer money","1","0");
INSERT INTO rms_setting VALUES("16","services","???????????????, ???????????????","1","0");
INSERT INTO rms_setting VALUES("18","branch_en","WESTERN UNIVERSITY","1","0");
INSERT INTO rms_setting VALUES("19","request_student","????????????????????","1","0");
INSERT INTO rms_setting VALUES("20","request_student_en","STUDENT REQUEST FORM","1","0");
INSERT INTO rms_setting VALUES("21","footer_branch","# 15,St 528 ,Boeung Kak I,Toul Kork ,Phnom Penh/# 47,St 173 ,Toul Svay Prey I,Chamkarmorn,Phnom Penh./#171-173,Pheah Ang Eng Street,Kampong Cham Town.","1","0");
INSERT INTO rms_setting VALUES("22","foot_phone","Phone:(855)23 998 233/Phone:(855)23 220 093/Phone:(855)42 942 024","1","0");
INSERT INTO rms_setting VALUES("23","f_email_website","Fax:(855)23 990n699/E-mail :info_wu@/Website western.edu.kh","1","0");
INSERT INTO rms_setting VALUES("24","reciept_en","OFFICAL RECEIPT","1","0");
INSERT INTO rms_setting VALUES("25","reciept_kh","???????????????????","1","0");
INSERT INTO rms_setting VALUES("26","This is My Test","ssss","1","1");
INSERT INTO rms_setting VALUES("27","set_service_label","1","1","0");
INSERT INTO rms_setting VALUES("28","rpt-transfer-title-kh","???? ?????????????????","0","1");
INSERT INTO rms_setting VALUES("29","exchange_ratetitle","?????????????????????","0","1");
INSERT INTO rms_setting VALUES("30","exchange_reciept","?????????????????????","0","1");
INSERT INTO rms_setting VALUES("31","rpt-transfer-location-adr-kh","4","0","1");
INSERT INTO rms_setting VALUES("34","comment","????????????????????????????????? ??????????????????","0","1");
INSERT INTO rms_setting VALUES("35","imgPath","7","0","1");
INSERT INTO rms_setting VALUES("36","rpt-transfer-title-eng","Tel 010 78 55 44","0","1");



DROP TABLE rms_user_log;

CREATE TABLE `rms_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `log_date` datetime NOT NULL,
  `log_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=489 DEFAULT CHARSET=utf8;

INSERT INTO rms_user_log VALUES("1","1","2014-01-18 05:09:43","in");
INSERT INTO rms_user_log VALUES("2","1","2014-01-18 05:11:21","in");
INSERT INTO rms_user_log VALUES("3","1","2014-01-18 08:35:11","in");
INSERT INTO rms_user_log VALUES("4","1","2014-01-19 05:34:03","in");
INSERT INTO rms_user_log VALUES("5","1","2014-01-19 05:46:26","in");
INSERT INTO rms_user_log VALUES("6","1","2014-01-20 11:21:29","in");
INSERT INTO rms_user_log VALUES("7","1","2014-01-20 14:26:06","in");
INSERT INTO rms_user_log VALUES("8","1","2014-01-21 14:01:00","in");
INSERT INTO rms_user_log VALUES("9","1","2014-01-23 11:44:37","in");
INSERT INTO rms_user_log VALUES("10","1","2014-01-23 11:56:00","in");
INSERT INTO rms_user_log VALUES("11","1","2014-01-25 00:44:42","in");
INSERT INTO rms_user_log VALUES("12","1","2014-01-26 11:12:44","in");
INSERT INTO rms_user_log VALUES("13","1","2014-01-26 12:07:58","in");
INSERT INTO rms_user_log VALUES("14","1","2014-02-05 14:20:18","in");
INSERT INTO rms_user_log VALUES("15","1","2014-02-09 00:58:51","in");
INSERT INTO rms_user_log VALUES("16","1","2014-02-09 01:08:35","out");
INSERT INTO rms_user_log VALUES("17","1","2014-02-09 01:08:41","in");
INSERT INTO rms_user_log VALUES("18","1","2014-02-09 01:08:51","out");
INSERT INTO rms_user_log VALUES("19","1","2014-02-09 01:09:21","in");
INSERT INTO rms_user_log VALUES("20","1","2014-02-09 01:24:16","out");
INSERT INTO rms_user_log VALUES("21","1","2014-02-09 01:25:11","in");
INSERT INTO rms_user_log VALUES("22","1","2014-02-09 01:26:44","out");
INSERT INTO rms_user_log VALUES("23","1","2014-02-09 01:27:38","in");
INSERT INTO rms_user_log VALUES("24","1","2014-02-09 10:39:04","in");
INSERT INTO rms_user_log VALUES("25","1","2014-02-09 10:41:35","in");
INSERT INTO rms_user_log VALUES("26","1","2014-02-09 13:31:42","in");
INSERT INTO rms_user_log VALUES("27","1","2014-02-15 05:22:56","in");
INSERT INTO rms_user_log VALUES("28","1","2014-02-15 06:02:22","in");
INSERT INTO rms_user_log VALUES("29","1","2014-02-17 11:15:45","in");
INSERT INTO rms_user_log VALUES("30","1","2014-02-18 11:12:22","in");
INSERT INTO rms_user_log VALUES("31","1","2014-02-18 23:13:48","in");
INSERT INTO rms_user_log VALUES("32","1","2014-02-19 12:20:51","in");
INSERT INTO rms_user_log VALUES("33","1","2014-02-19 23:09:24","in");
INSERT INTO rms_user_log VALUES("34","1","2014-02-20 03:04:05","in");
INSERT INTO rms_user_log VALUES("35","1","2014-02-20 11:38:08","in");
INSERT INTO rms_user_log VALUES("36","1","2014-02-20 13:31:46","in");
INSERT INTO rms_user_log VALUES("37","1","2014-02-22 00:10:55","in");
INSERT INTO rms_user_log VALUES("38","1","2014-02-22 07:59:55","in");
INSERT INTO rms_user_log VALUES("39","1","2014-02-22 10:16:08","in");
INSERT INTO rms_user_log VALUES("40","1","2014-02-22 13:15:30","in");
INSERT INTO rms_user_log VALUES("41","1","2014-02-23 04:51:08","in");
INSERT INTO rms_user_log VALUES("42","1","2014-02-25 11:56:49","in");
INSERT INTO rms_user_log VALUES("43","1","2014-02-25 12:13:02","out");
INSERT INTO rms_user_log VALUES("44","1","2014-02-25 12:15:17","in");
INSERT INTO rms_user_log VALUES("45","1","2014-02-25 14:10:05","out");
INSERT INTO rms_user_log VALUES("46","1","2014-02-25 14:10:13","in");
INSERT INTO rms_user_log VALUES("47","1","2014-02-26 14:00:32","in");
INSERT INTO rms_user_log VALUES("48","1","2014-02-26 23:37:51","in");
INSERT INTO rms_user_log VALUES("49","1","2014-02-27 11:58:17","in");
INSERT INTO rms_user_log VALUES("50","1","2014-02-28 14:08:31","in");
INSERT INTO rms_user_log VALUES("51","1","2014-02-28 14:15:08","out");
INSERT INTO rms_user_log VALUES("52","1","2014-02-28 14:15:27","in");
INSERT INTO rms_user_log VALUES("53","1","2014-02-28 14:16:00","out");
INSERT INTO rms_user_log VALUES("54","1","2014-02-28 14:19:22","in");
INSERT INTO rms_user_log VALUES("55","1","2014-02-28 14:31:03","in");
INSERT INTO rms_user_log VALUES("56","1","2014-02-28 15:15:02","out");
INSERT INTO rms_user_log VALUES("57","1","2014-03-01 00:46:40","in");
INSERT INTO rms_user_log VALUES("58","1","2014-03-01 00:48:27","in");
INSERT INTO rms_user_log VALUES("59","1","2014-03-01 05:23:21","in");
INSERT INTO rms_user_log VALUES("60","1","2014-03-01 05:45:37","out");
INSERT INTO rms_user_log VALUES("61","1","2014-03-01 05:45:43","in");
INSERT INTO rms_user_log VALUES("62","1","2014-03-01 05:47:12","out");
INSERT INTO rms_user_log VALUES("63","1","2014-03-01 05:47:26","in");
INSERT INTO rms_user_log VALUES("64","2","2014-03-02 13:49:22","in");
INSERT INTO rms_user_log VALUES("65","2","2014-03-02 14:41:30","out");
INSERT INTO rms_user_log VALUES("66","2","2014-03-03 09:22:59","in");
INSERT INTO rms_user_log VALUES("67","2","2014-03-06 11:06:28","in");
INSERT INTO rms_user_log VALUES("68","2","2014-03-10 02:07:21","in");
INSERT INTO rms_user_log VALUES("69","2","2014-03-10 03:02:51","in");
INSERT INTO rms_user_log VALUES("70","2","2014-03-10 03:55:52","in");
INSERT INTO rms_user_log VALUES("71","2","2014-03-10 08:46:26","in");
INSERT INTO rms_user_log VALUES("72","2","2014-03-10 10:11:31","in");
INSERT INTO rms_user_log VALUES("73","2","2014-03-10 11:30:20","in");
INSERT INTO rms_user_log VALUES("74","2","2014-03-10 13:33:24","in");
INSERT INTO rms_user_log VALUES("75","2","2014-03-10 14:53:47","in");
INSERT INTO rms_user_log VALUES("76","2","2014-05-02 02:18:16","in");
INSERT INTO rms_user_log VALUES("77","2","2014-05-02 02:49:27","in");
INSERT INTO rms_user_log VALUES("78","2","2014-05-03 03:19:52","in");
INSERT INTO rms_user_log VALUES("79","2","2014-05-03 05:14:59","in");
INSERT INTO rms_user_log VALUES("80","2","2014-05-03 08:37:17","in");
INSERT INTO rms_user_log VALUES("81","2","2014-05-03 09:27:07","out");
INSERT INTO rms_user_log VALUES("82","2","2014-05-03 09:27:23","in");
INSERT INTO rms_user_log VALUES("83","2","2014-05-20 14:32:06","in");
INSERT INTO rms_user_log VALUES("84","1","2014-06-01 03:55:48","in");
INSERT INTO rms_user_log VALUES("85","1","2014-06-01 06:35:08","in");
INSERT INTO rms_user_log VALUES("86","1","2014-06-01 11:51:09","in");
INSERT INTO rms_user_log VALUES("87","1","2014-06-01 12:04:32","in");
INSERT INTO rms_user_log VALUES("88","1","2014-06-01 13:52:01","in");
INSERT INTO rms_user_log VALUES("89","1","2014-06-01 22:29:58","in");
INSERT INTO rms_user_log VALUES("90","1","2014-06-02 22:30:30","in");
INSERT INTO rms_user_log VALUES("91","1","2014-06-03 21:38:29","in");
INSERT INTO rms_user_log VALUES("92","1","2014-06-04 18:27:47","in");
INSERT INTO rms_user_log VALUES("93","1","2014-06-04 22:15:19","out");
INSERT INTO rms_user_log VALUES("94","1","2014-06-05 04:48:17","in");
INSERT INTO rms_user_log VALUES("95","1","2014-06-05 18:17:16","in");
INSERT INTO rms_user_log VALUES("96","1","2014-06-06 05:38:43","in");
INSERT INTO rms_user_log VALUES("97","1","2014-06-06 07:22:15","in");
INSERT INTO rms_user_log VALUES("98","1","2014-06-06 22:10:07","in");
INSERT INTO rms_user_log VALUES("99","1","2014-06-07 05:33:41","in");
INSERT INTO rms_user_log VALUES("100","1","2014-06-07 06:06:47","in");
INSERT INTO rms_user_log VALUES("101","1","2014-06-07 15:00:40","in");
INSERT INTO rms_user_log VALUES("102","1","2014-06-07 17:13:39","in");
INSERT INTO rms_user_log VALUES("103","1","2014-06-07 20:41:01","in");
INSERT INTO rms_user_log VALUES("104","1","2014-06-08 06:00:02","in");
INSERT INTO rms_user_log VALUES("105","1","2014-06-08 08:36:25","in");
INSERT INTO rms_user_log VALUES("106","1","2014-06-08 08:45:30","in");
INSERT INTO rms_user_log VALUES("107","1","2014-06-08 09:37:59","in");
INSERT INTO rms_user_log VALUES("108","1","2014-06-14 07:10:10","in");
INSERT INTO rms_user_log VALUES("109","1","2014-06-14 10:15:58","in");
INSERT INTO rms_user_log VALUES("110","1","2014-06-14 14:12:25","in");
INSERT INTO rms_user_log VALUES("111","1","2014-06-14 21:31:42","in");
INSERT INTO rms_user_log VALUES("112","1","2014-06-14 23:03:13","in");
INSERT INTO rms_user_log VALUES("113","1","2014-06-15 04:43:34","in");
INSERT INTO rms_user_log VALUES("114","1","2014-06-15 04:47:07","in");
INSERT INTO rms_user_log VALUES("115","1","2014-06-15 16:50:10","in");
INSERT INTO rms_user_log VALUES("116","1","2014-06-16 06:55:49","in");
INSERT INTO rms_user_log VALUES("117","1","2014-06-16 19:15:32","in");
INSERT INTO rms_user_log VALUES("118","1","2014-06-21 06:45:03","in");
INSERT INTO rms_user_log VALUES("119","1","2014-06-21 07:07:38","in");
INSERT INTO rms_user_log VALUES("120","1","2014-06-21 09:32:57","in");
INSERT INTO rms_user_log VALUES("121","1","2014-06-22 16:59:58","in");
INSERT INTO rms_user_log VALUES("122","1","2014-06-22 17:40:27","in");
INSERT INTO rms_user_log VALUES("123","1","2014-06-22 20:40:53","in");
INSERT INTO rms_user_log VALUES("124","1","2014-06-24 21:29:23","in");
INSERT INTO rms_user_log VALUES("125","1","2014-06-24 21:51:40","in");
INSERT INTO rms_user_log VALUES("126","1","2014-06-25 19:45:29","in");
INSERT INTO rms_user_log VALUES("127","1","2014-06-26 06:29:30","in");
INSERT INTO rms_user_log VALUES("128","1","2014-06-26 20:18:09","in");
INSERT INTO rms_user_log VALUES("129","1","2014-06-28 14:37:49","in");
INSERT INTO rms_user_log VALUES("130","1","2014-06-28 21:24:55","in");
INSERT INTO rms_user_log VALUES("131","1","2014-06-29 05:23:08","in");
INSERT INTO rms_user_log VALUES("132","1","2014-06-29 05:34:44","out");
INSERT INTO rms_user_log VALUES("133","1","2014-06-29 05:34:56","in");
INSERT INTO rms_user_log VALUES("134","1","2014-06-29 10:25:45","in");
INSERT INTO rms_user_log VALUES("135","1","2014-06-29 11:35:51","out");
INSERT INTO rms_user_log VALUES("136","1","2014-06-29 15:25:24","in");
INSERT INTO rms_user_log VALUES("137","1","2014-06-29 20:31:58","in");
INSERT INTO rms_user_log VALUES("138","1","2014-06-29 20:56:06","out");
INSERT INTO rms_user_log VALUES("139","1","2014-06-29 21:34:59","in");
INSERT INTO rms_user_log VALUES("140","1","2014-06-30 05:29:47","in");
INSERT INTO rms_user_log VALUES("141","1","2014-06-30 20:41:59","in");
INSERT INTO rms_user_log VALUES("142","1","2014-07-01 05:51:04","in");
INSERT INTO rms_user_log VALUES("143","1","2014-07-01 19:54:49","in");
INSERT INTO rms_user_log VALUES("144","1","2014-07-02 06:27:57","in");
INSERT INTO rms_user_log VALUES("145","1","2014-07-02 21:45:38","in");
INSERT INTO rms_user_log VALUES("146","1","2014-07-03 05:19:54","in");
INSERT INTO rms_user_log VALUES("147","1","2014-07-04 04:41:10","in");
INSERT INTO rms_user_log VALUES("148","1","2014-07-04 05:31:37","in");
INSERT INTO rms_user_log VALUES("149","1","2014-07-04 06:56:53","in");
INSERT INTO rms_user_log VALUES("150","1","2014-07-04 21:28:37","in");
INSERT INTO rms_user_log VALUES("151","1","2014-07-05 05:44:15","in");
INSERT INTO rms_user_log VALUES("152","1","2014-07-05 20:13:17","in");
INSERT INTO rms_user_log VALUES("153","1","2014-07-06 11:00:03","in");
INSERT INTO rms_user_log VALUES("154","1","2014-07-06 18:01:20","in");
INSERT INTO rms_user_log VALUES("155","1","2014-07-06 20:38:16","in");
INSERT INTO rms_user_log VALUES("156","1","2014-07-07 20:20:32","in");
INSERT INTO rms_user_log VALUES("157","1","2014-07-08 06:01:40","in");
INSERT INTO rms_user_log VALUES("158","1","2014-07-08 07:15:37","in");
INSERT INTO rms_user_log VALUES("159","1","2014-07-08 20:39:18","in");
INSERT INTO rms_user_log VALUES("160","1","2014-07-09 06:37:35","in");
INSERT INTO rms_user_log VALUES("161","1","2014-07-09 20:27:37","in");
INSERT INTO rms_user_log VALUES("162","1","2014-07-10 19:55:19","in");
INSERT INTO rms_user_log VALUES("163","1","2014-07-11 06:15:03","in");
INSERT INTO rms_user_log VALUES("164","1","2014-07-11 06:25:07","in");
INSERT INTO rms_user_log VALUES("165","1","2014-07-11 22:15:04","in");
INSERT INTO rms_user_log VALUES("166","1","2014-07-12 06:52:32","in");
INSERT INTO rms_user_log VALUES("167","1","2014-07-12 09:35:48","in");
INSERT INTO rms_user_log VALUES("168","1","2014-07-12 12:53:16","in");
INSERT INTO rms_user_log VALUES("169","1","2014-07-12 17:09:30","in");
INSERT INTO rms_user_log VALUES("170","1","2014-07-12 18:11:14","in");
INSERT INTO rms_user_log VALUES("171","1","2014-07-12 21:46:18","in");
INSERT INTO rms_user_log VALUES("172","1","2014-07-13 07:09:35","in");
INSERT INTO rms_user_log VALUES("173","1","2014-07-13 11:21:08","in");
INSERT INTO rms_user_log VALUES("174","1","2014-07-13 18:05:53","in");
INSERT INTO rms_user_log VALUES("175","1","2014-07-13 20:11:44","in");
INSERT INTO rms_user_log VALUES("176","1","2014-07-14 20:51:13","in");
INSERT INTO rms_user_log VALUES("177","1","2014-07-15 06:08:36","in");
INSERT INTO rms_user_log VALUES("178","1","2014-07-15 13:51:34","in");
INSERT INTO rms_user_log VALUES("179","1","2014-07-15 17:36:49","in");
INSERT INTO rms_user_log VALUES("180","1","2014-07-15 20:51:35","in");
INSERT INTO rms_user_log VALUES("181","1","2014-07-15 20:52:41","in");
INSERT INTO rms_user_log VALUES("182","1","2014-07-16 06:39:13","in");
INSERT INTO rms_user_log VALUES("183","1","2014-07-16 06:42:37","in");
INSERT INTO rms_user_log VALUES("184","1","2014-07-16 19:26:04","in");
INSERT INTO rms_user_log VALUES("185","1","2014-07-17 03:49:26","in");
INSERT INTO rms_user_log VALUES("186","1","2014-07-17 05:02:29","in");
INSERT INTO rms_user_log VALUES("187","1","2014-07-17 05:14:15","in");
INSERT INTO rms_user_log VALUES("188","1","2014-07-17 20:33:27","in");
INSERT INTO rms_user_log VALUES("189","1","2014-07-18 05:21:58","in");
INSERT INTO rms_user_log VALUES("190","1","2014-07-18 21:11:27","in");
INSERT INTO rms_user_log VALUES("191","1","2014-07-19 10:24:14","in");
INSERT INTO rms_user_log VALUES("192","1","2014-07-19 13:33:43","in");
INSERT INTO rms_user_log VALUES("193","1","2014-07-19 16:32:24","in");
INSERT INTO rms_user_log VALUES("194","1","2014-07-19 16:35:36","in");
INSERT INTO rms_user_log VALUES("195","1","2014-07-19 17:49:58","in");
INSERT INTO rms_user_log VALUES("196","1","2014-07-19 17:50:16","in");
INSERT INTO rms_user_log VALUES("197","1","2014-07-19 17:50:44","in");
INSERT INTO rms_user_log VALUES("198","1","2014-07-19 17:50:59","in");
INSERT INTO rms_user_log VALUES("199","1","2014-07-19 18:02:19","in");
INSERT INTO rms_user_log VALUES("200","1","2014-07-19 21:38:14","in");
INSERT INTO rms_user_log VALUES("201","1","2014-07-20 10:15:34","in");
INSERT INTO rms_user_log VALUES("202","1","2014-07-20 15:23:38","in");
INSERT INTO rms_user_log VALUES("203","1","2014-07-20 20:02:06","in");
INSERT INTO rms_user_log VALUES("204","1","2014-07-27 08:34:13","in");
INSERT INTO rms_user_log VALUES("205","1","2014-07-27 08:52:25","in");
INSERT INTO rms_user_log VALUES("206","1","2014-07-27 16:14:46","in");
INSERT INTO rms_user_log VALUES("207","1","2014-07-27 18:36:55","in");
INSERT INTO rms_user_log VALUES("208","1","2014-07-28 20:32:08","in");
INSERT INTO rms_user_log VALUES("209","1","2014-07-28 20:52:42","in");
INSERT INTO rms_user_log VALUES("210","1","2014-07-29 06:32:59","in");
INSERT INTO rms_user_log VALUES("211","1","2014-07-29 19:43:46","in");
INSERT INTO rms_user_log VALUES("212","1","2014-07-30 07:15:37","in");
INSERT INTO rms_user_log VALUES("213","1","2014-07-30 18:01:28","in");
INSERT INTO rms_user_log VALUES("214","1","2014-07-30 19:04:46","in");
INSERT INTO rms_user_log VALUES("215","1","2014-08-01 06:39:39","in");
INSERT INTO rms_user_log VALUES("216","1","2014-08-02 09:26:50","in");
INSERT INTO rms_user_log VALUES("217","1","2014-08-02 18:39:09","in");
INSERT INTO rms_user_log VALUES("218","1","2014-08-03 10:20:35","in");
INSERT INTO rms_user_log VALUES("219","1","2014-08-03 16:40:14","in");
INSERT INTO rms_user_log VALUES("220","1","2014-08-04 20:03:21","in");
INSERT INTO rms_user_log VALUES("221","1","2014-08-05 21:12:02","in");
INSERT INTO rms_user_log VALUES("222","1","2014-08-06 07:18:56","in");
INSERT INTO rms_user_log VALUES("223","1","2014-08-06 20:36:29","in");
INSERT INTO rms_user_log VALUES("224","1","2014-08-07 04:13:12","in");
INSERT INTO rms_user_log VALUES("225","1","2014-08-07 05:08:59","in");
INSERT INTO rms_user_log VALUES("226","1","2014-08-07 17:54:28","in");
INSERT INTO rms_user_log VALUES("227","1","2014-08-07 18:12:09","in");
INSERT INTO rms_user_log VALUES("228","1","2014-08-07 20:45:33","in");
INSERT INTO rms_user_log VALUES("229","1","2014-08-08 21:32:59","in");
INSERT INTO rms_user_log VALUES("230","1","2014-08-11 21:08:09","in");
INSERT INTO rms_user_log VALUES("231","1","2014-08-12 18:17:32","in");
INSERT INTO rms_user_log VALUES("232","1","2014-08-13 18:12:23","in");
INSERT INTO rms_user_log VALUES("233","1","2014-08-14 05:37:25","in");
INSERT INTO rms_user_log VALUES("234","1","2014-08-14 19:41:34","in");
INSERT INTO rms_user_log VALUES("235","1","2014-08-15 06:14:04","in");
INSERT INTO rms_user_log VALUES("236","1","2014-08-15 19:49:53","in");
INSERT INTO rms_user_log VALUES("237","1","2014-08-16 21:52:05","in");
INSERT INTO rms_user_log VALUES("238","1","2014-08-16 22:05:04","in");
INSERT INTO rms_user_log VALUES("239","1","2014-08-17 19:22:03","in");
INSERT INTO rms_user_log VALUES("240","1","2014-08-18 21:00:16","in");
INSERT INTO rms_user_log VALUES("241","1","2014-08-19 06:29:20","in");
INSERT INTO rms_user_log VALUES("242","1","2014-08-19 18:34:26","in");
INSERT INTO rms_user_log VALUES("243","1","2014-08-31 10:10:22","in");
INSERT INTO rms_user_log VALUES("244","1","2014-08-31 16:04:43","in");
INSERT INTO rms_user_log VALUES("245","1","2014-08-31 17:09:09","in");
INSERT INTO rms_user_log VALUES("246","1","2014-08-31 19:57:00","in");
INSERT INTO rms_user_log VALUES("247","1","2014-09-01 06:31:20","in");
INSERT INTO rms_user_log VALUES("248","1","2014-09-01 18:23:22","in");
INSERT INTO rms_user_log VALUES("249","1","2014-09-01 19:47:05","in");
INSERT INTO rms_user_log VALUES("250","1","2014-09-02 06:41:51","in");
INSERT INTO rms_user_log VALUES("251","1","2014-09-02 19:10:19","in");
INSERT INTO rms_user_log VALUES("252","1","2014-09-03 06:37:47","in");
INSERT INTO rms_user_log VALUES("253","1","2014-09-03 07:02:12","in");
INSERT INTO rms_user_log VALUES("254","1","2014-09-03 18:44:09","in");
INSERT INTO rms_user_log VALUES("255","1","2014-09-03 20:49:12","in");
INSERT INTO rms_user_log VALUES("256","1","2014-09-04 06:58:42","in");
INSERT INTO rms_user_log VALUES("257","1","2014-09-04 18:29:00","in");
INSERT INTO rms_user_log VALUES("258","1","2014-09-04 20:45:56","in");
INSERT INTO rms_user_log VALUES("259","1","2014-09-04 22:34:11","in");
INSERT INTO rms_user_log VALUES("260","1","2014-09-09 21:19:29","in");
INSERT INTO rms_user_log VALUES("261","1","2014-09-10 18:32:44","in");
INSERT INTO rms_user_log VALUES("262","1","2014-09-11 21:13:56","in");
INSERT INTO rms_user_log VALUES("263","1","2014-10-09 20:32:45","in");
INSERT INTO rms_user_log VALUES("264","1","2014-10-10 08:49:25","in");
INSERT INTO rms_user_log VALUES("265","1","2014-10-11 09:09:12","in");
INSERT INTO rms_user_log VALUES("266","1","2014-10-11 17:14:14","in");
INSERT INTO rms_user_log VALUES("267","1","2014-10-12 09:18:11","in");
INSERT INTO rms_user_log VALUES("268","1","2014-10-12 15:14:40","in");
INSERT INTO rms_user_log VALUES("269","1","2014-10-12 15:52:02","in");
INSERT INTO rms_user_log VALUES("270","1","2014-10-12 19:49:23","in");
INSERT INTO rms_user_log VALUES("271","1","2014-10-26 16:19:12","in");
INSERT INTO rms_user_log VALUES("272","1","2014-10-27 20:56:01","in");
INSERT INTO rms_user_log VALUES("273","1","2014-10-27 23:22:59","in");
INSERT INTO rms_user_log VALUES("274","1","2014-10-28 08:49:03","in");
INSERT INTO rms_user_log VALUES("275","1","2014-10-28 08:49:13","in");
INSERT INTO rms_user_log VALUES("276","1","2014-10-28 21:32:40","in");
INSERT INTO rms_user_log VALUES("277","1","2014-10-28 21:44:26","in");
INSERT INTO rms_user_log VALUES("278","1","2014-10-29 17:41:01","in");
INSERT INTO rms_user_log VALUES("279","1","2014-10-30 08:47:14","in");
INSERT INTO rms_user_log VALUES("280","1","2014-10-31 09:00:51","in");
INSERT INTO rms_user_log VALUES("281","1","2014-10-31 20:48:43","in");
INSERT INTO rms_user_log VALUES("282","1","2014-10-31 20:52:49","in");
INSERT INTO rms_user_log VALUES("283","1","2014-10-31 00:28:59","in");
INSERT INTO rms_user_log VALUES("284","1","2014-10-31 09:06:45","in");
INSERT INTO rms_user_log VALUES("285","1","2014-11-01 00:34:47","in");
INSERT INTO rms_user_log VALUES("286","1","2014-11-01 00:41:19","in");
INSERT INTO rms_user_log VALUES("287","1","2014-11-01 08:43:22","in");
INSERT INTO rms_user_log VALUES("288","1","2014-11-01 10:34:13","in");
INSERT INTO rms_user_log VALUES("289","1","2014-11-01 22:07:13","in");
INSERT INTO rms_user_log VALUES("290","1","2014-11-01 23:10:31","in");
INSERT INTO rms_user_log VALUES("291","1","2014-11-02 22:21:39","in");
INSERT INTO rms_user_log VALUES("292","1","2014-11-06 22:09:22","in");
INSERT INTO rms_user_log VALUES("293","1","2014-11-06 22:44:32","in");
INSERT INTO rms_user_log VALUES("294","1","2014-11-06 22:45:41","in");
INSERT INTO rms_user_log VALUES("295","1","2014-11-06 23:48:01","in");
INSERT INTO rms_user_log VALUES("296","1","2014-11-08 23:52:54","in");
INSERT INTO rms_user_log VALUES("297","1","2014-11-09 00:17:20","in");
INSERT INTO rms_user_log VALUES("298","1","2014-11-10 23:25:50","in");
INSERT INTO rms_user_log VALUES("299","1","2014-11-10 23:46:56","in");
INSERT INTO rms_user_log VALUES("300","1","2014-11-11 01:31:09","in");
INSERT INTO rms_user_log VALUES("301","1","2014-11-12 09:03:34","in");
INSERT INTO rms_user_log VALUES("302","1","2014-11-13 00:10:27","in");
INSERT INTO rms_user_log VALUES("303","1","2014-11-13 00:25:43","in");
INSERT INTO rms_user_log VALUES("304","1","2014-11-13 00:40:17","in");
INSERT INTO rms_user_log VALUES("305","1","2014-11-13 21:25:22","in");
INSERT INTO rms_user_log VALUES("306","1","2014-11-13 21:46:45","in");
INSERT INTO rms_user_log VALUES("307","1","2014-11-13 20:10:40","in");
INSERT INTO rms_user_log VALUES("308","1","2014-11-13 20:12:19","in");
INSERT INTO rms_user_log VALUES("309","1","2014-11-13 22:24:54","in");
INSERT INTO rms_user_log VALUES("310","1","2014-11-14 20:17:26","in");
INSERT INTO rms_user_log VALUES("311","1","2014-11-14 20:23:26","in");
INSERT INTO rms_user_log VALUES("312","1","2014-11-15 08:57:13","in");
INSERT INTO rms_user_log VALUES("313","1","2014-11-15 10:46:24","in");
INSERT INTO rms_user_log VALUES("314","1","2014-11-15 18:45:01","in");
INSERT INTO rms_user_log VALUES("315","1","2014-11-16 07:48:24","in");
INSERT INTO rms_user_log VALUES("316","1","2014-11-16 17:55:01","in");
INSERT INTO rms_user_log VALUES("317","1","2014-11-16 20:57:45","in");
INSERT INTO rms_user_log VALUES("318","1","2014-11-16 22:31:24","in");
INSERT INTO rms_user_log VALUES("319","1","2014-11-16 22:32:04","in");
INSERT INTO rms_user_log VALUES("320","1","2014-11-17 18:09:44","in");
INSERT INTO rms_user_log VALUES("321","1","2014-11-17 20:26:16","in");
INSERT INTO rms_user_log VALUES("322","1","2014-11-17 21:33:47","in");
INSERT INTO rms_user_log VALUES("323","1","2014-11-18 06:47:54","in");
INSERT INTO rms_user_log VALUES("324","1","2014-11-18 16:23:39","in");
INSERT INTO rms_user_log VALUES("325","1","2014-11-18 16:44:49","in");
INSERT INTO rms_user_log VALUES("326","1","2014-11-18 16:47:49","in");
INSERT INTO rms_user_log VALUES("327","1","2014-11-18 17:22:34","in");
INSERT INTO rms_user_log VALUES("328","1","2014-11-19 18:50:39","in");
INSERT INTO rms_user_log VALUES("329","1","2014-11-19 22:09:47","in");
INSERT INTO rms_user_log VALUES("330","1","2014-11-20 01:29:53","in");
INSERT INTO rms_user_log VALUES("331","1","2014-11-20 10:10:47","in");
INSERT INTO rms_user_log VALUES("332","1","2014-11-20 21:15:10","in");
INSERT INTO rms_user_log VALUES("333","1","2014-11-20 19:25:45","in");
INSERT INTO rms_user_log VALUES("334","1","2014-11-21 06:11:11","in");
INSERT INTO rms_user_log VALUES("335","1","2014-11-21 11:31:37","in");
INSERT INTO rms_user_log VALUES("336","1","2014-11-21 12:49:04","in");
INSERT INTO rms_user_log VALUES("337","1","2014-11-21 14:13:48","in");
INSERT INTO rms_user_log VALUES("338","1","2014-11-21 20:01:01","in");
INSERT INTO rms_user_log VALUES("339","1","2014-11-21 21:31:04","in");
INSERT INTO rms_user_log VALUES("340","1","2014-11-22 06:49:58","in");
INSERT INTO rms_user_log VALUES("341","1","2014-11-22 08:58:09","in");
INSERT INTO rms_user_log VALUES("342","1","2014-11-22 11:19:08","in");
INSERT INTO rms_user_log VALUES("343","1","2014-11-22 11:28:35","in");
INSERT INTO rms_user_log VALUES("344","1","2014-11-22 14:35:56","in");
INSERT INTO rms_user_log VALUES("345","1","2014-11-22 15:40:46","in");
INSERT INTO rms_user_log VALUES("346","1","2014-11-22 21:45:40","in");
INSERT INTO rms_user_log VALUES("347","1","2014-11-23 10:35:44","in");
INSERT INTO rms_user_log VALUES("348","1","2014-11-23 11:03:07","in");
INSERT INTO rms_user_log VALUES("349","1","2014-11-23 14:44:15","in");
INSERT INTO rms_user_log VALUES("350","1","2014-11-23 19:31:42","in");
INSERT INTO rms_user_log VALUES("351","1","2014-11-23 23:21:59","in");
INSERT INTO rms_user_log VALUES("352","1","2014-11-23 23:44:30","in");
INSERT INTO rms_user_log VALUES("353","1","2014-11-24 21:35:28","in");
INSERT INTO rms_user_log VALUES("354","1","2014-11-25 00:35:44","in");
INSERT INTO rms_user_log VALUES("355","1","2014-11-25 21:43:03","in");
INSERT INTO rms_user_log VALUES("356","1","2014-11-26 10:18:20","in");
INSERT INTO rms_user_log VALUES("357","1","2014-11-26 15:44:10","in");
INSERT INTO rms_user_log VALUES("358","1","2014-11-26 20:14:47","in");
INSERT INTO rms_user_log VALUES("359","1","2014-11-26 23:15:36","in");
INSERT INTO rms_user_log VALUES("360","1","2014-11-26 23:57:00","in");
INSERT INTO rms_user_log VALUES("361","1","2014-11-27 20:50:15","in");
INSERT INTO rms_user_log VALUES("362","1","2014-11-27 22:24:27","in");
INSERT INTO rms_user_log VALUES("363","1","2014-11-28 00:48:07","in");
INSERT INTO rms_user_log VALUES("364","1","2014-11-28 19:53:46","in");
INSERT INTO rms_user_log VALUES("365","1","2014-11-28 21:34:37","in");
INSERT INTO rms_user_log VALUES("366","1","2014-11-28 22:55:47","in");
INSERT INTO rms_user_log VALUES("367","1","2014-11-30 01:29:58","in");
INSERT INTO rms_user_log VALUES("368","1","2014-11-30 11:03:29","in");
INSERT INTO rms_user_log VALUES("369","1","2014-11-30 19:54:36","in");
INSERT INTO rms_user_log VALUES("370","1","2014-11-30 23:01:56","in");
INSERT INTO rms_user_log VALUES("371","1","2014-11-30 23:03:01","in");
INSERT INTO rms_user_log VALUES("372","1","2014-12-01 09:55:47","in");
INSERT INTO rms_user_log VALUES("373","1","2014-12-02 02:19:27","in");
INSERT INTO rms_user_log VALUES("374","1","2014-12-02 20:12:38","in");
INSERT INTO rms_user_log VALUES("375","1","2014-12-02 22:29:23","in");
INSERT INTO rms_user_log VALUES("376","1","2014-12-03 07:45:42","in");
INSERT INTO rms_user_log VALUES("377","1","2014-12-03 13:29:39","in");
INSERT INTO rms_user_log VALUES("378","1","2014-12-03 21:37:07","in");
INSERT INTO rms_user_log VALUES("379","1","2014-12-04 05:53:19","in");
INSERT INTO rms_user_log VALUES("380","1","2014-12-04 21:30:13","in");
INSERT INTO rms_user_log VALUES("381","1","2014-12-05 22:08:08","in");
INSERT INTO rms_user_log VALUES("382","1","2014-12-08 08:07:22","in");
INSERT INTO rms_user_log VALUES("383","1","2014-12-08 21:54:49","in");
INSERT INTO rms_user_log VALUES("384","1","2014-12-09 10:07:46","in");
INSERT INTO rms_user_log VALUES("385","1","2014-12-09 11:19:18","in");
INSERT INTO rms_user_log VALUES("386","1","2014-12-09 22:44:19","in");
INSERT INTO rms_user_log VALUES("387","1","2014-12-10 18:37:00","in");
INSERT INTO rms_user_log VALUES("388","1","2014-12-12 09:05:43","in");
INSERT INTO rms_user_log VALUES("389","1","2014-12-12 11:00:14","in");
INSERT INTO rms_user_log VALUES("390","1","2014-12-13 12:37:07","in");
INSERT INTO rms_user_log VALUES("391","1","2014-12-13 17:49:46","in");
INSERT INTO rms_user_log VALUES("392","1","2014-12-13 18:08:25","in");
INSERT INTO rms_user_log VALUES("393","1","2014-12-13 18:12:42","in");
INSERT INTO rms_user_log VALUES("394","1","2014-12-13 18:14:07","in");
INSERT INTO rms_user_log VALUES("395","1","2014-12-13 18:16:54","in");
INSERT INTO rms_user_log VALUES("396","1","2014-12-13 21:43:36","in");
INSERT INTO rms_user_log VALUES("397","1","2014-12-14 17:19:24","in");
INSERT INTO rms_user_log VALUES("398","1","2014-12-15 00:14:43","in");
INSERT INTO rms_user_log VALUES("399","1","2014-12-15 12:03:51","in");
INSERT INTO rms_user_log VALUES("400","1","2014-12-15 22:09:34","in");
INSERT INTO rms_user_log VALUES("401","1","2014-12-16 00:14:26","in");
INSERT INTO rms_user_log VALUES("402","1","2014-12-16 11:13:45","in");
INSERT INTO rms_user_log VALUES("403","1","2014-12-16 22:52:22","in");
INSERT INTO rms_user_log VALUES("404","1","2014-12-16 23:11:30","in");
INSERT INTO rms_user_log VALUES("405","1","2014-12-17 17:46:50","in");
INSERT INTO rms_user_log VALUES("406","1","2014-12-17 19:25:09","in");
INSERT INTO rms_user_log VALUES("407","1","2014-12-18 11:06:27","in");
INSERT INTO rms_user_log VALUES("408","1","2014-12-18 08:25:58","in");
INSERT INTO rms_user_log VALUES("409","1","2014-12-18 08:39:47","in");
INSERT INTO rms_user_log VALUES("410","1","2014-12-18 09:17:10","in");
INSERT INTO rms_user_log VALUES("411","1","2014-12-18 10:05:28","in");
INSERT INTO rms_user_log VALUES("412","1","2014-12-18 19:08:36","in");
INSERT INTO rms_user_log VALUES("413","1","2014-12-19 06:52:42","in");
INSERT INTO rms_user_log VALUES("414","1","2014-12-19 10:00:57","in");
INSERT INTO rms_user_log VALUES("415","1","2014-12-19 10:41:02","in");
INSERT INTO rms_user_log VALUES("416","1","2014-12-19 13:36:50","in");
INSERT INTO rms_user_log VALUES("417","1","2014-12-20 09:49:01","in");
INSERT INTO rms_user_log VALUES("418","1","2014-12-20 09:49:20","in");
INSERT INTO rms_user_log VALUES("419","1","2014-12-20 21:54:32","in");
INSERT INTO rms_user_log VALUES("420","1","2014-12-21 09:19:06","in");
INSERT INTO rms_user_log VALUES("421","1","2014-12-21 09:21:34","in");
INSERT INTO rms_user_log VALUES("422","1","2014-12-21 18:51:51","in");
INSERT INTO rms_user_log VALUES("423","1","2014-12-22 08:51:56","in");
INSERT INTO rms_user_log VALUES("424","1","2014-12-22 10:23:22","in");
INSERT INTO rms_user_log VALUES("425","1","2014-12-22 22:00:34","in");
INSERT INTO rms_user_log VALUES("426","1","2014-12-23 08:50:46","in");
INSERT INTO rms_user_log VALUES("427","1","2014-12-23 10:11:23","in");
INSERT INTO rms_user_log VALUES("428","1","2014-12-24 07:04:54","in");
INSERT INTO rms_user_log VALUES("429","1","2014-12-24 07:22:54","in");
INSERT INTO rms_user_log VALUES("430","1","2014-12-24 08:18:26","in");
INSERT INTO rms_user_log VALUES("431","1","2014-12-23 21:20:42","in");
INSERT INTO rms_user_log VALUES("432","1","2014-12-23 21:25:37","in");
INSERT INTO rms_user_log VALUES("433","1","2014-12-24 11:17:12","in");
INSERT INTO rms_user_log VALUES("434","1","2014-12-24 13:49:36","in");
INSERT INTO rms_user_log VALUES("435","1","2014-12-24 20:17:02","in");
INSERT INTO rms_user_log VALUES("436","1","2014-12-25 06:57:39","in");
INSERT INTO rms_user_log VALUES("437","1","2014-12-25 16:02:43","in");
INSERT INTO rms_user_log VALUES("438","1","2014-12-25 19:41:03","in");
INSERT INTO rms_user_log VALUES("439","1","2014-12-26 13:19:35","in");
INSERT INTO rms_user_log VALUES("440","1","2014-12-26 10:39:57","in");
INSERT INTO rms_user_log VALUES("441","1","2014-12-27 07:36:28","in");
INSERT INTO rms_user_log VALUES("442","1","2014-12-27 13:00:57","in");
INSERT INTO rms_user_log VALUES("443","1","2014-12-28 21:32:25","in");
INSERT INTO rms_user_log VALUES("444","1","2014-12-28 21:43:08","in");
INSERT INTO rms_user_log VALUES("445","1","2014-12-28 21:54:45","in");
INSERT INTO rms_user_log VALUES("446","1","2014-12-29 12:51:22","in");
INSERT INTO rms_user_log VALUES("447","1","2014-12-29 16:15:37","in");
INSERT INTO rms_user_log VALUES("448","1","2014-12-30 00:24:18","in");
INSERT INTO rms_user_log VALUES("449","1","2014-12-30 08:06:45","in");
INSERT INTO rms_user_log VALUES("450","1","2014-12-30 09:53:08","in");
INSERT INTO rms_user_log VALUES("451","1","2014-12-30 22:31:38","in");
INSERT INTO rms_user_log VALUES("452","1","2014-12-31 09:11:36","in");
INSERT INTO rms_user_log VALUES("453","1","2014-12-31 06:21:29","in");
INSERT INTO rms_user_log VALUES("454","1","2015-01-02 08:30:45","in");
INSERT INTO rms_user_log VALUES("455","1","2015-01-02 10:37:05","in");
INSERT INTO rms_user_log VALUES("456","1","2015-01-02 14:26:22","in");
INSERT INTO rms_user_log VALUES("457","1","2015-01-02 21:52:02","in");
INSERT INTO rms_user_log VALUES("458","1","2015-01-03 12:27:25","in");
INSERT INTO rms_user_log VALUES("459","1","2015-01-03 18:50:47","in");
INSERT INTO rms_user_log VALUES("460","1","2015-01-04 07:31:25","in");
INSERT INTO rms_user_log VALUES("461","1","2015-01-04 17:20:31","in");
INSERT INTO rms_user_log VALUES("462","1","2015-01-05 04:02:57","in");
INSERT INTO rms_user_log VALUES("463","1","2015-01-05 12:13:40","in");
INSERT INTO rms_user_log VALUES("464","1","2015-01-05 13:24:38","in");
INSERT INTO rms_user_log VALUES("465","1","2015-01-05 16:18:29","in");
INSERT INTO rms_user_log VALUES("466","1","2015-01-06 00:26:56","in");
INSERT INTO rms_user_log VALUES("467","1","2015-01-06 05:47:53","in");
INSERT INTO rms_user_log VALUES("468","1","2015-01-06 05:48:55","in");
INSERT INTO rms_user_log VALUES("469","1","2015-01-06 08:17:07","in");
INSERT INTO rms_user_log VALUES("470","1","2015-01-06 04:28:42","in");
INSERT INTO rms_user_log VALUES("471","1","2015-01-06 04:29:12","in");
INSERT INTO rms_user_log VALUES("472","1","2015-01-07 10:55:02","in");
INSERT INTO rms_user_log VALUES("473","1","2015-01-07 11:28:01","in");
INSERT INTO rms_user_log VALUES("474","1","2015-01-07 12:01:35","in");
INSERT INTO rms_user_log VALUES("475","1","2015-01-07 19:39:29","in");
INSERT INTO rms_user_log VALUES("476","1","2015-01-07 19:40:27","in");
INSERT INTO rms_user_log VALUES("477","1","2015-01-11 12:01:49","in");
INSERT INTO rms_user_log VALUES("478","1","2015-01-11 12:31:04","in");
INSERT INTO rms_user_log VALUES("479","1","2015-01-11 19:30:58","in");
INSERT INTO rms_user_log VALUES("480","1","2015-01-12 08:32:34","in");
INSERT INTO rms_user_log VALUES("481","1","2015-01-12 15:59:36","in");
INSERT INTO rms_user_log VALUES("482","1","2015-01-12 16:00:32","in");
INSERT INTO rms_user_log VALUES("483","1","2015-01-13 06:21:22","in");
INSERT INTO rms_user_log VALUES("484","1","2015-01-13 08:02:03","in");
INSERT INTO rms_user_log VALUES("485","1","2015-01-13 20:16:57","in");
INSERT INTO rms_user_log VALUES("486","1","2015-01-14 10:26:37","in");
INSERT INTO rms_user_log VALUES("487","1","2015-02-05 10:57:52","in");
INSERT INTO rms_user_log VALUES("488","1","2015-02-09 13:59:43","in");



DROP TABLE rms_users;

CREATE TABLE `rms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` tinyint(1) DEFAULT '0' COMMENT '0: transfer; 1:admin',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO rms_users VALUES("1","?????","????","channy","5f4dcc3b5aa765d61d8327deb882cf99","1","1");
INSERT INTO rms_users VALUES("2","??????","????","soeurn","5f4dcc3b5aa765d61d8327deb882cf99","2","1");



