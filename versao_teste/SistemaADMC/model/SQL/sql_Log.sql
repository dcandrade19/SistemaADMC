create table if not exists log(
	id int(11) not null AUTO_INCREMENT,
    objeto varchar(255) not null,
    mensagem text,
    tipo varchar(255),
    tabela varchar(255),
    
    PRIMARY KEY(id)
);