create table posts(
id int primary key auto_increment,
author varchar(50),
content text
);

insert into posts (author, content) values ('Ribamar FS', 'Primeiro post');
insert into posts (author, content) values ('Tiago FS', 'Segundo post');
insert into posts (author, content) values ('Elias FS', 'Terceiro post');
insert into posts (author, content) values ('Fátima FS', 'Quarto post');
