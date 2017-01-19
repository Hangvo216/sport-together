insert into games (int_home_team,int_guest_team,int_team_win,int_team_lose,result,
int_field_id,date_played,time_played,game_type,message,home_team_rating,guest_team_rating,cancelled_by_int_team,created_at)
 values (1,2,1,2,'2 - 1',1,Date('2016-06-21'), Time('12:00:00'), '5 vs 5','team 1 win ',1,2,Date('2016-06-21'),CURRENT_TIMESTAMP),
 
 (1,null,1,2,null,1,Date('2017-06-21'), Time('12:00:00'), '7 vs 7','team 1 win ',1,2,Date('2016-06-21'),CURRENT_TIMESTAMP),
 (1,2,1,2,'2 - 1',1,Date('2017-03-21'), Time('12:00:00'), '5 vs 5','team 1 win ',1,2,Date('2016-06-21'),CURRENT_TIMESTAMP)