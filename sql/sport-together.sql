create database sportTogether;

use sportTogether;

drop table teams;

CREATE TABLE players
(
id int auto_increment primary key,
player_name text,
position text,
int_team_id bigint(20) unsigned,
day_joined date,
facebook_id bigint(20) unsigned,
username text,
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(int_team_id) REFERENCES teams(id)
);

select * from players;
insert into players (player_name, position, int_team_id, day_joined, facebook_id, username) VALUES('Player1','defense','1','02-02-2016',1111,
		'helllo');

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

create table games (
id bigint(20) unsigned auto_increment primary key,
int_home_team bigint(20) unsigned,
int_guest_team bigint(20) unsigned,
int_team_win bigint(20) unsigned,
int_team_lose bigint(20) unsigned,
result text,
int_field_id bigint(20) unsigned,
time_played datetime,
home_team_rating int,
guest_team_rating int,
created_at datetime not null,
updated_at timestamp NOT NULL DEFAULT
 CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(int_home_team) REFERENCES teams(id),
FOREIGN KEY(int_guest_team) REFERENCES teams(id),
FOREIGN KEY(int_team_win) REFERENCES teams(id),
FOREIGN KEY(int_team_lose) REFERENCES teams(id),
FOREIGN KEY(int_field_id) REFERENCES soccer_field(id)
);


create table soccer_field (
id bigint(20) unsigned auto_increment primary key,
address text,
district text,
city text,
steet text,
number int,
num_booked int,
num_canceled int,
day_joined datetime,
created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp
);

create table field_owner(
id bigint(20) unsigned auto_increment primary key,
facebook_id bigint(20) unsigned,
username text,
int_field_id bigint(20) unsigned,
owner_name text,
day_joined datetime,
field_booked_count int,
income bigint(20) unsigned,
day_joined datetime,
created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp,
FOREIGN KEY(int_field_id) REFERENCES soccer_field(id)

)