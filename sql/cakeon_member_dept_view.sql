SELECT d.career_id, a.member_id, 
	b.dept_id, c.dept_name, 
	a.email, a.member_name, 
	a.passwd, a.nickname, 
   a.birthdate, a.member_name, 	
	a.phone_number, a.auth_id, 
	a.lock_code, a.failed_cnt, 
	a.regidate, a.last_accessed_by,
	a.member_ip 
	FROM cakeon_member a 
	INNER JOIN cakeon_dept_member b 
		ON a.member_id = b.member_id
	INNER JOIN cakeon_dept c
		ON b.dept_id = c.dept_id
	INNER JOIN cakeon_career_list d 
		ON d.member_id = a.member_id;