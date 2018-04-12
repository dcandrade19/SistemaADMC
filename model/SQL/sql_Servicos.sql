create table if not exists servicos(
	id int(11) not null AUTO_INCREMENT,
    situacao varchar(255) not null,
    valor decimal(11, 2) not null,
    descricao text,
    id_solicitante int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_solicitante) REFERENCES moradores(id)
);