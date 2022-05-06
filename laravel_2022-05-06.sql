# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.5-10.7.3-MariaDB)
# Database: laravel
# Generation Time: 2022-05-06 09:39:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ad_bbs
# ------------------------------------------------------------

LOCK TABLES `ad_bbs` WRITE;
/*!40000 ALTER TABLE `ad_bbs` DISABLE KEYS */;

INSERT INTO `ad_bbs` (`idad_bb`, `topic`, `content`, `msg_date`, `modify_by`, `modify_time`, `status`)
VALUES
	(1,'系統資料庫更新','<font size=2 color=red>\r\n親愛的各位業務部同仁：<br><br>\r\n為了改善修改試算表儲存速度加快，<br>\r\n和訂版系統有時反應變慢問題，<br>\r\n技術部在09/26(四）上午10:00 - 12:00 <br>\r\n會更新系統資料庫,<br>\r\n該時間內請勿操作系統,<br>\r\n可能在11:00左右完成,<br>\r\n到時可登入查看，<br>\r\n如果沒看到此公告訊息表示已更新完成\r\n<br>\r\n</font>','2019-09-25','test@udn.com','2019-09-25 17:31:38',1);

/*!40000 ALTER TABLE `ad_bbs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ad_menus
# ------------------------------------------------------------

LOCK TABLES `ad_menus` WRITE;
/*!40000 ALTER TABLE `ad_menus` DISABLE KEYS */;

INSERT INTO `ad_menus` (`idad_menu`, `menu_id`, `status`, `rank`, `name`, `url`)
VALUES
	(1,0,1,1,'公告','home'),
	(2,0,1,2,'客戶維護',''),
	(3,0,1,3,'版位維護',''),
	(4,0,1,4,'版位簿',''),
	(5,0,1,5,'業務平台',''),
	(6,0,1,6,'發票作業',''),
	(7,0,1,7,'管理師平台',''),
	(8,2,1,1,'基本資料','customer'),
	(9,3,1,1,'專案設定','package'),
	(10,3,1,2,'大分類設定','page_main'),
	(11,3,1,3,'頻道設定','page_cate'),
	(12,3,1,4,'版位設定','page_item'),
	(13,3,1,5,'版位級別設定','cate_type'),
	(14,4,1,1,'版位簿','ad_book2'),
	(15,4,1,2,'版位簿2','sales_book'),
	(16,4,1,3,'版位價格清單','page_price'),
	(17,4,1,4,'專案清單','ad_package'),
	(18,5,1,1,'建立委刊','ad_proj'),
	(19,5,1,2,'表單查詢','my_trial'),
	(20,5,1,3,'簽核','my_approve'),
	(21,5,1,4,'內控取號','trial_icno'),
	(22,5,1,5,'已刪除委刊','trial_del'),
	(23,5,1,6,'報表','report'),
	(24,6,1,1,'發票列表','ad_receipt'),
	(25,6,1,2,'發票審核','ad_receipt_review'),
	(26,6,1,3,'發票匯入ERP','receipt_checkout'),
	(27,6,1,3,'折讓匯入ERP','allowance_checkout'),
	(28,7,1,1,'上刊管理','ad_server_update'),
	(29,98,1,1,'通知','message'),
	(30,99,1,1,'公告內容','ad_bb'),
	(31,99,1,2,'使用者維護','users'),
	(32,99,1,3,'權限設定','ad_permit'),
	(33,100,1,1,'除錯','debug');

/*!40000 ALTER TABLE `ad_menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ad_roles
# ------------------------------------------------------------

LOCK TABLES `ad_roles` WRITE;
/*!40000 ALTER TABLE `ad_roles` DISABLE KEYS */;

INSERT INTO `ad_roles` (`id`, `role`, `multiple`)
VALUES
	(1,'業務','Y'),
	(2,'業助','Y'),
	(3,'總監','Y'),
	(4,'主管','Y'),
	(5,'企劃','N'),
	(6,'財務','N'),
	(7,'管理師','N'),
	(8,'管理員','N'),
	(9,'BD','N'),
	(10,'財管','N'),
	(11,'財管主管','N'),
	(12,'高級主管','N'),
	(13,'高級管理員','N');

/*!40000 ALTER TABLE `ad_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ad_teams
# ------------------------------------------------------------

LOCK TABLES `ad_teams` WRITE;
/*!40000 ALTER TABLE `ad_teams` DISABLE KEYS */;

INSERT INTO `ad_teams` (`id`, `team`)
VALUES
	(1,'無'),
	(2,'策略中心'),
	(3,'業務一中心'),
	(4,'業務二中心'),
	(5,'業務三中心'),
	(6,'本埠中心'),
	(7,'外埠中心'),
	(8,'新媒業發中心'),
	(9,'數據業務中心');

/*!40000 ALTER TABLE `ad_teams` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `account`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `role`, `team`, `modify_by`, `modify_time`, `sign1`, `sign2`, `team_view`, `utma`, `tel`, `photofile`)
VALUES
	(2,'測試人員1','test@udn.com',NULL,'test@udn.com','$2y$10$cY/jzHxfKSJeaakTym6zHu3YDNskuFx0.YHgnTfQYfsBDkLuTU0xu','JMkCf3anvGLWbpt0a52cIjaLaWL6jHb9uWt0fVQIWRIUCJIEsPhvNJDbglX7','2022-05-03 15:38:40','2022-05-04 15:19:58',1,'13','1','test@udn.com','2022-05-03 15:38:40','N','N','N','','111','未命名-1.png'),
	(3,'test','imhandsame@adup.com.tw',NULL,'imhandsame@adup.com.tw','$2y$10$HxOJhwrDz.orNDih.0MqZeLtlegDaErksA8/4gIpn7CEStvlvC5p2',NULL,'2022-05-04 16:01:10','2022-05-04 16:01:10',1,'','','','2022-05-04 16:01:10','N','N','N','','',NULL),
	(4,'張君如','test1@udn.com',NULL,'test1@udn.com','$2y$10$LOkD7pAsHie6cStUUk8ih.WTWbF.rkaVeq1Rg.a3h72HBGgaKy3Dq',NULL,'2022-05-04 16:31:19','2022-05-04 16:31:19',1,'9','1','imhandsame@adup.com.tw','2022-05-04 16:31:19','N','N','N','','+886988763353',''),
	(5,'君如','test@gmail.com',NULL,'test@gmail.com','$2y$10$84sJCmP3Evpslu7FMWbPmOIHUbp3hGh9izOHpIwAdICVQthD2Vt/i',NULL,'2022-05-04 16:37:36','2022-05-04 16:37:36',1,'','','','2022-05-04 16:37:36','N','N','N','','',NULL),
	(6,'張君如','test5@udn.com',NULL,'test5@udn.com','$2y$10$EAE63h2JexhU/I19ykUgs.pYmqqZHjzX1SMIAmr23zD81apRAUoFG',NULL,'2022-05-05 09:52:00','2022-05-05 09:52:00',1,'5','2','test@udn.com','2022-05-05 09:52:00','N','N','N','','+886988763353','');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
