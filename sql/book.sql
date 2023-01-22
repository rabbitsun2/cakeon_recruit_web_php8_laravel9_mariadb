CREATE TABLE `book` (
  `num` int(11) NOT NULL PRIMARY KEY,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalpage` int(11) NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `book`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `book` (`num`, `title`, `body`, `totalpage`, `author`) VALUES (NULL, '이화룡과 홍길동', '안녕하십네까', '150', '이화룡');
INSERT INTO `book` (`num`, `title`, `body`, `totalpage`, `author`) VALUES (NULL, '시나소니와 김부장', '눈이 많이오네요', '250', '시라소니');


