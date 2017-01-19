create database sportTogether;

use sportTogether;

drop table teams;

drop table players;


update players set role = "captain" where id = 1;

CREATE TABLE players
(
id int auto_increment primary key,
player_name text,
position text,
role text,
int_team_id bigint(20) unsigned,
day_joined date,
facebook_id bigint(20) unsigned,
last_login datetime,
access_token text,
email text,
first_time BIT, 
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(int_team_id) REFERENCES teams(id)
);

select * from players;
insert into players (player_name, position, int_team_id, day_joined, facebook_id, username) VALUES('Phuong','defense','1','02-02-2016',1111,
		'PhuongFB');
INSERT INTO teams
    		  (team_name,
    		   description,
    		created_at) VALUES
    		("Team A","This is it.", now())
CREATE TABLE teams

(
id bigint(20) unsigned auto_increment primary key,
team_name text,
description text,
number_of_player int,
win int,
loss int,
draw int,
score int,
num_on_time int,
num_late int,
num_canceled int,
rating int,
ranking int,
fair_play int,
num_show_up int,
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



select * from teams;
drop table teams;

select * from games;

create table games (
id bigint(20) unsigned auto_increment primary key,
int_home_team bigint(20) unsigned,
int_guest_team bigint(20) unsigned,
int_team_win bigint(20) unsigned,
int_team_lose bigint(20) unsigned,
result text,
int_field_id bigint(20) unsigned,
date_played Date,
time_played time,
game_type text,
message text,
home_team_rating int,
guest_team_rating int,
cancelled_by_int_team bigint(20) unsigned, 
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(int_home_team) REFERENCES teams(id),
FOREIGN KEY(int_guest_team) REFERENCES teams(id),
FOREIGN KEY(int_team_win) REFERENCES teams(id),
FOREIGN KEY(int_team_lose) REFERENCES teams(id),
FOREIGN KEY(int_field_id) REFERENCES soccer_fields(id)
);

drop table games

select * from games;

insert into games values (1,2,1,2, '2 - 1',1,Date('2016-06-21'), Time('12:00:00'), '5 vs 5','team 1 win ',1,2,Date('2016-06-21'),CURRENT_TIMESTAMP);
insert into games (int_home_team,int_guest_team,int_team_win,int_team_lose,result,
int_field_id,date_played,time_played,game_type,message,home_team_rating,guest_team_rating,cancelled_by_int_team,created_at)
 values (1,2,1,2,'2 - 1',1,Date('2016-06-21'), Time('12:00:00'), '5 vs 5','team 1 win ',1,2,Date('2016-06-21'),CURRENT_TIMESTAMP)
truncate games

create table soccer_fields (
id bigint(20) unsigned auto_increment primary key,
field_name text,
address text,
district text,
city text,
steet text,
number int,
num_booked int,
num_canceled int,
day_joined datetime,
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table field_owners(
id bigint(20) unsigned auto_increment primary key,
facebook_id bigint(20) unsigned,
username text,
int_field_id bigint(20) unsigned,
owner_name text,
field_booked_count int,
income bigint(20) unsigned,
day_joined datetime,
updated_at timestamp NOT NULL DEFAULTt
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(int_field_id) REFERENCES soccer_fields(id)
);


create table team_join_request(
id bigint(20) unsigned auto_increment primary key,
team_id bigint(20) unsigned not null,
player_id in unsigned not null,
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(team_id) REFERENCES teams(id),
FOREIGN KEY(player_id) REFERENCES players(id)
);