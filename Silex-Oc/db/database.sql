create database if not exists weblinks character set utf8 collate utf8_unicode_ci;
use weblinks;

grant all privileges on weblinks.* to 'weblinks_user'@'localhost' identified by 'secret';
