/*	Endrer tegnsett i databasen
*/

alter database wpg25 character set utf8;

/*	Fjerner tabeller hvis de allerede eksisterer
*/

drop table if exists Auth, Post_Meta, Page_Meta, Comment_Meta, Categorization, Tag, Comment, Permissions, Profile;
drop table if exists Post, Page, Author, Category, User;

/*	Setter opp tabeller
*/

create table if not exists User (
	user_id int(4) auto_increment not null,
	user_name varchar(20) not null,
	primary key (user_id)
);

create table if not exists Permissions (
	user_id int(4) not null,
	is_root_user int(1) not null,
	is_administrator int(1) not null,
	is_banned int(1) not null,
	can_create_posts int(1) not null,
	can_edit_own_posts int(1) not null,
	can_delete_own_posts int(1) not null,
	can_edit_other_posts int(1) not null,
	can_delete_other_posts int(1) not null,
	can_create_pages int(1) not null,
	can_edit_pages int(1) not null,
	can_delete_pages int(1) not null,
	can_delete_comments int(1) not null,
	can_access_settings int(1) not null,
	primary key (user_id),
	foreign key (user_id) references User (user_id) on delete cascade
);

create table if not exists Auth (
	user_id int(4) not null,
	hash varchar(1024) not null,
	primary key (user_id),
	foreign key (user_id) references User (user_id) on delete cascade
);

create table if not exists Profile (
	user_id int(4) not null,
	user_display_name varchar(50) not null,
	user_email_address varchar(50) not null,
	user_homepage_url varchar(50),
	user_facebook_url varchar(50),
	user_twitter_url varchar(50),
	user_profile_description varchar(256) not null,
	user_photo blob,
	primary key (user_id),
	foreign key (user_id) references User (user_id) on delete cascade
);

create table if not exists Post (
	post_id int(4) auto_increment not null,
	post_title varchar(200) not null,
	post_data blob not null,
	primary key (post_id)
);

create table if not exists Post_Meta (
	post_id int(4) not null,
	post_published varchar(100) not null,
	post_last_modified varchar(100) not null,
	post_published_by int(4) not null,
	post_last_modified_by int(4) not null,
	primary key (post_id),
	foreign key (post_id) references Post (post_id) on delete cascade,
	foreign key (post_published_by) references User (user_id),
	foreign key (post_last_modified_by) references User (user_id)
);

create table if not exists Page (
	page_id int(4) auto_increment not null,
	page_title varchar(200) not null,
	page_data blob not null,
	primary key (page_id)
);

create table if not exists Page_Meta (
	page_id int(4) not null,
	page_published varchar(100) not null,
	page_last_modified varchar(100) not null,
	page_published_by int(4) not null,
	page_last_modified_by int(4) not null,
	primary key (page_id),
	foreign key (page_id) references Page (page_id) on delete cascade,
	foreign key (page_published_by) references User (user_id),
	foreign key (page_last_modified_by) references User (user_id)
);

create table if not exists Category (
	category_id int(4) auto_increment not null,
	category_name varchar(200) not null,
	primary key (category_id)
);

create table if not exists Categorization (
	categorization_id int(4) auto_increment not null,
	post_id int(4) not null,
	category_id int(4) not null,
	primary key (categorization_id),
	foreign key (post_id) references Post (post_id) on delete cascade,
	foreign key (category_id) references Category (category_id) on delete cascade
);

create table if not exists Tag (
	tag_id int(4) auto_increment not null,
	tag_name varchar(200) not null,
	post_id int(4) not null,
	primary key (tag_id),
	foreign key (post_id) references Post (post_id) on delete cascade
);

create table if not exists Author (
	author_id int(4) auto_increment not null,
	author_name varchar(200) not null,
	author_email varchar(200) not null,
	author_url varchar(200),
	primary key (author_id)
);

create table if not exists Comment (
	comment_id int(4) auto_increment not null,
	comment_title varchar(200) not null,
	comment_data blob not null,
	post_id int(4) not null,
	primary key (comment_id),
	foreign key (post_id) references Post (post_id) on delete cascade
);

create table if not exists Comment_Meta (
	comment_id int(4) not null,
	comment_published varchar(100) not null,
	comment_published_by int(4) not null,
	primary key (comment_id),
	foreign key (comment_id) references Comment (comment_id) on delete cascade,
	foreign key (comment_published_by) references Author (author_id)
);

/* Setter inn litt tabelldata
*/

insert into User (user_id, user_name) values (1, 'admin');
insert into Profile (user_id, user_display_name, user_email_address, user_profile_description) values (1, 'Administrator', 'lets@go.org', 'Jeg er administratoren her på siden!');
insert into Auth (user_id, hash) values (1, 'ZTA5YjhlNDZhMmE2ZmU1ODJiMTQ3YjA4YTg3YTU3N2M5YjA0Zjg3Y2ZhZWEzZDAxYmFlMjFmN2FjZDZlN2RjMWJkNzY0NDA5MzhmYjg0ZDFmNDc1MzZlZDNlNTA1YTU5MDExOWE0MTYxNmZmYTA3Njk5YjY2MDBhOTk2OWIyYTQ=');

insert into Category (category_id, category_name) values (1, 'Ukategorisert');

insert into Post (post_id, post_title, post_data) values (1, 'Dette er den første bloggposten', 'Velkommen til din nye blogg! Dersom du ønsker kan du slette denne posten, eller bare redigere den dersom du vil det. Håper du får en morsom opplevelse med vårt CMS! Hilsen gruppe 25');
insert into Post_Meta (post_id, post_published, post_last_modified, post_published_by, post_last_modified_by) values (1, '13-11-2013, 13:16', '13-11-2013, 13:16', 1, 1);
insert into Categorization (post_id, category_id) values (1, 1);
insert into Tag (post_id, tag_name) values (1, 'CMS');
insert into Tag (post_id, tag_name) values (1, 'Blogg');

insert into Page (page_id, page_title, page_data) values (1, 'Om denne nettsiden', 'Dette er en nettside som demonsterer CMS-systemet gruppe 25 laget i faget Webprosjekt ved HiOA, høsten 2013. Gi oss gjerne tilbakemelding dersom du synes systemet vårt virker spennende!');
insert into Page_Meta (page_id, page_published, page_last_modified, page_published_by, page_last_modified_by) values (1, '13-11-2013, 13:23', '13-11-2013, 13:23', 1, 1);

insert into Author (author_id, author_name, author_email) values (1, 'Mr. CMS', 'mistercms@fakety.fake');
insert into Comment (comment_id, comment_title, comment_data, post_id) values (1, 'Heisann!', 'Utrolig kul nettside du har laget! Går det an å laste ned dette CMS-et som du bruker, eller?', 1);
insert into Comment_Meta (comment_id, comment_published, comment_published_by) values (1, '13-11-2013, 13:26', 1);