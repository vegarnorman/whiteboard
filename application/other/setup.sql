drop table if exists Auth, Post_Meta, Page_Meta, Comment_Meta, Categorization, Tag, Comment;
drop table if exists Post, Page, Author, Category, User;

create table if not exists User (
	user_id int(4) auto_increment not null,
	user_name varchar(200) not null,
	primary key (user_id)
);

create table if not exists Auth (
	user_id int(4) not null,
	hash varchar(1024) not null,
	primary key (user_id),
	foreign key (user_id) references User (user_id)
);

create table if not exists Post (
	post_id int(4) auto_increment not null,
	post_title varchar(200) not null,
	post_data blob not null,
	primary key (post_id)
);

create table if not exists Post_Meta (
	post_id int(4) not null,
	post_published timestamp not null,
	post_last_modified timestamp not null,
	post_published_by int(4) not null,
	post_last_modified_by int(4) not null,
	primary key (post_id),
	foreign key (post_id) references Post (post_id),
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
	page_published timestamp not null,
	page_last_modified timestamp not null,
	page_published_by int(4) not null,
	page_last_modified_by int(4) not null,
	primary key (page_id),
	foreign key (page_id) references Page (page_id),
	foreign key (page_published_by) references User (user_id),
	foreign key (page_last_modified_by) references User (user_id)
);

create table if not exists Category (
	category_id int(4) auto_increment not null,
	category_name varchar(200) not null,
	primary key (category_id)
);

create table if not exists Categorization (
	post_id int(4) not null,
	category_id int(4) not null,
	primary key (post_id, category_id),
	foreign key (post_id) references Post (post_id),
	foreign key (category_id) references Category (category_id)
);

create table if not exists Tag (
	tag_id int(4) auto_increment not null,
	tag_name varchar(200) not null,
	post_id int(4) not null,
	primary key (tag_id),
	foreign key (post_id) references Post (post_id)
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
	foreign key (post_id) references Post (post_id)
);

create table if not exists Comment_Meta (
	comment_id int(4) not null,
	comment_published timestamp not null,
	comment_published_by int(4) not null,
	primary key (comment_id),
	foreign key (comment_published_by) references Author (author_id)
);