<<<<<<< HEAD
create table if not exists despesas(
	id int(11) not null AUTO_INCREMENT,
    titulo varchar(255) not null,
    descricao text,
    valor decimal(10,2) not null,
    
    PRIMARY KEY(id)
=======
create table if not exists despesas(
	id int(11) not null AUTO_INCREMENT,
    titulo varchar(255) not null,
    descricao text,
    valor decimal(10,2) not null,
    
    PRIMARY KEY(id)
>>>>>>> 383c10ba9d48ad89772a8dd6c1115cb2aaa3efe1
);