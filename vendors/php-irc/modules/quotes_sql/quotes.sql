# SVN FILE: $Id$
create table quotes (
	id int default null,
	deleted tinyint(1) default 0,
	author varchar(50) default "",
	quote text,
	channel varchar(100) default "",
	time int,
	key(id)
);