Drop database if exists calendar;
Create database calendar;
Use calendar;

Drop table if exists events;
Create table if not exists events (
	id int(11) not null auto_increment,
	name varchar(255) not null,
	description text,
	date_start datetime not null,
	date_end datetime not null,
	primary key (id)
) ENGINE=InnoDB;

Insert into events values
(1, "Evénement de test", null, "2021-04-02 13:25:11", "2021-04-02 15:00:01");
