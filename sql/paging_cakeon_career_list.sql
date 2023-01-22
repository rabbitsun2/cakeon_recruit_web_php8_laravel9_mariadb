select a.career_id, a.country_id, 
b.country_name, a.region_id, 
c.region_name, a.position_id,
d.position_name, a.job_type_id,
e.job_type_name, a.relation_id, 
f.relation_name, a.corp_id,
g.corp_code, g.corp_name, 
a.member_id,
h.email, h.nickname, 
a.subject, a.content, 
a.salary, a.max_cnt, 
a.ext_position, 
a.open_start_date, a.open_end_date, 
a.army_start_hour, a.army_start_min, 
a.army_end_hour, a.army_end_min, 
a.regidate 
 from cakeon_career_list a 
 INNER JOIN cakeon_career_country b 
 	ON a.career_id = b.country_id
 INNER JOIN cakeon_career_region c 
   ON a.region_id = c.region_id 
 INNER JOIN cakeon_career_position d 
   ON a.position_id = d.position_id 
 INNER JOIN cakeon_job_type e 
 	ON a.job_type_id = e.job_type_id
 INNER JOIN cakeon_career_relation f 
   ON a.relation_id = f.relation_id
 INNER JOIN cakeon_career_corporation g 
   ON a.corp_id = g.corp_id 
 INNER JOIN cakeon_member h
 	ON a.member_id = h.member_id 
 ORDER BY a.career_id DESC
 LIMIT 10 OFFSET 0;