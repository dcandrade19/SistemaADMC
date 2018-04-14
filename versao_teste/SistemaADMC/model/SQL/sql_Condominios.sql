create table if not exists condominios(
	id int(11) not null AUTO_INCREMENT,
    nome varchar(255) not null,
    endereco varchar(255) not null,
    status int(1) not null,
    
    PRIMARY KEY(id)   
);