# SVN FILE: $Id$
create table message (
	id int auto_increment,
	sender varchar(50)
	default "",
	recipient varchar(50) default "",
	mesg text,
	seen int default 0,
	private int default 0,
	key(id)
);

create table messagepending (
	recipient varchar(50) default ""
);