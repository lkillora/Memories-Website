create database if not exists thelist_db;
use thelist_db;

drop table if exists moments;
create table moments(
id int(5) auto_increment, 
moment varchar(500),
location varchar(500),
time varchar(100), 
story varchar(2500), 
primary key (id)
);

create table if not exists images(
pic_id int(5) not null auto_increment,
moment_id int(4),
pic mediumblob not null,
primary key (pic_id)
);

create table if not exists videos(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  moment_id int(4),
  name varchar(255) NOT NULL,
  location varchar(255) NOT NULL
);

insert into moments (moment, location, time) values 
('That time that...', "Dublin", "2018"), 
("The other time that...", "Dublin", "2019");