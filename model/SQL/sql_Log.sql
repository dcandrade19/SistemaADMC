<<<<<<< HEAD
create table if not exists log(
	id int(11) not null AUTO_INCREMENT,
    objeto varchar(255) not null,
    mensagem text,
    tipo varchar(255),
    tabela varchar(255),
    
    PRIMARY KEY(id)
=======
create table if not exists log(
	id int(11) not null AUTO_INCREMENT,
    objeto varchar(255) not null,
    mensagem text,
    tipo varchar(255),
    tabela varchar(255),
    
    PRIMARY KEY(id)
>>>>>>> 383c10ba9d48ad89772a8dd6c1115cb2aaa3efe1
);