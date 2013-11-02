alter database wpg25 character set utf8;

drop table if exists Auth, Post_Meta, Page_Meta, Comment_Meta, Categorization, Tag, Comment, Permissions, Profile;
drop table if exists Post, Page, Author, Category, User;

create table if not exists User (
	user_id int(4) auto_increment not null,
	user_name varchar(200) not null,
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
	user_homepage_url varchar(50) not null,
	user_facebook_url varchar(50) not null,
	user_twitter_url varchar(50) not null,
	user_profile_description varchar(256) not null,
	user_photo blob not null,
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
	post_published timestamp not null,
	post_last_modified timestamp not null,
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
	page_published timestamp not null,
	page_last_modified timestamp not null,
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
	comment_published timestamp not null,
	comment_published_by int(4) not null,
	primary key (comment_id),
	foreign key (comment_id) references Comment (comment_id) on delete cascade,
	foreign key (comment_published_by) references Author (author_id)
);