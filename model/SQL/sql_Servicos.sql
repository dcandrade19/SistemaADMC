<<<<<<< HEAD
create table if not exists servicos(
	id int(11) not null AUTO_INCREMENT,
    situacao varchar(255) not null,
    descricao text,
    id_despesa int,
    id_solicitante int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_despesa) REFERENCES despesas(id)
    FOREIGN KEY (id_solicitante) REFERENCES moradores(id)
=======
create table if not exists servicos(
	id int(11) not null AUTO_INCREMENT,
    situacao varchar(255) not null,
    descricao text,
    id_despesa int,
    id_solicitante int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_despesa) REFERENCES despesas(id)
    FOREIGN KEY (id_solicitante) REFERENCES moradores(id)
>>>>>>> 383c10ba9d48ad89772a8dd6c1115cb2aaa3efe1
);