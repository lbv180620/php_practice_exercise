create database php_work;

show database;

use php_work;

create table todo_items (
    id int auto_increment not null primary key,
    expiration_date date not null,
    todo_item varchar(100) not null,
    is_completed tinyint default 0 not null,
)
default charset=utf8mb4_general_ci
;

show tables;
