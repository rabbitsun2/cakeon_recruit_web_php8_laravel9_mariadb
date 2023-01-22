select COUNT(*) AS `cnt`  
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
 	ON a.member_id = h.member_id;