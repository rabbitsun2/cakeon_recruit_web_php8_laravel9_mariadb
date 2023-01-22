-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.4.25-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 테이블 dev_db.cake_board_dd 구조 내보내기
CREATE TABLE IF NOT EXISTS `cake_board_dd` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_subject` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_is_notice` int(11) DEFAULT NULL COMMENT '// 공지글',
  `b_author` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_member_id` int(11) DEFAULT NULL,
  `b_passwd` int(11) DEFAULT NULL COMMENT '// 비밀번호',
  `b_file_exist` int(11) DEFAULT NULL COMMENT '// 파일 존재 유무',
  `b_comment_cnt` int(11) DEFAULT NULL COMMENT '// 댓글 갯수',
  `b_cnt` int(11) DEFAULT NULL,
  `b_ip` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '// IP 주소',
  `b_regidate` datetime DEFAULT NULL,
  PRIMARY KEY (`b_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
