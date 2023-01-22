/*
	Created Date: 2023-01-13
	Author: Doyoon Jung
	File: secure_mysql_query.sql
	Description: 
	
*/

/* 단순화 */
SELECT HEX(AES_ENCRYPT(cakeon_apply_basic_info.email, 'cakeon')) AS 'cakeon' FROM cakeon_apply_basic_info;

/* 복호화 */
SELECT AES_DECRYPT(UNHEX(cakeon_apply_basic_info.email), 'cakeon') AS 'cakeon' FROM cakeon_apply_basic_info;