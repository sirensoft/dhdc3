/*
Navicat MySQL Data Transfer

Source Server         : 06-61.19.22.158-พรหมพิราม
Source Server Version : 50505
Source Host           : 61.19.22.158:3306
Source Database       : dhdc_fnc

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-11 12:58:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Procedure structure for dhdc_module_pop_cal_age
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_pop_cal_age`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_pop_cal_age`()
BEGIN

 DROP TABLE IF EXISTS `dhdc_population_age_group`;

 CREATE TABLE `dhdc_population_age_group` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `AGE_GROUP_ID` int(11) NOT NULL,
  `AGE_GROUP` varchar(255) DEFAULT '',
  `MALE` decimal(23,0) DEFAULT NULL,
  `FEMALE` decimal(23,0) DEFAULT NULL,
  `TOTAL` decimal(23,0) DEFAULT NULL,
  PRIMARY KEY (`HOSPCODE`,`AGE_GROUP_ID`)
) DEFAULT CHARSET=utf8;

 TRUNCATE dhdc_population_age_group;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,0 AGE_GROUP_ID
,'0-1' AGE_GROUP
,SUM(if(t.age_y>=0 AND t.age_y <1 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=0 AND t.age_y <1 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=0 AND t.age_y <1,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,1 AGE_GROUP_ID
,'1-2' AGE_GROUP
,SUM(if(t.age_y>=1 AND t.age_y <2 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=1 AND t.age_y <2 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=1 AND t.age_y <2,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,2 AGE_GROUP_ID
,'2-3' AGE_GROUP
,SUM(if(t.age_y>=2 AND t.age_y <3 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=2 AND t.age_y <3 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=2 AND t.age_y <3,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,3 AGE_GROUP_ID
,'3-4' AGE_GROUP
,SUM(if(t.age_y>=3 AND t.age_y <4 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=3 AND t.age_y <4 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=3 AND t.age_y <4,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,4 AGE_GROUP_ID
,'4-5' AGE_GROUP
,SUM(if(t.age_y>=4 AND t.age_y <5 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=4 AND t.age_y <5 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=4 AND t.age_y <5,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,5 AGE_GROUP_ID
,'5-6' AGE_GROUP
,SUM(if(t.age_y>=5 AND t.age_y <6 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=5 AND t.age_y <6 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=5 AND t.age_y <6,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,6 AGE_GROUP_ID
,'6-7' AGE_GROUP
,SUM(if(t.age_y>=6 AND t.age_y <7 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=6 AND t.age_y <7 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=6 AND t.age_y <7,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,7 AGE_GROUP_ID
,'7-8' AGE_GROUP
,SUM(if(t.age_y>=7 AND t.age_y <8 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=7 AND t.age_y <8 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=7 AND t.age_y <8,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,8 AGE_GROUP_ID
,'8-9' AGE_GROUP
,SUM(if(t.age_y>=8 AND t.age_y <9 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=8 AND t.age_y <9 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=8 AND t.age_y <9,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,9 AGE_GROUP_ID
,'9-10' AGE_GROUP
,SUM(if(t.age_y>=9 AND t.age_y <10 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=9 AND t.age_y <10 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=9 AND t.age_y <10,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,10 AGE_GROUP_ID
,'10-11' AGE_GROUP
,SUM(if(t.age_y>=10 AND t.age_y <11 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=10 AND t.age_y <11 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=10 AND t.age_y <11,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,11 AGE_GROUP_ID
,'11-12' AGE_GROUP
,SUM(if(t.age_y>=11 AND t.age_y <12 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=11 AND t.age_y <12 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=11 AND t.age_y <12,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,12 AGE_GROUP_ID
,'12-13' AGE_GROUP
,SUM(if(t.age_y>=12 AND t.age_y <13 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=12 AND t.age_y <13 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=12 AND t.age_y <13,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,13 AGE_GROUP_ID
,'13-14' AGE_GROUP
,SUM(if(t.age_y>=13 AND t.age_y <14 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=13 AND t.age_y <14 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=13 AND t.age_y <14,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,14 AGE_GROUP_ID
,'14-15' AGE_GROUP
,SUM(if(t.age_y>=14 AND t.age_y <15 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=14 AND t.age_y <15 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=14 AND t.age_y <15,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,15 AGE_GROUP_ID
,'15-16' AGE_GROUP
,SUM(if(t.age_y>=15 AND t.age_y <16 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=15 AND t.age_y <16 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=15 AND t.age_y <16,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,16 AGE_GROUP_ID
,'16-17' AGE_GROUP
,SUM(if(t.age_y>=16 AND t.age_y <17 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=16 AND t.age_y <17 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=16 AND t.age_y <17,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,17 AGE_GROUP_ID
,'17-18' AGE_GROUP
,SUM(if(t.age_y>=17 AND t.age_y <18 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=17 AND t.age_y <18 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=17 AND t.age_y <18,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,18 AGE_GROUP_ID
,'18-19' AGE_GROUP
,SUM(if(t.age_y>=18 AND t.age_y <19 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=18 AND t.age_y <19 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=18 AND t.age_y <19,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,19 AGE_GROUP_ID
,'19-20' AGE_GROUP
,SUM(if(t.age_y>=19 AND t.age_y <20 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=19 AND t.age_y <20 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=19 AND t.age_y <20,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,20 AGE_GROUP_ID
,'20-21' AGE_GROUP
,SUM(if(t.age_y>=20 AND t.age_y <21 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=20 AND t.age_y <21 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=20 AND t.age_y <21,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,21 AGE_GROUP_ID
,'21-22' AGE_GROUP
,SUM(if(t.age_y>=21 AND t.age_y <22 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=21 AND t.age_y <22 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=21 AND t.age_y <22,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,22 AGE_GROUP_ID
,'22-23' AGE_GROUP
,SUM(if(t.age_y>=22 AND t.age_y <23 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=22 AND t.age_y <23 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=22 AND t.age_y <23,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,23 AGE_GROUP_ID
,'23-24' AGE_GROUP
,SUM(if(t.age_y>=23 AND t.age_y <24 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=23 AND t.age_y <24 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=23 AND t.age_y <24,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,24 AGE_GROUP_ID
,'24-25' AGE_GROUP
,SUM(if(t.age_y>=24 AND t.age_y <25 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=24 AND t.age_y <25 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=24 AND t.age_y <25,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,25 AGE_GROUP_ID
,'25-26' AGE_GROUP
,SUM(if(t.age_y>=25 AND t.age_y <26 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=25 AND t.age_y <26 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=25 AND t.age_y <26,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,26 AGE_GROUP_ID
,'26-27' AGE_GROUP
,SUM(if(t.age_y>=26 AND t.age_y <27 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=26 AND t.age_y <27 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=26 AND t.age_y <27,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,27 AGE_GROUP_ID
,'27-28' AGE_GROUP
,SUM(if(t.age_y>=27 AND t.age_y <28 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=27 AND t.age_y <28 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=27 AND t.age_y <28,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,28 AGE_GROUP_ID
,'28-29' AGE_GROUP
,SUM(if(t.age_y>=28 AND t.age_y <29 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=28 AND t.age_y <29 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=28 AND t.age_y <29,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,29 AGE_GROUP_ID
,'29-30' AGE_GROUP
,SUM(if(t.age_y>=29 AND t.age_y <30 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=29 AND t.age_y <30 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=29 AND t.age_y <30,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,30 AGE_GROUP_ID
,'30-31' AGE_GROUP
,SUM(if(t.age_y>=30 AND t.age_y <31 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=30 AND t.age_y <31 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=30 AND t.age_y <31,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,31 AGE_GROUP_ID
,'31-32' AGE_GROUP
,SUM(if(t.age_y>=31 AND t.age_y <32 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=31 AND t.age_y <32 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=31 AND t.age_y <32,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,32 AGE_GROUP_ID
,'32-33' AGE_GROUP
,SUM(if(t.age_y>=32 AND t.age_y <33 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=32 AND t.age_y <33 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=32 AND t.age_y <33,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,33 AGE_GROUP_ID
,'33-34' AGE_GROUP
,SUM(if(t.age_y>=33 AND t.age_y <34 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=33 AND t.age_y <34 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=33 AND t.age_y <34,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,34 AGE_GROUP_ID
,'34-35' AGE_GROUP
,SUM(if(t.age_y>=34 AND t.age_y <35 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=34 AND t.age_y <35 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=34 AND t.age_y <35,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,35 AGE_GROUP_ID
,'35-36' AGE_GROUP
,SUM(if(t.age_y>=35 AND t.age_y <36 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=35 AND t.age_y <36 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=35 AND t.age_y <36,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,36 AGE_GROUP_ID
,'36-37' AGE_GROUP
,SUM(if(t.age_y>=36 AND t.age_y <37 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=36 AND t.age_y <37 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=36 AND t.age_y <37,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,37 AGE_GROUP_ID
,'37-38' AGE_GROUP
,SUM(if(t.age_y>=37 AND t.age_y <38 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=37 AND t.age_y <38 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=37 AND t.age_y <38,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,38 AGE_GROUP_ID
,'38-39' AGE_GROUP
,SUM(if(t.age_y>=38 AND t.age_y <39 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=38 AND t.age_y <39 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=38 AND t.age_y <39,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,39 AGE_GROUP_ID
,'39-40' AGE_GROUP
,SUM(if(t.age_y>=39 AND t.age_y <40 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=39 AND t.age_y <40 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=39 AND t.age_y <40,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,40 AGE_GROUP_ID
,'40-41' AGE_GROUP
,SUM(if(t.age_y>=40 AND t.age_y <41 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=40 AND t.age_y <41 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=40 AND t.age_y <41,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,41 AGE_GROUP_ID
,'41-42' AGE_GROUP
,SUM(if(t.age_y>=41 AND t.age_y <42 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=41 AND t.age_y <42 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=41 AND t.age_y <42,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,42 AGE_GROUP_ID
,'42-43' AGE_GROUP
,SUM(if(t.age_y>=42 AND t.age_y <43 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=42 AND t.age_y <43 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=42 AND t.age_y <43,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,43 AGE_GROUP_ID
,'43-44' AGE_GROUP
,SUM(if(t.age_y>=43 AND t.age_y <44 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=43 AND t.age_y <44 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=43 AND t.age_y <44,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,44 AGE_GROUP_ID
,'44-45' AGE_GROUP
,SUM(if(t.age_y>=44 AND t.age_y <45 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=44 AND t.age_y <45 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=44 AND t.age_y <45,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,45 AGE_GROUP_ID
,'45-46' AGE_GROUP
,SUM(if(t.age_y>=45 AND t.age_y <46 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=45 AND t.age_y <46 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=45 AND t.age_y <46,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,46 AGE_GROUP_ID
,'46-47' AGE_GROUP
,SUM(if(t.age_y>=46 AND t.age_y <47 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=46 AND t.age_y <47 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=46 AND t.age_y <47,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,47 AGE_GROUP_ID
,'47-48' AGE_GROUP
,SUM(if(t.age_y>=47 AND t.age_y <48 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=47 AND t.age_y <48 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=47 AND t.age_y <48,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,48 AGE_GROUP_ID
,'48-49' AGE_GROUP
,SUM(if(t.age_y>=48 AND t.age_y <49 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=48 AND t.age_y <49 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=48 AND t.age_y <49,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,49 AGE_GROUP_ID
,'49-50' AGE_GROUP
,SUM(if(t.age_y>=49 AND t.age_y <50 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=49 AND t.age_y <50 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=49 AND t.age_y <50,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,50 AGE_GROUP_ID
,'50-51' AGE_GROUP
,SUM(if(t.age_y>=50 AND t.age_y <51 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=50 AND t.age_y <51 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=50 AND t.age_y <51,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,51 AGE_GROUP_ID
,'51-52' AGE_GROUP
,SUM(if(t.age_y>=51 AND t.age_y <52 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=51 AND t.age_y <52 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=51 AND t.age_y <52,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,52 AGE_GROUP_ID
,'52-53' AGE_GROUP
,SUM(if(t.age_y>=52 AND t.age_y <53 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=52 AND t.age_y <53 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=52 AND t.age_y <53,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,53 AGE_GROUP_ID
,'53-54' AGE_GROUP
,SUM(if(t.age_y>=53 AND t.age_y <54 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=53 AND t.age_y <54 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=53 AND t.age_y <54,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,54 AGE_GROUP_ID
,'54-55' AGE_GROUP
,SUM(if(t.age_y>=54 AND t.age_y <55 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=54 AND t.age_y <55 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=54 AND t.age_y <55,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,55 AGE_GROUP_ID
,'55-56' AGE_GROUP
,SUM(if(t.age_y>=55 AND t.age_y <56 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=55 AND t.age_y <56 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=55 AND t.age_y <56,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,56 AGE_GROUP_ID
,'56-57' AGE_GROUP
,SUM(if(t.age_y>=56 AND t.age_y <57 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=56 AND t.age_y <57 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=56 AND t.age_y <57,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,57 AGE_GROUP_ID
,'57-58' AGE_GROUP
,SUM(if(t.age_y>=57 AND t.age_y <58 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=57 AND t.age_y <58 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=57 AND t.age_y <58,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,58 AGE_GROUP_ID
,'58-59' AGE_GROUP
,SUM(if(t.age_y>=58 AND t.age_y <59 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=58 AND t.age_y <59 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=58 AND t.age_y <59,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,59 AGE_GROUP_ID
,'59-60' AGE_GROUP
,SUM(if(t.age_y>=59 AND t.age_y <60 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=59 AND t.age_y <60 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=59 AND t.age_y <60,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,60 AGE_GROUP_ID
,'60-61' AGE_GROUP
,SUM(if(t.age_y>=60 AND t.age_y <61 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=60 AND t.age_y <61 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=60 AND t.age_y <61,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,61 AGE_GROUP_ID
,'61-62' AGE_GROUP
,SUM(if(t.age_y>=61 AND t.age_y <62 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=61 AND t.age_y <62 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=61 AND t.age_y <62,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,62 AGE_GROUP_ID
,'62-63' AGE_GROUP
,SUM(if(t.age_y>=62 AND t.age_y <63 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=62 AND t.age_y <63 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=62 AND t.age_y <63,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,63 AGE_GROUP_ID
,'63-64' AGE_GROUP
,SUM(if(t.age_y>=63 AND t.age_y <64 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=63 AND t.age_y <64 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=63 AND t.age_y <64,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,64 AGE_GROUP_ID
,'64-65' AGE_GROUP
,SUM(if(t.age_y>=64 AND t.age_y <65 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=64 AND t.age_y <65 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=64 AND t.age_y <65,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,65 AGE_GROUP_ID
,'65-66' AGE_GROUP
,SUM(if(t.age_y>=65 AND t.age_y <66 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=65 AND t.age_y <66 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=65 AND t.age_y <66,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,66 AGE_GROUP_ID
,'66-67' AGE_GROUP
,SUM(if(t.age_y>=66 AND t.age_y <67 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=66 AND t.age_y <67 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=66 AND t.age_y <67,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,67 AGE_GROUP_ID
,'67-68' AGE_GROUP
,SUM(if(t.age_y>=67 AND t.age_y <68 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=67 AND t.age_y <68 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=67 AND t.age_y <68,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,68 AGE_GROUP_ID
,'68-69' AGE_GROUP
,SUM(if(t.age_y>=68 AND t.age_y <69 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=68 AND t.age_y <69 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=68 AND t.age_y <69,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,69 AGE_GROUP_ID
,'69-70' AGE_GROUP
,SUM(if(t.age_y>=69 AND t.age_y <70 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=69 AND t.age_y <70 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=69 AND t.age_y <70,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,70 AGE_GROUP_ID
,'70-71' AGE_GROUP
,SUM(if(t.age_y>=70 AND t.age_y <71 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=70 AND t.age_y <71 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=70 AND t.age_y <71,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,71 AGE_GROUP_ID
,'71-72' AGE_GROUP
,SUM(if(t.age_y>=71 AND t.age_y <72 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=71 AND t.age_y <72 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=71 AND t.age_y <72,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,72 AGE_GROUP_ID
,'72-73' AGE_GROUP
,SUM(if(t.age_y>=72 AND t.age_y <73 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=72 AND t.age_y <73 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=72 AND t.age_y <73,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,73 AGE_GROUP_ID
,'73-74' AGE_GROUP
,SUM(if(t.age_y>=73 AND t.age_y <74 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=73 AND t.age_y <74 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=73 AND t.age_y <74,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,74 AGE_GROUP_ID
,'74-75' AGE_GROUP
,SUM(if(t.age_y>=74 AND t.age_y <75 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=74 AND t.age_y <75 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=74 AND t.age_y <75,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,75 AGE_GROUP_ID
,'75-76' AGE_GROUP
,SUM(if(t.age_y>=75 AND t.age_y <76 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=75 AND t.age_y <76 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=75 AND t.age_y <76,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,76 AGE_GROUP_ID
,'76-77' AGE_GROUP
,SUM(if(t.age_y>=76 AND t.age_y <77 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=76 AND t.age_y <77 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=76 AND t.age_y <77,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,77 AGE_GROUP_ID
,'77-78' AGE_GROUP
,SUM(if(t.age_y>=77 AND t.age_y <78 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=77 AND t.age_y <78 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=77 AND t.age_y <78,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,78 AGE_GROUP_ID
,'78-79' AGE_GROUP
,SUM(if(t.age_y>=78 AND t.age_y <79 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=78 AND t.age_y <79 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=78 AND t.age_y <79,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,79 AGE_GROUP_ID
,'79-80' AGE_GROUP
,SUM(if(t.age_y>=79 AND t.age_y <80 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=79 AND t.age_y <80 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=79 AND t.age_y <80,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,80 AGE_GROUP_ID
,'80-81' AGE_GROUP
,SUM(if(t.age_y>=80 AND t.age_y <81 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=80 AND t.age_y <81 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=80 AND t.age_y <81,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,81 AGE_GROUP_ID
,'81-82' AGE_GROUP
,SUM(if(t.age_y>=81 AND t.age_y <82 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=81 AND t.age_y <82 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=81 AND t.age_y <82,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,82 AGE_GROUP_ID
,'82-83' AGE_GROUP
,SUM(if(t.age_y>=82 AND t.age_y <83 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=82 AND t.age_y <83 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=82 AND t.age_y <83,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,83 AGE_GROUP_ID
,'83-84' AGE_GROUP
,SUM(if(t.age_y>=83 AND t.age_y <84 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=83 AND t.age_y <84 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=83 AND t.age_y <84,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,84 AGE_GROUP_ID
,'84-85' AGE_GROUP
,SUM(if(t.age_y>=84 AND t.age_y <85 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=84 AND t.age_y <85 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=84 AND t.age_y <85,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,85 AGE_GROUP_ID
,'85-86' AGE_GROUP
,SUM(if(t.age_y>=85 AND t.age_y <86 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=85 AND t.age_y <86 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=85 AND t.age_y <86,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,86 AGE_GROUP_ID
,'86-87' AGE_GROUP
,SUM(if(t.age_y>=86 AND t.age_y <87 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=86 AND t.age_y <87 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=86 AND t.age_y <87,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,87 AGE_GROUP_ID
,'87-88' AGE_GROUP
,SUM(if(t.age_y>=87 AND t.age_y <88 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=87 AND t.age_y <88 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=87 AND t.age_y <88,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,88 AGE_GROUP_ID
,'88-89' AGE_GROUP
,SUM(if(t.age_y>=88 AND t.age_y <89 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=88 AND t.age_y <89 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=88 AND t.age_y <89,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,89 AGE_GROUP_ID
,'89-90' AGE_GROUP
,SUM(if(t.age_y>=89 AND t.age_y <90 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=89 AND t.age_y <90 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=89 AND t.age_y <90,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,90 AGE_GROUP_ID
,'90-91' AGE_GROUP
,SUM(if(t.age_y>=90 AND t.age_y <91 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=90 AND t.age_y <91 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=90 AND t.age_y <91,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,91 AGE_GROUP_ID
,'91-92' AGE_GROUP
,SUM(if(t.age_y>=91 AND t.age_y <92 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=91 AND t.age_y <92 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=91 AND t.age_y <92,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,92 AGE_GROUP_ID
,'92-93' AGE_GROUP
,SUM(if(t.age_y>=92 AND t.age_y <93 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=92 AND t.age_y <93 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=92 AND t.age_y <93,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,93 AGE_GROUP_ID
,'93-94' AGE_GROUP
,SUM(if(t.age_y>=93 AND t.age_y <94 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=93 AND t.age_y <94 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=93 AND t.age_y <94,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,94 AGE_GROUP_ID
,'94-95' AGE_GROUP
,SUM(if(t.age_y>=94 AND t.age_y <95 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=94 AND t.age_y <95 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=94 AND t.age_y <95,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,95 AGE_GROUP_ID
,'95-96' AGE_GROUP
,SUM(if(t.age_y>=95 AND t.age_y <96 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=95 AND t.age_y <96 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=95 AND t.age_y <96,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,96 AGE_GROUP_ID
,'96-97' AGE_GROUP
,SUM(if(t.age_y>=96 AND t.age_y <97 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=96 AND t.age_y <97 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=96 AND t.age_y <97,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,97 AGE_GROUP_ID
,'97-98' AGE_GROUP
,SUM(if(t.age_y>=97 AND t.age_y <98 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=97 AND t.age_y <98 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=97 AND t.age_y <98,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,98 AGE_GROUP_ID
,'98-99' AGE_GROUP
,SUM(if(t.age_y>=98 AND t.age_y <99 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=98 AND t.age_y <99 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=98 AND t.age_y <99,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,99 AGE_GROUP_ID
,'99-100' AGE_GROUP
,SUM(if(t.age_y>=99 AND t.age_y <100 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=99 AND t.age_y <100 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=99 AND t.age_y <100,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group
SELECT  t.HOSPCODE
,100 AGE_GROUP_ID
,'100up' AGE_GROUP
,SUM(if(t.age_y>=100 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=100 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=100,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for dhdc_module_pop_cal_age5
-- ----------------------------
DROP PROCEDURE IF EXISTS `dhdc_module_pop_cal_age5`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dhdc_module_pop_cal_age5`()
BEGIN

 DROP TABLE IF EXISTS `dhdc_population_age_group5`;

 CREATE TABLE `dhdc_population_age_group5` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `AGE_GROUP_ID` int(11) NOT NULL,
  `AGE_GROUP` varchar(255) DEFAULT '',
  `MALE` decimal(23,0) DEFAULT NULL,
  `FEMALE` decimal(23,0) DEFAULT NULL,
  `TOTAL` decimal(23,0) DEFAULT NULL,
  PRIMARY KEY (`HOSPCODE`,`AGE_GROUP_ID`)
) DEFAULT CHARSET=utf8;

 TRUNCATE dhdc_population_age_group5;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,0 AGE_GROUP_ID
,'0-5' AGE_GROUP
,SUM(if(t.age_y>=0 AND t.age_y <5 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=0 AND t.age_y <5 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=0 AND t.age_y <5,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,5 AGE_GROUP_ID
,'5-10' AGE_GROUP
,SUM(if(t.age_y>=5 AND t.age_y <10 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=5 AND t.age_y <10 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=5 AND t.age_y <10,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,10 AGE_GROUP_ID
,'10-15' AGE_GROUP
,SUM(if(t.age_y>=10 AND t.age_y <15 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=10 AND t.age_y <15 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=10 AND t.age_y <15,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,15 AGE_GROUP_ID
,'15-20' AGE_GROUP
,SUM(if(t.age_y>=15 AND t.age_y <20 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=15 AND t.age_y <20 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=15 AND t.age_y <20,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,20 AGE_GROUP_ID
,'20-25' AGE_GROUP
,SUM(if(t.age_y>=20 AND t.age_y <25 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=20 AND t.age_y <25 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=20 AND t.age_y <25,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,25 AGE_GROUP_ID
,'25-30' AGE_GROUP
,SUM(if(t.age_y>=25 AND t.age_y <30 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=25 AND t.age_y <30 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=25 AND t.age_y <30,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,30 AGE_GROUP_ID
,'30-35' AGE_GROUP
,SUM(if(t.age_y>=30 AND t.age_y <35 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=30 AND t.age_y <35 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=30 AND t.age_y <35,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,35 AGE_GROUP_ID
,'35-40' AGE_GROUP
,SUM(if(t.age_y>=35 AND t.age_y <40 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=35 AND t.age_y <40 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=35 AND t.age_y <40,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,40 AGE_GROUP_ID
,'40-45' AGE_GROUP
,SUM(if(t.age_y>=40 AND t.age_y <45 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=40 AND t.age_y <45 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=40 AND t.age_y <45,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,45 AGE_GROUP_ID
,'45-50' AGE_GROUP
,SUM(if(t.age_y>=45 AND t.age_y <50 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=45 AND t.age_y <50 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=45 AND t.age_y <50,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,50 AGE_GROUP_ID
,'50-55' AGE_GROUP
,SUM(if(t.age_y>=50 AND t.age_y <55 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=50 AND t.age_y <55 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=50 AND t.age_y <55,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,55 AGE_GROUP_ID
,'55-60' AGE_GROUP
,SUM(if(t.age_y>=55 AND t.age_y <60 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=55 AND t.age_y <60 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=55 AND t.age_y <60,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,60 AGE_GROUP_ID
,'60-65' AGE_GROUP
,SUM(if(t.age_y>=60 AND t.age_y <65 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=60 AND t.age_y <65 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=60 AND t.age_y <65,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,65 AGE_GROUP_ID
,'65-70' AGE_GROUP
,SUM(if(t.age_y>=65 AND t.age_y <70 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=65 AND t.age_y <70 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=65 AND t.age_y <70,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,70 AGE_GROUP_ID
,'70-75' AGE_GROUP
,SUM(if(t.age_y>=70 AND t.age_y <75 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=70 AND t.age_y <75 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=70 AND t.age_y <75,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,75 AGE_GROUP_ID
,'75-80' AGE_GROUP
,SUM(if(t.age_y>=75 AND t.age_y <80 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=75 AND t.age_y <80 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=75 AND t.age_y <80,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,80 AGE_GROUP_ID
,'80-85' AGE_GROUP
,SUM(if(t.age_y>=80 AND t.age_y <85 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=80 AND t.age_y <85 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=80 AND t.age_y <85,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,85 AGE_GROUP_ID
,'85-90' AGE_GROUP
,SUM(if(t.age_y>=85 AND t.age_y <90 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=85 AND t.age_y <90 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=85 AND t.age_y <90,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,90 AGE_GROUP_ID
,'90-95' AGE_GROUP
,SUM(if(t.age_y>=90 AND t.age_y <95 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=90 AND t.age_y <95 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=90 AND t.age_y <95,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,95 AGE_GROUP_ID
,'95-100' AGE_GROUP
,SUM(if(t.age_y>=95 AND t.age_y <100 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=95 AND t.age_y <100 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=95 AND t.age_y <100,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

 REPLACE INTO dhdc_population_age_group5
SELECT  t.HOSPCODE
,100 AGE_GROUP_ID
,'100up' AGE_GROUP
,SUM(if(t.age_y>=100 AND t.SEX=1,1,0)) 'MALE'
,SUM(if(t.age_y>=100 AND t.SEX=2,1,0)) 'FEMALE'
,SUM(if(t.age_y>=100,1,0)) 'TOTAL'
FROM t_person_cid t 
WHERE t.DISCHARGE = 9
AND t.TYPEAREA in (1,3,5)
GROUP BY t.HOSPCODE;

END
;;
DELIMITER ;

DELETE FROM `sys_transform_plus` where t_name ='dhdc_module_pop'  ;
INSERT INTO `sys_transform_plus` (`t_name`, `t_sql`, `bycase`, `version`) VALUES ('dhdc_module_pop', 'CALL dhdc_module_pop_cal_age;\r\nCALL dhdc_module_pop_cal_age5;', 'utehn', '20170811');
