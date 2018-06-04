/*
Navicat MySQL Data Transfer

Source Server         : DC_SOPMOEI_IN
Source Server Version : 50505
Source Host           : 192.168.1.225:3306
Source Database       : db_demo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-11-14 17:09:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dhdc_module_unitcost
-- ----------------------------
DROP TABLE IF EXISTS `dhdc_module_unitcost`;
CREATE TABLE `dhdc_module_unitcost` (
  `HOSPCODE` varchar(5) NOT NULL,
  `INCOME` char(2) NOT NULL,
  `INCOME_NAME` varchar(255) NOT NULL,
  `COST` double(20,2) NOT NULL,
  `PRICE` double(20,2) NOT NULL,
  `TOTAL` double(20,2) NOT NULL,
  `PAYPRICE` double(20,2) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `BYEAR` varchar(4) NOT NULL,
  PRIMARY KEY (`HOSPCODE`,`INCOME`,`TYPE`,`BYEAR`),
  KEY `HOSPCODE` (`HOSPCODE`,`INCOME`,`TYPE`,`BYEAR`) USING BTREE,
  KEY `HOSPCODE_2` (`HOSPCODE`) USING BTREE,
  KEY `INCOME` (`INCOME`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dhdc_module_unitcost
-- ----------------------------

-- ----------------------------
-- Table structure for dhdc_module_unitcost_ins
-- ----------------------------
DROP TABLE IF EXISTS `dhdc_module_unitcost_ins`;
CREATE TABLE `dhdc_module_unitcost_ins` (
  `HOSPCODE` varchar(5) NOT NULL,
  `INS_CODE` varchar(5) NOT NULL,
  `INS_NAME` varchar(200) NOT NULL,
  `COST` double(20,2) NOT NULL,
  `PRICE` double(20,2) NOT NULL,
  `TOTAL` double(20,2) NOT NULL,
  `PAYPRICE` double(20,2) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `BYEAR` varchar(4) NOT NULL,
  PRIMARY KEY (`HOSPCODE`,`INS_CODE`,`TYPE`,`BYEAR`),
  KEY `HOSPCODE` (`HOSPCODE`,`INS_CODE`,`TYPE`,`BYEAR`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dhdc_module_unitcost_ins
-- ----------------------------

-- ----------------------------
-- Table structure for dhdc_module_unitcost_nation
-- ----------------------------
DROP TABLE IF EXISTS `dhdc_module_unitcost_nation`;
CREATE TABLE `dhdc_module_unitcost_nation` (
  `HOSPCODE` varchar(5) NOT NULL,
  `NATION` varchar(5) NOT NULL,
  `NATION_NAME` varchar(200) NOT NULL,
  `NATION_GROUP` varchar(5) NOT NULL,
  `NATION_GROUP_NAME` varchar(200) NOT NULL,
  `COST` double(20,2) NOT NULL,
  `PRICE` double(20,2) NOT NULL,
  `TOTAL` double(20,2) NOT NULL,
  `PAYPRICE` double(20,2) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `BYEAR` varchar(4) NOT NULL,
  PRIMARY KEY (`HOSPCODE`,`NATION`,`TYPE`,`BYEAR`),
  KEY `HOSPCODE` (`HOSPCODE`,`NATION`,`TYPE`,`BYEAR`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dhdc_module_unitcost_nation
-- ----------------------------

-- ----------------------------
-- Table structure for dhdc_module_unitcost_occ
-- ----------------------------
DROP TABLE IF EXISTS `dhdc_module_unitcost_occ`;
CREATE TABLE `dhdc_module_unitcost_occ` (
  `HOSPCODE` varchar(5) NOT NULL,
  `OCC_CODE` varchar(5) NOT NULL,
  `OCC_NAME` varchar(200) NOT NULL,
  `COST` double(20,2) NOT NULL,
  `PRICE` double(20,2) NOT NULL,
  `TOTAL` double(20,2) NOT NULL,
  `PAYPRICE` double(20,2) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `BYEAR` varchar(4) NOT NULL,
  PRIMARY KEY (`HOSPCODE`,`OCC_CODE`,`TYPE`,`BYEAR`),
  KEY `HOSPCODE` (`HOSPCODE`,`OCC_CODE`,`TYPE`,`BYEAR`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dhdc_module_unitcost_occ
-- ----------------------------

-- ----------------------------
-- Table structure for dhdc_income
-- ----------------------------
CREATE TABLE IF  NOT EXISTS`dhdc_income` (
  `income` char(2) NOT NULL DEFAULT '',
  `name` varchar(200) DEFAULT NULL,
  `income_group` char(2) DEFAULT NULL,
  PRIMARY KEY (`income`),
  KEY `ix_income_group` (`income_group`),
  KEY `ix_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of dhdc_income
-- ----------------------------
INSERT INTO `dhdc_income` VALUES ('01', 'ค่าห้องค่าอาหาร', '01');
INSERT INTO `dhdc_income` VALUES ('02', 'ค่าอวัยวะเทียมและอุปกรณ์ในการบำบัดรักษาโรค', '02');
INSERT INTO `dhdc_income` VALUES ('03', 'ค่ายาในบัญชียาหลักแห่งชาติ', '03');
INSERT INTO `dhdc_income` VALUES ('04', 'ค่ายากลับบ้าน', '04');
INSERT INTO `dhdc_income` VALUES ('05', 'ค่าเวชภัณฑ์ที่มิใช่ยา', '05');
INSERT INTO `dhdc_income` VALUES ('06', 'ค่าบริการโลหิตและส่วนประกอบของโลหิต', '06');
INSERT INTO `dhdc_income` VALUES ('07', 'ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา', '07');
INSERT INTO `dhdc_income` VALUES ('08', 'ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา', '08');
INSERT INTO `dhdc_income` VALUES ('09', 'ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ', '09');
INSERT INTO `dhdc_income` VALUES ('10', 'ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์', '10');
INSERT INTO `dhdc_income` VALUES ('11', 'ค่าทำหัตถการ และวิสัญญี', '11');
INSERT INTO `dhdc_income` VALUES ('12', 'ค่าบริการทางพยาบาล', '12');
INSERT INTO `dhdc_income` VALUES ('13', 'ค่าบริการทางทันตกรรม', '13');
INSERT INTO `dhdc_income` VALUES ('14', 'ค่าบริการทางกายภาพบำบัดและทางเวชกรรมฟื้นฟู', '14');
INSERT INTO `dhdc_income` VALUES ('15', 'ค่าบริการฝังเข็ม และค่าบริการการให้การบำบัดของผู้ประกอบโรคศิลปะอื่น', '15');
INSERT INTO `dhdc_income` VALUES ('16', 'ค่าบริการอื่น ๆ ที่ไม่เกี่ยวกับการรักษาพยาบาลโดยตรง', '16');
INSERT INTO `dhdc_income` VALUES ('17', 'ค่ายานอกบัญชียาหลักแห่งชาติ', '17');
INSERT INTO `dhdc_income` VALUES ('18', 'ค่าธรรมเนียม 30 บาท ประสงค์จ่ายเงิน', '16');
INSERT INTO `dhdc_income` VALUES ('19', 'ค่าใบรับรองแพทย์', '12');
INSERT INTO `dhdc_income` VALUES ('00', 'ค่าบริการที่ไม่ได้จัดหมวด', '00');

-- ----------------------------
-- Table structure for sys_transform_plus
-- ----------------------------
DELETE FROM `sys_transform_plus` WHERE t_name = "dhdc_module_unitcost";
INSERT INTO `sys_transform_plus` (`t_name`, `t_sql`, `active`, `bycase`, `version`) 
VALUES ('dhdc_module_unitcost', 'CALL start_process;\r\nUPDATE sys_check_process t SET t.fnc_name = \'run_dhdc_module_unitcost\',t.time = NOW();\r\n\r\nSET	@b_year := (SELECT yearprocess FROM pk_byear LIMIT 1);\r\n\r\nCALL dhdc_module_unitcost_cal(\'2018\');\r\nCALL dhdc_module_unitcost_cal(\'2017\');\r\nCALL dhdc_module_unitcost_cal(\'2016\');\r\n\r\nCALL dhdc_module_unitcost_inst(\'2018\');\r\nCALL dhdc_module_unitcost_inst(\'2017\');\r\nCALL dhdc_module_unitcost_inst(\'2016\');\r\n\r\nCALL dhdc_module_unitcost_occ(\'2018\');\r\nCALL dhdc_module_unitcost_occ(\'2017\');\r\nCALL dhdc_module_unitcost_occ(\'2016\');\r\n\r\nCALL dhdc_module_unitcost_nation(\'2018\');\r\nCALL dhdc_module_unitcost_nation(\'2017\');\r\nCALL dhdc_module_unitcost_nation(\'2016\');\r\n\r\nCALL end_process;\r\n', '1', 'pond', '20171114');


-- ----------------------------
-- Procedure structure for dhdc_module_unitcost
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_unitcost`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_unitcost`()
BEGIN 

CALL start_process;
UPDATE sys_check_process t SET t.fnc_name = 'run_dhdc_module_unitcost',t.time = NOW();

SET	@b_year := (SELECT yearprocess FROM pk_byear LIMIT 1);

CALL dhdc_module_unitcost_cal('2018');
CALL dhdc_module_unitcost_cal('2017');
CALL dhdc_module_unitcost_cal('2016');

CALL dhdc_module_unitcost_inst('2018');
CALL dhdc_module_unitcost_inst('2017');
CALL dhdc_module_unitcost_inst('2016');

CALL dhdc_module_unitcost_occ('2018');
CALL dhdc_module_unitcost_occ('2017');
CALL dhdc_module_unitcost_occ('2016');

CALL dhdc_module_unitcost_nation('2018');
CALL dhdc_module_unitcost_nation('2017');
CALL dhdc_module_unitcost_nation('2016');

CALL end_process;

 END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for dhdc_module_unitcost_cal
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_unitcost_cal`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_unitcost_cal`(IN `yy` varchar(4))
BEGIN

SET @b_year = yy;
SET	@start_d := concat(@b_year-1,'1001');
SET @end_d := concat(@b_year,'0930');

#DROP TABLE IF NOT EXISTS dhdc_module_unitcost;
CREATE TABLE IF NOT EXISTS dhdc_module_unitcost (
  HOSPCODE varchar(5) NOT NULL ,
	INCOME char(2) NOT NULL ,
  INCOME_NAME varchar(255) NOT NULL ,
  COST DOUBLE(20,2) NOT NULL ,
  PRICE DOUBLE(20,2) NOT NULL  ,
  TOTAL DOUBLE(20,2) NOT NULL  ,
	PAYPRICE DOUBLE(20,2) NOT NULL  ,
	TYPE VARCHAR(10) NOT NULL,
	BYEAR VARCHAR(4) NOT NULL,
  PRIMARY KEY (HOSPCODE,INCOME,TYPE,BYEAR),
	KEY (HOSPCODE,INCOME,TYPE,BYEAR),
  KEY (HOSPCODE),
  KEY  (INCOME)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM dhdc_module_unitcost WHERE BYEAR = @b_year;

INSERT IGNORE INTO dhdc_module_unitcost (

SELECT t.* FROM(

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.CHARGEITEM,i.`name` as INCOME_NAME,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'OPD' as Type,@b_year as BYEAR
FROM(
SELECT HOSPCODE,PID,DATE_SERV,CHARGEITEM,QUANTITY,COST,(QUANTITY*COST) as t_COST,(QUANTITY*PRICE) as PRICE
,((QUANTITY*PRICE)-(QUANTITY*COST))as TOTAL,PAYPRICE 
FROM charge_opd 

WHERE DATE_SERV BETWEEN @start_d AND @end_d

)tb1 

LEFT JOIN dhdc_income i ON tb1.CHARGEITEM = i.income_group
WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.CHARGEITEM
)t1

UNION ALL

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.CHARGEITEM,i.`name` as INCOME_NAME,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'IPD' as Type,@b_year as BYEAR
FROM(
SELECT HOSPCODE,PID,DATETIME_ADMIT as DATE_SERV,CHARGEITEM,QUANTITY,COST,(QUANTITY*COST) as t_COST,(QUANTITY*PRICE) as PRICE
,((QUANTITY*PRICE)-(QUANTITY*COST))as TOTAL,PAYPRICE 
FROM charge_ipd 

WHERE DATETIME_ADMIT BETWEEN @start_d AND @end_d

)tb1 

LEFT JOIN dhdc_income i ON tb1.CHARGEITEM = i.income_group
WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.CHARGEITEM
)t1

) t
);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for dhdc_module_unitcost_inst
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_unitcost_inst`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_unitcost_inst`(IN `yy` varchar(4))
BEGIN
SET @b_year = yy;
SET	@start_d := concat(@b_year-1,'1001');
SET @end_d := concat(@b_year,'0930');

#DROP TABLE IF EXISTS dhdc_module_unitcost_ins;
CREATE TABLE IF NOT EXISTS dhdc_module_unitcost_ins (
  HOSPCODE varchar(5) NOT NULL ,
	INS_CODE varchar(5) NOT NULL ,
	INS_NAME varchar(200) NOT NULL ,
  COST DOUBLE(20,2) NOT NULL ,
  PRICE DOUBLE(20,2) NOT NULL  ,
  TOTAL DOUBLE(20,2) NOT NULL  ,
	PAYPRICE DOUBLE(20,2) NOT NULL  ,
	TYPE VARCHAR(10) NOT NULL,
	BYEAR VARCHAR(4) NOT NULL, 
  PRIMARY KEY (HOSPCODE,INS_CODE,TYPE,BYEAR),
	KEY (HOSPCODE,INS_CODE,TYPE,BYEAR)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM dhdc_module_unitcost_ins WHERE BYEAR = @b_year;

INSERT IGNORE INTO dhdc_module_unitcost_ins (
SELECT t.* FROM(

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.instypegroup,ins2.instypegroupname,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'OPD' as Type,@b_year as BYEAR
FROM(
SELECT HOSPCODE,PID,DATE_SERV,INSTYPE,ins1.instypegroup,CHARGEITEM,QUANTITY,COST,(QUANTITY*COST) as t_COST,(QUANTITY*PRICE) as PRICE
,((QUANTITY*PRICE)-(QUANTITY*COST))as TOTAL,PAYPRICE 
FROM charge_opd c
LEFT JOIN cinstype_new ins1 on ins1.instypecode = c.INSTYPE
INNER JOIN cinstypegroup ins2 on ins2.instypegroupcode = ins1.instypegroup

WHERE DATE_SERV BETWEEN @start_d AND @end_d

)tb1 

LEFT JOIN dhdc_income i ON tb1.CHARGEITEM = i.income_group
INNER JOIN cinstypegroup ins2 on ins2.instypegroupcode = tb1.instypegroup 

WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.instypegroup
)t1

UNION ALL

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.instypegroup,ins2.instypegroupname,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'IPD' as Type,@b_year as BYEAR
FROM(
SELECT HOSPCODE,PID,DATETIME_ADMIT as DATE_SERV,INSTYPE, ins1.instypegroup,CHARGEITEM,QUANTITY,COST,(QUANTITY*COST) as t_COST,(QUANTITY*PRICE) as PRICE
,((QUANTITY*PRICE)-(QUANTITY*COST))as TOTAL,PAYPRICE 
FROM charge_ipd c
LEFT JOIN cinstype_new ins1 on ins1.instypecode = c.INSTYPE

WHERE DATETIME_ADMIT BETWEEN @start_d AND @end_d


)tb1 

LEFT JOIN dhdc_income i ON tb1.CHARGEITEM = i.income_group
INNER JOIN cinstypegroup ins2 on ins2.instypegroupcode = tb1.instypegroup  

WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.instypegroup
)t1

) t
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for dhdc_module_unitcost_nation
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_unitcost_nation`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_unitcost_nation`(IN `yy` varchar(4))
BEGIN

SET @b_year = yy;
SET	@start_d := concat(@b_year-1,'1001');
SET @end_d := concat(@b_year,'0930');


#DROP TABLE IF EXISTS dhdc_module_unitcost_nation;
CREATE TABLE IF NOT EXISTS dhdc_module_unitcost_nation (
  HOSPCODE varchar(5) NOT NULL ,
	NATION varchar(5) NOT NULL ,
	NATION_NAME varchar(200) NOT NULL ,
	NATION_GROUP varchar(5) NOT NULL ,
	NATION_GROUP_NAME varchar(200) NOT NULL ,
  COST DOUBLE(20,2) NOT NULL ,
  PRICE DOUBLE(20,2) NOT NULL  ,
  TOTAL DOUBLE(20,2) NOT NULL  ,
	PAYPRICE DOUBLE(20,2) NOT NULL  ,
	TYPE VARCHAR(10) NOT NULL, 
	BYEAR VARCHAR(4) NOT NULL,
  PRIMARY KEY (HOSPCODE,NATION,TYPE,BYEAR),
	KEY (HOSPCODE,NATION,TYPE,BYEAR)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM dhdc_module_unitcost_nation WHERE BYEAR = @b_year;
INSERT IGNORE INTO dhdc_module_unitcost_nation (

SELECT t.* FROM(

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.NATION,tb1.nationname,tb1.nationcodeaec,tb1.nationname_thai,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'OPD' as Type,@b_year as BYEAR
FROM(
SELECT c.HOSPCODE,c.PID,c.DATE_SERV,p.NATION,nt.nationname,nt.nationcodeaec,aec.nationname_thai,c.CHARGEITEM,c.QUANTITY,c.COST
,(c.QUANTITY*c.COST) as t_COST,(c.QUANTITY*c.PRICE) as PRICE
,((c.QUANTITY*c.PRICE)-(c.QUANTITY*c.COST))as TOTAL,c.PAYPRICE 
FROM charge_opd c
LEFT JOIN t_person_cid p ON p.check_hosp = c.HOSPCODE AND p.PID = c.PID
LEFT JOIN cnation nt ON nt.nationcode = p.NATION
INNER JOIN cnation_aec aec ON aec.nationgroup_aec = nt.nationcodeaec

WHERE c.DATE_SERV BETWEEN @start_d AND @end_d

)tb1 


WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.NATION
)t1

UNION ALL

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.NATION,tb1.nationname,tb1.nationcodeaec,tb1.nationname_thai,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'IPD' as Type,@b_year as BYEAR
FROM(
SELECT c.HOSPCODE,c.PID,c.DATETIME_ADMIT as DATE_SERV,p.NATION,nt.nationname,nt.nationcodeaec,aec.nationname_thai,c.CHARGEITEM,c.QUANTITY,c.COST
,(c.QUANTITY*c.COST) as t_COST,(c.QUANTITY*c.PRICE) as PRICE
,((c.QUANTITY*c.PRICE)-(c.QUANTITY*c.COST))as TOTAL,c.PAYPRICE 
FROM charge_ipd c
LEFT JOIN t_person_cid p ON p.check_hosp = c.HOSPCODE AND p.PID = c.PID
LEFT JOIN cnation nt ON nt.nationcode = p.NATION
INNER JOIN cnation_aec aec ON aec.nationgroup_aec = nt.nationcodeaec

WHERE c.DATETIME_ADMIT BETWEEN @start_d AND @end_d

)tb1 


WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.NATION
)t1

) t
);

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for dhdc_module_unitcost_occ
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_unitcost_occ`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_unitcost_occ`(IN `yy` varchar(4))
BEGIN
SET @b_year = yy;
SET	@start_d := concat(@b_year-1,'1001');
SET @end_d := concat(@b_year,'0930');


#DROP TABLE IF EXISTS dhdc_module_unitcost_occ;
CREATE TABLE IF NOT EXISTS dhdc_module_unitcost_occ (
  HOSPCODE varchar(5) NOT NULL ,
	OCC_CODE varchar(5) NOT NULL ,
	OCC_NAME varchar(200) NOT NULL ,
  COST DOUBLE(20,2) NOT NULL ,
  PRICE DOUBLE(20,2) NOT NULL  ,
  TOTAL DOUBLE(20,2) NOT NULL  ,
	PAYPRICE DOUBLE(20,2) NOT NULL  ,
	TYPE VARCHAR(10) NOT NULL,
	BYEAR VARCHAR(4) NOT NULL,
  PRIMARY KEY (HOSPCODE,OCC_CODE,TYPE,BYEAR),
	KEY (HOSPCODE,OCC_CODE,TYPE,BYEAR)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM dhdc_module_unitcost_occ WHERE BYEAR = @b_year;
INSERT IGNORE INTO dhdc_module_unitcost_occ (

SELECT t.* FROM(

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.id_occupation_new,tb1.occupation_new,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'OPD' as Type,@b_year as BYEAR
FROM(
SELECT c.HOSPCODE,c.PID,c.DATE_SERV,oc.id_occupation_new,oc.occupation_new,c.CHARGEITEM,c.QUANTITY,c.COST
,(c.QUANTITY*c.COST) as t_COST,(c.QUANTITY*c.PRICE) as PRICE
,((c.QUANTITY*c.PRICE)-(c.QUANTITY*c.COST))as TOTAL,c.PAYPRICE 
FROM charge_opd c
LEFT JOIN t_person_cid p ON p.check_hosp = c.HOSPCODE AND p.PID = c.PID
LEFT JOIN coccupation_new oc ON oc.id_occupation_new = p.OCCUPATION_NEW

WHERE c.DATE_SERV BETWEEN @start_d AND @end_d

)tb1 


WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.id_occupation_new
)t1

UNION ALL

SELECT t1.* FROM (
SELECT tb1.HOSPCODE,tb1.id_occupation_new,tb1.occupation_new,SUM(tb1.t_COST) as COST,SUM(tb1.PRICE) as PRICE
,SUM(tb1.TOTAL) as TOTAL,SUM(tb1.PAYPRICE) as PAYPRICE,'IPD' as Type,@b_year as BYEAR
FROM(
SELECT c.HOSPCODE,c.PID,c.DATETIME_ADMIT as DATE_SERV,oc.id_occupation_new,oc.occupation_new,c.CHARGEITEM,c.QUANTITY,c.COST
,(c.QUANTITY*c.COST) as t_COST,(c.QUANTITY*c.PRICE) as PRICE
,((c.QUANTITY*c.PRICE)-(c.QUANTITY*c.COST))as TOTAL,c.PAYPRICE 
FROM charge_ipd c
LEFT JOIN t_person_cid p ON p.check_hosp = c.HOSPCODE AND p.PID = c.PID
LEFT JOIN coccupation_new oc ON oc.id_occupation_new = p.OCCUPATION_NEW

WHERE c.DATETIME_ADMIT BETWEEN @start_d AND @end_d

)tb1 


WHERE 1=1
GROUP BY tb1.HOSPCODE,tb1.id_occupation_new
)t1

) t
);
END
;;
DELIMITER ;
