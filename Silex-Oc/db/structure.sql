drop table if exists t_link;
drop table if exists t_user;

create table t_user (
    user_id integer not null primary key auto_increment,
    user_name varchar(50) not null,
    user_password varchar(88) not null,
    user_salt varchar(23) not null,
    user_role varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_link (
    link_id integer not null primary key auto_increment,
    link_title varchar(500) not null,
    link_url varchar(200) not null,
    user_id integer not null,
    constraint fk_link_usr foreign key(user_id) references t_user(user_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;
